<?php

namespace Towoju5\Bitnob;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Towoju5\Bitnob\Http\Controllers\BeneficiaryController;
use Towoju5\Bitnob\Http\Controllers\CardsController;
use Towoju5\Bitnob\Http\Controllers\CustomerController;
use Towoju5\Bitnob\Http\Controllers\HostedCheckoutController;
use Towoju5\Bitnob\Http\Controllers\TransferController;

class Bitnob
{
    // Build your next great package.
    public static function send_request(string $uri, string $method, array $data = [])
    {
        $baseUrl = env("BITNOB_BASE_URL", "https://api.bitnob.co/api/v1/");
        $token = env("BITNOB_API_KEY");
        $url = self::formatUrl("{$baseUrl}{$uri}");

        $headers = [
            "Content-Type: application/json",
            "Accept: application/json"
        ];

        if ($token !== null) {
            $headers[] = "Authorization: Bearer " . $token;
        }

        $body = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            return response()->json([
                'error' => curl_error($ch),
                'errorCode' => curl_errno($ch)
            ]);
        }

        curl_close($ch);

        if (!is_array($result)) {
            $result = json_decode($result, true);
        }

        return $result;
    }

    public function cards(){
        $cards = new CardsController();
        return $cards;
    }

    public function transfer()
    {
        $transfer = new TransferController();
        return $transfer;
    }

    public function customer()
    {
        $customer = new CustomerController();
        return $customer;
    }

    public function beneficiary()
    {
        $beneficiary = new BeneficiaryController();
        return $beneficiary;
    }

    public function checkout()
    {
        $checkout = new HostedCheckoutController();
        return $checkout;
    }

    private static function formatUrl($url) {
        // Ensure the URL starts with a valid protocol or prepend 'http://'
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
    
        // Correct multiple slashes in the URL except in protocol part
        $url = preg_replace('#(?<!:)//+#', '/', $url);
    
        return $url;
    }
}
