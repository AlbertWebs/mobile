@extends('mobile.master-home')

@section('content')
<div class="padding_bottom">
     <!-- Checkout Start -->
     <div class="panel-body">
        {!!html_entity_decode($iframe)!!}
    </div>
    <!-- Checkout End -->
</div>
@include('mobile.horizontal-nav')
    @include('mobile.main-nav')
@endsection
