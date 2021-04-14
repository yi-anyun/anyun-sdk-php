<?php


namespace Eqxiu\Client;

use Eqxiu\Core\DateUtils;
use Eqxiu\Core\DefaultWrapSigner;
use Eqxiu\Core\WrapRequest;

/**
 * Class WrapClient
 * @package Seelyn\Client
 */
class WrapClient implements WrapOperation
{

    private $appKey;
    private $wrapSigner;

    /**
     * WrapClient constructor.
     */
    private function __construct($appKey, $appSecret)
    {
        $this->wrapSigner = new DefaultWrapSigner($appSecret);
        $this->appKey = $appKey;
    }

    /**
     * @param $source
     * @return mixed
     */
    function wrap($source)
    {
        $wrapRequest = new WrapRequest();
        $wrapRequest->setAppKey($this->appKey);
        $wrapRequest->setTimestamp(DateUtils::getMillisecond());
        $wrapRequest->setNonce(sprintf("%d", rand()));
        $wrapRequest->setData($source);
        $wrapRequest->setSignature($this->wrapSigner->signature($wrapRequest->getRequest()));
        return $wrapRequest->getRequest();
    }

    /**
     * 创建包裹客户端对象
     * @param $appKey '应用Key'
     * @param $appSecret '应用密钥'
     * @return WrapClient
     */
    public static function create($appKey, $appSecret)
    {
        return new WrapClient($appKey, $appSecret);
    }
}