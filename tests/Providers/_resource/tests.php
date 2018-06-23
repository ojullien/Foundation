<?php
$sBuffer20121015 = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'cache';
$this->_aTests[self::KEY_TEST] = array(
array( 'label'=>'TEST: NULL',       'test'=>array( 'value'=>NULL                                                 , 'mime'=>NULL ) ),
array( 'label'=>'TEST: EMPTY',      'test'=>array( 'value'=>''                                                   , 'mime'=>NULL ) ),
array( 'label'=>'TEST: DIRECTORY',  'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR               , 'mime'=>'directory' )),
array( 'label'=>'TEST: notadir',    'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'notadir'   , 'mime'=>'inode/x-empty' ) ),
array( 'label'=>'TEST: source.php', 'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'source.php', 'mime'=>'text/x-php' ) ),
array( 'label'=>'TEST: image.bmp',  'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.bmp' , 'mime'=>'image/x-ms-bmp' ) ),
array( 'label'=>'TEST: image.gif',  'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.gif' , 'mime'=>'image/gif' ) ),
array( 'label'=>'TEST: image.jpg',  'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.jpg' , 'mime'=>'image/jpeg' ) ),
array( 'label'=>'TEST: image.png',  'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.png' , 'mime'=>'image/png' ) ),
array( 'label'=>'TEST: image',      'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'image'     , 'mime'=>'image/png' ) ),
array( 'label'=>'TEST: audio.mp3',  'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'audio.mp3' , 'mime'=>'audio/mpeg' ) ),
array( 'label'=>'TEST: audio',      'test'=>array( 'value'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'audio'     , 'mime'=>'audio/mpeg' ) ),
);