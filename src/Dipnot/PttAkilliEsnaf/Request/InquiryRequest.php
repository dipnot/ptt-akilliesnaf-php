<?php
namespace Dipnot\PttAkilliEsnaf\Request;
use Dipnot\PttAkilliEsnaf\Request;
use Exception;

/**
 * Makes POST request to "API_ENDPOINT/inquiry"
 *
 * Class InquiryRequest
 * @package Dipnot\PttAkilliEsnaf\Request
 */
class InquiryRequest extends Request
{
    /**
     * @var object $_response
     */
    private $_response;

    /**
     * From official docs: Ön Otorizasyon (PreAuth) işleminde gönderilen Sipariş numarasıdır.
     *
     * @var string $_orderId
     */
    private $_orderId;

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
     * @return object
     * @throws Exception
     */
    public function getResponse()
    {
        if(!$this->_response) {
            throw new Exception("Before that execute() must be called");
        }

        return $this->_response;
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function execute()
    {
        // Check if all required properties are set
        if(!$this->getOrderId()) {
            throw new Exception("orderId must be set before executing the request.");
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

            "orderId" => $this->getOrderId()
        ];

        $this->_response = $this->_client->post("/inquiry", $postData);

        return $this;
    }
}