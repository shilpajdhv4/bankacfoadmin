@extends('layouts.app')
@section('title', 'Client Form')
@section('content')
<style>
    @media only screen and (max-width: 600px) {
        .mobile_date {
            width: 160px;
        }
    }
</style>


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
<section class="content-header">
    <div class="row">
        <div class="col-md-2">
            <h3>Client Form</h3>
        </div>
        <div class="col-md-4" style="margin-top:20px;">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Month</label>
                <div class="col-sm-8">
                    <select class="form-control select2 month_year" style="width: 100%;" name="month" id="month">
                        <option>-- Select Month --</option>
                        <option value="1">JANUARY</option>
                        <option value="2">FEBRUARY</option>
                        <option value="3">MARCH</option>
                        <option value="4">APRIL</option>
                        <option value="5">MAY</option>
                        <option value="6">JUNE</option>
                        <option value="7">JULY</option>
                        <option value="8">AUGUST</option>
                        <option value="9">SEPTEMBER</option>
                        <option value="10">OCTOBER</option>
                        <option value="11">NOVEMBER</option>
                        <option value="12">DECEMBER</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="margin-top:20px;">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Year</label>
                <div class="col-sm-8">
                    <select class="form-control select2 month_year" style="width: 100%;" name="year" id="year">
                        <option>-- Select Year --</option>
                        <?php
                        $date = date('Y-m-d');
                        $year = date('Y', strtotime($date));
                        ?>
                        <option value="{{$year}}">{{$year}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2" style="margin-top:20px;">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ url('get_subscribeservices?id='.$sub_id) }}">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box" style="border-top: 3px solid #ffffff;">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div>

                <form method="POST" action="{{url('update_office_data')}}" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box-body" id="client_field">
                        
                    </div>
                </form>
        </div>
    </div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function () {
    $('.select2').select2();

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
    $(".month_year").on("change", function () {
        var month = $("#month").val();
        var year = $("#year").val();
        var subscription_id = <?php echo $sub_id; ?>;
        var client_id = <?php echo $user_id; ?>;
        $.ajax({
            url: 'get_month_year/' + month + '/' + year + '/' + subscription_id + '/' + client_id,
            type: "GET",
            success: function (data) {
              
                console.log("Data"+data);
                $("#client_field").html(data);
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                checkboxClass: 'icheckbox_minimal-blue',
                                radioClass   : 'iradio_minimal-blue'
                              })
//                    if (data != "") {
//                        $("#mobile_no").val("");
//                    }
            }
        });
    });
});



$('#btnsubmit').on('click', function () {
    $("#orderForm").valid();
});


</script>
@endsection
