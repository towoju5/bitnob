<?php

namespace Towoju5\Bitnob;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

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
                $headers["Authorization"] = "Bearer ${token}";
            endif;

            $url = getenv("BITNOB_BASE_URL").$uri;
            $body = json_encode($data);
            $request = new Request($method, $url, $headers, $body);
            $res = $client->sendAsync($request)->wait();
            $result = $res->getBody();
            $req = json_decode($result);
            if (isset($req->status) && $req->status == true) :
                $result = get_success_response($req);
            else :
                $result = get_error_response($req, 400);
            endif;

            return $result;
        } catch (\Throwable $th) {
            return get_error_response($th->getMessage(), $th->getCode() ?? 500);
        }
    }
}
