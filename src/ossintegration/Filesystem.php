<?php
namespace ossintegration;

class Filesystem implements AdapterInterface
{
    private $_iAdapter = null;

    public function __construct(AdapterInterface $i)
    {
        $this->_iAdapter = $i;
    }

    public function file_put_contents ($filename, $data)
    {
        return $this->_iAdapter->file_put_contents($filename, $data);
    }

    /*
    public function file_append_contents($filename, $data)
    {
        return $this->_iAdapter->file_append_contents($filename, $data);
    }
    */

    public function file_delete($filename)
    {
        return $this->_iAdapter->file_delete($filename);
    }

    public function file_exist($filename)
    {
        return $this->_iAdapter->file_exist($filename);
    }

    public function file_get_contents($filename)
    {
        return $this->_iAdapter->file_get_contents($filename);
    }

    public function put_file($source, $dest)
    {
        return $this->_iAdapter->put_file($source, $dest);
    }


}