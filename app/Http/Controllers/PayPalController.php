<?php

namespace App\Http\Controllers;

use App\Helpers\PayPalClient; // Use the PayPalClient helper
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    /**
     * Create a PayPal Order.
     */
    public function createPayment()
    {
        try {
            // Initialize PayPal client
            $paypalClient = PayPalClient::client();
// Log PayPal configuration
Log::info('PAYPAL_CLIENT_ID: ' . env('PAYPAL_CLIENT_ID'));
Log::info('PAYPAL_CLIENT_SECRET: ' . env('PAYPAL_CLIENT_SECRET'));
Log::info('PAYPAL_MODE: ' . env('PAYPAL_MODE'));
Log::info('PayPal Config:', config('paypal'));
            // Create order request payload
            $request = new \PayPalCheckoutSdk\Orders\OrdersCreateRequest();
            $request->prefer('return=representation');
            $request->body = [
                "intent" => "CAPTURE", // Payment intent (can be "AUTHORIZE" or "CAPTURE")
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD", // Replace with your desired currency
                            "value" => "50.00"       // Replace with a dynamic amount if needed
                        ]
                    ]
                ]
            ];

            // Execute the PayPal order creation request
            $response = $paypalClient->execute($request);

            // Redirect user to PayPal approval page
            if (isset($response->result->id)) {
                foreach ($response->result->links as $link) {
                    if ($link->rel === 'approve') {
                        // Redirect user to PayPal for payment approval
                        return redirect($link->href);
                    }
                }
            }

            // If no approval link is found, show an error
            return back()->withErrors('Something went wrong. Unable to create PayPal order.');
        } catch (\Exception $e) {
            // Log and display the error message
            Log::error('PayPal Create Payment Error: ' . $e->getMessage());
            return back()->withErrors('An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Capture a PayPal Order Payment.
     */
    public function capturePayment(Request $request, $orderId)
    {
        try {
            // Initialize PayPal client
            $paypalClient = PayPalClient::client();

            // Create capture request
            $captureRequest = new \PayPalCheckoutSdk\Orders\OrdersCaptureRequest($orderId);
            $captureRequest->prefer('return=representation');

            // Execute the capture payment request
            $response = $paypalClient->execute($captureRequest);

            // Check if the payment was successful
            if (isset($response->result->status) && $response->result->status === 'COMPLETED') {
                // Update your transaction status in the database here
                return redirect()->route('bids.index')->with('success', 'Payment successful!');
            }

            return redirect()->route('bids.index')->withErrors('Payment failed. Please try again.');
        } catch (\Exception $e) {
            Log::error('PayPal Capture Payment Error: ' . $e->getMessage());
            return redirect()->route('bids.index')->withErrors('An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Test PayPal connection.
     */
    public function testPayPalConnection()
    {

        try {
            // Log PayPal configuration
Log::info('PAYPAL_CLIENT_ID: ' . env('PAYPAL_CLIENT_ID'));
Log::info('PAYPAL_CLIENT_SECRET: ' . env('PAYPAL_CLIENT_SECRET'));
Log::info('PAYPAL_MODE: ' . env('PAYPAL_MODE'));
Log::info('PayPal Config:', config('paypal'));
            // Initialize PayPal client
            $paypalClient = PayPalClient::client();
            Log::info('PayPal Client ID: ' . config('paypal.client_id'));
            Log::info('PayPal Mode: ' . config('paypal.mode'));

            // Log success message
            Log::info('PayPal Client Initialized Successfully.');

            return response()->json(['status' => 'success', 'message' => 'PayPal Client Initialized Successfully.']);
        } catch (\Exception $e) {
            Log::error('PayPal API Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
