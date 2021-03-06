<?php
include_once __DIR__.'/../vendor/autoload.php';

use ossintegration\Adapter\Local;
use ossintegration\Adapter\Oss;
use ossintegration\MountManager;

$prefixpath = '/Users/emily/data/';
$local = new Local($prefixpath);
$ossAliyun = new Oss('*', '*', '*', '*');
$fileSys = ['local' => $local, 'oss' => $ossAliyun];
$manager = new MountManager($fileSys);

//local
$mountLocal = $manager->mountFilesystem('local');
$filenameLocal = 'oss/localdata.dat';//权限
$dataLocal = 'hello local file!';
$mountLocal->file_put_contents($filenameLocal, $dataLocal);
var_dump($mountLocal->file_get_contents($filenameLocal));

//aliyun oss
$filenameOss = 'oss/ossdata.dat';//oss objectname 不能以/开头
$dataOss = 'hello aliyun oss!';
$mountOss = $manager->mountFilesystem('oss');
$mountOss->file_put_contents($filenameOss, $dataOss);
var_dump($mountOss->file_get_contents($filenameOss));

//put_file
$filenameLocalDest = 'oss/localdata2.dat';
$mountLocal->put_file($mountLocal->applyPathPrefix($filenameLocal), $mountLocal->applyPathPrefix($filenameLocalDest));//全路径copy本地文件
var_dump($mountLocal->file_get_contents($filenameLocalDest));

$filenameOssDest = 'oss/ossdata2.dat';
$mountOss->put_file($prefixpath.$filenameLocal, $filenameOssDest);//上传(全路径)本地文件
var_dump($mountOss->file_get_contents($filenameOssDest));

//oss special feature;从api设计角度来说希望是规范统一一套标准化api适用不同文件系统,从实际使用角度来说,希望一个libbrary就够用,能够兼容标准api和各个文件系统特有的api;
$bucket = $mountOss->getBucket();
$mountOss->signUrl($bucket, $filenameOssDest, 150);
var_dump($mountOss->getObjectMeta($bucket, $filenameOssDest));

//file_exist&file_delete
$mountLocal->file_delete($filenameLocal);
var_dump($mountLocal->file_exist($filenameLocal));
$mountOss->file_delete($filenameOss);
var_dump($mountOss->file_exist($filenameOss));









