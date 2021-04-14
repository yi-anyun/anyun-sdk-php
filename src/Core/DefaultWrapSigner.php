<?php

namespace Eqxiu\Core;

define("INTERNAL_STRING_CHARSET", "auto");

/**
 * Class DefaultWrapSigner
 * @package Eqxiu\Core
 */
class DefaultWrapSigner implements \Eqxiu\Core\WrapSigner
{
    private $allowSigner;
    private $appSecret;

    /**
     * DefaultWrapSigner constructor.
     * @param $appSecret
     */
    public function __construct($appSecret)
    {
        $this->allowSigner = array(self::APP_KEY, self::PRODUCT_KEY, self::SCENE_ID, self::TITLE, self::TIME_STAMP, self::NONCE);
        $this->appSecret = $appSecret;
    }

    public function signature($source)
    {
        $params = array();
        foreach ($source as $key => $value) {
            if (in_array($key, $this->allowSigner)) {
                $params[$key] = is_string($value) ? mb_convert_encoding($value, "utf8", INTERNAL_STRING_CHARSET) : $value;
            }
        }
        foreach ($source["data"] as $key => $value) {
            if (in_array($key, $this->allowSigner)) {
                $params[$key] = is_string($value) ? mb_convert_encoding($value, "utf8", INTERNAL_STRING_CHARSET) : $value;;
            }
        }
        ksort($params);

        $buff = "";
        foreach ($params as $key => $value) {
            if ($value !== null) {
                $buff .= $key . "=" . $value . "&";
            }
        }
        $len = strlen($buff);
        $result = substr($buff, 0, $len - 1);

        return base64_encode(hash_hmac('sha256', $result, $this->appSecret, true));
    }
}