<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class VerticalController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//        $this->middleware('permission:vertical||edit_vertical', ['only' => ['index','show']]);
//        $this->middleware('permission:add_vertical', ['only' => ['create','store']]);
//        $this->middleware('permission:edit_vertical', ['only' => ['edit','update']]);
//        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
         $this->middleware('permission:vertical|add_vertical|edit_vertical');
    }
    
    public function verticalList()
    {
        $vartical = \App\Vertical::where(['is_active'=>1])->get();
        return view('vertical.index',['vartical'=>$vartical]);
    }


    public function verticalCreate()
    {
        return view('vertical.create');
    }

    public function saveVertical(Request $request)
    {
        $requestData = $request->all();
//        echo "<pre>";print_r($requestData);exit;
        request()->validate([
            'vertical_name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
          //  'upload_img' => 'required',
        ]);
        
        if(isset($requestData['upload_img'])){
            $design = $requestData['upload_img'];
            $filename = $design->getClientOriginalName();
            $destination= "vertical_img/";
            $design->move($destination,$filename);
            $requestData['upload_img'] = $filename;
        }
        
        if(isset($requestData['is_active'])){
            if($requestData['is_active'] == "on"){
                $requestData['is_active'] = 1;
            }
        }
        
        \App\Vertical::create($requestData);
        Session::flash('alert-success','Created Successfully.');
        return redirect('vertical');
//        echo "<pre>";print_r($requestData);exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $id = $_GET['id'];
        $vertical_det = \App\Vertical::findorfail($id);
        return view('vertical.edit',['vertical_det'=>$vertical_det]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        
        request()->validate([
            'vertical_name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            //'upload_img' => 'required',
        ]);
        
        $vertical_det = \App\Vertical::findorfail($id);
        $oldFileName = $vertical_det->upload_img;
        if(empty($requestData['upload_img'])) {
                $requestData['upload_img'] = $oldFileName;
        }else{
            $design = $requestData['upload_img'];
            $filename = $design->getClientOriginalName();
            $destination= "vertical_img/";
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

        $vertical_det->update($requestData);

        
        return redirect('vertical')
                        ->with('success','Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();


        return redirect()->route('vertical')
                        ->with('success','Product deleted successfully');
    }
}