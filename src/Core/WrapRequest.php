<?php


namespace Eqxiu\Core;

class WrapRequest
{
    private $request;

    /**
     * @param mixed $appKey
     */
    public function setAppKey($appKey)
    {
        $this->request["appKey"] = $appKey;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature)
    {
        $this->request["signature"] = $signature;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->request["timestamp"] = $timestamp;
    }

    /**
     * @param mixed $nonce
     */
    public function setNonce($nonce)
    {
        $this->request["nonce"] = $nonce;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->request["data"] = $data;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

}