<?php


namespace LinkV;


use \Exception;
use LinkV\config\config;
use LinkV\im\im;
use LinkV\rtc\rtc;

class LinkV
{
    private bool $bInit = false;

    /**
     * @var  im $im
     */
    private $im = null;
    /**
     * @var  rtc $rtc
     */
    private $rtc = null;

    /**
     * init 初始化
     *
     * @param string $appID 产品id
     * @param string $appSecret 密文
     *
     * @return bool
     */
    public function init(string $appID, string $appSecret): bool
    {
        if ($this->bInit) {
            return true;
        }
        $cfg = config::getInstance($appID, $appSecret);
        $this->im = new im($cfg);
        $this->rtc = new rtc($cfg);
        $this->bInit = true;
        return true;
    }

    /**
     * getIM 初始化
     *
     * @return im
     *
     * @throws Exception
     */
    public function getIM(): im
    {
        if (!$this->bInit) {
            throw new Exception('un init');
        }
        return $this->im;
    }

    /**
     * getRTC 初始化
     *
     * @return rtc
     *
     * @throws Exception
     */
    public function getRTC(): rtc
    {
        if (!$this->bInit) {
            throw new Exception('un init');
        }
        return $this->rtc;
    }
}