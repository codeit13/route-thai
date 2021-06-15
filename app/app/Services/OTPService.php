<?php
namespace App\Services;

use App\Models\OTP;
use App\Mail\SignUpOTP;
use Mail;
use Carbon\Carbon;

class OTPService
{

    public $otp;

    public function __construct()
    {
        $this->otp = new OTP;
    }


    public function sendOTP($to, $channel = 'email'){
        $code = $this->otp->generate($to);
        Mail::to($to)->send(new SignUpOTP($code->value));
        return ['session_id'=>$code->id];
    }

    public function verifyOTP($to, $otp, $id){
        
        $q = $this->otp->where(['to'=>$to, 'value'=>$otp, 'id' => $id, 'expired'=>0]);
        if($q->count() > 0){
            $q =  $q->first();
            $q->expired = 1;
            return ['code'=>1, 'msg'=>'The OTP is verified.'];
        }
        return ['code'=>0, 'msg'=>'The OTP is not verified.'];
    }
}   