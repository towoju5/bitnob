<?php

namespace Towoju5\Bitnob\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Towoju5\Bitnob\Bitnob;

class HostedCheckoutController extends Controller
{
    protected $bitnob, $endpoint;

    public function __construct()
    {
        $this->bitnob = new Bitnob;
        $this->endpoint = "/checkout";
    }

    /**
     * Create a new hosted checkout.
     *
     * @param array $data
     * @return array
     */
    public function createHostedCheckout(array $data)
    {
        if (isset($data['amount'])) {
            $data['amount'] = $this->convertBitcoinToSatoshis($data['amount']);
        }

        $endpoint = $this->endpoint;
        try {
            return $this->bitnob->send_request($endpoint, "POST", $data);
        } catch (Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage()
            ];
        }
    }

    /**
     * @param string order ASC - optional 
     * @param string page - optional 
     * @param string take - optional 
     * @param string period allTime - optional 
     * @param string q - optional 
     */
    public function getCheckouts($param = null)
    {
        $endpoint = $this->endpoint;
        if(!is_null($param)) {
            $endpoint = $endpoint.http_build_query($param); 
        }
        return $this->bitnob->send_request($endpoint, "GET", $param);
    }

    /**
     * @param string order ASC - optional 
     * @endpoint https://sandboxapi.bitnob.co/api/v1/checkout/status/{checkoutId}
     */
    public function getCheckoutStatus($checkoutId)
    {
        $endpoint = $this->endpoint."/status/".$checkoutId; 
        return $this->bitnob->send_request($endpoint, "GET");
    }

    /**
     * @param int checkoutId
     * 
     * @return array
     */
    public function getCheckout($checkoutId)
    {
        $endpoint = $this->endpoint;
        if(!is_null($param)) {
            $endpoint = $endpoint.http_build_query($param); 
        }
        return $this->bitnob->send_request($endpoint, "GET", $checkoutId);
    }

    /**
     * Convert amount in bitcoin to satoshis.
     * Adjust the conversion rate based on current market values or specific business logic.
     *
     * @param float $amount in BTC
     * @return int
     */
    private function convertBitcoinToSatoshis($amount)
    {
        return (int) ($amount * 100000000);
    }
}
