<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri'  =>  $this->baseUri
        ]);
        // dd($this->baseUri.$requestUrl);
        // dd($formParams);
        $response = $client->request($method, $requestUrl, [
            'form_params' => $formParams,
            'headers'     => $headers,
            'http_errors' => false,
            'debug'=>false
        ]);

        return $response->getBody()->getContents();
    }
}