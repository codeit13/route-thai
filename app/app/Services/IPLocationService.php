<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class IPLocationService
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
        $this->secret = config('services.ipstack.secret');
        $this->baseUri = config('services.ipstack.base_uri');
    }

    public function getLocation($ipaddress){
        return $this->performRequest('GET',$ipaddress.'?access_key='.$this->secret.'&format=1');
    }

}