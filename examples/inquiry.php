<?php
use Dipnot\PttAkilliEsnaf\Request\InquiryRequest;

require_once("./../vendor/autoload.php");

// Config
$config = require_once("./_config.php");

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