<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;


class ExchangeRatesService
{
    use ConsumeExternalService;

    /**
     * The base uri to consume exchange service
     * @var string
     */
    public $baseUri;

    


     public function crypto_rates()
    {
        $this->baseUri = config('services.exchange.crypto_uri');

        return $this->performRequest('GET','ticker/24hr',[], ['content-type'=>'application/x-www-form-urlencoded']);
    }

     public function fiat_rates()
    {

        $this->baseUri   =   config('services.exchange.fiat_uri');

        return $this->performRequest('GET','exchange-rates',[], ['content-type'=>'application/x-www-form-urlencoded']);
    }
}   