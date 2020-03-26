@extends('layouts.app')
@section('title', 'Create New User')
@section('content')
<style>
@media only screen and (max-width: 600px) {
    .mobile_date {
        width: 160px;
    }
}
</style>
<section class="content-header">
    <h1>Edit Subscription
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ url('services') }}"> Back</a>
    </div></h1>
</section>
@if (Session::has('alert-success'))
<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Success!</h4>
    {{ Session::get('alert-success') }}
</div>
@endif


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box" >
                <div class="box box-info"></div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="form" method="post" action="{{ url('update_service/'.$_GET['id']) }}" autocomplete="on" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="box-body">
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Vertical Name <span style="color:red"> * </span></label>

                      <div class="col-sm-10">
                          <select class="form-control select2" id="vertical_id" name="vertical_id" required >
                            <option value="">-- Select Vertical --</option>
                            @foreach($vertical as $vert)
                            <option value="{{$vert->id}}" <?php if($service->vertical_id == $vert->id) echo "selected"; ?>>{{$vert->vertical_name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Category Name <span style="color:red"> * </span></label>
                      <div class="col-sm-10">
                        <select class="form-control select2" id="category_id" name="category_id" required >
                            <option value="">-- Select Category --</option>
                            @foreach($category as $cat)
                            <option value="{{$cat->id}}" <?php if($service->category_id == $cat->id) echo "selected"; ?>>{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Service Name <span style="color:red"> * </span></label>

                      <div class="col-sm-10">
                          <input type="text" name="service_name" id="service_name" value="{{$service->service_name}}" class="form-control" rows="3" placeholder="Service Name" required>
                      </div>
                    </div>
                     
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Short Desc.</label>

                      <div class="col-sm-10">
                        <textarea id="editor1"  name="short_desc" rows="10" cols="80">
                                    {{$service->short_desc}}
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Long Desc.</label>

                      <div class="col-sm-10">
                        <textarea id="editor2" name="long_desc" rows="10" cols="80">
                                    {{$service->long_desc}}
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Upload Image</label>

                      <div class="col-sm-10">
                          <input type="file" name="upload_img" id="upload_img">
                      </div>
                    </div>
                      <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Type Of Service <span style="color:red"> * </span></label>
                      <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" id="type_of_service" name="type_of_service" required>
                            <option value="">-- Select Service --</option>
                            <option value="Packaged" <?php if($service->type_of_service == "Packaged") echo "selected"; ?>>Packaged</option>
                            <option value="Flat" <?php if($service->type_of_service == "Flat") echo "selected"; ?>>Flat</option>
                            <option value="Quotation" <?php if($service->type_of_service == "Quotation") echo "selected"; ?>>Quotation</option>
                        </select>
                      </div>
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="userName" class="col-sm-2 control-label">Is Active</label>
                      <div class="col-sm-10">
                        <div class="checkbox">
                          <label>
                              <input type="checkbox" name="is_active" id="is_active" class="minimal" checked=""> 
                          </label>
                        </div>
                      </div>
                    </div>
                  
                    
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                  </form>
                  <!-- /.box-footer -->
                
            </div>
                
              </div>
        

    </div>
</section>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">  
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<script src="js/jquery.steps.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('select').select2();
    
    $('input').on('ifChecked', function(event){
        var inputValue = $(this).val(); // alert value
        if(inputValue == "yes"){
            $("#recuring_yes").css("display","block");
        }else{
            $("#recuring_yes").css("display","none");
        }
    });
 
    var k = 1;
     $(".append").click( function(e) {
          e.preventDefault();
        $("#h_lost").append('<tr class="input_fields_wrap">\n\
                                <td style="width:0.5%;"><i class="fa fa-minus-circle remove_this" style="font-size: x-large;color: red;"></i></td>\n\
                                <td class="parameter"><input type="text" name="parameter_detail['+k+'][cat_name]" id="remark" class="form-control parameter checkblank serach_val" rows="1"  aria-required="true"></td>\n\
                                <td class="parameter"><input type="text" name="parameter_detail['+k+'][cat_description]" id="remark" class="form-control parameter checkblank" rows="1"  aria-required="true"></td>\n\
                                <td class="parameter"><div class="checkbox"><label><input type="checkbox" class="minimal"></label></div></td>\n\
                                </tr>');
                              $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                checkboxClass: 'icheckbox_minimal-blue',
                                radioClass   : 'iradio_minimal-blue'
                              })
                    k++;
        return false;
        });
        
        var l = 1;
        $(".append1").click( function(e) {
          e.preventDefault();
        $("#h_lost1").append('<tr class="input_fields_wrap">\n\
                                <td style="width:0.5%;"><i class="fa fa-minus-circle remove_this" style="font-size: x-large;color: red;"></i></td>\n\
                                <td class="parameter"><input type="text" name="parameter_detail['+l+'][cat_name]" id="remark" class="form-control parameter checkblank serach_val" rows="1"  aria-required="true"></td>\n\
                                </tr>');
                            
                    l++;
        return false;
        });
        
        $("#type_of_service").on("change",function(){
            var service = $(this).val();
//            alert(service);
            if(service == "Packaged"){
                $("#service_package").css("display","block");
            }else{
                $("#service_package").css("display","none");
            }
                
        })
        
        $("#vertical_id").on("change",function(){
            var id = $(this).val();
          //  alert(id);
            $.ajax({
                url: 'get_category/'+id,
                type: "GET",
                success: function (data) {
                    console.log(data);
                    $("#category_id").html(data);
                }
            });
        })
});

$(function () {
  CKEDITOR.replace('editor1')
  CKEDITOR.replace('editor2')
  //bootstrap WYSIHTML5 - text editor
  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  })
})
</script>
@endsection