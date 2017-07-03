<?php

use ossintegration;
$local = new ossintegration\Adapter\Local();
$ossAliyun = new ossintegration\Adapter\Oss('qukan-test', 'SBns8nHSboF7cItp', 'sWuCgC58sEfbugEQknj46kaxTqn4r2', 'http://oss-cn-beijing.aliyuncs.com');
$fileSys = ['local' => $local, 'oss' => $ossAliyun];
$manager = new ossintegration\MountManager($fileSys);
$mount = $manager->mountFilesystem('local');

$filename = '/data/oss/localdata';
$data = 'hello raja!';
$mount->file_put_contents($filename, $data);

