<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

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
        return $this->performRequest('GET', $this->secret.'/SMS/+91'.$mobile.'/AUTOGEN');
    }
    public function verifyOtpSms($mobile, $code, $session){ 
        return $this->performRequest('GET', $this->secret.'/SMS/VERIFY/'.$session.'/'.trim($code));
    }   
}   