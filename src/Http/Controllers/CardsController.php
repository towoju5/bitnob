<?php

namespace Towoju5\Bitnob\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Towoju5\Bitnob\Bitnob;
use Towoju5\Bitnob\Models\Cards;

class CardsController extends Controller
{
    public function list()
    {
        $endpoint = "virtualcards/cards";
        
        $action = $this->send_request($endpoint, 'GET', []);
        return $action;
    }

    public function regUser($data)
    {
        $data = [
            'customerEmail'     => $data['customerEmail'],
            'idNumber'          => $data['idNumber'],
            'idType'            => $data['idType'],
            'firstName'         => $data['firstName'],
            'lastName'          => $data['lastName'],
            'phoneNumber'       => $data['phoneNumber'],
            'city'              => $data['city'],
            'state'             => $data['state'],
            'country'           => $data['country'],
            'zipCode'           => $data['zipCode'],
            'line1'             => $data['line1'],
            'houseNumber'       => $data['houseNumber'],
            'idImage'           => $data['idImage'],
        ];
        
        $action = $this->send_request('virtualcards/registercarduser', 'POST', $data);
        return $action;
    }

    public function create($data)
    {
        $data = [
            'customerEmail' => $data['customerEmail'],
            'cardBrand'     => $data['cardBrand'],
            'cardType'      => $data['cardType'],
            'reference'     => $data['reference'],
            'amount'        => $data['amount'],
        ];
        
        $action = $this->send_request('virtualcards/create', 'POST', $data);
        return $action;
    }

    public function topup($data)
    {
        $data = [
            'cardId'    => $data['cardId'],
            'reference' => $data['reference'],
            'amount'    => $data['amount'],
        ];
        
        $action = $this->send_request('virtualcards/topup', 'POST', $data);
        return $action;
    }

    public function action($action, $cardId)
    {
        $data = [
            'cardId'    => $cardId,
        ];
        
        $action = $this->send_request("virtualcards/$action", 'POST', $data);
        return $action;
    }

    public function getCard($cardId)
    {
        $data = [
            'card_id'    => $cardId,
        ];
        
        $action = $this->send_request('card', 'GET', $data);
        return $action;
    }

    public function getTransaction($cardId)
    {
        
        $action = $this->send_request("virtualcards/cards/$cardId/transactions", 'GET', []);
        return $action;
    }


    private function send_request(string $uri, string $method, array $data = [])
    {
        try {
            $token = env("BITNOB_API_KEY");
            $url = $this->formatUrl(env("BITNOB_BASE_URL") . $uri);

            $response = Http::withToken($token)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->$method($url, $data);

            $result = $response->json();

            return (array)$result;
        } catch (\Throwable $th) {
            return get_error_response(['error' => $th->getMessage()]);
        }
    }

    private function formatUrl($url)
    {
        // Ensure the URL starts with a valid protocol or prepend 'http://'
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        // Correct multiple slashes in the URL except in protocol part
        $url = preg_replace('#(?<!:)//+#', '/', $url);

        return $url;
    }

}
