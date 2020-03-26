@extends('layouts.app')
@section('title', 'User-List')

@section('content')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<section class="content-header">
    <h1>
        Client List
    </h1>
</section>

@if (Session::has('alert-success'))
<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Success!</h4>
    {{ Session::get('alert-success') }}
</div>
@endif

<section class="content">
    <div class="box">
 <?php $i = 0; ?>
        <div class="box-body" >
            <table id="example1" class="table table-bordered table-striped" border="1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User Name</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $x =1; ?>
                    @foreach($detail as $row)
                   <tr>
                        <td>{{$x++}}</td>
                        <td>{{$row->name}}</td>
                        <td width="280px">
                            <a class="btn btn-primary" href="get_subscribeservices?id={{$row->user_id}}">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>   
</section>
<!-- END PAGE CONTENT WRAPPER -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function () {
    $('select').select2();
//    alert();
    $(".delete").on("click", function () {
        return confirm('Are you sure to delete user');
    });
    
    $("#cat_id").on("change",function(){
        var id = $(this).val();
        location.href = 'services?id='+id;
    })
});
$(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false
    })
})
</script>
@endsection
        
