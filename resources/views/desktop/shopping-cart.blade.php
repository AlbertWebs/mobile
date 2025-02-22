@extends('mobile.master-profile')

@section('content')
<div class="d-flex align-items-center gurdeep-osahan-inner-header bg-light p-3">
    <div class="left mr-auto">
       <a href="{{url('/')}}/mobile/get-started" class="back_button"><i class="btn_detail shadow-sm mdi mdi-chevron-left bg-dark text-white shadow-sm"></i></a>
    </div>
    <div class="center mx-auto">
       <p class="mb-0">DELIVERING TO <a href="#" class="text-primary">HOME<span class="mr-1 mdi mdi-chevron-down"></span></a></p>
    </div>
    <div class="right ml-auto d-flex align-items-center">
       <a class="toggle btn_detail bg-primary shadow-sm text-white" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
       </a>
    </div>
 </div>
 <div class="padding_bottom">
    <section class="bg-white p-3">
       <a href="{{url('/')}}/mobile/profile" class="text-dark d-flex align-items-center mb-3">
          <div class="mb-3">
             <p class="mb-1 text-danger">Delivered to</p>
             <p class="mb-0 text-dark">{{Auth::User()->location}}</p>
             <p class="small text-muted mb-0"><strong>Pick Up Address:</strong> Kettle House Bar & Grill, Lavington, Muthangari Road, off Gitanga Rd, Nairobi </p>
          </div>
          <div class="ml-auto"><i class="mdi mdi-chevron-right bg-light p-2 text-muted box_rounded h4 mb-0"></i></div>
       </a>
       <div class="details-page my-1">
          <p class="text-dark h5 mb-3">Shaq's Bites</p>


          @foreach ($cartItems as $shoppingCart)
          <?php
              $Product = \App\Models\Menu::find($shoppingCart->id);
          ?>
          <div class="d-flex align-items-center mb-3">
            <div class="mr-2"><img src="{{url('/')}}/uploads/menu/{{$Product->image}}" class="img-fluid box_rounded cart_img"></div>
            <div class="small text-muted">{{$shoppingCart->quantity}} x</div>
            <div class="text-dark ml-2">
               <p class="mb-0">{{$Product->title}}</p>
               <p class="mb-0 small">KES {{$shoppingCart->price}}</p>
            </div>
            <a href="{{url('/')}}/mobile/shopping-cart/remove/1{{$shoppingCart->id}}" class="ml-auto"><i class="bg-light text-danger p-2 mdi mdi-trash-can-outline box_rounded h6 mb-0"></i></a>
         </div>
          @endforeach


          <p><a href="{{url('/')}}/mobile/menu" class="text-primary"><i class="mdi mdi-plus mr-2"></i> Add more items</a></p>
          <a href="select_address.html" class="d-flex align-items-center mb-3">
             <div class="m-0 h1"><i class="d-block mdi mdi-motorbike box_rounded bg-light text-warning px-3 py-1"></i></div>
             <div class="text-dark ml-3">
                <p class="mb-0">Delivery</p>
                <p class="mb-0 small">KES 100</p>
             </div>
          </a>

       </div>
    </section>
    <section class="fixed-bottom p-3">
       <div class="d-flex align-items-center box_rounded overflow-hidden">
          <a href="{{url('/')}}/mobile/profile" class="btn btn-warning btn-block rounded-0 w-25 py-3"><i class="mdi mdi-account-plus-outline"></i></a>
          <a href="{{url('/')}}/mobile/checkout" class="btn btn-primary btn-block fw-bold rounded-0 w-75 py-3 d-flex align-items-center px-3">
          Checkout <span class="ml-auto">KES {{\Cart::getTotal()}}</span>
          </a>
       </div>
    </section>
 </div>

@include('mobile.main-nav')
@endsection
