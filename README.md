# iPaymu-php
<p align="center">
  <a href="https://github.com/frankyso/iPaymu/blob/master/LICENSE">
    <img alt="License: MIT" src="https://img.shields.io/badge/license-MIT-yellow.svg" target="_blank" />
  </a>
  <a href="https://github.com/frankyso/iPaymu-changelog">
    <img src="https://img.shields.io/badge/changelog-iPaymu-brightgreen.svg" alt="gitmoji-changelog">
  </a>
</p>

The easiest way to integrate your website into [iPaymu payment gateway](https://ipaymu.com).

## Installation
The best way to use this package is using [composer](https://getcomposer.org/)
```
composer require frankyso/ipaymu
```

## Usage
### Check Balance
```php
<?php
use frankyso\iPaymu\iPaymu;

$iPaymu = new iPaymu('your-api-key');
$iPaymu->checkBalance();
```

### Check API Key Validity
```php
<?php
use frankyso\iPaymu\iPaymu;

$iPaymu = new iPaymu('your-api-key');
$iPaymu->isApiKeyValid();
```

### Add Product to Cart
```php
<?php
use frankyso\iPaymu\iPaymu;

$iPaymu = new iPaymu('your-api-key');
$cart = $iPaymu->cart();

$product = new \frankyso\iPaymu\Product();
$product->id = "1231";
$product->name = "Soap";
$product->price = 12000;
$cart->add($product);
```

### Remove Product From Cart
```php
<?php
use frankyso\iPaymu\iPaymu;

$iPaymu = new iPaymu('your-api-key');
$cart = $iPaymu->cart();
$cart->remove(1231);
```

### Checkout Transaction
in this package we use cart type transaction so you must checkout after adding your product 
```php
<?php
use frankyso\iPaymu\iPaymu;

$iPaymu = new iPaymu('your-api-key');
$cart = $iPaymu->cart();

$product = new \frankyso\iPaymu\Product();
$product->id = "1231";
$product->name = "Soap";
$product->price = 12000;
$cart->add($product);

$product = new \frankyso\iPaymu\Product();
$product->id = "1231";
$product->name = "Soap";
$product->price = 12000;

$cart->add($product);

$cart->checkout();
```


## Authors

* **Franky So** - *Initial work* - [Konnco](https://github.com/konnco)

See also the list of [contributors](https://github.com/frankyso/iPaymu/contributors) who participated in this project.