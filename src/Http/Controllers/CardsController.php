<?php

namespace Towoju5\Bitnob\Http\Controllers;

use Illuminate\Http\Request;
use Towoju5\Bitnob\Bitnob;
use Towoju5\Bitnob\Models\Cards;

class CardsController extends Controller
{
    public function list()
    {
        // get all user cards.
    }

    public function regUser(Request $request): void
    {
        $data = [
            'customerEmail'     => 'mosese@gmail.com',
            'idNumber'          => '00000000000',
            'idType'            => 'NIN',
            'firstName'         => $request->user->firstName,
            'lastName'          => $request->user->lastName,
            'phoneNumber'       => $request->user->phoneNumber,
            'city'              => $request->user->city,
            'state'             => $request->user->state,
            'country'           => $request->user->country,
            'zipCode'           => $request->user->zipCode,
            'line1'             => 'Ikeja',
            'houseNumber'       => 'accra',
            'idImage'           => 'null',
        ];
    }

    public function create(Request $request)
    {
        $data = [
            'customerEmail' => $request->user->email,
            'cardBrand'     => 'visa', // cardBrand should be "visa" or "mastercard"
            'cardType'      => 'virtual',
            'reference'     => _getTransactionId(),
            'amount'        => $request->amount,
        ];
        $action = Bitnob::send_request('create', 'POST', $data);
        return $action;
    }

    public function topup(Request $request)
    {
        $data = [
            'cardId'    => $request->cardId, //'4f644a2c-3c4f-48c7-a3fa-e896b544d546',
            'reference' => _getTransactionId(),
            'amount'    => $request->amount,
        ];
        $action = Bitnob::send_request('topup', 'POST', $data);
        return $action;
    }

    public function action(Request $request)
    {
        $data = [
            'cardId'    => $request->cardId
        ];
        $action = Bitnob::send_request($request->action, 'POST', $data);
        return $action;
    }

    public function getCard(Request $request)
    {
        $data = [
            'card_id'    => $request->cardId,
        ];
        $action = Bitnob::send_request('card', 'GET', $data);
        return $action;
    }

    public function getTransaction(Request $request)
    {
        $card_id = $request->cardId;
        $action = Bitnob::send_request("cards/$card_id/transactions", 'GET', []);
        return $action;
    }
}
