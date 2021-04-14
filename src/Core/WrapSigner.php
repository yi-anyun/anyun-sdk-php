<?php


namespace Eqxiu\Core;

/**
 * Interface WrapSigner
 * @package Seelyn\Core
 */
interface WrapSigner
{
    const APP_KEY = "appKey";
    const PRODUCT_KEY = "productKey";
    const SCENE_ID = "sceneId";
    const TITLE = "title";
    const TIME_STAMP = "timestamp";
    const NONCE = "nonce";

    /**
     * @param $source
     * @return mixed
     */
    public function signature($source);
}