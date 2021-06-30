<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\User;
use App\Services\OTPService;
use Hash; 
use Auth;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->service = new OTPService();
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.user.change-password');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'otp' => ['required'],
        ]);
        $response = $this->service->verifyOTP(Auth::user()->email, $request->otp, $request->session_id);
        if($response['code'] == 1) {
            $request->validate([
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);
            User::find(auth()->user()->id)->update(['email'=> Hash::make($request->new_password)]);
            return redirect()->route('user.security','request');
        }
    }
}
