<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait ConsumesExternalService
{

    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {               
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
        // try {
        //     $response = $client->request($method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers]);
        // } catch (GuzzleException $e) {
        //     return  $e;
        // }

        try {
            $response = $client->request($method, $requestUrl, ['form_params' => $formParams, 'headers' => $headers]);
        } catch (GuzzleException $e) {
            return  $e;
        }


        return $response->getBody()->getContents();
    }
}
