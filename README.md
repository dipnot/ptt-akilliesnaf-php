
# PTT Akıllı Esnaf API Wrapper for PHP
[![Latest Stable Version](https://poser.pugx.org/dipnot/ptt-akilliesnaf-php/v)](https://packagist.org/packages/dipnot/ptt-akilliesnaf-php) [![Total Downloads](https://poser.pugx.org/dipnot/ptt-akilliesnaf-php/downloads)](https://packagist.org/packages/dipnot/ptt-akilliesnaf-php)

Unofficial PHP wrapper for [PTT Akıllı Esnaf API](https://akilliesnaf.ptt.gov.tr/developer/)

Only covers `threeDSecure` (Ortak Ödeme Sayfası)

`threeDPayment` (3D ile Ödeme), `inquiry` (Ödeme Sorgulama), `void` (İptal), `refund` (İade) or `history` (İşlem Listeleme) are not our goal currently. We would be happy to see your contributions!

## Dependencies
- PHP 5.6.36 or higher
- ext-curl
- ext-json


## Installation
You can install via [Composer](https://getcomposer.org/).

    composer require dipnot/ptt-akilliesnaf-php

## Usage
You can see the full example in [examples](https://github.com/dipnot/ptt-akilliesnaf-php/tree/main/examples) folder.

// TODO: Detailed usage will be added.

## Test cards
While developing the package, the test cards in the official documentation were not working. So we contacted the authorities and got the following values for testing.

|||    
|--|--|  
|Card holder|Fill randomly|    
|Card number|4159560047417732|    
|Card expiry date (Month/Year)|08/24|    
|Card CVV|123|

## License
[![License: MIT](https://img.shields.io/badge/License-MIT-%232fdcff)](https://github.com/dipnot/ptt-akilliesnaf-php/blob/main/LICENSE)
