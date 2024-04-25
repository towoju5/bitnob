<?php

namespace Towoju5\Bitnob\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Towoju5\Bitnob\Bitnob;

class CustomerController extends Controller
{
    protected $bitnob;

    public function __construct()
    {
        $this->bitnob = new Bitnob;
    }

    /**
     * Create a new customer.
     *
     * @param array $data
     * @return array
     */
    public function createCustomer(array $data)
    {
        $rules = [
            'email' => 'required|email',  // Ensure the email is unique in the 'customers' database table
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'countryCode' => 'required|string|max:6',  // Country code might include + symbol
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new Exception([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
        }

        $endpoint = "/customers";
        return $this->bitnob->send_request($endpoint, "POST", $data);
    }

    /**
     * Update an existing customer.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function updateCustomer(string $id, array $data)
    {
        $rules = [
            'email' => 'sometimes|required|email|unique:customers,email,' . $id,
            'firstName' => 'sometimes|required|string|max:255',
            'lastName' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'countryCode' => 'sometimes|required|string|max:6',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new Exception([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
        }

        $endpoint = "/customers/{$id}";
        return $this->bitnob->send_request($endpoint, "PUT", $data);
    }

    /**
     * List all customer.
     *
     * @param string $id
     * @return array
     */
    public function listCustomer(string $id)
    {
        $endpoint = "/customers";
        return $this->bitnob->send_request($endpoint, "GET");
    }

    /**
     * Get a customer.
     *
     * @param string $id
     * @return array
     */
    public function getCustomer(string $id)
    {
        $endpoint = "/customers/{$id}";
        return $this->bitnob->send_request($endpoint, "GET");
    }
}
