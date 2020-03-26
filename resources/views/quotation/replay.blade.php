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
    <h1>Quotation Reply
    <div class="pull-right">
        <a class="btn btn-primary" href="quotation_request"> Back</a>
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
                <form class="form-horizontal" id="form" method="post" action="{{ url('reply_quotation/'.$_GET['id']) }}" autocomplete="on" >
                    {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Client Name </label>
                      <div class="col-sm-4 control-label" style="text-align: left;">
                          {{$quotation->name}}
                      </div>
                      <label for="inputEmail3" class="col-sm-2 control-label">Service Name </label>
                      <div class="col-sm-4 control-label" style="text-align: left;">
                          {{$quotation->subscription_name}}
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Company Details</label>
                      <div class="col-sm-4 control-label" style="text-align: left;">
                        {{$quotation->details_of_company}}
                      </div>
                       <label for="inputPassword3" class="col-sm-2 control-label">Service details</label>
                      <div class="col-sm-4 control-label" style="text-align: left;">
                       {{$quotation->details_of_services}}
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Reply<span style="color:red"> * </span></label>
                      <div class="col-sm-10">
                          <textarea class="form-control" name="quotation_replay" id="quotation_replay" rows="3" placeholder="Enter ..." required >{{$quotation->quotation_replay}}</textarea>
                      </div>
                    </div>
                    
                  </div>
                    
                  <!-- /.box-body -->
                  <div class="box-footer">
                      <a class="btn btn-default" href="reply_quotation?id=<?php echo $_GET['id']; ?>"> Cancel</a>
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

