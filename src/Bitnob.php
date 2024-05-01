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
    public static function send_request(string $uri, string $method, array $data = []) : array
    {
        try {
            $token = getenv("BITNOB_API_KEY");
            $client = new Client();
            $headers["Content-Type"]    = "application/json";
            $headers["accept"]          = "application/json";

            if (NULL != $token) :
                $headers["Authorization"] = "Bearer ".$token;
            endif;

            $url = self::formatUrl(getenv("BITNOB_BASE_URL").$uri);
            $body = json_encode($data);
            $request = new Request($method, $url, $headers, $body);
            $res = $client->sendAsync($request)->wait();
            $result = $res->getBody();
            $req = json_decode($result);
            if (isset($req->status) && $req->status == true) :
                $result = response()->json($req);
            else :
                $result = response()->json($req, 400);
            endif;

            return $result;
        } catch (\Throwable $th) {
            return response()->json([
                'error'  => $th->getMessage(), 
                'errorCode' => $th->getCode() ?? 500 
            ]);
        }
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

    private function formatUrl($url) {
        // Ensure the URL starts with a valid protocol or prepend 'http://'
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
    
        // Correct multiple slashes in the URL except in protocol part
        $url = preg_replace('#(?<!:)//+#', '/', $url);
    
        return $url;
    }
}
