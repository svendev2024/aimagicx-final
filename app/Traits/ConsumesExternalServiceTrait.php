<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServiceTrait
{
    /**
     * Part of payment processing feature.
     * Only used by Paypal and Stripe REST API codes.
     * 
     */
    public function makeRequest($method, $requestURL, $queryParams = [], $formParams = [], $headers = [], $isJSONRequest = false)
    {
        $client = new Client([
            'base_uri' => $this->baseURI
        ]);

        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }

        $response = $client->request($method, $requestURL, [
            $isJSONRequest ? 'json' : 'form_params' => $formParams,
            'headers' => $headers,
            'query' => $queryParams
        ]);

        $response = $response->getBody()->getContents();

        if (method_exists($this, 'decodeResponse')) {
            $response = $this->decodeResponse($response);
        }

        return $response;
    }
}