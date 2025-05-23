
    @extends('mobile.master-home')

    @section('content')
    <div class="padding_bottom">
        <section class="bg-warnings p-3">
        <div class="location_search">
            <p class="text-dark mb-1 fw-bold">SHAQ'S BITES</p>
            {{-- <p>{{Auth::User()->location}} <span class="mr-1 mdi mdi-chevron-down text-dark"></span></p> --}}
        </div>
        <div class="d-flex align-items-center">
            <div class="search_item shadow-sm p-1 input-group bg-white rounded-3 mr-3">
                <span class="input-group-text bg-white mdi mdi-magnify border-0" id="basic-addon1"></span>
                <form method="POST" action="{{route('search_post')}}">
                @csrf
                <input type="text" class="form-control border-0 bg-white pl-0" name="key" placeholder="Search" aria-label="search" aria-describedby="basic-addon1">
            </form>
            </div>
            <a class="toggle border-0 btn btn-dark rounded-3 homepage-toggle-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                </svg>
            </a>
        </div>
        </section>
        <br>
        <div class="px-3">
        <div class="title mb-3 d-flex align-items-center">
            <h6 class="mb-0 fw-bold">Menu</h6>
            <a href="tel:+254706788440" class="ml-auto"><span class="text-primarys theme-color"><span class="mdi mdi-phone"></span> Call Us</span></a>
        </div>
        <section class="bg-light body_rounded position-relative row" id="data-wrapper" >


                    @include('mobile.data')



        </section>
            <!-- Data Loader -->
            <div class="text-center auto-load" style="display: none;">
                <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        {{-- <div class="text-center">
            <div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>
        </div> --}}
        </div>
    </div>
    @include('mobile.horizontal-nav')
    @include('mobile.main-nav')
    @endsection
