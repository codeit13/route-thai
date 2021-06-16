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
use Auth;

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

    public function sendOTPOnLogin(SendOTPonLogin $request)
    {   
        $user = User::select('mobile')->where('email',$request->email)->first();
        return $this->service->sendOtpSms($user->mobile);
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
    