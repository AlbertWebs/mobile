<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use Auth;
use Hash;
use DB;
use App\Models\User;
use App\Models\Code;


class MobileLoginController extends Controller
{
    public function index(){
        if(Auth::User()){
            return redirect()->route('get-started');
        }else{
            return view('mobile.index');
        }
    }

    public function sign_in(){
        if(Auth::User()){
            return redirect()->route('get-started');
        }else{
            return view('mobile.sign-in');
        }
    }

    public function forgot_password(){
        if(Auth::User()){
            return redirect()->route('get-started');
        }else{
            return view('mobile.forgot-password');
        }
    }

    public function email_success(){
        if(Auth::User()){
            return redirect()->route('get-started');
        }else{
            return view('mobile.email-success');
        }
    }




    public function sign_up(Request $request)
    {
        if(Auth::User()){
            return redirect()->route('get-started');
        }else{
            $ip = $request->ip();
            // $ip = '197.156.140.165';
            $currentUserInfo = Location::get($ip);
            return view('mobile.sign-up', compact('currentUserInfo'));
        }
    }

    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $Username = Auth::User()->email;
                return response()->json([
                    "message" => "Success"
                ]);
        }else{
                return response()->json([
                    "message" => "Fail"
                ]);
        }
    }

    public function sign_up_post(Request $request){
         $name = $request->name;
         $email = $request->email;
         $mobile = $request->mobile;
         $address = $request->address;
         $password = $request->password;
         $password_confirm = $request->password_confirm;

         $User = DB::table('users')->where('email',$email)->get();
         $Check = count($User);

         if($password == $password_confirm){
            if($Check == 0){
                // create user
                $password_inSecured = $password;
                //harshing password Here
                $password = Hash::make($password_inSecured);
                $User = new User;
                $User->name = $request->name;
                $User->email = $request->email;
                $User->location = $request->address;
                $User->mobile = $request->mobile;
                $User->notes = " ";
                $User->password = $password;
                $User->save();

                $user = User::where('email','=',$email)->first();
                Auth::loginUsingId($user->id, TRUE);
                return response()->json([
                    "message" => "Success"
                ]);
            }else{
                return response()->json([
                    "message" => "That email is already in use by another person"
                ]);
            }
        }else{
            return response()->json([
                "message" => "Password Did Not Match!"
            ]);
        }
    }

    public function logouts(Request $request) {
        Auth::logout();
        return redirect('/mobile/sign-in');
      }
}
