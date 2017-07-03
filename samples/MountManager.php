<?php
include_once __DIR__.'/../vendor/autoload.php';

use ossintegration\Adapter\Local;
use ossintegration\Adapter\Oss;
use ossintegration\MountManager;

$local = new Local();
$ossAliyun = new Oss('qukan-test', 'SBns8nHSboF7cItp', 'sWuCgC58sEfbugEQknj46kaxTqn4r2', 'http://oss-cn-beijing.aliyuncs.com');
$fileSys = ['local' => $local, 'oss' => $ossAliyun];
$manager = new MountManager($fileSys);

//local
$mountLocal = $manager->mountFilesystem('local');
//$filenameLocal = '/data/oss/localdata.dat';
$filenameLocal = '/Users/emily/data/oss/localdata.dat';//权限
$dataLocal = 'hello local file!';
$mountLocal->file_put_contents($filenameLocal, $dataLocal);
var_dump($mountLocal->file_get_contents($filenameLocal));

//aliyun oss
$filenameOss = 'Users/emily/data/oss/localdata.dat';//oss objectname 不能以／开头
$dataOss = 'hello aliyun oss!';
$mountOss = $manager->mountFilesystem('oss');
$mountOss->file_put_contents($filenameOss, $dataOss);
var_dump($mountOss->file_get_contents($filenameOss));

//put_file
$filenameLocalDest = '/Users/emily/data/oss/localdata2.dat';
$mountLocal->put_file($filenameLocal, $filenameLocalDest);
var_dump($mountLocal->file_get_contents($filenameLocalDest));

$filenameOssDest = 'Users/emily/data/oss/localdata2.dat';
$mountOss->put_file($filenameLocal, $filenameOssDest);//上传本地文件
var_dump($mountOss->file_get_contents($filenameOssDest));

//file_exist&file_delete
$mountLocal->file_delete($filenameLocal);
var_dump($mountLocal->file_exist($filenameLocal));
$mountOss->file_delete($filenameOss);
var_dump($mountOss->file_exist($filenameOss));







