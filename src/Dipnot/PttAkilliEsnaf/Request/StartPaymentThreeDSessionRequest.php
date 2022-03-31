<?php
namespace Dipnot\PttAkilliEsnaf\Request;
use Dipnot\PttAkilliEsnaf\Request;
use Exception;

/**
 * Makes POST request to "API_ENDPOINT/startPaymentThreeDSession"
 *
 * Class CreateStartPayment3DSessionRequest
 * @package Dipnot\PttAkilliEsnaf\Request
 */
class StartPaymentThreeDSessionRequest extends Request
{
    /**
     * From official docs: 3D sonucunun dönüleceği url
     *
     * @var string $_callbackUrl
     */
    private $_callbackUrl;

    /**
     * From official docs: Sipariş Numarasıdır. Belirlenmediği takdirde sistem otomatik üretecektir.
     *
     * @var string $_orderId
     */
    private $_orderId;

    /**
     * From official docs: İşlem Tutarı, son iki hane kuruştur. 1522 = 15 TL 22 Kuruş
     *
     * @var float $_amount
     */
    private $_amount;

    /**
     * From official docs: İşlem Para birimi 949
     *
     * @var int $_currency
     */
    private $_currency;

    /**
     * From official docs: Default “0”
     *
     * @var int $_installmentCount
     */
    private $_installmentCount = 0;

    /**
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->_callbackUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->_callbackUrl = $callbackUrl;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->_orderId;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->_orderId = $orderId;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    /**
     * @return int
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * @param int $currency
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;
    }

    /**
     * @return string
     */
    public function getInstallmentCount()
    {
        return $this->_installmentCount;
    }

    /**
     * @param int $installmentCount
     */
    public function setInstallmentCount($installmentCount)
    {
        $this->_installmentCount = $installmentCount;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function execute()
    {
        // Check if all required properties are set
        if(!$this->getCallbackUrl() || !$this->getOrderId() || !$this->getAmount() || !$this->getCurrency() || !$this->getInstallmentCount()) {
            throw new Exception("callbackUrl, orderId, amount, currency and installmentCount must be set before executing the request.");
        }

        // Check if all required Config properties are set
        if(!$this->_config->isAllSet()) {
            throw new Exception("clientId, apiUser and apiPass must be set for Config before executing the request.");
        }

        $postData = [
            "clientId" => $this->_config->getClientId(),
            "apiUser" => $this->_config->getApiUser(),
            "Rnd" => $this->getRnd(),
            "timeSpan" => $this->getTimeStan(),
            "Hash" => $this->getHash(),

            "callbackUrl" => $this->getCallbackUrl(),
            "orderId" => $this->getOrderId(),
            "amount" => $this->getAmount(),
            "currency" => $this->getCurrency(),
            "installmentCount" => $this->getInstallmentCount()
        ];

        return $this->_client->post("/startPaymentThreeDSession", $postData);
    }
}