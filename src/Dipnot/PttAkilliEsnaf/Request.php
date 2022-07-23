<?php
namespace Dipnot\PttAkilliEsnaf;

/**
 * Class Request
 * @package Dipnot\PttAkilliEsnaf
 */
class Request
{
    const API_ENDPOINT_PROD = "https://aeo.ptt.gov.tr/api/Payment";
    const API_ENDPOINT_TEST = "https://payment.testdgpf.dgpaysit.com/api/Payment";

    /**
     * @var Config $_config
     */
    protected $_config;

    /**
     * @var HttpClient $_client
     */
    protected $_client;

    /**
     * @var string $_rnd
     */
    private $_rnd;

    /**
     * @var string $_timeSpan
     */
    private $_timeSpan;

    /**
     * @var string $_hash
     */
    private $_hash;

    /**
     * Request constructor
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->_config = $config;
        $this->_client = $this->createHttpClient();

        $this->_rnd = str_shuffle(mt_rand(10000000, 99999999));
        $this->_timeSpan = date("YmdHis");
        $this->_hash = $this->createHash();
    }

    /**
     * @return string
     */
    protected function getRnd()
    {
        return $this->_rnd;
    }

    /**
     * @return string
     */
    protected function getTimeStan()
    {
        return $this->_timeSpan;
    }

    /**
     * @return string
     */
    protected function getHash()
    {
        return $this->_hash;
    }

    /**
     * Generates hash
     * @see https://akilliesnaf.ptt.gov.tr/developer/#hash-mekanizmasi
     *
     * @return string
     */
    private function createHash()
    {
        $clientId = $this->_config->getClientId();
        $apiPass = $this->_config->getApiPass();
        $apiUser = $this->_config->getApiUser();
        $rnd = $this->getRnd();
        $timeSpan = $this->getTimeStan();

        $hashString = $apiPass . $clientId . $apiUser . $rnd . $timeSpan;

        $hashingBytes = hash("sha512", $hashString, true);

        return base64_encode($hashingBytes);
    }

    /**
     * Creates an HttpClient instance based on the test mode
     *
     * @return HttpClient
     */
    private function createHttpClient()
    {
        return new HttpClient(
            $this->_config->isTestModeEnabled() ?
                self::API_ENDPOINT_TEST :
                self::API_ENDPOINT_PROD
        );
    }
}