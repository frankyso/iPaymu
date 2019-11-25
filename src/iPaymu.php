<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

namespace frankyso\iPaymu;

use frankyso\iPaymu\Exceptions\ApiKeyInvalid;
use frankyso\iPaymu\Exceptions\ApiKeyNotFound;
use frankyso\iPaymu\Traits\CurlTrait;

class iPaymu
{
    use CurlTrait;

    /**
     * iPaymu Api Key
     *
     * @var $apiKey
     */
    protected $apiKey;

    /**
     * @var $cart Cart, Cart Object Builder
     */
    protected $cart;

    /**
     * @var $ureturn , Url redirect after payment page
     */
    protected $ureturn;

    /**
     * @var $unotify , Url Notify when transaction paid
     */
    protected $unotify;

    /**
     * @var $ucancel , Url Redirect when user cancel the transaction
     */
    protected $ucancel;

    /**
     * iPaymu constructor.
     * @param null $apiKey
     * @param array $url
     * @throws ApiKeyNotFound
     */
    public function __construct($apiKey = null, $url = ["", "", ""])
    {
        $this->setApiKey($apiKey);
        $this->cart = new Cart($this);
        $this->setUcancel($url[0]);
        $this->setUreturn($url[1]);
        $this->setUnotify($url[2]);
    }

    /**
     * Set Api Key
     *
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return mixed
     */
    public function getUreturn()
    {
        return $this->ureturn;
    }

    /**
     * @param mixed $ureturn
     */
    public function setUreturn($ureturn)
    {
        $this->ureturn = $ureturn;
    }

    /**
     * @return mixed
     */
    public function getUcancel()
    {
        return $this->ucancel;
    }

    /**
     * @param mixed $ucancel
     */
    public function setUcancel($ucancel)
    {
        $this->ucancel = $ucancel;
    }

    /**
     * @return mixed
     */
    public function getUnotify()
    {
        return $this->unotify;
    }

    /**
     * @param mixed $unotify
     */
    public function setUnotify($unotify)
    {
        $this->unotify = $unotify;
    }

    /**
     * Get ApiKey Value
     *
     * @param null $apiKey Api Key from iPaymu Dashboard.
     * @throws ApiKeyNotFound
     */
    public function setApiKey($apiKey = null)
    {
        if ($apiKey == null) {
            throw new ApiKeyNotFound();
        }
        $this->apiKey = $apiKey;
    }

    /**
     * Check if Api Key inserted is valid or not
     *
     * @return bool
     * @throws \Exception
     */
    public function isApiKeyValid()
    {
        try {
            $this->checkBalance();
            return true;
        } catch (ApiKeyInvalid $e) {
            return false;
        }
    }

    /**
     * Check Balance
     */
    public function checkBalance()
    {
        $response = $this->request(Resource::$BALANCE, [
            "key" => $this->apiKey,
            "format" => 'json'
        ]);

        return $response;
    }

    /**
     * Get Cart Object
     *
     * @return Cart
     */
    public function cart()
    {
        return $this->cart;
    }

    /**
     * Check Transactions
     *
     * @deprecated
     */
    public function checkTransaction($id)
    {
        return $this->request(Resource::$TRANSACTION, [
            'key' => $this->apiKey,
            'id' => $id
        ]);
    }
}

?>
