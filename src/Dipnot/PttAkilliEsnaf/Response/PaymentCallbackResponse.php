<?php
namespace Dipnot\PttAkilliEsnaf\Response;
use Dipnot\PttAkilliEsnaf\Response;
use Exception;
use InvalidArgumentException;

/**
 * Class PaymentCallbackResponse
 * @package Dipnot\PttAkilliEsnaf\Response
 */
class PaymentCallbackResponse extends Response
{
    /**
     * @var array $_data
     */
    private $_data;

    /**
     * @param string|null $key
     * @return array|string|null
     */
    public function getData($key = null)
    {
        if($key !== null) {
            return isset($this->_data[$key]) && $this->_data[$key] ? $this->_data[$key] : null;
        }

        return $this->_data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->_data = $data;
    }

    /**
     * Helpers to get OrderId from $_data
     *
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->getData("OrderId");
    }

    /**
     * Helpers to get BankResponseMessage from $_data
     *
     * @return string|null
     */
    public function getBankResponseMessage()
    {
        return $this->getData("BankResponseMessage");
    }

    /**
     * @return $this
     * @throws Exception
     */
    public function execute()
    {
        if(!$this->_data || !is_array($this->_data)) {
            throw new InvalidArgumentException("Before that the data must be set and it must be an array");
        }

        return $this;
    }

    /**
     * Checks if the payment succeed
     *
     * @return bool
     */
    public function isPaymentSucceed()
    {
        if($this->isHashValid()) {
            return $this->isBankResponseCodeSucceed();
        }

        return false;
    }

    /**
     * Checks if BankResponseCode from $_data succeed
     *
     * @return bool
     */
    private function isBankResponseCodeSucceed()
    {
        // FIXME: 00 is not correct. The correct value should be updated after learning from the authorities.
        return $this->getData("BankResponseCode") === "00";
    }

    /**
     * Validates hash that given from $_data
     *
     * @return bool
     */
    private function isHashValid()
    {
        $hashParameters = $this->getData("HashParameters");

        if($hashParameters) {
            $parameters = explode(",", $hashParameters);

            $config = [
                "ClientId" => $this->_config->getClientId(),
                "ApiUser" => $this->_config->getApiUser()
            ];

            $hashString = $this->_config->getApiPass();

            foreach($parameters as $parameter) {
                $hashString .= isset($config[$parameter]) ? $config[$parameter] : $this->getData($parameter);
            }

            $hashingBytes = hash("sha512", $hashString, true);

            return $this->getData("Hash") === base64_encode($hashingBytes);
        }

        return false;
    }
}