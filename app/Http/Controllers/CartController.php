<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

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
        $selqty = Input::get('selqty');

        $itemdata = \DB::select("SELECT A.itemcode, B.aedprice, B.usdprice, B.ispromo, B.promodisc FROM itemmas A LEFT JOIN itemprices B ON A.itemcode = B.itemcode WHERE B.classid IN (SELECT classid FROM users WHERE id = 1) AND A.ID = " . $itemid);

        $cartitem = [];
        $cartitem['userid'] = \Auth::user()->id;
        $cartitem['itemcode'] = $itemdata[0]->itemcode;
        $cartitem['selqty'] = $selqty;
    
        $cartitem['itemrate'] = $itemdata[0]->aedprice * (1 - $itemdata[0]->promodisc);
        $cartitem['currency'] = \Auth::user()->currency;
        $cartitem['totalprice'] = $cartitem['selqty'] * $cartitem['itemrate'];
        $cartitem['updatedby'] = \Auth::user()->id;

        \DB::table('currentcart')->insert($cartitem);
    }
}
