<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

namespace frankyso\iPaymu;

use frankyso\iPaymu\Exceptions\ApiKeyInvalid;
use frankyso\iPaymu\Exceptions\ApiKeyNotFound;

class iPaymu
{
    /**
     * iPaymu Api Key
     *
     * @var
     */
    protected $apiKey;
    protected $products = [];
    protected $debug = false;

    protected $responseFormat = "json";

    public function __construct($apiKey = null, $responseFormat = "json", $debug = false)
    {
        $this->setApiKey($apiKey);
        $this->setResponseFormat($responseFormat);
        $this->setDebug($debug);
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey = null)
    {
        if ($apiKey == null) {
            throw new ApiKeyNotFound();
        }
        $this->apiKey = $apiKey;
    }

    /**
     * @return bool
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @return string
     */
    public function getResponseFormat()
    {
        return $this->responseFormat;
    }

    /**
     * @param string $responseFormat
     */
    public function setResponseFormat($responseFormat)
    {
        $this->responseFormat = $responseFormat;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isApiKeyValid()
    {
        $result = file_get_contents("https://my.ipaymu.com/api/CekSaldo.php?key=" . $this->apiKey . "&format=json");
        if (isset($result->Status)) {
            if ($result->Status == "-1001") {
                throw new ApiKeyInvalid($result->Keterangan, $result->status);
            } else {
                return true;
            }
        }

        return true;
    }

    private function post($resource, $params)
    {
        $params_string = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $resource);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $request = curl_exec($ch);

        if ($request === false) {
            echo 'Curl Error: ' . curl_error($ch);
        } else {
            return $result = json_decode($request, true);
        }

        curl_close($ch);
        exit;
    }

    /**
     * Add Product into transaction
     *
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    /**
     * get Added product from transaction
     *
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Check Balance
     */
    public function checkBalance()
    {
        $response = $this->post(Resource::$BALANCE, [
            "key" => $this->apiKey,
            "format" => $this->responseFormat
        ]);
    }
}

?>
