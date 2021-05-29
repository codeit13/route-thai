<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;
use DateTime;


class SMSService
{
    use ConsumeExternalService;

    /**
     * The base uri to consume Students service
     * @var string
     */
    public $baseUri;

    /**
     * Studentization secret to pass to Student api
     * @var string
     */

    public $secret;

    public function __construct()
    {
        $this->secret = config('services.sms.secret');
        $this->baseUri = config('services.sms.base_uri');
    }

    public function sendOtpSms($mobile){
        $mobile = str_replace([' ','-','(',')'],'',$mobile);
        return $this->performRequest('GET', $this->secret.'/SMS'.'/'.$mobile.'/AUTOGEN');
    }
    public function verifyOtpSms($mobile, $code, $session){ 
        return $this->performRequest('GET',$this->secret.'/SMS/VERIFY/'.$session.'/'.trim($code));
    }  
    
    
    public function send(Array $to, String $message , DateTime $schedule = NULL ){
        $from = 'TFCTOR';
        $to = trim(str_replace(['+',' '],'',implode(',',$to)));

      


        $message = $message;
        $param = array(
            "To" => $to,
            "Msg" =>$message,
        );      
        if($schedule != null) {
            $param['sendAt'] = $schedule;
        }       
        return $this->performRequest('POST', $this->secret.'/ADDON_SERVICES/SEND/PSMS',$param, ['Content-type'=>'application/json']);
    }
}   