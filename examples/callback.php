<?php
use Dipnot\PttAkilliEsnaf\Response\PaymentCallbackResponse;

require_once("./../vendor/autoload.php");

// Config
$config = require_once("./_config.php");

$paymentStatusResponse = new PaymentCallbackResponse($config);
$paymentStatusResponse->setData($_POST);
$response = $paymentStatusResponse->execute();

if($response->isPaymentSucceed()) {
    ?>
    <h1>Payment succeed</h1>
    <p>OrderId: <?= $response->getOrderId() ?></p>
    <p>BankResponseMessage: <?= $response->getBankResponseMessage() ?></p>
    <?php
    echo "<pre>";
    print_r($response->getData());
    echo "</pre>";
} else {
    ?>
    <h1>Payment failed</h1>
    <p>OrderId: <?= $response->getOrderId() ?></p>
    <p>BankResponseMessage: <?= $response->getBankResponseMessage() ?></p>
    <?php
    echo "<pre>";
    print_r($response->getData());
    echo "</pre>";
}