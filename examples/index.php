<?php
use Dipnot\PttAkilliEsnaf\Enum\Currency;
use Dipnot\PttAkilliEsnaf\Request\StartPaymentThreeDSessionRequest;

require_once("./../vendor/autoload.php");

// Config
$config = require_once("./_config.php");

$orderId = "ORDERCODE" . time();
$startPayment3DSessionRequest = new StartPaymentThreeDSessionRequest($config);
$startPayment3DSessionRequest->setCallbackUrl("http://localhost:8083/ptt-akilliesnaf-php/examples/callback.php");
$startPayment3DSessionRequest->setOrderId($orderId);
$startPayment3DSessionRequest->setAmount(1000);
$startPayment3DSessionRequest->setCurrency(Currency::TL);
$startPayment3DSessionRequest->setInstallmentCount(1);

try {
    $request = $startPayment3DSessionRequest->execute();
    ?>

    <h1>Response:</h1>
    <?php
    echo "<pre>";
    print_r($request->getResponse());
    echo "</pre>";
    ?>

    <hr />

    <h1>Payment iframe:</h1>
    <p>Will redirect to <?= $request->getCallbackUrl() ?></p>
    <iframe src="<?= $request->getIframeUrl() ?>" width="1010" height="480"></iframe>
    <?php
} catch(Exception $e) {
    echo $e->getMessage();
}