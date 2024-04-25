<?php

namespace Towoju5\Bitnob\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Towoju5\Bitnob\Bitnob;

class BeneficiaryController extends Controller
{
    protected $bitnob;

    public function __construct()
    {
        $this->bitnob = new Bitnob;
    }

    /**
     * Create a new beneficiary.
     *
     * @param array $data
     * @return array
     */
    public function createBeneficiary(array $data)
    {
        $endpoint = "/beneficiaries/create";
        return $this->bitnob->send_request($endpoint, "POST", $data);
    }

    /**
     * List all beneficiaries.
     *
     * @return array
     */
    public function ListBeneficiaries()
    {
        $endpoint = "/beneficiaries";
        return $this->bitnob->send_request($endpoint, "DELETE");
    }

    /**
     * Get a beneficiary.
     *
     * @param string $beneficiary_id
     * @return array
     */
    public function getBeneficiary($beneficiary_id)
    {
        $endpoint = "/beneficiaries/{$beneficiary_id}";
        return $this->bitnob->send_request($endpoint, "DELETE");
    }
}
