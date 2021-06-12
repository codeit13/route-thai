<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

use Illuminate\Support\Facades\Log;

use App\Notifications\LaravelTelegramNotification;

// use Phattarachai\LineNotify\Facade\Line;

class UserController extends Controller
{
    
    public function dashboard(){
        return view('front.user.dashboard');
    }
    public function profile(){
        return view('front.user.profile');
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
            $user->line_notification = $request->mode == 'line_notification' ? ($user->line_notification == true ? false : true ) :$user->line_notification ;
        } else if($request->mode == 'telegram_notification'){
            $user->telegram_notification = $request->mode == 'telegram_notification' ? ($user->telegram_notification == true ? false : true ) :$user->telegram_notification ;
        }
        $user->save();
        return response()->json(['status'=>'OK','message'=> __('The settings has been updated') ]);
    }
    public function updateTelegramUserIdSettings(Request $request){
            $user = Auth::user();
            $user->telegram_user_id = $request->telegram_user_id ;
            $user->save();
            // Line::send('Hello bro!');
            // $profile = \LINEBot::getProfile('Ucbe288cc1c5ccfb8a80368c56a9918ce');
            // Log::info(json_encode($profile));
            if($user->telegram_notification) {
            $user->notify(new LaravelTelegramNotification([
                'text' => "Welcome to the application " . $user->name . "!",
                'telegram_user_id' => $user->telegram_user_id,
                ]));
            }
            // return response()->json(['status'=>'OK','message'=> __('The telegram user id settings has been updated') ]);
            return redirect()->route('user.dashboard');
    }
    public function updateLineUserIdSettings(Request $request){
        $user = Auth::user();
        $user->line_user_id = $request->line_user_id ;
        $user->save();
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
}
