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
    <h1>Edit Category 
    <div class="pull-right">
        <a class="btn btn-primary" href="category?id=<?php echo $category->vertical_id; ?>"> Back</a>
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
                <!-- form start -->
                <form class="form-horizontal" id="form" method="post" action="{{ url('update_category/'.$_GET['id']) }}" autocomplete="on" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Vertical Name <span style="color:red"> * </span></label>
                      <div class="col-sm-10">
                          <select class="form-control select2" id="vertical_id" name="vertical_id" required >
                            <option value="">-- Select Vertical --</option>
                            @foreach($vertical as $vert)
                            <option value="{{$vert->id}}" <?php if($category->vertical_id == $vert->id) echo "selected";  ?>>{{$vert->vertical_name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Category Name <span style="color:red"> * </span></label>

                      <div class="col-sm-10">
                          <input type="text" name="category_name" id="category_name" class="form-control" rows="3" placeholder="Category Name" value="{{$category->category_name}}" required >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Short Desc.</label>

                      <div class="col-sm-10">
                        <textarea id="editor1"  name="short_desc" rows="10" cols="80">
                                    {{$category->short_desc}}
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Long Desc.</label>

                      <div class="col-sm-10">
                        <textarea id="editor2" name="long_desc" rows="10" cols="80">
                                     {{$category->long_desc}}
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Upload Image</label>

                      <div class="col-sm-10">
                          <input type="file" name="upload_img" id="exampleInputFile">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                              <input type="checkbox" name="is_active" class="minimal" <?php if($category->is_active == 1) { ?>checked="" <?php } ?>> <b>  Is Active</b>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                    
                  <!-- /.box-body -->
                  <div class="box-footer">
                      <a class="btn btn-default" href="category?id=<?php echo $category->vertical_id; ?>"> Cancel</a>
                    <!--<button type="submit" class="btn btn-default">Cancel</button>-->
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                  <!-- /.box-footer -->
                </form>
              </div>
        

    </div>
</div>
</section>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">  
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
var historyVar = [];
$(document).ready(function () {
   $('.select2').select2();
});
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
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

