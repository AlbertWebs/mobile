<footer class="bg-white body_rounded mt-n5 fixed-bottom osahan-footer-nav shadow">
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
          <a href="{{url('/')}}/mobile/shopping-cart" class="text-muted" id="myCart">
             <h1 class="mb-0"><span class="mdi mdi-cart"></span></h1>({{\Cart::getContent()->count()}})
          </a>
       </div>
       <div class="col text-center">
          <a href="{{url('/')}}/mobile/profile" class="text-muted">
             <h1 class="mb-0"><span class="mdi mdi-account-outline"></span></h1>
          </a>
       </div>
    </div>
 </footer>
