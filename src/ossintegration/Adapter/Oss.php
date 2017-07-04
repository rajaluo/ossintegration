<?php
namespace ossintegration\Adapter;

use ossintegration\AdapterInterface;
use OSS\OssClient;
use OSS\Core\OssException;


class Oss extends AbstractAdapter
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

    public function getBucket()
    {
        return $this->_bucket;
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
     * oss追加上传api设计的不好；和文件操作差异较大,不太好做统一的api,如果要用的话建议用各自原生的api,暴露公用方法,但这和初衷不一致
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

    /**
     * @desc 本地文件上传到oss
     * @param $source 本地文件全路径
     * @param $dest oss object name
     * @throws OssException
     */
    public function put_file($source, $dest)
    {
        $this->_ossClient->uploadFile($this->_bucket, $dest, $source);
    }

    /**
     * @desc oss系统自己的特性方法访问入口
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array(array($this->_ossClient, $name), $arguments);
    }
}