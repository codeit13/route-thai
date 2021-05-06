<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SMSService;
use App\Http\Requests\SendOTPRequest;
use App\Http\Requests\VerifyOTPRequest;
use App\Http\Requests\SendOTPonLogin;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $service;

    public function __construct()
    {
        $this->service = new SMSService();
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

    public function sendOTP(SendOTPRequest $request)
    {   
        return $this->service->sendOtpSms($request->mobile);
    }

    public function verifyOTP(VerifyOTPRequest $request)
    {   
        return $this->service->verifyOtpSms($request->mobile, $request->code, $request->sessionid);
    }

    public function sendOTPOnLogin(SendOTPonLogin $request)
    {   
        $user = User::select('mobile')->where('email',$request->email)->first();
        return $this->service->sendOtpSms($user->mobile);
    }
}
    