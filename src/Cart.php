<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

namespace frankyso\iPaymu;

class Cart
{
    protected $iPaymu;
    protected $items = [];

    /**
     * Cart constructor.
     * @param iPaymu $iPaymu
     */
    public function __construct(iPaymu $iPaymu)
    {
        $this->iPaymu = $iPaymu;
    }

    /**
     * @param Product $product
     */
    public function add($id, $name, $quantity, $price)
    {
        $this->items[] = [
            'id' => $id,
            'name' => $name,
            'quantity' => $quantity,
            'price' => $price,
        ];
    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        foreach ($this->items as $key => $item) {
            if ($item['id'] == $id) {
                unset($this->items[$key]);
            }
        }
    }

    /**
     * @param string $comments
     * @return mixed
     */
    public function checkout($comments = "")
    {
        return $this->iPaymu->request(Resource::$PAYMENT, $this->buildParams($comments));
    }

    /**
     * @param string $comments
     * @return mixed
     */
    private function buildParams($comments = "")
    {
        $productsName = [];
        $productsPrice = [];
        $productsQty = [];

        foreach ($this->items as $item) {
            $productsName[] = $item['name'];
            $productsPrice[] = $item['price'];
            $productsQty[] = $item['quantity'];
        }

        $params['key'] = $this->iPaymu->getApiKey();
        $params['payment'] = 'payment';
        $params['product'] = $productsName;
        $params['price'] = $productsPrice;
        $params['quantity'] = $productsQty;
        $params['comments'] = $comments;
        $params['ureturn'] = $this->iPaymu->getUreturn();
        $params['unotify'] = $this->iPaymu->getUnotify();
        $params['ucancel'] = $this->iPaymu->getUcancel();
        $params['format'] = 'json';

        return $params;
    }
}
