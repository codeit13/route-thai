<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Log;
use App\Notifications\LaravelTelegramNotification;
use App\Services\OTPService;
use LINE;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
        $this->service = new OTPService();
    }
    
    public function dashboard(){
        return view('front.user.dashboard');
    }
    public function profile(){
        return view('front.user.profile');
    }
    public function line_bot() {
        return view('front.line-bot');
    }
    public function security(){
        return view('front.user.account');
    } 

    public function notifications(){
        return view('front.user.notification');
    } 

    public function updateEmail(){
        return view('front.user.update-email');
    } 

    public function updateMobile(Request $request){
        $request->validate([
            'mobile' => ['required', 'unique:users,mobile'],
        ]);
        $user = Auth::user();
        $user->mobile = $request->mobile;
        $user->sms_auth = 1;
        $user->save();
        return redirect()->route('user.security')->with('message','Your mobile has been updated.');
    }
    public function confimrUpdateEmail(Request $request){

        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'new_email' => ['required','unique:users,email'],
            'new_confirm_email' => ['same:new_email'],
        ]);
        $data = $this->service->sendOTP(Auth::user()->email, 'email');
        return view('front.user.confirm-update-email',compact('request','data'));
    } 
    public function  verifyEmailCode(Request $request){

        $request->validate([
            'code' => ['required'],
            'session_id' => ['required'],
        ]);
        
        $response = $this->service->verifyOTP(Auth::user()->email, $request->code, $request->session_id);
        if($response['code'] == 1) { 
            $user = Auth::user();
            $user->email = $request->email;
            $user->save();
            return redirect()->route('user.security')->with('message','Your email has been updated.');
            
        } else{
            return redirect()->route('user.updateEmail');
        }
    } 

    public function deviceManagement(Request  $request){
        $perpage = 15;
        $authentications = Auth::user()->authentications->forPage($request->page, $perpage);
        $page = $request->page;
        return view('front.user.deviceManagement',compact('authentications','perpage','page'));
    }     
    public function isUsernameExist(Request $request){
        $status = User::where('name',$request->name)->count() == 0 ? 'OK': 'NOT OK';
        $message = $status == 'OK' ? 'Congrats! Username: '.$request->name.' is available' :'Sorry ! This Username is not available.';
        return response()->json(['status'=>$status,'message'=>$message]);
    }
    public function updateNotificationSettings(Request $request){
        $user = Auth::user();
        if($request->mode == 'sms_notification'){
            $user->sms_notification = $request->mode == 'sms_notification' ? ($user->sms_notification == true ? false : true ) :$user->sms_notification ;
        } else if($request->mode == 'line_notification'){
            $user->line_notification = $request->mode == 'line_notification' ? (false ) :$user->line_notification ;
        } else if($request->mode == 'telegram_notification'){
            $user->telegram_notification = $request->mode == 'telegram_notification' ? ( false ) :$user->telegram_notification ;
        }
        $user->save();
        return response()->json(['status'=>'OK','message'=> __('The settings has been updated') ]);
    }
    public function updateTelegramUserIdSettings(Request $request){
            $user = Auth::user();
            $user->telegram_user_id = $request->telegram_user_id ;
            $user->telegram_notification = true;
            $user->save();
            if($user->telegram_notification) {
            $user->notify(new LaravelTelegramNotification([
                'text' => "Welcome to the application " . $user->name . "!",
                'telegram_user_id' => $user->telegram_user_id,
                ]));
            }
            return redirect()->route('user.dashboard');
    }
    public static function updateLineUserIdSettings($request){
        $user = Auth::user();
        $user->line_user_id = $request['line_user_id'];
        $user->line_name = $request['line_name'] ;
        $user->line_avatar = $request['line_avatar'] ;
        $user->line_access_token = $request['line_access_token'] ;
        $user->line_refresh_token = $request['line_refresh_token'] ;
        $user->line_notification = true;
        $user->save();
        LINE::pushmessage(
            $user->line_user_id,
            new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Your Line Notifications have been turned ON.')
        );
        return response()->json(['status'=>'OK','message'=> __('The line user id settings has been updated') ]);
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

    public function addGoogle2fa(){
        $google2fa = app('pragmarx.google2fa');
        $qrcode =  $google2fa->generateSecretKey();
        $QR_Image = $google2fa->getQRCodeInline(
            "Route Thai",
            Auth::user()->email,
            $qrcode
        );
        return view('front.user.addGoogle2fa',compact('QR_Image','qrcode'));
    }
    public function saveGoogle2fa(Request $request){
        $request->validate([
            'key' => ['required'] 
        ]);
        $user = Auth::user();
        $google2fa = app('pragmarx.google2fa');
        $secret = $request->input('key');
        $valid = $google2fa->verifyKey($request->secret, $secret);

        if($valid) {
            $user->google2fa_secret = $request->secret;
            $user->save();
            return redirect()->route('user.security');
        } else {
            return redirect()->route('user.security.2fa.google.add')->with('message','Entered key is invalid. Please try again.');
        }
    }
    public function verifyGoogle2fa(Request $request){
        $user = Auth::user();
        $user->google2fa_secret = $request->secret;
        $user->save();
        return redirect()->route('user.security');
    }
    public function verifyActivity(Request $request){
        
        $google2fa = app('pragmarx.google2fa');

        $request->validate([
            'code' => ['required'] 
        ]);
        $secret = $request->code;

        $valid = $google2fa->verifyKey(Auth::user()->google2fa_secret, $secret);
        $status = 'failed';
        if($valid) {
            $status = 'success';
        }
        return response()->json(['status'=>$status]);
    }   

    public function sendOTP($channel){
        $data = $this->service->sendOTP(Auth::user()->email, $channel);
        return $data;
    }
}
