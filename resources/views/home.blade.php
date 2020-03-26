@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{Auth::user()->name}}
                    You are logged in!
                    <br/><br/>
                    <div class="row">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Quotation Notification</h3>

                              <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <ul class="products-list product-list-in-box">
                                    @foreach($quotation as $row)
                                    <li class="item">
                                      <div class="product-img">
                                        <img src="dist/img/default-50x50.gif" alt="Product Image">
                                      </div>
                                      <div class="product-info">
                                        <a href="javascript:void(0)" class="product-title">{{$row->subscription_name}}
                                          <!--<span class="label label-warning pull-right">$1800</span></a>-->
                                        <span class="product-description">
                                              New Quotation Request from {{$row->name}} for service {{$row->subscription_name}}.
                                            </span>
                                      </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <?php 
//                            $dirname = "vertical_img/";
//                            $images = glob($dirname."*");
                        ///    echo "<pre>";print_r($images);exit;
//                            $latest = array();
//
//                            foreach($images as $image) {
//
//                                $x = (string)filectime($image);
//                                // Incase you encounter duplicates
//                                // $x = (string)filectime($image) . $image;
//
//                                $latest[$x] = $image;
//                            }
//
//                            krsort($latest);
//                            $latest = array_slice(array_values($latest), 0, 10);
//
//                            var_dump($latest);
//                            <img src="{{$latest[0]}}" />
                            
                            ?>
                            <!---->
                            <!-- /.box-body -->
<!--                            <div class="box-footer text-center" style="">
                              <a href="javascript:void(0)" class="uppercase">View All Products</a>
                            </div>-->
                            <!-- /.box-footer -->
                          </div>
                    </div>
                    
                    
                    
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
