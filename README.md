# iPaymu.class
### Made simple iPaymu API code

---

####Instantiation
Ada beberapa metode yang berbeda yang tersedia untuk membuat contoh baru dari iPaymu Class ini. Pertama ada constructor. Ini menimpa parent constructor yang Anda untuk mebaca parameter pertama yang ada.


```php
$iPaymu = new iPaymu('apiKey iPaymu Anda');
```

parameter pertama yang digunakan adalah API iPaymu Anda, API dapat Anda temukan pada dashboard iPaymu.

metode kedua adalah dengan metode statis:

```php
$iPaymu = iPaymu\iPaymu::api('apiKey iPaymu Anda');
```

####Mengecek Saldo
untuk mengecek saldo Anda pada iPaymu Anda dapat mengikuti contoh dibawah ini:
```php
$iPaymu = iPaymu\iPaymu::api('apiKey iPaymu Anda');
echo $iPaymu->balance;
```

####Mengecek Status
untuk mengecek status Anda pada iPaymu Anda dapat mengikuti contoh dibawah ini:
```php
$iPaymu = iPaymu\iPaymu::api('apiKey iPaymu Anda');
echo $iPaymu->status;
```

####Mengecek Transaksi
```php
$iPaymu = iPaymu\iPaymu::api('apiKey iPaymu Anda');
var_dump($iPaymu->transaction($id_transaksi));
```

####Transaksi Baru
```php
$iPaymu = iPaymu\iPaymu::api('apiKey iPaymu Anda');
$iPaymu->addProduct('nama produk', 'Harga Produk', 'Jumlah Produk', 'Keterangan Produk');
var_dump($iPaymu->paymentPage($urlReturn, $urlNotify , $urlCancel));
```


Jika ada bug, silahkan membuat issue pada bitbucket.
