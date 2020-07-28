<?php


namespace LinkV\rtc;


class config
{
    /**
     * @var  string $app_id
     */
    public $app_id = null;
    /**
     * @var  string $app_key
     */
    public $app_key = null;

    function __construct(array $jsonData)
    {
        $this->app_id = isset($jsonData['app_id']) ? $jsonData['app_id'] : '';
        $this->app_key = isset($jsonData['app_secret']) ? $jsonData['app_secret'] : '';
    }
}