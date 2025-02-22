@extends('mobile.master-sign')

@section('content')
<div class="d-flex align-items-center p-3 gurdeep-osahan-inner-header position-absolute w-100">
    <div class="left mr-auto">
       <a href="forgot_password.html" class="back_button"><i class="btn_detail shadow-sm mdi mdi-chevron-left bg-dark text-white shadow-sm"></i></a>
    </div>
    <div class="center mx-auto"></div>
    <div class="right ml-auto d-flex align-items-center">
       <a class="toggle btn_detail bg-danger shadow-sm text-white" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
       </a>
    </div>
 </div>
 <div class="padding_bottom">
    <section class="position-relative">
       <span class="position-absolute title_sign text-white text-center">
       <a href="home1.html">
       <img src="{{asset('uploads/VENSHAQ001-41.png')}}" class="height-70" alt="logo" />
       </a>
       </span>
       <img src="{{asset('mobileTheme/img/covertop.jpg')}}" class="img-fluid">
    </section>
    <section class="bg-white body_rounded mt-n5 position-relative p-4">
       <h5 class="mb-3">Verify your phone number</h5>
       <p class="text-muted small mb-5">We have sent you an sms with a code to number <strong>{{Auth::User()->mobile}}</strong> </p>
       <form class="" id="Veryfy-Form" action="{{url('/')}}/mobile/send-verification">
          @csrf
          <input class="form-control bg-dark search_item p-3 box_rounded border-0 text-white" name="mobile" value="{{Auth::User()->mobile}}" type="text" placeholder="Enter Phone Number">
          {{-- <div class="p-4 fixed-bottom">
             <a href="{{url('/')}}/mobile/verification-code" class="btn btn-danger btn-block box_rounded w-100 py-3">Send</a>
          </div> --}}
          <input type="hidden" value="{{Auth::User()->id}}" name="user">
          <div class="p-4 fixed-bottom">
            <button type="submit" class="btn btn-danger btn-block box_rounded w-100 py-3">Send</button>
            <br>
            <div class="text-center">
                <img width="30" src="{{asset('/mobileTheme/img/loading.gif')}}" class="loading-img">
            </div>
          </div>

       </form>
    </section>
 </div>
 @include('mobile.main-nav')
@endsection
