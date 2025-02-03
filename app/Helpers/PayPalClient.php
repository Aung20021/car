<?php

namespace App\Helpers;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment.
     * Uses sandbox credentials from the environment file.
     *
     * @return PayPalHttpClient
     */
    public static function client()
    {
        // Retrieve credentials from the .env file
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        // Set up the Sandbox environment with the retrieved credentials
        $environment = new SandboxEnvironment($clientId, $clientSecret);

        // Return the PayPal HTTP Client instance
        return new PayPalHttpClient($environment);
    }
}
