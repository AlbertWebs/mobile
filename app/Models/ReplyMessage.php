<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Mail;

class ReplyMessage extends Model
{
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
