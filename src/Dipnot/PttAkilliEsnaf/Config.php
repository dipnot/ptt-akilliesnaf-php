<?php
namespace Dipnot\PttAkilliEsnaf;

/**
 * Class Config
 * @package Dipnot\PttAkilliEsnaf
 */
class Config
{
    /**
     * @var string $_clientId
     */
    private $_clientId = "";

    /**
     * @var string $_apiUser
     */
    private $_apiUser = "";

    /**
     * @var string $_apiPass
     */
    private $_apiPass = "";

    /**
     * @var bool $_isTestModeEnabled
     */
    private $_isTestModeEnabled;

    /**
     * @param bool $isTestModeEnabled
     */
    public function __construct($isTestModeEnabled = false)
    {
        $this->_isTestModeEnabled = $isTestModeEnabled;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->_clientId;
    }

    /**
     * @param string $clientId
     * @return void
     */
    public function setClientId($clientId)
    {
        $this->_clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getApiUser()
    {
        return $this->_apiUser;
    }

    /**
     * @param string $apiKey
     * @return void
     */
    public function setApiUser($apiKey)
    {
        $this->_apiUser = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiPass()
    {
        return $this->_apiPass;
    }

    /**
     * @param string $apiPass
     * @return void
     */
    public function setApiPass($apiPass)
    {
        $this->_apiPass = $apiPass;
    }

    /**
     * @return bool
     */
    public function isTestModeEnabled()
    {
        return $this->_isTestModeEnabled;
    }
}