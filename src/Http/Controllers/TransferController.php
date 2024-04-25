<?php

namespace Towoju5\Bitnob\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Towoju5\Bitnob\Bitnob;

class TransferController extends Controller
{
    protected $bitnob;

    public function __construct()
    {
        $this->bitnob = new Bitnob;
    }

    /**
     * Initialize a payout.
     *
     * @param array $arrays
     * @return array
     */
    public function initPayout(array $arrays)
    {
        // Validation rules
        try {
            $rules = [
                'amount' => 'required|numeric|min:0',
                'country' => 'required|string',
                'reference' => 'required|string',
                'customerEmail' => 'required|email',
                'description' => 'required|string',
                'beneficiaryId' => 'required|string',
                'sourceWalletCurrency' => 'required|in:USD',
                'callbackUrl' => 'required|url',
            ];

            // Create a Validator instance and validate
            $validator = Validator::make($arrays, $rules);

            if ($validator->fails()) {
                // Use a standard Laravel exception for handling validation errors.
                throw new Exception([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            $endpoint = "/wallets/payout/initialize";
            return $this->bitnob->send_request($endpoint, "POST", $arrays);

        } catch (Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage(),
                'code' => $ex->getCode()
            ];
        }
    }

    /**
     * Complete a payout.
     *
     * @param string $payoutInitId
     * @return array
     */
    public function completePayout(string $payoutInitId)
    {
        try {
            $array = ["transactionId" => $payoutInitId];
            $endpoint = "/wallets/payout/finalize";
            return $this->bitnob->send_request($endpoint, "POST", $array);

        } catch (Exception $ex) {
            return [
                'success' => false,
                'error' => $ex->getMessage(),
                'code' => $ex->getCode()
            ];
        }
    }

    /**
     * List requirements for a country payout.
     *
     * @return array
     */
    public function countryRequirements(string $country_code)
    {
        $endpoint = "/wallets/payout/supported-countries/{$country_code}";
        return $this->bitnob->send_request($endpoint, "GET");
    }

    /**
     * List all supported countries.
     *
     * @return array
     */
    public function supportedCountries()
    {
        $endpoint = "/wallets/payout/supported-countries/";
        return $this->bitnob->send_request($endpoint, "GET");
    }
}
