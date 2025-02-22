@extends('admin.master')

@section('content')
<div id="wrap" >
        

        <!-- HEADER SECTION -->
        @include('admin.top')
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
        @include('admin.left')
        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
        <div id="content">
             
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        <h1> Orders </h1>
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                 
                 <!-- COMMENT AND NOTIFICATION  SECTION -->
                   <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Orders
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Product</th>
                                                    <th>User</th>
                                                    <th>Status</th>
                                                    <th>Mark</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Orders as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td><?php $time = $value->created_at; echo timeago($time); ?></td>
                                                    <td>
                                                    <!-- Product Name -->
                                                    Product:
                                                    <?php
                                                        $OrderID = $value->id;
                                                        $orders_products = DB::table('orders_products')->where('orders_id',$OrderID)->get();
                                                        foreach($orders_products as $product){
                                                            $product_id = $product->products_id;
                                                            $Products = DB::table('product')->where('id',$product_id)->paginate(1);
                                                            foreach($Products as $pro_value){
                                                                echo $pro_value->name;
                                                                echo "<br>";
                                                            }
                                                        }
                                                    ?>
                                                    
                                                    
                                                    <br>
                                                    Total:{{$value->total}}
                                                    </td>
                                                    <td>
                                                    <?php 
                                                        $user_id = $value->user_id;
                                                        $User = DB::table('users')->where('id',$user_id)->get();
                                                    ?>
                                                        @foreach($User as $user)
                                                            Name: {{$user->name}}<br>
                                                            Email: {{$user->email}}<br>
                                                            Mobile:  {{$user->mobile}}<br>
                                                        @endforeach
                                                        
                                                    
                                                    </td>
                                                    <td>{{$value->status}}</td>
                                                    <td class="center"><a onclick="return confirm('Mark This Order as Delivered? You cannot undo this proccess')" href="{{url('/admin')}}/mark_order/{{$value->id}}"   class="btn btn-info"><i class="icon-check icon-white"></i> Mark</a></td>
                                                   
                                                  
                                                </tr>
                                            @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- END COMMENT AND NOTIFICATION  SECTION -->
                



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>

@endsection