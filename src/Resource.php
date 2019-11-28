<?php
/**
 * @author Franky So <frankyso.mail@gmail.com>
 */

namespace frankyso\iPaymu;

class Resource
{
    public static $BALANCE = 'https://my.ipaymu.com/api/saldo';
    public static $TRANSACTION = 'https://my.ipaymu.com/api/transaksi';
    public static $CHECK_TRANSACTION = 'https://my.ipaymu.com/api/transaksi';
    public static $PAYMENT = 'https://my.ipaymu.com/payment';

    // will be developed next release
    public static $PAYMENT_COD_REQUEST_SESSION_ID = 'https://my.ipaymu.com/api/payment/getsid';
    public static $PAYMENT_COD = 'https://my.ipaymu.com/api/payment/cod';
    public static $PAYMENT_COD_SHIPPING_FEE = 'https://my.ipaymu.com/api/payment/cod';
    public static $PAYMENT_COD_AREA = 'https://my.ipaymu.com/api/payment/cod';
}
