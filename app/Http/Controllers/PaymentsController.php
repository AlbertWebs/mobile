<?php

namespace App\Http\Controllers;
use Pesapal;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use AmrShawky\LaravelCurrency\Facade\Currency;

class PaymentsController extends Controller
{
    public function payment(Request $request){//initiates payment
        if($request->currency == "KES"){
            // $amount = $request -> amount;
            $amount = "1";
        }elseif($request->currency == "USD"){
            $amount = Currency::convert()->from('USD')->to('KES')->amount($request -> amount)->get();
        }elseif($request->currency == "GBP"){
            $amount = Currency::convert()->from('GBP')->to('KES')->amount($request -> amount)->get();
        }elseif($request->currency == "EUR"){
            $amount = Currency::convert()->from('EUR')->to('KES')->amount($request -> amount)->get();
        }
        $amount = "1";
        $payments = new Payment;
        $payments -> businessid = 1; //Business ID
        $payments -> transactionid = Pesapal::random_reference();
        $payments -> status = 'NEW'; //if user gets to iframe then exits, i prefer to have that as a new/lost transaction, not pending
        $payments -> amount = (int)$amount;
        $payments -> currency = $request->currency;
        $payments -> save();

        $details = array(
            'amount' => $payments -> amount,
            'description' => 'Armstrong-Boissons-Limited'.$request->first_name,
            'type' => 'MERCHANT',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phonenumber' => $request->mobile,
            'reference' => $payments -> transactionid,
            'height'=>'800px',
            'currency' => 'KES'
        );
        // dd($details);
        $iframe=Pesapal::makePayment($details);
        return view('payments.business.pesapal', compact('iframe'));
    }

    function sendMessage(){

    }

    public function sendSMS($Message,$PhoneNumber){
        $message = $Message;
        $phone =$PhoneNumber;
        $senderid = "DESIGNEKTA";
        //
        $url = 'https://bulk.cloudrebue.co.ke/api/v1/send-sms';
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYnVsay5jbG91ZHJlYnVlLmNvLmtlXC8iLCJhdWQiOiJodHRwczpcL1wvYnVsay5jbG91ZHJlYnVlLmNvLmtlXC8iLCJpYXQiOjE2NTM5Nzc0NTEsImV4cCI6NDgwOTczNzQ1MSwiZGF0YSI6eyJlbWFpbCI6ImluZm9AZGVzaWduZWt0YS5jb20iLCJ1c2VyX2lkIjoiMTQiLCJ1c2VySWQiOiIxNCJ9fQ.N3y4QhqTApKi46YSiHmkaoEctO9z6Poc4k1g44ToyjA";

            $post_data=array(
            'sender'=>$senderid,
            'phone'=>$phone,
            'correlator'=>'Whatever',
            'link_id'=>null,
            'message'=>$message
            );

        $data_string = json_encode($post_data);
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization:Bearer '.$token,
                'Content-Length: ' . strlen($data_string)
                )
            );

        $response = curl_exec($ch);
        curl_close($ch);
        // print_r($response);
    }
    public function paymentsuccess(Request $request)
    {
        // Create Order
        // Clear Cart
        \Cart::clear();
        $trackingid = $request->input('tracking_id');
        $ref = $request->input('merchant_reference');

        $payments = Payment::where('transactionid',$ref)->first();
        $payments -> trackingid = $trackingid;
        $payments -> status = 'Confirmed';
        $payments -> save();
        // Send SMS
        $u = Auth::User()->name;
        $sms_u = "Hello $u, Your Order Was Posted Successfully, Our delivery agent will contact you shortly";
        $sms_a = "New Order! You have received a new order, check your email for the order details";

        $phone = "254790841987";
        $this->sendSMS($sms_u,Auth::User()->mobile);
        $this->sendSMS($sms_a,$phone);
        //
        //go back home
        $payments=Payment::all();
        return view('payments.business.home', compact('payments'));
    }
    //This method just tells u that there is a change in pesapal for your transaction..
    //u need to now query status..retrieve the change...CANCELLED? CONFIRMED?
    public function paymentconfirmation(Request $request)
    {
        $trackingid = $request->input('pesapal_transaction_tracking_id');
        $merchant_reference = $request->input('pesapal_merchant_reference');
        $pesapal_notification_type= $request->input('pesapal_notification_type');

        //use the above to retrieve payment status now..
        $this->checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type);
    }
    //Confirm status of transaction and update the DB
    public function checkpaymentstatus($trackingid,$merchant_reference,$pesapal_notification_type){
        $status=Pesapal::getMerchantStatus($merchant_reference);
        $payments = Payment::where('trackingid',$trackingid)->first();
        $payments -> status = $status;
        $payments -> payment_method = "PESAPAL";//use the actual method though...
        $payments -> save();
        return "success";
    }
    public function make_payment(){
        $page_title = 'We will be Back Soon';
        return view('payments.business.make-payment',compact('page_title'));
    }
}
