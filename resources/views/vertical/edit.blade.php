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
    <h1>Edit Vertical
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ url('vertical') }}"> Back</a>
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
                <form class="form-horizontal" id="form" method="post" action="{{ url('update_vertical/'.$_GET['id']) }}" autocomplete="on" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Vertical Name <span style="color:red"> * </span></label>

                      <div class="col-sm-10">
                          <textarea class="form-control" name="vertical_name" id="vertical_name" value="" rows="3" placeholder="Enter ..." required >{{$vertical_det->vertical_name}}</textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Short Desc.</label>

                      <div class="col-sm-10">
                        <textarea id="editor1"  name="short_desc" rows="10" cols="80">
                                    {{$vertical_det->short_desc}}
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Long Desc.</label>

                      <div class="col-sm-10">
                        <textarea id="editor2" name="long_desc" rows="10" cols="80">
                                    {{$vertical_det->long_desc}}
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Upload Image <span style="color:red"> * </span></label>

                      <div class="col-sm-10">
                          <input type="file" name="upload_img" id="upload_img" required >
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                              <input type="checkbox" name="is_active" class="minimal" <?php if($vertical_det->is_active == 1) echo "checked"; ?> > <b> Is Active</b>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                    
                  <!-- /.box-body -->
                  <div class="box-footer">
                      <a class="btn btn-default" href="{{ url('edit_vertical?id='.$_GET['id']) }}"> Cancel</a>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                  <!-- /.box-footer -->
                </form>
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
var historyVar = [];
$(document).ready(function () {
   
    var k = 1;
     $(".append").click( function(e) {
          e.preventDefault();
        $("#h_lost").append('<tr class="input_fields_wrap">\n\
                                <td style="width:0.5%;"><i class="fa fa-minus-circle remove_this" style="font-size: x-large;color: red;"></i></td>\n\
                                <td class="parameter"><input type="text" name="parameter_detail['+k+'][cat_name]" id="remark" class="form-control parameter checkblank serach_val" rows="1"  aria-required="true"></td>\n\
                                <td class="parameter"><input type="text" name="parameter_detail['+k+'][cat_description]" id="remark" class="form-control parameter checkblank" rows="1"  aria-required="true"></td>\n\
                                </tr>');
                    k++;
        return false;
        });

        $(".automplete-1").on("focusout",function(){
            var id = $(this).val();
            $.ajax({
                url : "get_prev_cat/"+id,
                type: "GET",
                success : function (data){
                    swal(data)
                }
            })
        })

    jQuery(document).on('click', '.remove_this', function() {
        jQuery(this).parent().parent().remove();        
        return false;
        }); 
        
        
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