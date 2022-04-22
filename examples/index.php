<?php
use Dipnot\PttAkilliEsnaf\Enum\Currency;
use Dipnot\PttAkilliEsnaf\Request\StartPaymentThreeDSessionRequest;

require_once("./../vendor/autoload.php");

// Config
$config = require_once("./_config.php");

$orderId = "ORDERCODE" . time();
$startPayment3DSessionRequest = new StartPaymentThreeDSessionRequest($config);
$startPayment3DSessionRequest->setCallbackUrl("http://localhost:8081/ptt-akilliesnaf-php/examples/callback.php");
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
    <p>Test cards</p>
    <ul>
        <li>Card holder: Fill randomly</li>
        <li>Card number: 4159560047417732</li>
        <li>Card expiry date (Month/Year): 08/24</li>
        <li>Card CVV: 123</li>
        <li>3D Secure code: You can get it under the countdown timer on the 3D Secure page</li>
    </ul>
    <iframe src="<?= $request->getIframeUrl() ?>" width="1010" height="480"></iframe>
    <?php
} catch(Exception $e) {
    echo $e->getMessage();
}