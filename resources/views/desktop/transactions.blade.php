@extends('mobile.master-profile')

@section('content')
<section class="p-3 bg-primary">
    <div class="d-flex align-items-center gurdeep-osahan-inner-header pb-5">
       <div class="left mr-auto">
          <a href="{{url('/')}}/mobile/profile" class="back_button"><i class="btn_detail shadow-sm mdi mdi-chevron-left bg-white text-dark"></i></a>
       </div>
       <div class="center mx-auto">
          <h6 class="text-dark mb-0"></h6>
       </div>
       <div class="right ml-auto d-flex align-items-center">
          <a href="{{url('/')}}/mobile/search" class="fav_button mr-2"><i class="btn_detail mdi mdi-magnify bg-danger text-white"></i></a>
          <a class="toggle btn_detail bg-white text-dark shadow-sm" href="#">
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
             </svg>
          </a>
       </div>
    </div>
    <h5 class="text-white">Transaction history</h5>
    <p class="text-white-50 mb-0">Here is your all Transaction history</p>
 </section>
 <section class="search p-3 bg-light body_rounded mt-n5">
    <p class="text-muted mb-4">{{today()}}</p>
    @foreach ($lnmo_api_response as $lnmr)
    <div class="d-flex align-items-center border-bottom pb-3 mb-3">
        <div>
            <?php
                $jsonData  =  $lnmr->checkout;
                $data = json_decode($jsonData, true);
                // dd($data);
            ?>
           <p class="mb-0"><strong>Payment For:</strong> </p>
           @if($data == null)
           <p class="text-danger">No data</p>
           @else
                @foreach ($data as $items)
                <p class="mb-0">{{$items['name']}} - {{$items['quantity']}}</p>
                @endforeach
            @endif
            {{--
             --}}

             @if($lnmr->MpesaReceiptNumber == null)
               <p class="text-danger">Pending Payment</p>
             @else
               <p class="text-success"><strong>{{$lnmr->MpesaReceiptNumber}}</strong></p>
             @endif
           <span class="text-muted small">{{$lnmr->TransactionDate}}</span>
        </div>
        <div class="ml-auto"><span class="bg-danger fs-5 text-white fw-bold rounded px-2 py-1">kes {{$lnmr->Amount}}</span></div>
     </div>
    @endforeach


 </section>

 @include('mobile.horizontal-nav')
 @include('mobile.main-nav')
@endsection
