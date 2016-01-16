<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
    * The landing page for Administrators.
    *
    */
    public function index() {
        return view('admin.adminlanding');
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


    public function runItemUpdate($filename)
    {
         \Excel::load("public\uploads\\" . $filename , function($reader) {

            $results = $reader->get();

            date_default_timezone_set("Asia/Dubai");
            $count = 0;
            //echo count($results);
            $total = count($results);
            $this->setProgress('items','0');
            $response = '';

            foreach ($results as $result) {
                //loop through all of the input item codes
                $itemdata = [];
                $itemdata['itemcode'] = $result->itemcode;
                $itemdata['itemname'] = $result->itemname;
                //$itemdata['brand'] = $result->brand;
                //$itemdata['gender'] = $result->gender;
                //$itemdata['size'] = $result->size;
                //$itemdata['type'] = $result->type;
                //$itemdata['imgurl'] = $result->imgurl;
                $itemdata['isactive'] = $result->isactive;
                $itemdata['isnew'] = $result->isnew;
                $itemdata['updatedby'] = \Auth::user()->id;

                // if (!\DB::select("SELECT itemcode FROM itemmas WHERE itemcode = '" . $itemdata['itemcode'] . "'")) {
                    \DB::table('itemmas')->insert($itemdata);
                // } else {
                //     //TODO: Error! Item already exists
                // }
                $count = $count + 1;
                $progress = round($count / $total * 100);
                $response = $response . '<br>' . $progress;
                $this->setProgress('items',$progress);
           }
           echo $total . ' is the total';
           echo $response;
           //echo $count . " items checked!";
        });
    }

    public function uploadItems() {
        $filename = $this->upload();

        //check file integrity here
        return view('admin.updateitemsprocess',array('filename'=>$filename));
        //echo 'TEST!';

    }

    public function upload() {
        $destinationPath = '';
        $filename        = '';

        if (Input::hasFile('file')) {
            $file            = Input::file('file');
            $destinationPath = public_path() . "/uploads/";
            $filename        = str_random(6) . '_' . $file->getClientOriginalName();
            $uploadSuccess   = $file->move($destinationPath, $filename);
        }

        return $filename;
    }

    public function setProgress($type, $value) {
        \Session::set('progress_' . $type, $value);
    }

    public function getProgress($type) {
        \Session::get('progress_' . $type);
    }

    public function updateItems() {
        return view('admin.updateitems');
    }



}
