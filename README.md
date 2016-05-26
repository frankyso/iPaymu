# iPaymu

###Transaction
```php
$iPaymu = iPaymu\iPaymu::transaction([
            'action'   => 'payment',
            'product'  => 'Topup WIFIMU',
            'price'    => $request->get('ammount',0),
            'quantity' => 1,
            'comments' => '',
            'ureturn'  => url('setting/billing?'),
            'unotify'  => url('api/v1/payment'),
            'ucancel'  => url('setting/billing'),
            ], 'Api Ipaymu Anda');
```
