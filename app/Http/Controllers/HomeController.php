<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $quotation = DB::table('tbl_quotation')
                  ->select('tbl_quotation.*','tbl_subscription.subscription_name','tbl_employees.name')
                  ->leftjoin('tbl_employees','tbl_employees.id','tbl_quotation.user_id')
                  ->leftjoin('tbl_subscription','tbl_subscription.id','tbl_quotation.service_id')
                  ->orderBy('id','DESC')
                  ->get();
     //   echo "<pre>";print_r($quotation);exit;
        return view('home',['quotation'=>$quotation]);
    }
}
