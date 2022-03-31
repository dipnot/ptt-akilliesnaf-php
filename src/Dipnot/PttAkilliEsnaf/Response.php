<?php
namespace Dipnot\PttAkilliEsnaf;

/**
 * Class Response
 * @package Dipnot\PttAkilliEsnaf
 */
abstract class Response
{
    /**
     * @var Config $_config
     */
    protected $_config;

    /**
     * Response constructor
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->_config = $config;
    }
}