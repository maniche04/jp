<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class AdminController extends Controller
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
    public function updatePrices()
    {
        //return view('admin.adminlanding');
        \Excel::load("public\data\Prices.xlsx", function($reader) {

            $results = $reader->get();

            date_default_timezone_set("Asia/Dubai");
            $insertcount = 0;
            foreach ($results as $result) {
                //loop through all of the input item codes
                $pricedata = [];
                $pricedata['classid'] = $result->custgroup;
                $pricedata['itemcode'] = $result->itemcode;
                $pricedata['aedprice'] = $result->aedprice;
                $pricedata['usdprice'] = $result->usdprice;
                $pricedata['lastaedprice'] = 0;
                $pricedata['lastusdprice'] = 0;
                $pricedata['ispromo'] = $result->ispromo;
                $pricedata['promodisc'] = $result->promodisc;
                $pricedata['updatedby'] = \Auth::user()->id;
                $pricedata['isactive'] = 1;

                if (\DB::statement("UPDATE itemprices SET isactive = 0 WHERE itemcode = '" . $result->itemcode . "' AND classid = " . $result->custgroup)) {
                    \DB::table('itemprices')->insert($pricedata);
                    $insertcount = $insertcount + 1;
                }
           }

           echo $insertcount . " items updated!";
        });
    }


    public function updateItemMaster()
    {
         \Excel::load("public\data\Items.xlsx", function($reader) {

            $results = $reader->get();

            date_default_timezone_set("Asia/Dubai");
            $insertcount = 0;
            foreach ($results as $result) {
                //loop through all of the input item codes
                $pricedata = [];
                $pricedata['classid'] = $result->custgroup;
                $pricedata['itemcode'] = $result->itemcode;
                $pricedata['aedprice'] = $result->aedprice;
                $pricedata['usdprice'] = $result->usdprice;
                $pricedata['lastaedprice'] = 0;
                $pricedata['lastusdprice'] = 0;
                $pricedata['ispromo'] = $result->ispromo;
                $pricedata['promodisc'] = $result->promodisc;
                $pricedata['updatedby'] = \Auth::user()->id;
                $pricedata['isactive'] = 1;

                if (\DB::statement("UPDATE itemprices SET isactive = 0 WHERE itemcode = '" . $result->itemcode . "' AND classid = " . $result->custgroup)) {
                    \DB::table('itemprices')->insert($pricedata);
                    $insertcount = $insertcount + 1;
                }
           }

           echo $insertcount . " items updated!";
        });
    }


    public function syncItems() {
        
    }
}
