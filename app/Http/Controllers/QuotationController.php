<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class QuotationController extends Controller
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
        return view('quotation.index',['quotation'=>$quotation]);
    }
    
    public function replayQuotation(){
        $id = $_GET['id'];
        $quotation = DB::table('tbl_quotation')
                  ->select('tbl_quotation.*','tbl_subscription.subscription_name','tbl_employees.name')
                  ->leftjoin('tbl_employees','tbl_employees.id','tbl_quotation.user_id')
                  ->leftjoin('tbl_subscription','tbl_subscription.id','tbl_quotation.service_id')
                  ->where(['tbl_quotation.id'=>$id])
                  ->first();
        return view('quotation.replay',['quotation'=>$quotation]);
    }
    
    public function saveReplay(Request $request, $id){
//        echo "<pre>";print_r($request->all());exit;
        $requestData = $request->all();
        if($requestData['quotation_replay'] != ""){
            $requestData['status'] = 1;
        }
        $data = \App\Quotation::findorfail($id);
        $data->update($requestData);
        return redirect('quotation_request')->with('success','Updated successfully.');
    }
}
