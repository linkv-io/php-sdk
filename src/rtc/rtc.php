<?php


namespace LinkV\rtc;

use LinkV\config\config as cfg;
use LinkV\rtc\config as RTCConfig;

class rtc
{
    /**
     * @var  RTCConfig $config
     */
    public $config = null;

    function __construct(cfg $config)
    {
        $this->config = $config->rtc;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
}