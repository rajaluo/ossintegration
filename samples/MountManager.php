<?php
namespace ossintegration;

//use ossintegration;
use ossintegration\Adapter\Local;
use ossintegration\Adapter\Oss;

$local = new Local();
$ossAliyun = new Oss('qukan-test', 'SBns8nHSboF7cItp', 'sWuCgC58sEfbugEQknj46kaxTqn4r2', 'http://oss-cn-beijing.aliyuncs.com');
$fileSys = ['local' => $local, 'oss' => $ossAliyun];
$manager = new MountManager($fileSys);
$mount = $manager->mountFilesystem('local');

$filename = '/data/oss/localdata';
$data = 'hello raja!';
$mount->file_put_contents($filename, $data);

