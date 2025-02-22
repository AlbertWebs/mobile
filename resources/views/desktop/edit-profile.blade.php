@extends('mobile.master')

@section('content')
<div class="padding_bottom">
    <section class="p-3 bg-primary">
       <div class="d-flex align-items-center gurdeep-osahan-inner-header pb-5">
          <div class="left mr-auto">
             <a href="{{url('/')}}/mobile/profile" class="back_button"><i class="btn_detail shadow-sm mdi mdi-chevron-left bg-white text-dark"></i></a>
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
        <img src="{{asset('mobileTheme/img/alberts.jpg')}}" class="img-fluid box_rounded profile_img">
        <div class="text-white ml-3">
           <p class="mb-1 fw-bold h6">{{Auth::User()->name}}</p>
           <p class="mb-0 small">Editing Profile</p>
        </div>
     </div>
    </section>
    <section class="p-3 bg-light body_rounded mt-n5">
       <p class="text-muted mb-4">Profile Details</p>
       <form class="mb-5" method="POST" action="{{route('edit-profile-post')}}">
          @csrf
          <div class="d-flex align-items-center mb-3 border-bottom pb-2">
             <span class="mdi mdi-account-outline box_rounded py-1 px-2 shadow-sm btn bg-white mr-1 text-primary"></span>
             <div class="form-floating w-100">
                <input type="text" class="form-control border-0 bg-light" name="name" id="floatingInputValue" placeholder="{{Auth::User()->name}}" value="{{Auth::User()->name}}">
                <label for="floatingInputValue">FULL NAME</label>
             </div>
          </div>
          <div class="d-flex align-items-center mb-3 border-bottom pb-2">
             <span class="mdi mdi-email-outline box_rounded py-1 px-2 shadow-sm btn bg-white mr-1 text-primary"></span>
             <div class="form-floating w-100">
                <input type="email" class="form-control border-0 bg-light" id="floatingInputValue" name="email"  placeholder="{{Auth::User()->email}}" value="{{Auth::User()->email}}">
                <label for="floatingInputValue">EMAIL</label>
             </div>
          </div>
          <div class="d-flex align-items-center mb-3 border-bottom pb-2">
            <span class="mdi mdi-phone box_rounded py-1 px-2 shadow-sm btn bg-white mr-1 text-primary"></span>
            <div class="form-floating w-100">
               <input type="text" class="form-control border-0 bg-light" name="mobile"  id="floatingInputValue" placeholder="{{Auth::User()->mobile}}" value="{{Auth::User()->mobile}}">
               <label for="floatingInputValue">Mobile</label>
            </div>
         </div>

         <div class="d-flex align-items-center mb-3 border-bottom pb-2">
            <span class="mdi mdi-map box_rounded py-1 px-2 shadow-sm btn bg-white mr-1 text-primary"></span>
            <div class="form-floating w-100">
               <input type="text" class="form-control border-0 bg-light" name="location"  id="floatingInputValue" placeholder="{{Auth::User()->location}}" value="{{Auth::User()->location}}">
               <label for="floatingInputValue">Address</label>
            </div>
         </div>

         <button type="submit" class="mt-5 btn btn-primary py-3 box_rounded w-100"><span class="mdi mdi-pencil"></span> Update</button>

       </form>
    </section>
 </div>
@include('mobile.horizontal-nav')
@include('mobile.main-nav')
@endsection
