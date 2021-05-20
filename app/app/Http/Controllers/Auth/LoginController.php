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
        
        
        if(Auth::attempt($credential) || Auth::viaRemember()){
            $user = User::where(["email" => $credential['email']])->first();
            Auth::login($user, $remember_me);
            $this->auth_locationlog();

            return redirect('/home')->withCookie(Cookie::make('logged_in', $user->remember_token, 43200));
        }
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
        //     return redirect()->intended('/home');
        // }
        return back()->withInput($request->only('email', 'remember'));
    }
    public function auth_locationlog(){
        $location = '{ "ip":"49.34.96.230", "type":"ipv4", "continent_code":"AS", "continent_name":"Asia", "country_code":"IN", "country_name":"India", "region_code":"GJ", "region_name":"Gujarat", "city":"Dholera", "zip":"382455", "latitude":22.249860763549805, "longitude":72.19344329833984, "location":{ "geoname_id":null, "capital":"New Delhi", "languages":[ { "code":"hi", "name":"Hindi", "native":"\u0939\u093f\u0928\u094d\u0926\u0940" }, { "code":"en", "name":"English", "native":"English" } ], "country_flag":"http:\/\/assets.ipstack.com\/flags\/in.svg", "country_flag_emoji":"\ud83c\uddee\ud83c\uddf3", "country_flag_emoji_unicode":"U+1F1EE U+1F1F3", "calling_code":"91", "is_eu":false } }';
        $location = json_decode($location);


        $newlocation = (array)$location;
        
        // dd($location->location);
        $newlocation['ip_address'] = $location->ip;
        $newlocation['country_flag'] = $location->location->country_flag;
        $newlocation['calling_code'] = $location->location->calling_code;
        $newlocation['country_flag_emoji'] = $location->location->country_flag_emoji;
        $newlocation['country_flag_emoji_unicode'] = $location->location->country_flag_emoji_unicode;
        unset($newlocation['location']);
        unset($newlocation['ip']);
        unset($newlocation['type']);
        $authlog =  Authentication_log::where('id',Auth::user()->authentications->first()->id)->update($newlocation);
        return true;

    }
}
