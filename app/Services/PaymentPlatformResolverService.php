<?php

namespace App\Services;

use App\Models\PaymentPlatform;
use Illuminate\Support\Facades\Auth;
use DB;

class PaymentPlatformResolverService 
{
    protected $paymentPlatforms;

    public function __construct()
    {
        $this->paymentPlatforms = PaymentPlatform::all();
    }


    /**
     * Process payment platforms
     *
     * 
     */
    public function resolveService($paymentPlatformID)
    {
        $name = strtolower($this->paymentPlatforms->firstWhere('id', $paymentPlatformID)->name);

        $service = config("services.{$name}.class");

        if ($service) {
            return resolve($service);
        }

        throw new \Exception('The selected payment gateway is not supported.');
    }

    

}