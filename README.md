# Yi-Anyun SDK for PHP

Yi-Anyun SDK for PHP 是支持产品快捷访问的开发包。

## 发行说明

我们在 `消除已知问题` 和 `兼容旧语法` 的原则上开发了新内核，增加了如下特性：

- [支持 Composer][packagist]

## 先决条件

您的系统需要满足[先决条件](/docs/zh-CN/0-Prerequisites.md)，包括 PHP >= 5.5。 我们强烈建议使用cURL扩展，并使用 TLS 后端编译 cURL 7.16.2+。

## 安装依赖

如果已在系统上[全局安装 Composer](https://getcomposer.org/doc/00-intro.md#globally)，请直接在项目目录中运行以下内容来安装 Alibaba Cloud SDK for PHP
作为依赖项：

```
composer require eqxiu/anyun-sdk
```

> 一些用户可能由于网络问题无法安装，可以使用[阿里云 Composer 全量镜像](https://developer.aliyun.com/composer)。

请看[安装](/docs/zh-CN/1-Installation.md)有关通过 Composer 和其他方式安装的详细信息。

## 快速使用

```php
<?php

use Eqxiu\Client\AuditClient;

$auditClient = AuditClient::create($appKey, $appSecret, $productKey);
    
try {    
    $ret = $auditClient
        ->setSceneId("1000000")
        ->setTitle("测试")
        ->addTextContent("测试文本")
        ->setCreateUser("linfeng")
        ->setCover("https://res1.eqh5.com/FpA6sMCfreBpDXPbMc_oJvMv4aaO")
        ->addAudioContent("https://res1.eqh5.com/store/5b4629d7a536423f25fe74e99248b5f9.mp3")
        ->addImgContent("https://res1.eqh5.com/FpA6sMCfreBpDXPbMc_oJvMv4aaO")
        ->addVideoContent("https://video-1251586368.file.myqcloud.com//tencent/675a74d31adb9111e050adcae908cced/25e45311345749d69f84cd4f52ae2c03.mp4")
        ->addLinkContent("https://www.baidu.com/")
        ->post();
        
    var_dump($ret);
    if ($ret["code"] == 200) {
        echo $ret . "\n";
    } else {
        var_dump($ret);
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
    echo $exception->getErrorCode(). PHP_EOL;
    echo $exception->getRequestId(). PHP_EOL;
    echo $exception->getErrorMessage(). PHP_EOL;
} 
        

```

## 问题

[提交 Issue](https://gitee.com/yi-anyun/anyun-sdk-php/issues/new/)，不符合指南的问题可能会立即关闭。

## 许可证

[Apache-2.0](/LICENSE.md)
