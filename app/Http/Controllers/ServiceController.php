<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ServiceController extends Controller
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
    public function serviceList()
    {
        $category = \App\Category::select('id','category_name')->where(['is_active'=>1])->get();
        if(isset($_GET['id'])){
            if($_GET['id'] != ""){
               $service = \App\Service::where(['category_id'=>$_GET['id'],'is_active'=>1])->get();
            }else{
               $service = \App\Service::where(['is_active'=>1])->get();
            }
        }else{
            $service = \App\Service::where(['is_active'=>1])->get();
        }
        
        return view('services.index',['service'=>$service,'category'=>$category]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceCreate()
    {
        $vertical = \App\Vertical::select('id','vertical_name')->where(['is_active'=>1])->get();
        $category = \App\Category::select('id','category_name')->where(['is_active'=>1])->get();
        return view('services.create',['vertical'=>$vertical,'category'=>$category]);
    }
    
    public function saveService(Request $request){
        $requestData = $request->all();
        request()->validate([
            'vertical_id' => 'required',
            'category_id' => 'required',
            'service_name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
        //    'upload_img' => 'required',
            'type_of_service' => 'required'
        ]);
        
        if(isset($requestData['upload_img'])){
            $design = $requestData['upload_img'];
            $filename = $design->getClientOriginalName();
            $destination= "service_img/";
            $design->move($destination,$filename);
            $requestData['upload_img'] = $filename;
        }
        
        if(isset($requestData['is_active'])){
            if($requestData['is_active'] == "on"){
                $requestData['is_active'] = 1;
            }
        }
      //  echo "<pre>";print_r($requestData);exit;
      \App\Service::create($requestData);


        return redirect('services')->with('success','Services created successfully.');
    }
    
    public function editService(){
        $id = $_GET['id'];
        $vertical = \App\Vertical::select('id','vertical_name')->where(['is_active'=>1])->get();
        $category = \App\Category::select('id','category_name')->where(['is_active'=>1])->get();
        $service = \App\Service::findorfail($id);
        return view('services.edit',['vertical'=>$vertical,'category'=>$category,'service'=>$service]);
    }

    public function update($id, Request $request){
        $requestData = $request->all();
//        echo "<pre>";print_r($requestData);exit;
        request()->validate([
            'vertical_id' => 'required',
            'category_id' => 'required',
            'service_name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'type_of_service' => 'required',
        ]);
        
        $service_det = \App\Service::findorfail($id);
        $oldFileName = $service_det->upload_img;
        if(empty($requestData['upload_img'])) {
                $requestData['upload_img'] = $oldFileName;
        }else{
            $design = $requestData['upload_img'];
            $filename = $design->getClientOriginalName();
            $destination = "service_img/";
            if($oldFileName != ""){
                unlink($destination.'/'.$oldFileName);
            }
            $design->move($destination,$filename);
            $requestData['upload_img'] = $filename;
        }
               
        if(isset($requestData['is_active'])){
            if($requestData['is_active'] == "on"){
                $requestData['is_active'] = 1;
            }
        }
      //  echo "<pre>";print_r($requestData);exit;
        $service_det->update($requestData);


        return redirect('services')
                        ->with('success','Service updated successfully.');
    }

    

    public function varticalCategory($id){
        $category = \App\Category::select('id','category_name')->where(['is_active'=>1])->get();
    }

    public function getVerticalCategory($id){
        $category = \App\Category::select('id','category_name')->where(['vertical_id'=>$id])->get();
        $data = "";
        foreach($category as $cat){
            $data .="<option value='".$cat->id."'>".$cat->category_name."</option>";
        }
        echo $data;
    }
    
    public function checkService($id,$id1,$id2){
        if (\App\Service::where(['vertical_id'=>$id1,'category_id'=>$id2,'type_of_service'=>$id])->exists()) {
            echo "Type of Service Alredy Exists !";
        }
    }
   
}