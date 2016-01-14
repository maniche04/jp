<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class SettingsController extends Controller
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
    public function setLayout($value)
    {
        $userid = \Auth::user()->id;
        \DB::statement("UPDATE users SET defaultview = '" . $value . "' WHERE id = " . $userid);
    }
}
