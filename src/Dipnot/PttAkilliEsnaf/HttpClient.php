<?php
namespace Dipnot\PttAkilliEsnaf;

/**
 * Class HttpClient
 * @package Dipnot\PttAkilliEsnaf
 */
class HttpClient
{
    const METHOD_POST = "POST";

    /**
     * @var string $_baseUrl
     */
    private $_baseUrl;

    /**
     * @var Curl $_curl
     */
    private $_curl;

    /**
     * HttpClient constructor
     *
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->_baseUrl = $baseUrl;
        $this->_curl = new Curl();
    }

    /**
     * Makes a HTTP POST request
     *
     * @param string $uri
     * @param mixed $body
     * @return mixed
     */
    public function post($uri, $body)
    {
        return $this->makeHttpRequest(self::METHOD_POST, $uri, $body);
    }

    /**
     * Makes a HTTP request
     *
     * @param string $method
     * @param string $uri
     * @param mixed $body
     * @return mixed
     */
    private function makeHttpRequest($method, $uri, $body)
    {
        $url = $this->_baseUrl . $uri;

        $response = $this->_curl->execute($url, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($body),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ]
        ]);

        return $this->parseResponse($response);
    }

    /**
     * Parses JSON response
     *
     * @param string $response
     * @return mixed
     */
    private function parseResponse($response)
    {
        return json_decode($response);
    }
}