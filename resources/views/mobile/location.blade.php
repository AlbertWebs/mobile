@extends('mobile.master-location')

@section('content')
<div class="bg-white d-flex align-items-center p-3 gurdeep-osahan-inner-header shadow-sm mb-1">
    <div class="left mr-auto">
       <a href="{{url('/')}}/mobile" class="back_button">Skip</a>
    </div>
    <div class="center mx-auto"></div>
    <div class="right ml-auto d-flex align-items-center">
       <a href="#" class="fav_button mr-2"><i class="btn_detail mdi mdi-crosshairs-gps bg-light text-dark"></i></a>
       <a class="toggle btn_detail bg-light text-dark" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
       </a>
    </div>
 </div>
 {{-- <section>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63818.141944585215!2d36.71411478845313!3d-1.3961431893213294!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f05cf50f94e8d%3A0x51c29656e6fd8ca9!2sOngata%20Rongai!5e0!3m2!1sen!2ske!4v1656394588417!5m2!1sen!2ske" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
 </section> --}}
 <section class="bg-light body_rounded position-relative mt-n5 p-3">

    <strong>Name:</strong>Albert Muhatia<br>
    <strong>Email:</strong>albertmuhatia@gmail.com<br>
    <strong>Mobile:</strong>+254723014032<br><br>
    <h6 class="mb-3 fw-bold">Select Location</h6>
    <form class="form-floating pb-2 d-flexs align-items-center mb-3">
       <input type="email" class="form-control bg-white border-0 shadow-sm form-control-sm w-100" id="floatingInputValue" placeholder="" value="{{ $currentUserInfo->regionName }}, {{ $currentUserInfo->cityName }}" autofocus>
       <label for="floatingInputValue">Your Location <a class="text-danger" href="#">Change</a></label>
       <br>
       <input type="submit" value="Save Changes" href="{{url('/')}}/mobile/get-started" class="btn btn-outline-primary btn-sm px-3 rounded-3 w-100 mr-2">
    </form>

    <p class="text-muted small mb-2">TAG THIS LOCATION FOR LATER</p>
    <input onclick="return confirm('Do you want to use this as your home address?')" type="radio" class="btn-check" name="options-outlined" id="home" autocomplete="off" checked>
    <label class="btn btn-outline-primary btn-sm px-3 rounded-3 mr-2" for="home">Home</label>
    <input onclick="return confirm('Do you want to use this as your work address?')" type="radio" class="btn-check" name="options-outlined" id="work" autocomplete="off">
    <label class="btn btn-outline-primary btn-sm px-3 rounded-3 mr-2" for="work">Work</label>
    <input onclick="return confirm('Do you want to use this as your alternative address?')" type="radio" class="btn-check" name="options-outlined" id="other" autocomplete="off">
    <label class="btn btn-outline-primary btn-sm px-3 rounded-3 mr-2" for="other">Other</label>
    <div class="p-3 fixed-bottom">
       <a href="{{url('/')}}/mobile/get-started" class="btn btn-danger btn-block box_rounded w-100 py-3">Save Address</a>
    </div>
 </section
{{-- @include('mobile.main-nav') --}}
@endsection
