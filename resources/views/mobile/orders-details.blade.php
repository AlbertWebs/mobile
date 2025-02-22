@extends('mobile.master-profile')

@section('content')
@foreach ($Order as $order)
    <div class="padding_bottom">
        <div class="d-flex align-items-center bg-light gurdeep-osahan-inner-header p-3">
        <div class="left mr-auto">
            <a href="{{url('/')}}/mobile/profile/orders" class="back_button"><i class="btn_detail shadow-sm mdi mdi-chevron-left bg-dark text-white shadow-sm"></i></a>
        </div>
        <div class="center mx-auto">
            <h6 class="text-dark mb-0">Order #1DFF90E</h6>
        </div>
        <div class="right ml-auto d-flex align-items-center">
            <a class="toggle btn_detail bg-dark shadow-sm text-white" href="tel:254723014032">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </a>
        </div>
        </div>
        <section class="bg-light p-3">
        <a href="detail1.html" class="d-flex align-items-center pb-3">
            <div class="bg-white box_rounded">
                <img src="{{asset('mobileTheme/img/1.png')}}" class="img-fluid box_rounded">
            </div>
            <div class="ml-3 d-flex w-100">
                <div class="text-dark fw-bold">
                    <h6 class="mb-1 fw-bold">Oberoia Special</h6>
                    <p class="small text-muted m-0">July 06, 2022 <span class="ml-1"><i class="mdi mdi-circle-medium mr-1"></i>23:54</span></p>
                </div>
                @if($order->status == "completed")
                  <div class="badge bg-success ml-auto mb-auto">Completed</div>
                @elseif($order->status == "confirmed")
                  <div class="badge bg-warning ml-auto mb-auto">Confirmed</div>
                @else
                  <div class="badge bg-danger ml-auto mb-auto">Pending</div>
                @endif

            </div>
        </a>
        <div class="d-flex justify-content-between">
            <button class="btn btn-danger btn-block mr-1 box_rounded  px-4 w-50">Reorder</button>
            <button class="btn btn-outline-danger btn-block ml-1 box_rounded w-50">Get Help</button>
        </div>
        </section>
        <section class="p-3 body_rounded mt-n5 bg-white">
        <p class="text-danger fw-bold mb-3 fs-6">Order Detais</p>
        <div class="details-page">
            <div class="d-flex align-items-center">
                <p class="bg-light rounded px-2 mr-3 text-muted">2</p>
                <p class="text-dark">Large Pizza</p>
                <p class="ml-auto">kes 22</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="bg-light rounded px-2 mr-3 text-muted">1</p>
                <p class="text-dark">Medium Fries</p>
                <p class="ml-auto">kes 4</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="bg-light rounded px-2 mr-3 text-muted">1</p>
                <p class="text-dark">Coca Cola</p>
                <p class="ml-auto"><span class="mr-2 text-danger small">2x</span>kes 3</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="text-dark">Subtotal</p>
                <p class="ml-auto">kes 52</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="text-dark">Delivery fee</p>
                <p class="ml-auto">kes 4</p>
            </div>
            <div class="d-flex align-items-center">
                <p class="text-dark fs-6 fw-bold">Total</p>
                <p class="ml-auto fw-bold text-danger fs-6">kes 56</p>
            </div>
            <div class="d-flex align-items-center mb-3">
                <p class="text-dark">M-PESA Number</p>
                <p class="ml-auto d-flex align-items-center">
                    <i class="mdi mdi-phone mr-2 fs-5 mb-0"></i>
                    <span class="dots-circle mr-2 small"><i class="mdi mdi-circle"></i> <i class="mdi mdi-circle"></i> <i class="mdi mdi-circle"></i> <i class="mdi mdi-circle"></i> <i class="mdi mdi-circle"></i> <i class="mdi mdi-circle"></i></span>
                    <span>4032</span>
                </p>
            </div>
        </div>
        </section>
        <section class="p-3 body_rounded mt-n5 bg-dark fixed-bottom">
            <h6 class="text-white mb-1">Rate your order</h6>
            <div class="rating-star d-flex align-items-center fs-3">
                <i class="mdi mdi-star text-warning mr-2"></i> <i class="mdi mdi-star text-warning mr-2"></i> <i class="mdi mdi-star text-warning mr-2"></i> <i class="mdi mdi-star text-warning mr-2"></i> <i class="mdi mdi-star-outline text-warning mr-2"></i>
                <button class="btn btn-warning ml-auto px-4">Review</button>
            </div>
        </section>
    </div>
 @endforeach
@include('mobile.main-nav')
@endsection
