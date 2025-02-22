@extends('mobile.master-profile')

@section('content')
<div class="d-flex align-items-center bg-light gurdeep-osahan-inner-header p-3">
    <div class="left mr-2">
       <a href="{{url('/')}}/mobile/profile/" class="back_button"><i class="btn_detail shadow-sm mdi mdi-chevron-left bg-dark text-white shadow-sm"></i></a>
    </div>
    <div class="center mr-auto">
       <h6 class="text-dark mb-0">My Orders</h6>
    </div>
    <div class="right ml-auto d-flex align-items-center">
       <a href="{{url('/')}}/mobile/search" class="ml-auto mr-2"><i class="btn_detail mdi mdi-magnify bg-danger text-white"></i></a>
       <a class="toggle btn_detail bg-dark shadow-sm text-white" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
             <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
       </a>
    </div>
 </div>

 <section class="p-3">
    @if($Order->isEmpty())
      <p class="small text-muted mb-0 mb-2">Today:  <strong>{{date('D d M Y')}}</strong> You Have Not Made Any Orders, Go to <a href="{{url('/')}}/mobile/get-started"></a> to place an order</p>
    @else
    <p class="small text-muted mb-0 mb-2">Today: <strong>{{date('D d M Y')}}</strong> </p>
        @foreach ($Order as $order)
            <div class="order_detail col-2 order_detail-2 mb-2 bg-dark p-1 box_rounded text-white text-center">
                <strong>
                    BITES#{{$order->id}}
                </strong>
            </div>
            <?php $Product = DB::table('menu_orders')->where('orders_id',$order->id)->get();  ?>
            @foreach ($Product as $item)
                <?php $Products = DB::table('menus')->where('id',$item->menu_id)->get();  ?>
                @foreach ($Products as $pro)
                <div class="order_detail order_detail-2 mb-2 bg-light p-3 box_rounded">
                    <a href="{{url('/')}}/mobile/profile/orders/{{$order->id}}" class="d-flex align-items-center pb-3">
                    <div class="bg-white box_rounded">
                        <img src="{{url('/')}}/uploads/menu/{{$pro->image}}" class="img-fluid rounded">
                    </div>
                    <div class="ml-3 d-flex w-100">
                        <div class="text-dark">
                            <p class="mb-1 fw-bold">{{$pro->title}}</p>
                            <p class="small text-muted mb-0"> {{date('D' , strtotime($order->created_at))}} {{date('d' , strtotime($order->created_at))}} {{date('M' , strtotime($order->created_at))}}, {{date('Y' , strtotime($order->created_at))}} <span class="ml-1"><i class="mdi mdi-circle-medium mr-1"></i>{{date('H:i' , strtotime($order->created_at))}}</span></p>
                        </div>
                    </div>
                    </a>

                </div>
                @endforeach
            @endforeach

            <div class="d-flex justify-content-between">
                {{-- Only Show Reorder When Status is Completed --}}
                @if($order->status == "completed")
                   <a onclick="return confirm('Reorder This Now?')" data-url="{{url('/')}}/mobile/profile/orders/re-order/{{$order->id}}" class="btn btn-primary btn-block mr-1 box_rounded w-50 btn-sm py-2 re-order">Reorder <span style="visibility: hidden" class="spinner-border spinner-border-sm" role="status"></span></a>
                @elseif($order->status == "confirmed")
                <a href="whatsapp://send?text=Tracking My Order Number:BITES{{$order->id}}&phone=+254706788440" class="btn btn-outline-primary btn-block ml-1 box_rounded w-50 btn-sm py-2"><span class="mdi mdi-whatsapp"></span> Track Order</a>
                @endif


                @if($order->status == "pending")
                   <a href="#" class="btn btn-outline-danger btn-block ml-1 box_rounded w-50 btn-sm py-2"><span class="mdi mdi-clock"></span> Pending</a>
                @elseif($order->status == "confirmed")
                   <a href="#" class="btn btn-outline-warning btn-block ml-1 box_rounded w-50 btn-sm py-2"><span class="mdi mdi-clock"></span> Confirmed</a>
                @else
                   <a href="#" class="btn btn-outline-success btn-block ml-1 box_rounded w-50 btn-sm py-2 re-order"><span class="mdi mdi-check"></span> <strong>Completed</strong></a>
                @endif
            </div>
            <hr>
        @endforeach
    @endif

 </section>
@include('mobile.main-nav')
@include('mobile.horizontal-nav')
@endsection
