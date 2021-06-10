<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;
use DateTime;


class EmailService
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
        $this->secret = config('services.email.secret');
        $this->baseUri = config('services.email.base_uri');
    }

    public function sendEmail(){}

}   