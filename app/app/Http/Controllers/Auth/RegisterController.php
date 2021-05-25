<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Wallet;
use App\Services\SMSService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VerifyOTPRequest;

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
        // dd($data);
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'otp' => ['sometimes','array'],
            'mobile' => ['required','unique:users']
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


        $parts = explode("@",  strtolower($data['email']));
        $email = $parts[0];
        $username = $email;
        do
        { 
            $username = $email.rand(00, 9999999);
        }
        while(User::whereName($email)->exists());
        
        return User::create([
            'email' => $data['email'],
            'name' => $username,
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request){

        if($this->verifyOTP($request)) {
            $validator = $this->validator($request->all());
            if ($validator->errors()->count() > 0)
                return redirect()->intended('register')->withInput($request->all())->withErrors($validator); 
                
            $user = $this->create($request->all());
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                return redirect()->intended('/home');
            } 
        } 
        return redirect()->intended('register')->withInput($request->all())->with('message', 'The entered OTP is wrong');
    }

    public function verifyOTP(Request $request){    
        $otp = implode('',$request->otp);
        $response = $this->service->verifyOtpSms($request->mobile, $otp, $request->session);
        $response = json_decode($response);
        return $response->Status == 'Success' ?  true: false;
    }

    public function showRegistrationForm(Request $request){
        if(!Auth::check())
        return view('front.auth.register');
        else return redirect()->route('home');
    }

    public function showOTPForm(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->errors()->count() > 0)
        return redirect()->back()->withInput($request->all())->withErrors($validator); 
        $data = $this->service->sendOtpSms($request->mobile);
        return view('front.auth.otp',compact('request','data'));
    }

    public function isMobileNoExist(Request $request){
        $status = User::where('mobile',$request->mobile)->count() == 0 ? 'OK': 'NOT OK';
        $message = $status == 'OK' ? 'Congrats! You can register with this number':'Sorry ! This Mobile Number is already registered.';
        return response()->json(['status'=>$status,'message'=>$message]);
    }

    public function isEmailExist(Request $request){
        $status = User::where('email',$request->email)->count() == 0 ? 'OK': 'NOT OK';
        $message = $status == 'OK' ? 'Congrats! You can register with this email address.':'Sorry ! This email address is already registered.';
        return response()->json(['status'=>$status,'message'=>$message]);
    }

    public function isUserExist(Request $request){
        // $status = User::where('email',$request->email)->count() == 0 ? 'OK': 'NOT OK';
        // $message = $status == 'OK' ? 'Congrats! You can register with this email address.':'Sorry ! This email address is already registered.';
        // return response()->json(['status'=>$status,'message'=>$message]);
        $user = User::where('email',$request->email);
        $status = 'NOT OK';
        if($user->count() > 0 ){
            $hashedPassword = $user->first()->password;
            if(Hash::check($request->password, $hashedPassword)){
                $status = 'OK';
            } 
        }
       return response()->json(['status'=>$status]); 
    }
}


