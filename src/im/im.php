<?php


namespace LinkV\im;

use LinkV\config\config as cfg;
use LinkV\im\config as IMConfig;

class im
{
    /**
     * @var  IMConfig $config
     */
    public $config = null;

    function __construct(cfg $config)
    {
        $this->config = $config->im;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}