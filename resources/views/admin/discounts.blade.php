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
                        <h1> All Discounts </h1>
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
                                    All Discount
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>value</th>
                                                    <th>CartID</th>
                                                    <th>User id/IP</th>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Discount as $value)
                                                <tr class="odd gradeX">
                                                    <td>{{$value->id}}</td>
                                                    <td>{{$value->value}}</td>
                                                    <td>{{$value->rowID}}</td>
                                                    <td>{{$value->user}}</td>
                                                    <td>
                                                    <?php 
                                                        $Prodcuct = DB::table('product')->where('id',$value->product_id)->get();
                                                        foreach ($Prodcuct as $key => $value) {
                                                            $Pname = $value->name;
                                                            echo $Pname;
                                                        }
                                                    ?>
                                                   
                                                    </td>
                                                    <td>{{$value->created_at}}</td>
                                                   
                                                
                                                   
                                                   
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