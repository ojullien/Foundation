<?php
$sCache20121105 = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR .'cache'. DIRECTORY_SEPARATOR;
$sUploads20121105 = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'. DIRECTORY_SEPARATOR .'uploads';

$this->_aTests[self::KEY_TEST] = [
[ 'label' => 'TEST: dir is file "notadir"', 'test' => $sCache20121105 .'notadir'],
[ 'label' => 'TEST: dir already exists', 'test' => $sUploads20121105],
[ 'label' => 'TEST: dir does not exist', 'test' => $sUploads20121105 . DIRECTORY_SEPARATOR . 'todelete'],
];
