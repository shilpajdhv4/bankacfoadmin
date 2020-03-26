<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class UserSubscribedfield extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    function __construct()
//    {
//         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
//         $this->middleware('permission:product-create', ['only' => ['create','store']]);
//         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
//         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function showSubfield(){
//        $date = date('Y-m-d');
//        $nameOfDay = ltrim(date('d', strtotime($date)),"0");
//        $month = date('m',strtotime($date));
//        $year = date('Y',strtotime($date));
//        $result = DB::table('tbl_services_subscribed as tbl1')
//                ->select('tbl1.user_id','tbl1.subscription_id','tbl1.service_date','tbl2.field_title','tbl2.is_office_only','tbl2.id','tbl2.recurring_reminder_day')
//                ->leftjoin('tbl_subscription_fields as tbl2','tbl2.id','tbl1.subscription_id')
//                ->where(['tbl1.is_active'=>0,'tbl2.is_recurring'=>1,'tbl2.recurring_frequency'=>'Monthly','tbl2.recurring_reminder_day'=>$nameOfDay])
//                ->get();
//        echo "<pre>";print_r($result);exit;
        
        
        $detail = DB::table('tbl_services_subscribed')
                ->select('tbl_employees.name','tbl_services_subscribed.user_id')
                ->leftjoin('tbl_employees','tbl_employees.id','tbl_services_subscribed.user_id')
                ->distinct()
                ->get();
        return view('user_subscription_data.subscription_field',['detail'=>$detail]);
    }
    
    public function showServices()
    {
        $id=$_GET['id'];
        $detail = DB::table('tbl_services_subscribed')
                ->select('tbl_subscription.subscription_name', 'tbl_vertical.vertical_name', 'tbl_subscription.id', 'tbl_subscription.text_to_be_display','tbl_subscription.subscription_price','tbl_services_subscribed.user_id')
                ->leftjoin('tbl_subscription', 'tbl_subscription.id', 'tbl_services_subscribed.subscription_id')
                ->leftjoin('tbl_vertical', 'tbl_vertical.id', 'tbl_subscription.vertical_id')
                ->where(['tbl_services_subscribed.user_id' => $id])
                ->get();
          return view('user_subscription_data.services_list',['detail'=>$detail]);
    }
    
    public function getAjaxdata($id,$id1,$id2,$id3){
//       echo $id;
//       echo $id1;
//       echo $id2;
//       echo $id3;exit;
        $office_field_data = DB::table('tbl_sub_client_fields')
            ->select('tbl_sub_client_fields.*', 'tbl_subscription_fields.field_title', 'tbl_subscription_fields.field_type', 'tbl_subscription_fields.field_extras')
            ->leftjoin('tbl_subscription_fields', 'tbl_subscription_fields.id', '=', 'tbl_sub_client_fields.field_id')
            ->where(['tbl_sub_client_fields.subscription_id' => $id2])
            ->where(['tbl_sub_client_fields.is_office_only' => 1])
            ->where(['client_id' => $id3])
            ->where(['rec_month' => $id, 'rec_year' => $id1])
            ->get();
        $client_field_data = DB::table('tbl_sub_client_fields')
            ->select('tbl_sub_client_fields.*', 'tbl_subscription_fields.field_title', 'tbl_subscription_fields.field_type', 'tbl_subscription_fields.field_extras')
            ->leftjoin('tbl_subscription_fields', 'tbl_subscription_fields.id', '=', 'tbl_sub_client_fields.field_id')
            ->where(['tbl_sub_client_fields.subscription_id' => $id2])
            ->where(['tbl_sub_client_fields.is_office_only' => 0])
            ->where(['client_id' => $id3])
            ->where(['rec_month' => $id, 'rec_year' => $id1])
            ->get();
        if(count($office_field_data)>0 || count($client_field_data)>0){
//            echo "in if";
//        echo "<pre>"; print_r($office_field_data);exit;
            return view('user_subscription_data.field_data',['office_field_data'=>$office_field_data,'client_field_data'=>$client_field_data]);
        }else{
            echo "Data Does Not Exists !";
        }
        
    }

    public function showClientForm()
    {
        $data=explode("!",$_GET['id']);
        $user_id=$data[1];
        $sub_id=$data[0];
        $form_data = DB::table('tbl_sub_client_fields')
                    ->select('tbl_sub_client_fields.*', 'tbl_subscription_fields.field_title', 'tbl_subscription_fields.field_type', 'tbl_subscription_fields.field_extras')
                    ->leftjoin('tbl_subscription_fields', 'tbl_subscription_fields.id', '=', 'tbl_sub_client_fields.field_id')
                    ->where(['tbl_sub_client_fields.subscription_id' => $data[0]])
                    ->where(['tbl_subscription_fields.is_office_only' => 0])
                    ->where(['tbl_sub_client_fields.subscription_id' => $sub_id, 'client_id' => $user_id])
                    ->get();
          
        $office_data = DB::table('tbl_sub_client_fields')
                    ->select('tbl_sub_client_fields.*', 'tbl_subscription_fields.field_title', 'tbl_subscription_fields.field_type', 'tbl_subscription_fields.field_extras')
                    ->leftjoin('tbl_subscription_fields', 'tbl_subscription_fields.id', '=', 'tbl_sub_client_fields.field_id')
                    ->where(['tbl_sub_client_fields.subscription_id' => $data[0]])
                    ->where(['tbl_subscription_fields.is_office_only' => 1])
                    ->where(['tbl_sub_client_fields.subscription_id' => $sub_id])
                    ->get();
//       echo "<pre/>"; print_r($form_data);
//        return view('user_subscription_data.show_client_form',['form_data'=>$form_data]);
        return view('user_subscription_data.create',['form_data'=>$form_data,'office_data'=>$office_data,'sub_id'=>$sub_id,'user_id'=>$user_id]);
    }
    
    public function updateOfficefield(Request $request)
    {
        $requestData = $request->all();
        $ndata = $sub_id = $client_id = '';
//         echo "<pre>";
//         print_r($requestData);
//         exit;
         
//         foreach ($requestData['office_form'] as $client_data){
//             echo "<pre>";
//         print_r($client_data);
//         exit;
            foreach ($requestData['office_form'] as $key => $row) {
               $field_data = $field_data_val = $arr_k = array();
               if (is_numeric($key)) {
                   $data = \App\SubscriptionsubclientField::where(['id' => $key])->first();
                   // echo $key;
                   $sub_id=$data->subscription_id;
                   $client_id=$data->client_id;
                   $field_data = json_decode($data->field_input, true);
                   $arr_k = array_keys($field_data);
                   $id = $key;
                   $type_data = \App\SubscriptionField::select('*')->where(['id' => $id])->first();
                   // echo $type_data->field_type;
                   // exit;
                   if ($data->field_type == "singlefile") {
                       $uniqueid = uniqid();
                       $original_name = $row->getClientOriginalName();
                       $size = $row->getSize();
                       $extension = $row->getClientOriginalExtension();
                       $name = $uniqueid . '.' . $extension;
                       $path = $row->move(public_path('office_img'), $name);
                       if ($path) {
                           $row = $name;
                       }
                   }
                   if ($data->field_type == "multiplefile") {
                       $files = $row;
                       
                       foreach ($files as $file) {
//                           echo "<pre>";print_r($file);exit;
                           $uniqueid = uniqid();
                           $original_name = $file->getClientOriginalName();
                           $size = $file->getSize();
                           $extension = $file->getClientOriginalExtension();
                           $name = $uniqueid . '.' . $extension;
//                           exit;
                           $path = $file->move(public_path('office_img'), $name);
                           if ($path) {
                               $ndata .= $name . ",";
                           }
                       }
                       $row = $ndata;
                   }
                   // echo $row;
                   $field_data_val[$arr_k[0]] = $row;
                   $update_data['field_input'] = json_encode($field_data_val);
                   $update_data['is_complete'] = 'Yes';
                   $update_data['is_approved'] = '1';
                   $data->update($update_data);
               }
           }
//        }
         $update_data = array();
        foreach($requestData['client_form'] as $key=>$row){
//            echo "<pre>";print_r($key);exit;
//            foreach($client_data as $key=>$row){
                $field_data = $field_data_val = $arr_k = array();
               if (is_numeric($key)) {
                   $data = \App\SubscriptionsubclientField::where(['id' => $key])->first();
                   $sub_id=$data->subscription_id;
                   $client_id=$data->client_id;
                   if($row['is_approve'] == 0){
                       $update_data['is_complete'] = 'No';
                       $update_data['comment'] = $row['comment'];
                   }else{
                       $update_data['is_complete'] = 'Yes';
                       $update_data['comment'] = $row['comment'];
                   }
                   $update_data['is_approved'] = $row['is_approve'];
                 //  echo "<pre>";print_r($update_data);exit;
                   $data->update($update_data);
               }
//            }
        }
     //   exit;
//        foreach ($requestData as $key => $row) {
//            $field_data = $field_data_val = $arr_k = array();
//            if (is_numeric($key)) {
//                $data = \App\SubscriptionsubclientField::where(['id' => $key])->first();
//                $client_id=$data->client_id;
//                $sub_id=$data->subscription_id;
//                // echo $key;
//                $field_data = json_decode($data->field_input, true);
//                $arr_k = array_keys($field_data);
//                $id = $key;
//                $type_data = \App\SubscriptionField::select('*')->where(['id' => $id])->first();
////                 echo $type_data->field_type;
////                 exit;
//                if ($type_data->field_type == "singlefile") {
////                     print_r($row);
////                     exit;
//                    $uniqueid = uniqid();
//                    $original_name = $row->getClientOriginalName();
//                    $size = $row->getSize();
//                    $extension = $row->getClientOriginalExtension();
//                    $name = $uniqueid . '.' . $extension;
//                    $path = $row->move(public_path('office'), $name);
//                    if ($path) {
//                        $row = $name;
//                    }
//                }
//                if ($type_data->field_type == "multiplefile") {
//
//                    $files = $row;
//
//                    //var_dump($files);
//                    // print_r($files);
//                    //exit;
//                    foreach ($files as $file) {
//                        $uniqueid = uniqid();
//                        $original_name = $file->getClientOriginalName();
//                        $size = $file->getSize();
//                        $extension = $file->getClientOriginalExtension();
//                        $name = $uniqueid . '.' . $extension;
//                        $path = $file->move(public_path('office'), $name);
//                        if ($path) {
//                            $ndata .= $name . ",";
//                        }
//                    }
//                    $row = $ndata;
//                }
//                // echo $row;
//                $field_data_val[$arr_k[0]] = $row;
//                $update_data['field_input'] = json_encode($field_data_val);
//                $update_data['is_complete'] = 'Yes';
//                $update_data['is_approved'] = 1;
//                $data->update($update_data);
//            }
//        }
         $id=$sub_id."!".$client_id;
         Session::flash('alert-success','Form Updated successfully.');
         return redirect('show_client_form?id='.$id);
    }
}