<footer class="bg-white body_rounded mt-n5 fixed-bottom osahan-footer-nav shadow">
    @if(Auth::check())

    <div class="text-center">
        <img width="25" src="{{asset('/mobileTheme/img/loading.gif')}}" class="loading-img">
     </div>
    <div class="row p-0 align-items-center">
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/get-started" class="text-muted">
             <h1 class="mb-0"><span class="mdi mdi-home-outline"></span></h1>
          </a>
       </div>
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/search" class="text-warning">
             <h1 class="mb-0"><span class="mdi mdi-magnify"></span></h1>
          </a>
          <span class="mdi mdi-circle-medium text-warning"></span></a>
       </div>
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/shopping-cart" class="text-muted" >
             <h1 class="mb-0"><span class="mdi mdi-cart"></span></h1><span id="myCart">({{\Cart::getContent()->count()}})</span>
          </a>
       </div>
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/profile" class="text-muted">
             <h1 class="mb-0"><span class="mdi mdi-account-outline"></span></h1>
          </a>
       </div>
    </div>
    @else
    <div class="text-center">
        <img width="25" src="{{asset('/mobileTheme/img/loading.gif')}}" class="loading-img">
     </div>
    <div class="row p-0 align-items-center">
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/get-started" class="text-muted">
             <h1 class="mb-0"><span class="mdi mdi-home-outline"></span></h1>
          </a>
       </div>
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/search" class="text-warning">
             <h1 class="mb-0"><span class="mdi mdi-magnify"></span></h1>
          </a>
          <span class="mdi mdi-circle-medium text-warning"></span></a>
       </div>
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/shopping-cart" class="text-muted" >
             <h1 class="mb-0"><span class="mdi mdi-cart"></span></h1><span id="myCart">({{\Cart::getContent()->count()}})</span>
          </a>
       </div>

    </div>
    @endif

 </footer>
