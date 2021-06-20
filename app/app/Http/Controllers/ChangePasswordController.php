<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Models\User;
use Hash; 
class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'current_password' => ['required', new MatchOldPassword],
            'new_email' => ['required'],
            'new_confirm_email' => ['same:new_email'],
        ]);
        // User::find(auth()->user()->id)->update(['email'=> Hash::make($request->new_email)]);
        return redirect()->route('user.security','request');
    }
}
