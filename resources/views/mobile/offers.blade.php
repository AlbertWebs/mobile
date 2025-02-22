@extends('mobile.master')

@section('content')
<div class="bg-white d-flex align-items-center p-3 gurdeep-osahan-inner-header shadow-sm">
    <div class="left mr-auto">
       <a href="home1.html" class="back_button"><i class="btn_detail mdi mdi-chevron-left bg-dark text-white"></i></a>
    </div>
    <div class="center mx-auto"></div>
    <div class="right ml-auto d-flex align-items-center">
       <a href="favourities.html" class="fav_button mr-2"><i class="btn_detail mdi mdi-heart bg-danger text-white"></i></a>
       <a class="toggle btn_detail bg-dark text-white" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
       </a>
    </div>
 </div>
 <div class="padding_bottom">
    <section class="position-relative">
       <div class="osahan-banner">
          <span class="position-absolute title_sign text-white text-center">
             <h1>Our Menu</h1>
             <p class="text-white-50 m-0">+25 Options</p>
          </span>
       </div>
       <img src="{{asset('mobileTheme/img/covertop.jpg')}}" class="img-fluid">
    </section>
    <section class="bg-light body_rounded mt-n5 position-relative p-3 row">
       <a class="col-6 pr-2" href="detail1.html">
          <div class="bg-white box_rounded overflow-hidden mb-3">
             <img src="{{asset('mobileTheme/img/search1.jpg')}}" class="img-fluid">
             <div class="p-2">
                <p class="text-dark mb-1 fw-bold">Na Thai Town</p>
                <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="font-weight-bold text-dark ml-1 fw-bold">4.8</span> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> Asian <span class="mdi mdi-circle-medium"></span> kes $29 </span></p>
                <p class="small mb-0 text-muted ml-auto"><span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span></p>
             </div>
          </div>
       </a>
       <a class="col-6 pl-2" href="detail1.html">
          <div class="bg-white box_rounded overflow-hidden mb-3">
             <img src="{{asset('mobileTheme/img/search2.jpg')}}" class="img-fluid">
             <div class="p-2">
                <p class="text-dark mb-1 fw-bold">Thai Casual</p>
                <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="font-weight-bold text-dark ml-1 fw-bold">4.8</span> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> Asian <span class="mdi mdi-circle-medium"></span> kes $29 <del>$20</del></span></p>
                <p class="small mb-0 text-muted ml-auto"><span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span></p>
             </div>
          </div>
       </a>
       <a class="col-6 pr-2" href="detail1.html">
          <div class="bg-white box_rounded overflow-hidden mb-3">
             <img src="{{asset('mobileTheme/img/search3.jpg')}}" class="img-fluid">
             <div class="p-2">
                <p class="text-dark mb-1 fw-bold">Italic Food</p>
                <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="font-weight-bold text-dark ml-1 fw-bold">4.8</span> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> Asian <span class="mdi mdi-circle-medium"></span> kes $29 </span></p>
                <p class="small mb-0 text-muted ml-auto"><span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span></p>
             </div>
          </div>
       </a>
       <a class="col-6 pl-2" href="detail1.html">
          <div class="bg-white box_rounded overflow-hidden mb-3">
             <img src="{{asset('mobileTheme/img/search4.jpg')}}" class="img-fluid">
             <div class="p-2">
                <p class="text-dark mb-1 fw-bold">The Mint Sauce</p>
                <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="font-weight-bold text-dark ml-1 fw-bold">4.8</span> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> Asian <span class="mdi mdi-circle-medium"></span> kes $29 </span></p>
                <p class="small mb-0 text-muted ml-auto"><span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span></p>
             </div>
          </div>
       </a>
       <a class="col-6 pr-2" href="detail1.html">
          <div class="bg-white box_rounded overflow-hidden mb-3">
             <img src="{{asset('mobileTheme/img/search5.jpg')}}" class="img-fluid">
             <div class="p-2">
                <p class="text-dark mb-1 fw-bold">Mid - Day Town</p>
                <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="font-weight-bold text-dark ml-1 fw-bold">4.8</span> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> Asian <span class="mdi mdi-circle-medium"></span> kes $29 </span></p>
                <p class="small mb-0 text-muted ml-auto"><span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span></p>
             </div>
          </div>
       </a>
       <a class="col-6 pl-2" href="detail1.html">
          <div class="bg-white box_rounded overflow-hidden mb-3">
             <img src="{{asset('mobileTheme/img/search6.jpg')}}" class="img-fluid">
             <div class="p-2">
                <p class="text-dark mb-1 fw-bold">Diet Town</p>
                <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="font-weight-bold text-dark ml-1 fw-bold">4.8</span> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> Asian <span class="mdi mdi-circle-medium"></span> kes $29 </span></p>
                <p class="small mb-0 text-muted ml-auto"><span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span></p>
             </div>
          </div>
       </a>
    </section>
    <div class="text-center">
       <div class="spinner-border spinner-border-sm" role="status">
          <span class="visually-hidden">Loading...</span>
       </div>
    </div>
 </div>
@include('mobile.main-nav')
@endsection
