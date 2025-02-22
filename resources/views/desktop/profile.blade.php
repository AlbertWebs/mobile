@extends('mobile.master-profile')

@section('content')
<div class="padding_bottom">
    <section class="p-3 bg-primary">
       <div class="d-flex align-items-center gurdeep-osahan-inner-header pb-5">
          <div class="left mr-auto">
             <a href="{{url('/')}}/mobile/menu" class="back_button"><i class="btn_detail shadow-sm mdi mdi-chevron-left bg-white text-dark"></i></a>
          </div>
          <div class="center mx-auto">
             <h6 class="text-dark mb-0"></h6>
          </div>
          <div class="right ml-auto d-flex align-items-center">
             <a class="toggle btn_detail bg-white text-dark shadow-sm" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                   <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
             </a>
          </div>
       </div>
       <div class="d-flex align-items-center">
          <img src="{{asset('mobileTheme/img/albert.jpg')}}" class="img-fluid box_rounded profile_img">
          <div class="text-white ml-3">
             <p class="mb-1 fw-bold h6">Albert Muhatia</p>
             <p class="mb-0 small">Edit Profile</p>
          </div>
       </div>
    </section>
    <section class="p-3 bg-light body_rounded mt-n5 ">
       <div class="pb-3 border-bottom">
          <p class="text-muted mb-2">Account</p>
          <a href="{{url('/')}}/mobile/profile/edit-profile" class="shadow-sm text-dark d-flex align-items-center mb-1 p-2 bg-white rounded">
             <p class="h5 text-primary mb-0"><i class="mdi mdi-account-outline"></i></p>
             <p class="ml-3 mb-0">Profile</p>
             <p class="h5 ml-auto text-muted mb-0"><i class="mdi mdi-chevron-right"></i></p>
          </a>
          <a href="{{url('/')}}/mobile/profile/transactions" class="shadow-sm text-dark d-flex align-items-center mb-1 p-2 bg-white rounded">
             <p class="h5 text-danger mb-0"><i class="mdi mdi-cash-usd-outline"></i></p>
             <p class="ml-3 mb-0">Transaction History</p>
             <p class="h5 ml-auto text-muted mb-0"><i class="mdi mdi-chevron-right"></i></p>
          </a>
          <a href="{{url('/')}}/mobile/profile/orders" class="shadow-sm text-dark d-flex align-items-center mb-1 p-2 bg-white rounded">
             <p class="h5 text-warning mb-0"><i class="mdi mdi-cart"></i></p>
             <p class="ml-3 mb-0">Orders</p>
             <p class="h5 ml-auto text-muted mb-0"><i class="mdi mdi-chevron-right"></i></p>
          </a>

          <a href="tel:+254723014032" class="shadow-sm text-dark d-flex align-items-center mb-1 p-2 bg-white rounded">
            <p class="h5 text-warning mb-0"><i class="mdi mdi-progress-question  bg-white text-dark"></i></p>
            <p class="ml-3 mb-0">Help</p>
            <p class="h5 ml-auto text-muted mb-0"><i class="mdi mdi-chevron-right"></i></p>
         </a>
       </div>
       <div class="pt-4">
          <p class="text-muted mb-2">Offers</p>
          <a href="{{url('/')}}/mobile/offers" class="shadow-sm text-dark d-flex align-items-center mb-1 p-2 bg-white rounded">
             <p class="h5 text-primary mb-0"><i class="mdi mdi-ticket-percent"></i></p>
             <p class="ml-3 mb-0">Offers &amp; Promos</p>
             <p class="h5 ml-auto text-muted mb-0"><i class="mdi mdi-chevron-right"></i></p>
          </a>
          <a href="{{url('/')}}/mobile/menu" class="shadow-sm text-dark d-flex align-items-center mb-1 p-2 bg-white rounded">
             <p class="h5 text-danger mb-0"><i class="mdi mdi-home"></i></p>
             <p class="ml-3 mb-0">Menu</p>
             <p class="h5 ml-auto text-muted mb-0"><i class="mdi mdi-chevron-right"></i></p>
          </a>
       </div>
    </section>
 </div>
@include('mobile.horizontal-nav')
@include('mobile.main-nav')
@endsection
