[![API Reference](https://img.shields.io/badge/api-reference-blue.svg)]()
[![Build Status](https://img.shields.io/static/v1?label=build&message=passing&color=32CD32)]()
[![Apache V2 License](https://img.shields.io/badge/license-Apache%20V2-blue.svg)](https://github.com/linkv-io/php-sdk/blob/master/LICENSE)

# php-sdk

LINKV SDK for the php programming language.

## Requirement
PHP

PHP-CPP 

## Installing
- install PHP-CPP
    - 2.2.0 (PHP 7.4+) https://github.com/CopernicaMarketingSoftware/PHP-CPP
    - 2.1.4 (PHP 7.0~7.3) https://github.com/CopernicaMarketingSoftware/PHP-CPP
    - 1.7.1 (PHP 5.3+) https://github.com/CopernicaMarketingSoftware/PHP-CPP-LEGACY
```sh
tar zxf PHP-CPP.tar.gz
cd PHP-CPP
make
make install
```

- download [linkv.so](https://github.com/linkv-io/php-sdk/tags) 
    - PHP 7.4+ (2.2.0)
    - PHP 7.0~7.3 (2.1.4)
    - PHP 5.3+ (1.7.1)
  
- edit php.ini
```sh
# php.ini
[linkv]
extension=/path/linkv.so
```

## License

This SDK is distributed under the
[Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0),
see LICENSE.txt and NOTICE.txt for more information.