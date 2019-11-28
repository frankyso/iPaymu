<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

namespace frankyso\iPaymu\Traits;

use frankyso\iPaymu\Exceptions\ApiKeyInvalid;

trait CurlTrait
{
    /**
     * @param $resource
     * @param $params
     *
     * @throws ApiKeyInvalid
     *
     * @return mixed
     */
    public function request($resource, $params)
    {
        $params_string = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $resource);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $request = curl_exec($ch);

        if ($request === false) {
            echo 'Curl Error: '.curl_error($ch);
        } else {
            $result = $this->responseHandler(json_decode($request, true));

            return $result;
        }

        curl_close($ch);
        exit;
    }

    /**
     * @param $response
     *
     * @throws ApiKeyInvalid
     *
     * @return mixed
     */
    private function responseHandler($response)
    {
        switch (@$response['Status']) {
            case '-1001':
                throw new ApiKeyInvalid();
            default:
                return $response;
        }
    }
}
