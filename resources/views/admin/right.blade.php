<div id="right">


            <div class="well well-small">
                <ul class="list-unstyled">
                    <li>Admin &nbsp; : <span><?php $Admins = DB::table('users')->where('is_admin','1')->get(); $Count = count($Admins); echo $Count ?></span></li>
                    <li>Users &nbsp; : <span><?php $Users = DB::table('users')->where('is_admin','0')->get(); $Count = count($Users); echo $Count ?></span></li>
                    <li>Subscribers &nbsp; : <span><?php $Subscribers = DB::table('subscribers')->get(); $Count = count($Subscribers); echo $Count ?></span></li>

                </ul>
            </div>
            <div class="well well-small">
                <button type="button" class="btn btn-block"> Help </button>
                <button type="button" onclick="window.open('{{url('/admin/Products_featured')}}','_self')" class="btn btn-primary btn-block"> Featured</button>
                <button type="button" onclick="window.open('{{url('/admin/Products_offer')}}','_self')" class="btn btn-primary btn-block"> Offers</button>
                <button type="button" onclick="window.open('{{url('/admin/categories')}}','_self')" class="btn btn-warning btn-block"> Categories</button>
                <button type="button" onclick="window.open('{{url('/admin/subscribers')}}','_self')" class="btn btn-success btn-block"> Subscribers </button>
                <button type="button" onclick="window.open('{{url('/admin/notifications')}}','_self')" class="btn btn-danger btn-block"> Notifications </button>
                <button type="button" onclick="window.open('{{url('/admin/discounts')}}','_self')" class="btn btn-danger btn-block"> Discounts </button>
                <button type="button" onclick="window.open('{{url('/admin/orders')}}','_self')" class="btn btn-danger btn-block"> Orders </button>
                <button type="button" onclick="window.open('{{url('/admin/updates')}}','_self')" class="btn btn-inverse btn-block"> Updates </button>


            </div>
            {{-- <div class="well well-small">
                <span>Profit</span><span class="pull-right"><small>20%</small></span>

                <div class="progress mini">
                    <div class="progress-bar progress-bar-info" style="width: 20%"></div>
                </div>
                <span>Sales</span><span class="pull-right"><small>40%</small></span>

                <div class="progress mini">
                    <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                </div>
                <span>Pending</span><span class="pull-right"><small>60%</small></span>

                <div class="progress mini">
                    <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
                </div>
                <span>Summary</span><span class="pull-right"><small>80%</small></span>

                <div class="progress mini">
                    <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
                </div>
            </div> --}}




        </div>
