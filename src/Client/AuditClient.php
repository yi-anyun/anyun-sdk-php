<?php


namespace Eqxiu\Client;
define("API_TIMEOUT", 10);
define("API_URL", "http://check.eqxiu.com/cdc/data/receive");

use Eqxiu\Core\DateUtils;
use Exception;

/**
 * Class AuditClient
 * @package Eqxiu\Client
 */
class AuditClient implements AuditOperations
{
    /**
     * @var $wrapClient
     */
    private $wrapClient;
    /**
     * 请求参数
     */
    private $requestMap;

    /**
     * 创建包裹客户端对象
     * @param $appKey '应用Key'
     * @param $appSecret '应用密钥'
     * @param $productKey
     * @return AuditClient
     */
    public static function create($appKey, $appSecret, $productKey)
    {
        return new AuditClient($appKey, $appSecret, $productKey);
    }

    /**
     * AuditRequest constructor.
     * @param $appKey '应用Key'
     * @param $productKey '审核计划Key'
     */
    private function __construct($appKey, $appSecret, $productKey)
    {
        $this->wrapClient = WrapClient::create($appKey, $appSecret);
        $this->requestMap = array(
            "appKey" => $appKey,
            "productKey" => $productKey,
            "publishTime" => DateUtils::getMillisecond(),
            "contents" => array()
        );
    }

    /**
     * @param mixed $sceneId
     */
    public function setSceneId($sceneId)
    {
        $this->requestMap["sceneId"] = $sceneId;
        return $this;
    }

    /**
     * @param mixed $title
     * @throws Exception
     */
    public function setTitle($title)
    {
        if (!is_string($title)) {
            throw new Exception("标题不是字符串");
        }
        $this->requestMap["title"] = $title;
        return $this;
    }

    /**
     * @param mixed $cover
     * @throws Exception
     */
    public function setCover($cover)
    {
        if (!is_string($cover)) {
            throw new Exception("封面不是字符串");
        }
        $this->requestMap["cover"] = $cover;
        return $this;
    }

    /**
     * @param mixed $description
     * @throws Exception
     */
    public function setDescription($description)
    {
        if (!is_string($description)) {
            throw new Exception("描述不是字符串");
        }
        $this->requestMap["description"] = $description;
        return $this;
    }

    /**
     * @param mixed $viewUrl
     * @throws Exception
     */
    public function setViewUrl($viewUrl)
    {
        if (!is_string($viewUrl)) {
            throw new Exception("预览地址不是字符串");
        }
        $this->requestMap["viewUrl"] = $viewUrl;
        return $this;
    }

    /**
     * @param mixed $createUser
     * @throws Exception
     */
    public function setCreateUser($createUser)
    {
        if (!is_string($createUser)) {
            throw new Exception("创建用户不是字符串");
        }
        $this->requestMap["createUser"] = $createUser;
        return $this;
    }

    /**
     * @param mixed $createTime
     */
    public function setCreateTime($createTime)
    {
        $this->requestMap["createTime"] = $createTime;
        return $this;
    }

    /**
     * @param $content
     * @return $this
     * @throws Exception
     */
    public function addTextContent($content)
    {
        if (!is_string($content)) {
            throw new Exception("文本不是字符串");
        }
        $item = array("type" => "TXT", "content" => $content);
        array_push($this->requestMap["contents"], $item);
        return $this;
    }

    /**
     * @param array $contents 文本内容数组
     * @return $this 构造器
     * @throws Exception 异常
     */
    public function addTextContents(array $contents)
    {
        if (!is_array($contents)) {
            throw new Exception("传入参数不是数组");
        }
        $num = count($contents);
        for ($i = 0; $i < $num; $i++) {
            $item = array(
                "type" => "TXT",
                "content" => $contents[$i]
            );
            array_push($this->requestMap["contents"], $item);
        }
        return $this;
    }

    /**
     * @param $content
     * @return $this
     * @throws Exception
     */
    public function addImgContent($content)
    {
        if (!is_string($content)) {
            throw new Exception("图片地址不是字符串");
        }
        $item = array("type" => "IMAGE_URL", "content" => $content);
        array_push($this->requestMap["contents"], $item);
        return $this;
    }

    /**
     * @param array $contents 图片地址数组
     * @return $this 构造器
     * @throws Exception 异常
     */
    public function addImgContents(array $contents)
    {
        if (!is_array($contents)) {
            throw new Exception("传入参数不是数组");
        }
        $num = count($contents);
        for ($i = 0; $i < $num; $i++) {
            $item = array(
                "type" => "IMAGE_URL",
                "content" => $contents[$i]
            );
            array_push($this->requestMap["contents"], $item);
        }
        return $this;
    }

    /**
     * @param $content
     * @return $this
     * @throws Exception
     */
    public function addLinkContent($content)
    {
        if (!is_string($content)) {
            throw new Exception("外链地址不是字符串");
        }
        $item = array("type" => "LINK", "content" => $content);
        array_push($this->requestMap["contents"], $item);
        return $this;
    }

    /**
     * @param array $contents 外链地址数组
     * @return $this 构造器
     * @throws Exception 异常
     */
    public function addLinkContents(array $contents)
    {
        if (!is_array($contents)) {
            throw new Exception("传入参数不是数组");
        }
        $num = count($contents);
        for ($i = 0; $i < $num; $i++) {
            $item = array(
                "type" => "LINK",
                "content" => $contents[$i]
            );
            array_push($this->requestMap["contents"], $item);
        }
        return $this;
    }

    /**
     * @param $content
     * @return $this
     * @throws Exception
     */
    public function addAudioContent($content)
    {
        if (!is_string($content)) {
            throw new Exception("音频地址不是字符串");
        }
        $item = array("type" => "AUDIO_URL", "content" => $content);
        array_push($this->requestMap["contents"], $item);
        return $this;
    }

    /**
     * @param array $contents 音频地址数组
     * @return $this 构造器
     * @throws Exception 异常
     */
    public function addAudioContents(array $contents)
    {
        if (!is_array($contents)) {
            throw new Exception("传入参数不是数组");
        }
        $num = count($contents);
        for ($i = 0; $i < $num; $i++) {
            $item = array(
                "type" => "AUDIO_URL",
                "content" => $contents[$i]
            );
            array_push($this->requestMap["contents"], $item);
        }
        return $this;
    }

    /**
     * @param $content
     * @return $this
     * @throws Exception
     */
    public function addVideoContent($content)
    {
        if (!is_string($content)) {
            throw new Exception("视频地址不是字符串");
        }
        $item = array("type" => "VIDEO_URL", "content" => $content);
        array_push($this->requestMap["contents"], $item);
        return $this;
    }

    /**
     * @param array $contents 视频地址数组
     * @return $this 构造器
     * @throws Exception 异常
     */
    public function addVideoContents(array $contents)
    {
        if (!is_array($contents)) {
            throw new Exception("传入参数不是数组");
        }
        $num = count($contents);
        for ($i = 0; $i < $num; $i++) {
            $item = array(
                "type" => "VIDEO_URL",
                "content" => $contents[$i]
            );
            array_push($this->requestMap["contents"], $item);
        }
        return $this;
    }

    /**
     * @param mixed $extra
     * @return $this 构造器
     */
    public function setExtra($extra)
    {
        if (!is_string($extra)) {
            throw new Exception("额外信息不是字符串");
        }
        $this->requestMap["extra"] = $extra;
        return $this;
    }

    /**
     * @throws Exception
     */
    function post()
    {
        $this->validateRequest();
        $wrapRequest = $this->wrapClient->wrap($this->requestMap);
        $result = $this->curl_post($wrapRequest, API_URL, API_TIMEOUT);
        return json_decode($result, true);
    }

    /**
     * 请求参数验证
     * @throws Exception
     */
    function validateRequest()
    {
        if (empty($this->requestMap)) {
            throw new Exception("请求参数不能为空");
        }
        if (empty($this->requestMap["appKey"])) {
            throw new Exception("appKey不能为空");
        }
        if (empty($this->requestMap["productKey"])) {
            throw new Exception("productKey不能为空");
        }
        if (empty($this->requestMap["sceneId"])) {
            throw new Exception("sceneId不能为空");
        }
        if (empty($this->requestMap["title"])) {
            throw new Exception("title不能为空");
        }
    }

    /**
     * curl post请求
     * @params 输入的参数
     */
    function curl_post($params, $url, $timout)
    {
        $json = json_encode($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, $timout);
        // POST数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // 把post的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json; charset=utf-8",
                "Content-Length: " . strlen($json))
        );
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}