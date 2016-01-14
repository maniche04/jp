<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Add new item to the Customer Cart.
     *
     * @return Response
     */
    public function add()
    {
        $itemid = Input::get('itemid');
        $userid = \Auth::user()->id;
        $selqty = Input::get('selqty');

        $itemdata = \DB::select("SELECT A.itemcode, B.aedprice, B.usdprice, B.ispromo, B.promodisc FROM itemmas A LEFT JOIN itemprices B ON A.itemcode = B.itemcode WHERE A.isactive = 1 AND B.isactive = 1 AND B.classid IN (SELECT classid FROM users WHERE id = " . $userid . ") AND A.ID = " . $itemid);

        $cartitem = [];
        $cartitem['userid'] = \Auth::user()->id;
        $cartitem['itemcode'] = $itemdata[0]->itemcode;
        $cartitem['selqty'] = $selqty;
        $cartitem['currency'] = \Auth::user()->currency;

        if ($cartitem['currency'] == 'AED') {
            $itemrate = $itemdata[0]->aedprice;
        } else {
            $itemrate = $itemdata[0]->usdprice;
        }


        if ($itemdata[0]->ispromo == 1) {
            $cartitem['itemrate'] = number_format($itemrate * (1 - ($itemdata[0]->promodisc/100)),2); 
        } else {
            $cartitem['itemrate'] = $itemrate; 
        }

        $cartitem['totalprice'] = $cartitem['selqty'] * $cartitem['itemrate'];
        $cartitem['updatedby'] = \Auth::user()->id;

        \DB::table('currentcart')->insert($cartitem);

        //dd($cartitem);
    }


    public function remove()
    {
        $itemid = Input::get('itemid');
        $userid = \Auth::user()->id;
        $delqry = "DELETE FROM currentcart WHERE itemcode IN (SELECT itemcode FROM itemmas WHERE id = " . $itemid . ") AND userid = " . $userid;
        if (\DB::statement($delqry)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function getbox() {
        $userid = \Auth::user()->id;
        $cart = \DB::select("SELECT COUNT(*) as numitems, SUM(totalprice) as totalprice, SUM(selqty) as quantity FROM currentcart WHERE userid = " . $userid);
        $currency = \DB::select("SELECT currency FROM users WHERE id = " . $userid);
        return view('cart.cartbox', array('cart'=>$cart, 'currency'=>$currency));
    }
}
