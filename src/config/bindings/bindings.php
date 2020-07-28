<?php

namespace LinkV\config\bindings;

use \FFI;
use \Exception;

/**
 * _platformFile 获取系统信息
 *
 * @param string $name 文件名称
 *
 * @return string
 *
 * @throws Exception
 */
function _platformFile(string $name): string
{
    if (php_uname('s') == 'Linux') {
        return "lib{$name}.so";
    }
    if (php_uname('s') == 'Linux') {
        return "lib{$name}.dylib";
    }
    if (php_uname('s') == 'Windows') {
        return "lib{$name}.dll";
    }
    throw new Exception('Platform not implemented');
}

/**
 * dlOpenPlatformSpecific 获取系统信息
 *
 * @param string $name 文件名称
 * @param string $path 文件路径
 *
 * @return FFI|false
 */
function dlOpenPlatformSpecific(string $name, string $path = ""): FFI
{
    try {
        if ($path == "") {
            $path = sys_get_temp_dir();
        }
        return FFI::cdef(<<<EOH
        char* decrypt(char*, char*);
        void release(char*);
        EOH, "{$path}/" . _platformFile($name));
    } catch (Exception $e) {
        return false;
    }
}

/**
 * download 获取动态链接库
 *
 * @param string $name 文件名称
 * @param string $path 文件路径
 * @param string $version 版本
 * @param string $uri uri
 *
 * @return bool
 */
function download(string $name, string $path, string $version, string $uri): bool
{
    try {
        if ($path == "") {
            $path = sys_get_temp_dir();
        }
        $fullName = "{$path}/" . _platformFile($name);
        if (file_exists($fullName)) {
            return true;
        };
        // http://dl.linkv.fun/static/server/0.0.4/libdecrypt.so
        $url = "{$uri}/{$version}/" . _platformFile($name);
        return copy($url, $fullName);
    } catch (Exception $e) {
        return false;
    }
}

class bindings
{
    /**
     * @var  FFI $ffi
     */
    private $ffi = null;

    private static $FILE = 'decrypt';
    private static $VERSION = '0.0.4';
    private static $DOWNLOAD = 'http://dl.linkv.fun/static/server';

    /**
     * bindings 构造
     *
     * @param string $file 文件名
     *
     */
    function __construct(string $file)
    {
        $ffi = dlOpenPlatformSpecific($file);
        if ($ffi) {
            $this->ffi = $ffi;
        }
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    /**
     * decrypt 解密
     *
     * @param FFI\CData $appID 产品id
     * @param FFI\CData $cipherText 密文
     *
     * @return FFI\CData|false
     */
    public function decrypt(FFI\CData $appID, FFI\CData $cipherText): FFI\CData
    {
        if ($this->ffi == null) {
            return false;
        }
        return $this->ffi->decrypt($appID, $cipherText);
    }

    /**
     * release 释放
     *
     * @param FFI\CData $plainText 明文
     *
     * @return void
     */
    public function release(FFI\CData $plainText): void
    {
        if ($this->ffi == null) {
            return;
        }
        $this->ffi->release($plainText);
    }

    /**
     * release 释放
     *
     * @return bindings|false
     */
    public static function download(): bindings
    {
        if (!download(self::$FILE, '', self::$VERSION, self::$DOWNLOAD)) {
            return false;
        }
        $b = new bindings(self::$FILE);
        return is_null($b) ? false : $b;
    }
}