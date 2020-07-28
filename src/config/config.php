<?php


namespace LinkV\config;

use \FFI;

use LinkV\config\bindings\bindings;
use LinkV\im\config as IMConfig;
use LinkV\rtc\config as RTCConfig;

class config
{
    /**
     * @var  config $instance
     */
    private static $instance = null;
    /**
     * @var  IMConfig $im
     */
    public $im = null;

    /**
     * @var  RTCConfig $rtc
     */
    public $rtc = null;

    function __construct(array $jsonData)
    {
        if (isset($jsonData['im'])) {
            $this->im = new IMConfig($jsonData['im']);
        }
        if (isset($jsonData['rtc'])) {
            $this->rtc = new RTCConfig($jsonData['rtc']);
        }
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    /**
     * init 初始化
     *
     * @param string $appID 产品id
     * @param string $appSecret 密文
     *
     * @return config| false
     */
    public static function getInstance(string $appID, string $appSecret): config
    {
        if (self::$instance == null) {
            $bind = bindings::download();
            if (!$bind) {
                return false;
            }
            $c_app_id = FFI::new('char [' . (strlen($appID) + 1) . ']');
            FFI::memset($c_app_id, 0, strlen($appID) + 1);
            FFI::memcpy($c_app_id, $appID, strlen($appID));
            $c_app_secret = FFI::new('char [' . (strlen($appSecret) + 1) . ']');
            FFI::memset($c_app_secret, 0, strlen($appSecret) + 1);
            FFI::memcpy($c_app_secret, $appSecret, strlen($appSecret));
            $c_plain_text = $bind->decrypt(FFI::cast(FFI::type('char *'), $c_app_id), FFI::cast(FFI::type('char *'), $c_app_secret));
            $config = FFI::string($c_plain_text);
            $bind->release($c_plain_text);
            self::$instance = new self(json_decode($config, true));
        }
        return self::$instance;
    }
}