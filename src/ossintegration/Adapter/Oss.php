<?php
namespace ossintegration\Adapter;

use ossintegration\AdapterInterface;
use OSS\OssClient;
use OSS\Core\OssException;


class Oss implements AdapterInterface
{
    private $_ossClient = null;
    private $_bucket = null;

    public function __construct($bucket, $accessKeyId, $accessKeySecret, $endpoint, $isCName = false, $securityToken = NULL)
    {
        $this->_ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint, $isCName, $securityToken);
        $this->_ossClient->setTimeout(3600 /* seconds */);
        $this->_ossClient->setConnectTimeout(10 /* seconds */);
        $this->_bucket = $bucket;
    }

    /**
    //* 设置http库的请求超时时间，单位秒
     *
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->_ossClient->setTimeout($timeout);
    }

    /**
     * 设置http库的连接超时时间，单位秒
     *
     * @param int $connectTimeout
     */
    public function setConnectTimeout($connectTimeout)
    {
        $this->_ossClient->setConnectTimeout($connectTimeout);
    }


    public function file_put_contents($filename, $data)
    {
        $this->_ossClient->putObject($this->_bucket, $filename, $data);
    }

    /*
    public function file_append_contents($filename, $data)
    {

    }
    */

    public function file_delete($filename)
    {
        $this->_ossClient->deleteObject($this->_bucket, $filename);
    }

    public function file_exist($filename)
    {
        $exist = $this->_ossClient->doesObjectExist($this->_bucket, $filename);
        return $exist;
    }

    public function file_get_contents($filename)
    {
        $content = $this->_ossClient->getObject($this->_bucket, $filename);
        return $content;
    }

    public function put_file($source, $dest)
    {
        $this->_ossClient->uploadFile($this->_bucket, $dest, $source);
    }
}