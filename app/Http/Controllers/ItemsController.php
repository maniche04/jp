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
        return view('items.itemlanding', array('itemlist'=>$items));
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
        $sqlquery = "SELECT A.*, B.aedprice, B.usdprice, B.ispromo, B.promodisc, C.currstock, C.laststock, IFNULL(D.selqty,0) as selqty FROM itemmas A
        LEFT JOIN itemprices B ON A.itemcode = B.itemcode LEFT JOIN itemstocks C ON A.itemcode = C.itemcode LEFT JOIN currentcart D ON A.itemcode = D.itemcode AND D.userid = 1 WHERE B.classid IN (SELECT classid FROM users WHERE id = 1) ";


        if (strlen($hotkey) > 0) {
            $items = \DB::select($sqlquery . " AND A.itemname LIKE '%" . $hotkey . "%'");      

        } else {
            $items = \DB::select($sqlquery . " LIMIT 100");      
        }

        
        return view('items.itemgrid', array('itemlist'=>$items));
    }
}
