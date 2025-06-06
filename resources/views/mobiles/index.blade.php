

@if ($browser->isMobile())

    @extends('mobile.master-landing')

    @section('content')
    <div class="osahan-index">
        <div class="text-center">
        <div class="fixed-top fixed-top-logo text-center p-4">
            <a href="{{url('/')}}/mobile">
            <img src="{{asset('uploads/VENSHAQ001-41.png')}}" class="height-70" alt="logo"  />
            </a>
        </div>
        <div class="index_slider text-white d-flex align-items-center justify-content-center p-4">
            <div class="slider px-4">
                <h5>All Your Favourite Dishes</h5>
                <p class="text-white-50">Order from your nearby best restaurant in the town, you can easily order from anywhere, anytime</p>
            </div>
            <div class="slider px-4">
                <h5>All Your Favourite Dishes</h5>
                <p class="text-white-50">Order from your nearby best restaurant in the town, you can easily order from anywhere, anytime</p>
            </div>
            <div class="slider px-4">
                <h5>All Your Favourite Dishes</h5>
                <p class="text-white-50">Order from your nearby best restaurant in the town, you can easily order from anywhere, anytime</p>
            </div>
        </div>
        <div class="fixed-bottom text-center p-4">
            <a href="{{url('/')}}/mobile/sign-up" class="btn btn-danger btn-lg btn-block w-100 mb-2 box_rounded">Get Started</a>
            <a href="{{url('/')}}/mobile/sign-in" class="btn btn-warning search_item btn-lg btn-block w-100 box_rounded">Login</a>
        </div>
        </div>
    </div>
    @endsection

@else
   @include('shaqshouse.index')
@endif


