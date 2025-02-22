@foreach ($Menu as $menu)
<a class="col-6 pr-2 order-btn" href="javascript:void(0);" id="{{$menu->id}}">
    <div class="bg-white box_rounded overflow-hidden mb-3 shadow-sm">
    <img style="height: 150px; width:100%; object-fit:cover" src="{{url('/')}}/uploads/menu/{{$menu->image}}" class="img-fluid">
    <div class="p-2">
        <p class="text-dark mb-1 fw-bold">{{$menu->title}}</p>
        <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> <?php $Cat = DB::table('category')->where('id',$menu->cat_id)->first() ?>{{$Cat->cat}}
        <span class="mdi mdi-circle-medium"></span> kes {{$menu->price}} </span></p>
        <p class="small mb-0 text-muted ml-auto"><span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span> &nbsp; <button id="{{$menu->id}}" class="pull-right order-btn" type="button">+ Order <span class="mdi mdi-food"></span></button></p>
    </div>
    </div>
</a>
@endforeach
