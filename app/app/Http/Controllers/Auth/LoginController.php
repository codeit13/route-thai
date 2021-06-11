<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\IPLocationService;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Cookie;
use Auth;
use App\Models\Authentication_log; 

use App\Notifications\LaravelTelegramNotification;

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
        $this->middleware('guest:web')->except('logout');
        $this->locationService = new IPLocationService();
    }

    public function showLoginForm(Request $request){
        if(!Auth::check())
        return view('front.auth.login'); 
        else return redirect()->route('home');
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
        
        
        if(Auth::attempt($credential, $request->get('remember')) || Auth::viaRemember()){
            $user = User::where(["email" => $credential['email']])->first();
            Auth::login($user, $remember_me);
            $this->auth_locationlog($request);
            $user->notify(new LaravelTelegramNotification([
                'text' => $user->name . " You currently logged in!",
                'telegram_user_id' => $user->telegram_user_id
            ]));
            return redirect('/home')->withCookie(Cookie::make('logged_in', $user->remember_token, 43200));
        }
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
        //     return redirect()->intended('/home');
        // }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function auth_locationlog(Request $request){
        $location = $this->locationService->getLocation($request->ip()); 
        $location = json_decode($location);
        $newlocation = (array)$location;
        $newlocation['ip_address'] = $location->ip;
        $newlocation['country_flag'] = $location->location->country_flag;
        $newlocation['calling_code'] = $location->location->calling_code;
        $newlocation['country_flag_emoji'] = $location->location->country_flag_emoji;
        $newlocation['country_flag_emoji_unicode'] = $location->location->country_flag_emoji_unicode;
        unset($newlocation['location']);
        unset($newlocation['ip']);
        unset($newlocation['type']);
        $authlog = Authentication_log::where('id',Auth::user()->authentications->first()->id)->update($newlocation);
        return true;
    }
}
