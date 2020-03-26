<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;


class CategoryController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
//         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
//         $this->middleware('permission:product-create', ['only' => ['create','store']]);
//         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
//         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        $this->middleware('permission:category|add_category|edit_category');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryList()
    {
        $vertical = \App\Vertical::select('id','vertical_name')->where(['is_active'=>1])->get();
        if(isset($_GET['id'])){
            if($_GET['id'] != ""){
               $category = \App\Category::where(['vertical_id'=>$_GET['id'],'is_active'=>1])->get();
            }else{
               $category = \App\Category::where(['is_active'=>1])->get();
            }
        }else{
            $category = \App\Category::where(['is_active'=>1])->get();
        }
        return view('category.index',['vertical'=>$vertical,'category'=>$category]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryCreate()
    {
        $vertical = \App\Vertical::select('id','vertical_name')->where(['is_active'=>1])->get();
        return view('category.create',['vertical'=>$vertical]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCategory(Request $request)
    {
        $requestData = $request->all();
//        echo "<pre>";print_r($requestData);exit;
        request()->validate([
            'vertical_id' => 'required',
            'category_name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
          //  'upload_img' => 'required',
        ]);
        
        
        
        if(isset($requestData['upload_img'])){
            $design = $requestData['upload_img'];
            $filename = $design->getClientOriginalName();
            $destination= "category_img/";
            $design->move($destination,$filename);
            $requestData['upload_img'] = $filename;
        }
        
        if(isset($requestData['is_active'])){
            if($requestData['is_active'] == "on"){
                $requestData['is_active'] = 1;
            }
        }
      //  echo "<pre>";print_r($requestData);exit;
        \App\Category::create($requestData);


        return redirect('category')
                        ->with('success','Category created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = $_GET['id'];
        $vertical = \App\Vertical::select('id','vertical_name')->where(['is_active'=>1])->get();
        $category = \App\Category::where(['id'=>$id])->first();
        return view('category.edit',['vertical'=>$vertical,'category'=>$category]);
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
//        echo "<pre>";print_r($requestData);exit;
        request()->validate([
            'vertical_id' => 'required',
            'category_name' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
         //   'upload_img' => 'required',
        ]);
        
        $category_det = \App\Category::findorfail($id);
        $oldFileName = $category_det->upload_img;
        if(empty($requestData['upload_img'])) {
                $requestData['upload_img'] = $oldFileName;
        }else{
            $design = $requestData['upload_img'];
            $filename = $design->getClientOriginalName();
            $destination = "category_img/";
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
        $category_det->update($requestData);


        return redirect('category')
                        ->with('success','Category updated successfully.');
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


        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}