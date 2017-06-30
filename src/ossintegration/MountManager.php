<?php
namespace ossintegration;

class MountManager
{
    private $_aFilesystem = [];

    public function __construct($aFilesystem)
    {
        $this->_aFilesystem = $aFilesystem;
    }

    public function mountFilesystem($key)
    {
        return $this->_aFilesystem[$key];
    }

}