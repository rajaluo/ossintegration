<?php
namespace ossintegration\Adapter;

use ossintegration\AdapterInterface;

class Local implements AdapterInterface
{

    public function __construct()
    {

    }

    public function file_put_contents($filename, $data)
    {
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

    }
    */

    public function file_delete($filename)
    {
        unlink($filename);
    }

    public function file_exist($filename)
    {
        return file_exists($filename);
    }

    public function file_get_contents($filename)
    {
        return file_get_contents($filename);
    }

    /**
     * @desc 本地文件拷贝
     * @param $source
     * @param $dest
     */
    public function put_file($source, $dest)
    {
        copy($source, $dest);
    }
}