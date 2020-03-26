<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;


class PaymentController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayment()
    {
        
        return view('payment');
    }


    public function razorPaySuccess(Request $Request){
//      $data = [
//                'user_id' => '1',
//                'payment_id' => $request->payment_id,
//                'amount' => $request->amount,
//             ];
    //  $getId = Payment::insertGetId($data);  
      $arr = array('msg' => 'Payment successfully credited', 'status' => true);
      return Response()->json($arr);    
    }
    
    public function RazorThankYou()
    {
        return view('thankyou');
    }
}