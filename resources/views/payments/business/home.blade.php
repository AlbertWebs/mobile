@extends('mobile.master-home')

@section('content')
<div class="padding_bottom">
    <div class="bg_color_1">
        <div class="container margin_80_55" style="min-height:520px">

            <center>
                <h1 class="text-success">Payment Success:<i class="ti-check"></i></h1>
                <h2>Tracking ID:</h2>{{ Request::get('tracking_id') }}
                <h2>Merchant Reference:</h2>{{ Request::get('merchant_reference') }}
                <br><br>
                <div class="btn-box">
                    <a href="{{url('/')}}/mobile" class="theme-btn btn-style-one"><span class="txt"><span class="fa fa-shopping-cart"></span> &nbsp; Back To Shop</span></a>
                </div>
            </center>

        </div>
        <!--/container-->
    </div>
    <!--/bg_color_1-->
</div>
@include('mobile.horizontal-nav')
    @include('mobile.main-nav')
@endsection
