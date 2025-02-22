<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

use Mail;

class MailOrder extends Model
{
    public static function MailOrder(){
        $Subject = 'Orders';
        $contactMessage = "Hi There, You May Have Received a New Order, Log In to the Admins Panel To check";
        $contactName = 'Evelyne Wambui';
        $ClientName = Auth::user()->name;
        $data = array(
            'name'=>$contactName,
            'subject'=>$Subject,
            'messageAppend'=>$contactMessage
        );

        $FromVariable = 'info@sokoafya.com';
        $FromVariableName = 'Sokofya Ecommerce';

        $toVariable = 'albertmuhatia@gmail.com';
        $toVariableName = 'Albert Muhatia';


        Mail::send('mail', $data, function($message) use ($Subject,$FromVariable,$FromVariableName,$toVariable,$toVariableName){
            $message->from($FromVariable , $FromVariableName);
            $message->to($toVariable, $toVariableName)->cc('wambuievelyne@gmail.com')->cc('ewaititu@gmail.com')->subject($Subject);

    });
    }
}
