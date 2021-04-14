<?php

require_once '../vendor/autoload.php';

// 简单测试
use Eqxiu\Client\AuditClient;

function main()
{

    $auditClient = AuditClient::create("leputy",
        "Dekna5A4P2nuC9usrhhD", "leputy_product");

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
}

main();

?>