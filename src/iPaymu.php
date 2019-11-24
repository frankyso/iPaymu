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

    public function __construct($apiKey = null)
    {
        $this->setApiKey($apiKey);
    }

    /**
     * Check if an attribute exists on the object
     *
     * @param string $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        try {
            $this->__get($name);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    /**
     * Get a part of the iPaymu object
     *
     * @param string $name
     *
     * @return string|int
     * @throws InvalidArgumentException
     *
     */

    public function __get($name)
    {
        switch (true) {
            case $name === 'paymentPage':
                return $this->paymentPage();

            case $name === 'balance':
                return (int)$this->checkBalance();

            case $name === 'status':
                return (int)$this->checkStatus();

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }
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
}

?>
