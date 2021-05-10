<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\SMSService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->service = new SMSService();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {        
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'otp' => ['required','array'],
            'mobile' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'name' => null,
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request){

        if($this->validator($request->all()) && $this->verifyOTP($request)) {
           $this->create($request->all());
           if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
             return redirect()->intended('/home');
           } 
        }
        return redirect()->intended('register')->withInput($request->all())->with('message', 'The entered OTP is wrong');
    }

    public function verifyOTP($request){
    
        $otp = implode('',$request->otp);
        $response = $this->service->verifyOtpSms($request->mobile, $request->code, $request->session);
        $response = json_decode($response);
        return $response->Status == 'success' ?  true: false;
    }

    public function showRegistrationForm(Request $request){
        return view('front.auth.register');
    }

    public function showOTPForm(Request $request){
        $data = $this->service->sendOtpSms($request->mobile);
        return view('front.auth.otp',compact('request','data'));
    }
}

