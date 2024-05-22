<?php

namespace Towoju5\Bitnob\Http\Controllers;

use Illuminate\Http\Request;
use Towoju5\Bitnob\Bitnob;
use Towoju5\Bitnob\Models\Cards;

class CardsController extends Controller
{
    public function list()
    {
        $endpoint = "virtualcards/cards";
        $action = Bitnob::send_request($endpoint, 'GET', []);
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
        $action = Bitnob::send_request('virtualcards/registercarduser', 'POST', $data);
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
        $action = Bitnob::send_request('virtualcards/create', 'POST', $data);
        return $action;
    }

    public function topup($data)
    {
        $data = [
            'cardId'    => $data['cardId'],
            'reference' => $data['reference'],
            'amount'    => $data['amount'],
        ];
        $action = Bitnob::send_request('virtualcards/topup', 'POST', $data);
        return $action;
    }

    public function action($action, $cardId)
    {
        $data = [
            'cardId'    => $cardId,
        ];
        $action = Bitnob::send_request("virtualcards/$action", 'POST', $data);
        return $action;
    }

    public function getCard($cardId)
    {
        $data = [
            'card_id'    => $cardId,
        ];
        $action = Bitnob::send_request('card', 'GET', $data);
        return $action;
    }

    public function getTransaction($cardId)
    {
        $action = Bitnob::send_request("virtualcards/cards/$cardId/transactions", 'GET', []);
        return $action;
    }

}
