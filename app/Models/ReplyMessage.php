<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Mail;

class ReplyMessage extends Model
{
    public static function mailclient($email,$name,$invoicenumber,$ShippingFee,$TotalCost){
        $message = 'Hello '.$name.'';
        $subject = 'Your Invoice Has Been Created';
        $CartItems = \Cart::getContent();

        // Process Cart

        //The Generic mailler Goes here
        $data = array(
            'invoicenumber'=>$invoicenumber,
            'content'=>$message,
            'subject'=>$subject,
            'ShippingFee'=>$ShippingFee,
            'TotalCost'=>$TotalCost,
            'name'=>$name,
            'CartItems'=>$CartItems,

        );


        $appName = config('app.name');
        $appEmail = config('mail.username');

        $FromVariable = "info@shaqshouse.co.ke";
        $FromVariableName = "Shaqs Bites";

        $toVariable = $email;

        $toVariableName = $name;


        Mail::send('mailclientInvoice', $data, function($message) use ($subject,$FromVariable,$FromVariableName,$toVariable,$toVariableName){
            $message->from($FromVariable , $FromVariableName);
            $message->to($toVariable, $toVariableName)->bcc('albertmuhatia@gmail.com')->cc('info@shaqsbites.co.ke')->cc('sales@shaqsbites.co.ke')->subject($subject);
        });
    }

    public static function mailmerchant($email,$name,$phone){
        $message = 'Hi, A person by name, '.$name.' and email address '.$email.' and phone number '.$phone.' Has purchases an item';
        $subject = 'New Order';
        //The Generic mailler Goes here
        $data = array(
            'name'=>$name,
            'email'=>$email,
            'content'=>$message,
            'service'=>$subject,

        );

        $FromVariable = "info@shaqshouse.co.ke";
        $FromVariableName = "Shaqs Bites Mailers";

        $toVariable = "info@shaqsbites.co.ke";
        $toVariableName = "Shaqs Bites Admin";



        Mail::send('mailclienttwo', $data, function($message) use ($subject,$FromVariable,$FromVariableName,$toVariable,$toVariableName){
            $message->from($FromVariable , $FromVariableName);
            $message->to($toVariable, $toVariableName)->cc('sales@shaqsbites.co.ke')->cc('albert@designekta.com')->cc('albertmuhatia@gmail.com')->subject($subject);
        });
    }


    public static function SendMessage($body,$subject,$name,$to,$id){
      //The Generic mailler Goes here
      $data = array(
        'name'=>$name,
        'subject'=>$subject,
        'messageAppend'=>$body
    );
    $appName = config('app.name');
    $appEmail = config('mail.username');


    $FromVariable = $appEmail;
    $FromVariableName = $appName;

    $toVariable = $to;
    $toVariableName = $name;


    Mail::send('mail', $data, function($message) use ($subject,$FromVariable,$FromVariableName,$toVariable,$toVariableName){
        $message->from($FromVariable , $FromVariableName);
        $message->to($toVariable, $toVariableName)->cc('')->cc('')->subject($subject);

});
  $updateDetail = array(
      'status' => 1
  );
  DB::table('messages')->where('id',$id)->update($updateDetail);
  return back();
    }

    public static function mailSubscriber(){

    }

    public static function mailSubscribers(){

    }
}
