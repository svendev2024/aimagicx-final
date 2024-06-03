<?php

namespace App\Http\Controllers\Admin\Webhooks;

use App\Http\Controllers\Controller;
use App\Traits\ConsumesExternalServiceTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MollieWebhookController extends Controller
{
    use ConsumesExternalServiceTrait;

    private $key;
    private $baseURI;

    public function __construct()
    {
        $this->key = config('services.mollie.key_id');
        $this->baseURI = config('services.mollie.base_uri');
       
    }


    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }


    public function resolveAccessToken()
    {       
        return "Bearer {$this->key}"; 
    }

    /**
     * Stripe Webhook processing, unless you are familiar with 
     * Stripe's PHP API, we recommend not to modify it
     */
    public function handleMollie(Request $request)
    {
        if(!$request->has('id') ) {
            return;
        } 
        
        $payment = $this->getPayment($request->id);
          
        
        if($payment->status == 'paid') {

            Log::info(json_encode($payment));
        }

        http_response_code(200);
    }


    public function getPayment($paymentID)
    {
        return $this->makeRequest(
            'GET',
            '/v2/payments/' . $paymentID,
            [],
            []
        );        
    }
    
}
