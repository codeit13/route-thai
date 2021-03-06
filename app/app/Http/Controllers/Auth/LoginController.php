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

use Illuminate\Support\Facades\Log;
use App\Notifications\Notify;

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

            $location =  Authentication_log::whereNotNull('continent_code')->where('authenticatable_id',$user->id)->orderBy('id','DESC')->first();
            $Message = "Hi, ".$user->name . ", You currently logged in! \n";
            $Message .= "Location: ".$location->city.", ".$location->region_name.", ".$location->country_name."\n";
            $Message .= "IP Address: ".$location->ip_address;
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

            return redirect('/home')->withCookie(Cookie::make('logged_in', $user->remember_token, 43200));
        }
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

    // private function sendTelegramNotification($user){
    //     $location =  Authentication_log::whereNotNull('continent_code')->where('authenticatable_id',$user->id)->orderBy('id','DESC')->first();
    //     $welcomeMessage = 'Hi, ' . $user->name . ', You currently logged in! \n';
    //     $welcomeMessage .= 'Location: ' . $location->city. ', ' . $location->region_name . ', ' . $location->country_name . '\n';
    //     $welcomeMessage .= 'IP Address: ' . $location->ip_address;
        
    //     Log::debug($welcomeMessage);
    //     Log::debug($user->telegram_user_id);
    //     $welcomeMessage = str_replace(array('_'), '\\_', $welcomeMessage);
    //     $user->notify(new LaravelTelegramNotification([
    //         'text' => $welcomeMessage,
    //         'telegram_user_id' => $user->telegram_user_id,
    //     ]));
    // }   
    // private function sendLineNotification($user){
    //     $location =  Authentication_log::whereNotNull('continent_code')->where('authenticatable_id',$user->id)->orderBy('id','DESC')->first();
    //     $welcomeMessage = "Hi, ".$user->name . ", You currently logged in! \n";
    //     $welcomeMessage .= "Location: ".$location->city.", ".$location->region_name.", ".$location->country_name."\n";
    //     $welcomeMessage .= "IP Address: ".$location->ip_address;
    //     LINE::pushmessage(
    //         $user->line_user_id,
    //         new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($welcomeMessage)
    //     );
    // }
}
