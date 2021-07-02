<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SMSService;
use App\Services\OTPService;
use App\Http\Requests\SendOTPRequest;
use App\Http\Requests\VerifyOTPRequest;
use App\Http\Requests\SendOTPonLogin;
use App\Http\Requests\SendOTPonRegister;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Auth;

use App\Notifications\Notify;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $service;
    private $otpervice;

    public function __construct()
    {
        $this->service = new SMSService();
        $this->otpservice = new OTPService();
        
       }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
        return view('front.home');
    }

    public function arbitrage()
    {  
        return view('front.arbitrage');
    }

    public function twofactorauth(){
        return view('front.auth.twoFactor');  
    }
   
    public function sendOTP(SendOTPRequest $request)
    {   
        return $this->service->sendOtpSms($request->mobile);
    }

    public function verifyOTP(VerifyOTPRequest $request)
    {   
        return $this->otpservice->verifyOTP($request->email, $request->code, $request->sessionid);
    }
    public function verifyOTPMobile(VerifyOTPRequest $request)
    {   
        return $this->service->verifyOtpSms($request->mobile, $request->code, $request->sessionid);
    }

    public function sendOTPOnLogin(SendOTPonLogin $request)
    {   
        $user = User::select('mobile')->where('email',$request->email)->first();
        return $this->service->sendOtpSms($user->mobile);
    }

    public function getToken() {
        return csrf_token();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendMessage($user_id='', $loan_id='')
    {   Log::debug("Debug: " . $user_id . "," . $loan_id);
        $user = DB::table('users')->where('id', $user_id)->first();
        $Message = "[Route-Thai] Loan Order (Ending with " . substr($loan_id, -4) . ") got liquidated automatically.";
        Notify::sendMessage([   
            'sms_notification' => $user->sms_notification,
            'mobile' => $user->mobile,
            'telegram_notification' => $user->telegram_notification,
            'telegram_user_id' => $user->telegram_user_id,
            'line_notification' => $user->line_notification,
            'line_user_id' => $user->line_user_id,
            'email_notification' => $user->email_notification,
            'email_id' => $user->email,
            'Message' => $Message,
        ]);
        return response()->json(['message'=>$Message]);
    }

    public function sendOTPOnRegister(SendOTPonRegister $request)
    {   
        $data = $this->otpservice->sendOTP($request->email, 'email');
        return response()->json($data);
    }


    
    public function updatePassword(Request $request){
        return view('front.auth.update_password',compact('request'));
    }

    public function resetPassword(Request $request){
        $user = User::where('mobile',$request->mobile)->first();
        $user->password = Hash::make($request->password);
        $user->update();
        return redirect()->intended('login')->with('message', 'The password has been updated.');
    }
}