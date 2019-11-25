<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

namespace frankyso\iPaymu;

class Resource
{
    static public $BALANCE = "https://my.ipaymu.com/api/saldo";
    static public $TRANSACTION = "https://my.ipaymu.com/api/transaksi";
    static public $CHECK_TRANSACTION = "https://my.ipaymu.com/api/transaksi";
    static public $PAYMENT = "https://my.ipaymu.com/payment";

    // will be developed next release
    static public $PAYMENT_COD_REQUEST_SESSION_ID = "https://my.ipaymu.com/api/payment/getsid";
    static public $PAYMENT_COD = "https://my.ipaymu.com/api/payment/cod";
    static public $PAYMENT_COD_SHIPPING_FEE = "https://my.ipaymu.com/api/payment/cod";
    static public $PAYMENT_COD_AREA = "https://my.ipaymu.com/api/payment/cod";
}