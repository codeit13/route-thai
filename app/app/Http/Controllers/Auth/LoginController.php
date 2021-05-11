<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request){
        return view('front.auth.login');
    }

    public function attemptLogin(Request $request)
    {
        
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember_me  = ( !empty( $request->remember_me ) )? TRUE : FALSE;

        if(Auth::attempt($credential) || Auth::viaRemember()){
            $user = User::where(["email" => $credential['email']])->first();
            Auth::login($user, $remember_me);
            return redirect()->withCookie(Cookie::make('logged_in', $user->remember_token, 43200))->intended('/home');
        }
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
        //     return redirect()->intended('/home');
        // }
        return back()->withInput($request->only('email', 'remember'));
    }
}
