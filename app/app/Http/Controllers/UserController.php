<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    
    public function dashboard(){
        return view('front.user.dashboard');
    }
    public function profile(){
        return view('front.user.profile');
    }
    public function securtiy(){
        return view('front.user.account');
    } 

    public function notifications(){
        return view('front.user.notification');
    } 

    public function updateEmail(){
        return view('front.user.update-email');
    } 
    public function confimrUpdateEmail(){
        return view('front.user.confirm-update-email');
    } 


    public function deviceManagement(){
        return view('front.user.deviceManagement');
    }    
 
    public function isUsernameExist(Request $request){
        $status = User::where('name',$request->name)->count() == 0 ? 'OK': 'NOT OK';
        $message = $status == 'OK' ? 'Congrats! Username: '.$request->name.' is available' :'Sorry ! This Username is not available.';
        return response()->json(['status'=>$status,'message'=>$message]);
    }
    public function updateNotificationSettings(Request $request){
        if($request->mode == 'sms_notification' || $request->mode = 'line_notification'){
            $user = Auth::user();
            $user->sms_notification = $request->mode == 'sms_notification' ? ($user->sms_notification == true ? false : true ) :$user->sms_notification ;
            $user->line_notification = $request->mode == 'line_notification' ? ($user->line_notification == true ? false : true) :$user->line_notification;
            $user->save();
            return response()->json(['status'=>'OK','message'=> __('The settings has been updated') ]);
        }
    }
    public function updateUsername(Request $request){
        if($request->has('username') && !empty($request->username)) {
            $user = Auth::user();
            $user->name = trim($request->username);
            $user->is_username_updated = 1;
            $user->save();
            return response()->json(['status'=>'OK','message'=> __('The username has been updated.') ]);
        }
    }
    public function updateCurrencySettings(Request $request){    
        if($request->has('currency') && !empty($request->currency)) {
            $user = Auth::user();
            $user->default_currency = (int)$request->currency;
            $user->save();
            return response()->json(['status'=>'OK','message'=> __('The currency settings has been updated.') ]);
        }
    }

    public function updateLanguageSettings(Request $request){    
        if($request->has('language') && !empty($request->language)) {
            $user = Auth::user();
            $user->default_language = (int)$request->language;
            $user->save();
            return response()->json(['status'=>'OK','message'=> __('The language settings has been updated.') ]);
        }
    }
}
