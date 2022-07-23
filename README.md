[![Latest Stable Version](https://poser.pugx.org/dipnot/ptt-akilliesnaf-php/v)](https://packagist.org/packages/dipnot/ptt-akilliesnaf-php) [![Total Downloads](https://poser.pugx.org/dipnot/ptt-akilliesnaf-php/downloads)](https://packagist.org/packages/dipnot/ptt-akilliesnaf-php)
# PTT Akıllı Esnaf API Wrapper for PHP

Unofficial PHP wrapper for [PTT Akıllı Esnaf API](https://akilliesnaf.ptt.gov.tr/developer/)

We got a lot of help from the [sample codes](https://akilliesnaf.ptt.gov.tr/developer/#acik-kaynak).

Only covers `threeDSecure` (Ortak Ödeme Sayfası) and `inquiry` (Ödeme Sorgulama)

`threeDPayment` (3D ile Ödeme), `void` (İptal), `refund` (İade) or `history` (İşlem Listeleme) are not our goal currently. We would be happy to see your contributions!

## Dependencies
- PHP 5.6.36 or higher
- ext-curl
- ext-json


## Installation
You can install via [Composer](https://getcomposer.org/).

    composer require dipnot/ptt-akilliesnaf-php

## Usage
You can see the full example in [examples](https://github.com/dipnot/ptt-akilliesnaf-php/tree/main/examples) folder.
### Config
All request are needs a Config.
```php
use Dipnot\PttAkilliEsnaf\Config;

$config = new Config(true); // Don't forget to change it to "false" in production :)
$config->setClientId("1000000032");
$config->setApiUser("Entegrasyon_01");
$config->setApiPass("gkk4l2*TY112");
```

### Making a `threeDPayment` request
```php
use Dipnot\PttAkilliEsnaf\Enum\Currency;
use Dipnot\PttAkilliEsnaf\Request\ThreeDPaymentRequest;

// $config = ...;

$orderId = "ORDERCODE" . time();

$threeDPaymentRequest = new ThreeDPaymentRequest($config);
$threeDPaymentRequest->setCallbackUrl("http://localhost/ptt-akilliesnaf-php/examples/callback.php");
$threeDPaymentRequest->setOrderId($orderId);
$threeDPaymentRequest->setAmount(1000);
$threeDPaymentRequest->setCurrency(Currency::TL);
$threeDPaymentRequest->setInstallmentCount(1);

try {
    $request = $threeDPaymentRequest->execute();
    
    ?>
    <h1>Response:</h1>
    <?php
    echo "<pre>";
    print_r($request->getResponse());
    echo "</pre>";
    ?>

    <hr />

    <h1>Payment iframe:</h1>
    <iframe src="<?= $request->getIframeUrl() ?>" width="1010" height="480"></iframe>
    <?php
} catch(Exception $e) {
    echo $e->getMessage();
}
```

### Making an `inquiry` request
```php
use Dipnot\PttAkilliEsnaf\Request\InquiryRequest;

// $config = ...;

$orderId = "SAMPLEORDERCODE";

$inquiryRequest = new InquiryRequest($config);
$inquiryRequest->setOrderId($orderId);

try {
    $request = $inquiryRequest->execute();
    ?>

    <h1>Response:</h1>
    <?php
    echo "<pre>";
    print_r($request->getResponse());
    echo "</pre>";
} catch(Exception $e) {
    echo $e->getMessage();
}
```

## Test cards
While developing the package, the test cards in the official documentation were not working. So we contacted the authorities and got the following values for testing.

||Value|    
|--|--|  
|Card holder|Fill randomly|    
|Card number|4159560047417732|    
|Card expiry date (Month/Year)|08/24|    
|Card CVV|123|
|3D Secure code|You can get it under the countdown timer on the 3D Secure page|

## License
[![License: MIT](https://img.shields.io/badge/License-MIT-%232fdcff)](https://github.com/dipnot/ptt-akilliesnaf-php/blob/main/LICENSE)
