<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class ItemsController extends Controller
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
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        $items = \DB::table('itemmas')->get();
        $defaultview = \Auth::user()->defaultview;
        return view('items.itemlanding', array('itemlist'=>$items, 'view'=>$defaultview));
    }

        /**
     * Searches for the items
     *
     * @return Response
     */
    public function search()
    {
        $hotkey = Input::get('hotkey');
        $userid = \Auth::user()->id;
        $usercurrency = \Auth::user()->currency;
        $resultstr = '';
        $sqlquery = "SELECT A.*, B.aedprice, B.usdprice, B.ispromo, B.promodisc, C.currstock, C.laststock, IFNULL(D.selqty,0) as selqty, D.currency as cartcurr, D.totalprice as cartitemtot FROM itemmas A
        LEFT JOIN itemprices B ON A.itemcode = B.itemcode LEFT JOIN itemstocks C ON A.itemcode = C.itemcode LEFT JOIN currentcart D ON A.itemcode = D.itemcode AND D.userid = " . $userid . " WHERE A.isactive = 1 AND B.isactive = 1 AND C.isactive = 1 AND B.classid IN (SELECT classid FROM users WHERE id = " . $userid . ") ";


        if (strlen($hotkey) > 0) {
            $items = \DB::select($sqlquery . " AND A.itemname LIKE '%" . $hotkey . "%'");      
            $resultstr = count($items) . ' matching item(s)';
        } else {
            $items = \DB::select($sqlquery . " LIMIT 100");
        }

        $defaultview = \Auth::user()->defaultview;

        if ($defaultview == 'grid') {
            return view('items.itemgrid', array('itemlist'=>$items, 'currency'=>$usercurrency,'result'=>$resultstr));
        } else {
            return view('items.itemlist', array('itemlist'=>$items, 'currency'=>$usercurrency,'result'=>$resultstr));
        }
    }
}
