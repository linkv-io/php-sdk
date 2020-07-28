<?php


namespace LinkV\im;


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
    /**
     * @var  string $app_secret
     */
    public $app_secret = null;
    /**
     * @var  string $url
     */
    public $url = null;

    function __construct(array $jsonData)
    {
        $this->app_id = isset($jsonData['app_id']) ? $jsonData['app_id'] : '';
        $this->app_key = isset($jsonData['app_key']) ? $jsonData['app_key'] : '';
        $this->app_secret = isset($jsonData['app_secret']) ? $jsonData['app_secret'] : '';
        $this->url = isset($jsonData['url']) ? $jsonData['url'] : '';
    }
}