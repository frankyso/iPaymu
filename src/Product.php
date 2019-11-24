<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

namespace frankyso\iPaymu;


class Product
{
    /**
     * @var $id , Cart Identifier
     */
    public $id;

    /**
     * @var $name , Product Name
     */
    public $name;

    /**
     * @var $price , Product Price
     */
    public $price;

    /**
     * @var $quantity , Product Quantity
     */
    public $quantity;

    /**
     * @var $weight , used for COD Parameters, in Kilograms
     */
    public $weight;

    /**
     * @var $length , used for COD Parameters, in Kilograms
     * @todo still dont know, what unit used to this variable
     */
    public $length;

    /**
     * @var $width , used for COD Parameters, in Kilograms
     * @todo still dont know, what unit used to this variable
     */
    public $width;

    /**
     * @var $height , used for COD Parameters, in Kilograms
     * @todo still dont know, what unit used to this variable
     */
    public $height;
}