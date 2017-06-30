<?php
namespace ossintegration;

interface AdapterInterface
{
    public function file_put_contents ($filename, $data);

    //public function file_append_contents($filename, $data);

    public function file_delete($filename);

    public function file_exist($filename);

    public function file_get_contents($filename);

    public function put_file($source, $dest);


}