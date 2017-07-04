<?php
namespace ossintegration\Adapter;

use ossintegration\AdapterInterface;

class Local extends AbstractAdapter
{

    public function __construct($prefixpath='')
    {
        $this->setPathPrefix($prefixpath);
    }

    public function file_put_contents($filename, $data)
    {
        $filename = $this->applyPathPrefix($filename);
        $dir = dirname($filename);
        if ( !file_exists($dir)) {
            if ( !mkdir($dir, 0777, true)) {
                return false;
            }
            chmod($dir, 0777);
        }
        file_put_contents($filename, $data);
    }

    /*
    public function file_append_contents($filename, $data)
    {
        $filename = $this->applyPathPrefix($filename);
        $dir = dirname($filename);
        if ( !file_exists($dir)) {
            if ( !mkdir($dir, 0777, true)) {
                return false;
            }
            chmod($dir, 0777);
        }
        file_put_contents($filename, $data, FILE_APPEND);
    }
    */


    public function file_delete($filename)
    {
        $filename = $this->applyPathPrefix($filename);
        unlink($filename);
    }

    public function file_exist($filename)
    {
        $filename = $this->applyPathPrefix($filename);
        return file_exists($filename);
    }

    public function file_get_contents($filename)
    {
        $filename = $this->applyPathPrefix($filename);
        return file_get_contents($filename);
    }

    /**
     * @desc 本地文件拷贝(忽略$prefixpath)
     * @param $source 全路径
     * @param $dest 全路径
     */
    public function put_file($source, $dest)
    {
        copy($source, $dest);
    }
}