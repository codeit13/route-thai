<?php

namespace App\Http\Controllers;
use App\Notification\TwoFactorCode;

use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index() 
    {
        return view('front.auth.twoFactor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);

        $user = auth()->user();

        if($request->input('two_factor_code') == $user->two_factor_code)
        {
            $user->resetTwoFactorCode();

            return redirect()->route('home');
        }

        return redirect()->back()
            ->withErrors(['two_factor_code' => 
                'The two factor code you have entered does not match']);
    }

    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());

        return redirect()->route('verify.2f')->withMessage('The two factor code has been sent again');
    } 
}
