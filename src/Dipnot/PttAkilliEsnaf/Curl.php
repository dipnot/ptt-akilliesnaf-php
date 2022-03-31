<?php
namespace Dipnot\PttAkilliEsnaf;

/**
 * Class Curl
 * @package Dipnot\PttAkilliEsnaf
 */
class Curl
{
    /**
     * Creates and executes cURL
     *
     * @param string $url
     * @param array $options
     * @return string|bool
     */
    public function execute($url, $options)
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, $options);

        return curl_exec($curl);
    }
}