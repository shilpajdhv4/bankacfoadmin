@extends('layouts.app')
@section('title', 'Quotation Request')

@section('content')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<section class="content-header">
    <h1>
        Quotation Requests
    </h1>
</section>

@if (Session::has('success'))
<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">Success!</h4>
    {{ Session::get('success') }}
</div>
@endif
<section class="content">
    <div class="box">
        <div class="box-body" >
<table id="example1" class="table table-bordered table-striped" border="1">
    <thead>
        <tr>
           <th>No</th>
           <th>User Name</th>
           <th>Service Name</th>
           <th>Company Details</th>
           <th>Service Details</th>
           <th>Status</th>
           <th >Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
    @foreach ($quotation as $row)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->subscription_name}}</td>
        <td>{{ $row->details_of_company}}</td>
        <td>{{ $row->details_of_services}}</td>
        <td><?php echo $result = $row->is_active == 0 ? '<span class="label label-warning">Pending</span>' : '<span class="label label-success">Pending</span>'; ?></td>
        <td>
                <a class="btn btn-primary" href="{{ url('reply_quotation?id='.$row->id) }}">Reply</a>
           
<!--                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $row->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}-->
          
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
//    alert();
    $(".delete").on("click", function () {
        return confirm('Are you sure to delete user');
    });
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