<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Auth;
use Hash;
use DB;
use App\Models\User;
use App\Models\Code;
use App\Models\Menu;
use App\Models\orders;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ReplyMessage;
use App\Models\STKRequest;
use App\Models\STKMpesaTransaction;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use Response;
use Session;
use Illuminate\Support\Facades\Log;

class MobileController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $Menu = Menu::paginate(12);
        // $Menu = DB::table('menus')->limit(12)->get();
        $Category = DB::table('category')->get();
        $Orders = DB::table('orders')->where('user_id', Auth::User()->id)->get();
        if ($request->ajax()) {
            $view = view('mobile.data', compact('Menu'))->render();
            return response()->json(['html' => $view]);
        }
        return view('mobile.home', compact('Menu','Category','Orders'));
    }



    public function getMenu(Request $request)
    {
        $results = Menu::orderBy('id')->paginate(3);
        $Menu = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $Menu.=
                '
                <span class="col-6 pr-2" href="detail1#html">
                    <div class="bg-white box_rounded overflow-hidden mb-3 shadow-sm">
                    <img width="100%" src="{{url('/')}}/uploads/menu/$result->thumbnail" class="img-fluid">
                    <div class="p-2">
                        <p class="text-dark mb-1 fw-bold">$result->title</p>
                        <p class="small mb-2"><i class="mdi mdi-star text-warning"></i> <span class="font-weight-bold text-dark ml-1 fw-bold">4.8</span> <span class="text-muted"> <span class="mdi mdi-circle-medium"></span> African <span class="mdi mdi-circle-medium"></span> kes $result->price </span> <span class="bg-light d-inline-block font-weight-bold text-muted rounded-3 py-1 px-2">25-30 min</span></span></p>
                        <p class="small mb-0 text-muted ml-auto"><a class="text-danger" href="{{url('/')}}/mobile/shopping-cart/add-to-cart/$result->id">Add to Basket <i class="mdi mdi-cart text-danger"></i></a></p>
                    </div>
                    </div>
                </span>
                ';
            }
            return $Menu;
        }
        return view('mobile.home');
    }


    public function add_to_cart($id)
    {
        $Product = Menu::find($id);
        \Cart::add([
            'id' => $Product->id,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => 1,
            'attributes' => array(
            'image' => $Product->thumbnail,
            )
        ]);
        $data = $Product->title." has been added to basket";
        return Response::json($data);
    }

    public function add_to_cart_get($id)
    {
        $Product = Menu::find($id);
        \Cart::add([
            'id' => $Product->id,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => 1,
            'attributes' => array(
            'image' => $Product->thumbnail,
            )
        ]);
        $data = $Product->title." has been added to basket";
        $cartItems = \Cart::getContent();
        return view('mobile.checkout', compact('cartItems'));
    }


    public function orders_re_order($id)
    {
        $Order = DB::table('orders')->where('id',$id)->get();
        foreach($Order as $order){
           $OrderProducts = DB::table('menu_orders')->where('orders_id',$order->id)->get();
           foreach($OrderProducts as $orderproducts){
               $products_id = $orderproducts->menu_id;
               $qty = $orderproducts->qty;
               $Product = Menu::find($products_id);
                \Cart::add([
                    'id' => $Product->id,
                    'name' => $Product->title,
                    'price' => $Product->price,
                    'quantity' => 1,
                    'attributes' => array(
                    'image' => $Product->thumbnail,
                    )
                ]);
           }
        }
        $data = "Success";
        return Response::json($data);
    }




    public function orders(){
        $Order = DB::table('orders')->where('user_id', Auth::User()->id)->get();
        return view('mobile.orders', compact('Order'));
    }

    public function orders_details($id){
        $Order = DB::table('orders')->where('id', $id)->get();
        $OrderProducts = DB::table('menu_orders')->where('orders_id', $id)->get();

        return view('mobile.orders-details', compact('Order', 'OrderProducts'));
    }


    public function transactions(){
        // Get all from table lnmo_api_response where status is 1 for the logged in user

        $lnmo_api_response = DB::table('lnmo_api_response')->where('user_id', Auth::User()->id)->where('status', 1)->get();
        return view('mobile.transactions', compact('lnmo_api_response'));
    }


    public function edit_profile(){
        return view('mobile.edit-profile');
    }

    public function profile(){
        return view('mobile.profile');
    }

    public function offers(){
        return view('mobile.offers');
    }

    public function veryfy_number(){
        return view('mobile.veryfy-number');
    }

    public function verification_code(){
        return view('mobile.verification-code');
    }

    public function search(){
        $Category = DB::table('category')->get();
        $Menu = DB::table('menus')->where('title','0')->get();
        return view('mobile.search', compact('Menu','Category'));
    }

    public function food(){
        $Menu = DB::table('menus')->get();
        return view('mobile.food', compact('Menu'));

    }

    public function shopping_cart(){
        $cartItems = \Cart::getContent();
        // dd($cartItems);

        return view('mobile.shopping-cart', compact('cartItems'));
    }

    public function checkout(){
        $cartItems = \Cart::getContent();
        return view('mobile.checkout', compact('cartItems'));
    }

    public function menu($menu){
        $Menu = DB::table('product')->where('slung', $menu)->get();
        return view('mobile.details', compact('Menu'));
    }

    public function menus(){
        $Menu = DB::table('menus')->get();
        return view('mobile.menu', compact('Menu'));
    }

    public function category($menu){
        $Menu = DB::table('category')->where('slung', $menu)->get();
        foreach ($Menu as $key => $value) {
            $Products = DB::table('menus')->where('cat_id', $value->id)->get();
        }
        return view('mobile.menu', compact('Menu','Products'));
    }

    public function menu_item($menu){
        $Products = DB::table('menus')->where('id', $menu)->get();
        return view('mobile.details', compact('Products'));
    }



    public function location(Request $request)
    {
        // $ip = $request->ip();
        $ip = '197.156.140.165';
        $currentUserInfo = Location::get($ip);

        return view('mobile.location', compact('currentUserInfo'));
    }

    public function removeCart($id)
    {
        \Cart::remove($id);
        session()->flash('success', 'Item Cart Remove Successfully !');
        return redirect()->route('cart.list.mobile');
    }


    public function generateCode(){
        $num_str = sprintf(mt_rand(1000, 9999));
        $Codes = DB::table('codes')->where('code',$num_str)->get();
        if($Codes->isEmpty()){
            $Add = new Code;
            $Add->code = $num_str;
            $Add->user = Auth::User()->id;
            $Add->save();
            $Code = $num_str;
        }else{
            $Code = $this->generateCode();
        }
        return $Code;
    }


    public function send_verification_test(Request $request){
        // Generate Random Code
        $Code = $this->generateCode();

        $Message = "$Code is Your Shaq's House Verification code";
        $PhoneNumber = "+254723014032";

        $this->send($Message,$PhoneNumber);
        return response()->json([
            "message" => "Success"
        ]);


    }

    public function send_verification(Request $request){
        // Generate Random Code
        $Code = $this->generateCode();

        $Message = "$Code is Your Shaq's House Verification code";
        $PhoneNumber = $request->mobile;

        $this->send($Message,$PhoneNumber);
        return response()->json([
            "message" => "Success"
        ]);


    }

    public function verify(Request $request){
        $code = $request->code;
        $Check =  DB::table('codes')->where('code',$code)->get();
        if($Check->isEmpty()){
            return response()->json([
                "message" => "Wrong Code"
            ]);
        }else{
            $updateDetails = array('status'=>1);
            DB::table('codes')->where('user', Auth::User()->id)->where('code',$code)->update($updateDetails);
            return response()->json([
                "message" => "Success"
            ]);
        }
    }



     public function send($phoneNumber,$Message){
        $message = $Message;
        $phone =$phoneNumber;
        $senderid = "SHAQSHOUSE";
        //
        $url = 'https://portal.zettatel.com/SMSApi/send';
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYnVsay5jbG91ZHJlYnVlLmNvLmtlXC8iLCJhdWQiOiJodHRwczpcL1wvYnVsay5jbG91ZHJlYnVlLmNvLmtlXC8iLCJpYXQiOjE2NTM5Nzc0NTEsImV4cCI6NDgwOTczNzQ1MSwiZGF0YSI6eyJlbWFpbCI6ImluZm9AZGVzaWduZWt0YS5jb20iLCJ1c2VyX2lkIjoiMTQiLCJ1c2VySWQiOiIxNCJ9fQ.N3y4QhqTApKi46YSiHmkaoEctO9z6Poc4k1g44ToyjA";

            $post_data=array(
            'sender'=>$senderid,
            'phone'=>$phone,
            'correlator'=>'Verification',
            'link_id'=>null,
            'message'=>$message
            );

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://portal.zettatel.com/SMSApi/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "userid=shaqshouse&password=vB4xy3eY&sendMethod=quick&mobile=+$phone&msg=$message&senderid=$senderid&msgType=text&duplicatecheck=true&output=json",
                CURLOPT_HTTPHEADER => array(
                    "apikey: e9d00bd511565ce0a7cfc40fe779bc9d33fdc737",
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
            // dd($response);
            return response()->json($response);
    }



    public function place_orders(){
        // Create Invoice
        $Invoice = DB::table('invoices')->orderBy('id','DESC')->Limit('1')->get();
        $count_mpesa = count($Invoice);
        if($count_mpesa == 0){
            $InvoiceNumber = 'SCZ01';
        }else{
            foreach($Invoice as $mpesa){
                $LastID = $mpesa->id;
                $Next = $LastID+1;
                $InvoiceNumber = "SCZ0".$Next;
            }
        }
        $Invoice = new Invoice;
        $Invoice->number = $InvoiceNumber;
        $Invoice->shipping = "100";
        $Invoice->products = serialize(\Cart::getContent());
        $Invoice->user_id = Auth::user()->id;
        $Invoice->amount = \Cart::getTotal();
        $Invoice->save();

        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $phone = Auth::user()->mobile;
        $InvoiceNumber = $InvoiceNumber;
        $ShippingFee = 100;
        $TotalCost = \Cart::getTotal();

        $CartItems = \Cart::getContent();
        if($CartItems->isEmpty()){
            return redirect()->route('get-started');
        }else{
            Orders::createOrder($InvoiceNumber);
            // Send To Merchant
            $date = date('h:i:s');
            $MessageMerchant = "Order Number $InvoiceNumber, Has Been Placed at $date by $name, Email:$email and Phone:$phone";
            $MerchantPhoneNumber = "254706788440";
            $this->send($MessageMerchant,$MerchantPhoneNumber);
            // Send To Client
            $Message = "Your Order #$InvoiceNumber has been Placed successfully";
            $this->send($Message,$phone);
            ReplyMessage::mailclient($email,$name,$InvoiceNumber,$ShippingFee,$TotalCost);
            \Cart::clear();
            Session::flash('message', $Message);
            return redirect()->route('get-started');
        }
    }

    public function update_profile(Request $request){
        $name = $request->name;
        $email = $request->email;
        $mobile = $request->mobile;
        $address = $request->address;

        $updateDetails = array(
            'name' =>$name,
            'email' =>$email,
            'mobile' =>$mobile,
            'location' =>$address,
        );
        DB::table('users')->where('id', Auth::User()->id)->update($updateDetails);
        return response()->json([
            "message" => "Success"
        ]);
    }

    public function edit_profile_pic(){
        $User = User::find(Auth::User()->id);
        return view('mobile.edit-profile-pic', compact('User'));
    }

    public function mailClient(){
        $User = User::find(Auth::User()->id);
        $content = "Contents";
        $subject = "Your Order Is Placed!";
        $name = "Albert Muhatia";
        $ShippingFee = 100;
        $CartItems = \Cart::getContent();
        $TotalCost = \Cart::getTotal();
        $invoicenumber = "SHAQ001";
        return view('mailClient', compact('User','content','subject','name','CartItems','ShippingFee','TotalCost','invoicenumber'));
    }



    public function edit_profile_post(Request $request){
        $updateDetails = array(
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'location'=>$request->location,
         );

         DB::table('users')->where('id', Auth::User()->id)->update($updateDetails);
         $User = User::find(Auth::User()->id);
         return view('mobile.edit-profile', compact('User'));
    }
    public function edit_profile_pic_post(Request $request){
        if($request->file('avatar')){
            $file= $request->file('avatar');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('uploads/users'), $filename);
            // $data['image']= $filename;
        }
        else{
            $filename = $request->fake_avatar;
        }
        $updateDetails = array(
           'image'=>$filename,
        );
        DB::table('users')->where('id', Auth::User()->id)->update($updateDetails);
        $User = User::find(Auth::User()->id);
        return view('mobile.edit-profile-pic', compact('User'));
    }

    // Search method to search menu
    public function search_menu(Request $request){
        $search = $request->search;
        $Menu = DB::table('menus')->where('title','LIKE','%'.$search.'%')->get();
        return view('mobile.search', compact('Menu'));
    }

    public function search_post(Request $request){
        // dd($request->key);
        $Menu = DB::table('menus')->where('title','LIKE','%'.$request->key.'%')->paginate(3);
        if ($request->ajax()) {
            $view = view('mobile.data', compact('Menu'))->render();
            return response()->json(['html' => $view]);
        }
        return view('mobile.search', compact('Menu'));
    }



    public function lipaNaMpesaPassword()
    {
        $lipa_time = Carbon::rawParse('now')->format('YmdHms');
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $BusinessShortCode = 174379;
        $timestamp =$lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $lipa_na_mpesa_password;
    }

    public function generateAccessToken()
    {
        $consumer_key = config('mpesa.consumer_key');
        $consumer_secret = config('mpesa.consumer_secret');


        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        Log::info($curl_response);
        return $access_token->access_token;
    }

    public function test_stk(){
        $AmountSTK = 1;
        $phoneNumber = "254723014032";
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => env('BUSINESSSHORTCODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $AmountSTK,
            'PartyA' => $phoneNumber, // replace this with your phone number
            'PartyB' => env('STKPARTYB'),
            'PhoneNumber' => $phoneNumber, // replace this with your phone number
            'CallBackURL' => env('STK_CALLBACKURL'),
            'AccountReference' => "Shaqs House Limited",
            'TransactionDesc' => "TEST"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
    }



    public function customerMpesaSTKPush(Request $request)
    {
       // check user table if phone mobile field is empty if its empty update with $request->mobile
        $user = \App\Models\User::where('id', $request->user_id)->first();
        if($user){
            $user->mobile = $request->mobile;
            $user->save();
        }



        $phoneNumber = str_replace("+","",$request->mobile);
        $AmountSTK = $request->amount;

        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => env('BUSINESSSHORTCODE'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $AmountSTK,
            'PartyA' => $phoneNumber, // replace this with your phone number
            'PartyB' => env('STKPARTYB'),
            'PhoneNumber' => $phoneNumber, // replace this with your phone number
            'CallBackURL' => env('STK_CALLBACKURL'),
            'AccountReference' => "Shaqs House Limited",
            'TransactionDesc' => "TEST"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        // return $curl_response;

         // Insert MerchantRequestID
         $curl_content=json_decode($curl_response);
         $MerchantRequestID = $curl_content->MerchantRequestID;
         $mpesa_transaction = new STKRequest;
         $mpesa_transaction->CheckoutRequestID =  $curl_content->CheckoutRequestID;
         $mpesa_transaction->MerchantRequestID =  $MerchantRequestID;
         $mpesa_transaction->user_id =  $request->user_id;
         $mpesa_transaction->PhoneNumber =  $phoneNumber;
         $mpesa_transaction->Amount =  $AmountSTK;
         $mpesa_transaction->save();


         $STKMpesaTransaction = new STKMpesaTransaction;
         $STKMpesaTransaction->user_id = $request->user_id;
         $STKMpesaTransaction->CheckoutRequestID = $curl_content->CheckoutRequestID;
         $STKMpesaTransaction->MerchantRequestID = $MerchantRequestID;
         $STKMpesaTransaction->PhoneNumber = $phoneNumber;
         $STKMpesaTransaction->Amount = $AmountSTK;
         $STKMpesaTransaction->checkout = $request->cartItems;
         $STKMpesaTransaction->save();

         Log::info($curl_response);

         $CheckoutRequestID = $curl_content->CheckoutRequestID;
         $table = 'lnmo_api_response';
         return $this->checklast($CheckoutRequestID,$curl_response,$request->user_id);
    }

    public function checklast($AccID,$curl_response,$user){

        $TableData = DB::table('lnmo_api_response')->where('CheckoutRequestID', $AccID)->where('status','1')->get();
        if($TableData->isEmpty()){
            sleep(10);
            return $this->checklast($AccID,$curl_response,$user);
        }else{
            $UpdateDetails = array(
                'status'=>1,
            );
            $UpdateDetail = array(
                'user_id'=>$user,
            );
            DB::table('s_t_k_requests')->where('CheckoutRequestID',$AccID)->update($UpdateDetails);
            //return json success
            return response()->json(['message'=>'Success']);
        }
    }


    public function customerMpesaSTKPushCallBack(Request $request){
        Log::info($request->getContent());
        $content=json_decode($request->getContent(), true);
        $CheckoutRequestID = $content['Body']['stkCallback']['CheckoutRequestID'];
        $MerchantRequestID = $content['Body']['stkCallback']['MerchantRequestID'];

        $nameArr = [];
        foreach ($content['Body']['stkCallback']['CallbackMetadata']['Item'] as $row) {

            if(empty($row['Value'])){
                continue;
            }
            $nameArr[$row['Name']] = $row['Value'];
        }

        DB::table('lnmo_api_response')->where('MerchantRequestID',$MerchantRequestID)->update($nameArr);
        $updateStatus = array(
            'status' =>1
        );
        DB::table('lnmo_api_response')->where('MerchantRequestID',$MerchantRequestID)->update($updateStatus);
        return response()->json(['message' => 'CallBack Received successfully!']);
    }

    public function stk_push(Request $request){
        $amount = $request->amount;
        $mobile = $request->mobile;
        Log::info("$mobile Initiated STK Push for amout $amount");

        // Initiatre STK
        $AmountSTK = $amount;
        $phoneNumber = str_replace( '+', '', $mobile);
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken()));
        $curl_post_data = [
            //Fill in the request parameters with valid values
            'BusinessShortCode' => config('mpesa.businessshortcode'),
            'Password' => $this->lipaNaMpesaPassword(),
            'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $AmountSTK,
            'PartyA' => $phoneNumber, // replace this with your phone number
            'PartyB' => config('mpesa.stkpartyb'),
            'PhoneNumber' => $phoneNumber, // replace this with your phone number
            'CallBackURL' => config('mpesa.stk_callback'),
            'AccountReference' => "Shaqs House Limited",
            'TransactionDesc' => "TEST"
        ];
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        // dd($curl_response);

        // Insert MerchantRequestID
        $curl_content=json_decode($curl_response);
        $MerchantRequestID = $curl_content->MerchantRequestID;
        $mpesa_transaction = new STKRequest;
        $mpesa_transaction->CheckoutRequestID =  $curl_content->CheckoutRequestID;
        $mpesa_transaction->MerchantRequestID =  $MerchantRequestID;
        $mpesa_transaction->user_id =  Auth::User()->id;
        $mpesa_transaction->PhoneNumber =  $phoneNumber;
        $mpesa_transaction->Amount =  $AmountSTK;
        $mpesa_transaction->save();



        $STKMpesaTransaction = new STKMpesaTransaction;
        $STKMpesaTransaction->user_id = Auth::User()->id;
        $STKMpesaTransaction->CheckoutRequestID = $curl_content->CheckoutRequestID;
        $STKMpesaTransaction->MerchantRequestID = $MerchantRequestID;
        $STKMpesaTransaction->PhoneNumber = $phoneNumber;
        $STKMpesaTransaction->orders = $phoneNumber;
        $STKMpesaTransaction->Amount = $AmountSTK;
        $STKMpesaTransaction->checkout = \Cart::getContent();
        $STKMpesaTransaction->save();

        Log::info($curl_response);

        $CheckoutRequestID = $curl_content->CheckoutRequestID;
        $user_id = Auth::User()->id;
        $user_name = Auth::User()->name;
        $table = 'lnmo_api_response';
        $this->checklast($CheckoutRequestID,$curl_response,$user_id);
        // Place Order.
        orders::createOrder();
        // SMS KETTLE HOUSE
        $smsMessage = "Dear $user_name Thanks for your order! We are firing up the grill. Your Meal will be ready in 25-30 minutes Fresh and delicious!";
        $this->send(str_replace( '+', '', $request->mobile),$smsMessage);
        $Admin = "+254706788440";
        $AdminMessage = "You have a new order from $user_name;";
        $this->send(str_replace( '+', '', $Admin),$AdminMessage);
        // Clear Cart
        \Cart::clear();
        return response()->json([
            "message" => "Success"
        ]);
    }
}
