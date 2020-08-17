[![API Reference](https://img.shields.io/badge/api-reference-blue.svg)]()
[![Build Status](https://img.shields.io/static/v1?label=build&message=passing&color=32CD32)]()
[![Apache V2 License](https://img.shields.io/badge/license-Apache%20V2-blue.svg)](https://github.com/linkv-io/php-sdk/blob/master/LICENSE)

# php-sdk

LINKV SDK for the php programming language.

## Requirement
PHP-CPP

## Installing
- install PHP-CPP
    - 2.2.0 (PHP 7.4+) https://github.com/CopernicaMarketingSoftware/PHP-CPP
    - 2.1.4 (PHP 7.0~7.3) https://github.com/CopernicaMarketingSoftware/PHP-CPP
    - 1.7.1 (PHP 5.*) https://github.com/CopernicaMarketingSoftware/PHP-CPP-LEGACY
```sh
tar zxf PHP-CPP.tar.gz
cd PHP-CPP
make
make install
```

- edit php.ini
```sh
# php.ini
[linkv]
extension=/path/linkv.so
```

## Usage

```php
<?php

$appID = "rbaiHjNHQyVprPCBSHevvVvuNynNeTvp";
$appSecret = "87EA975D424238D0A08F772321169816DD016667D5BB577EBAEB820516698416E4F94C28CB55E9FD8E010260E6C8A177C0B078FC098BCF2E9E7D4A9A71BF1EF8FBE49E05E5FC5A6A35C6550592C1DB96DF83F758EAFBC5B342D5D04C9D92B1A82A76E3756E83A4466DA22635A8A9F88901631B5BBBABC8A94577D66E8B000F4B179DA99BAA5E674E4F793D9E60EEF1C3B757006459ABB5E6315E370461EBC8E6B0A7523CA0032D33B5C0CF83264C9D83517C1C94CAB3F48B8D5062F5569D9793982455277C16F183DAE7B6C271F930A160A6CF07139712A9D3ABF85E05F8721B8BB6CAC1C23980227A1D5F31D23FA6567578AEEB6B124AF8FF76040F9598DDC9DE0DA44EF34BBB01B53E2B4713D2D701A9F913BE56F9F5B9B7D8D2006CA910D8BFA0C34C619AB0EEBDAA474E67115532511686992E88C4E32E86D82736B2FE141E9037381757ED02C7D82CA8FC9245700040D7E1E200029416295D891D388D69AC5197A65121B60D42040393FB42BC2769B1E2F649A7A17083F6AB2B1BE6E993";
if (!LvInit($appID,$appSecret)) {
    return;
}

// $im = new LvIM();
// var_dump($im);
// $rtc = new LvRTC();
// var_dump($rtc);

$live = new LvLIVE();
$third_uid="test-php-tob";
$a_id = "test";
$arr = $live->GetTokenByThirdUID($third_uid,$a_id,'test-php','http://meet.linkv.sg/app/rank-list/static/img/defaultavatar.cd935fdb.png',LvLIVE::SexTypeUnknown);
var_dump($arr['live_token']);


$liveOpenID = $arr['live_open_id'];
$gold0 = $live->GetGoldByLiveOpenID($liveOpenID);
var_dump("gold0:".$gold0);
$orderID = '';
$gold = 10;
$gold1 = $live->SuccessOrderByLiveOpenID($liveOpenID, LvLIVE::OrderTypeAdd, $gold, 10, 1, LvLIVE::PlatformTypeH5,$orderID);
var_dump("gold1:".$gold1);

if (($gold0+$gold) != $gold1) {
    var_dump("(golds0+gold) != golds1");
    return;
}

$ok = $live->ChangeGoldByLiveOpenID($liveOpenID, LvLIVE::OrderTypeDel, $gold, 1, 'test del');
if (!$ok) {
    var_dump("ok: ".$ok);
    return;
}
$gold2 = $live->GetGoldByLiveOpenID($liveOpenID);
var_dump("gold2:".$gold2);

if($gold0 != $gold2) {
    var_dump("golds0 != golds2");
    return;
}
var_dump("success");
```
## License

This SDK is distributed under the
[Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0),
see LICENSE.txt and NOTICE.txt for more information.