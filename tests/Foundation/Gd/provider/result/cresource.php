<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
//[ 'label'=>'TEST: NULL',       'test'=>NULL ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => FALSE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: EMPTY',      'test'=>'' ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => FALSE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: DIRECTORY',  'test'=>APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => FALSE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: notadir',    'test'=>APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'notadir' ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 2, 'save' => TRUE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: source.php', 'test'=>APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'source.php' ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => TRUE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: image.bmp',  'test'=>APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'image.bmp' ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => TRUE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: image.gif',  'test'=>APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'image.gif' ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => TRUE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: image.jpg',  'test'=>APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'image.jpg' ],
    [ 'expected' => [ 'valid'     => TRUE, 'exception' => [ 'init' => 0, 'save' => TRUE ], 'info'      => [
                'width'    => 500, 'height'   => 375, 'type'     => IMAGETYPE_JPEG, 'tag'      => 'width="500" height="375"',
                'mime'     => 'image/jpeg', 'channels' => 3, 'bits'     => 8
                , 'string'   => 'a:7:{s:5:"width";i:500;s:6:"height";i:375;s:4:"type";i:2;s:3:"tag";s:24:"width="500" height="375"";s:4:"mime";s:10:"image/jpeg";s:8:"channels";i:3;s:4:"bits";i:8;}' ] ] ],
//[ 'label'=>'TEST: image.png',  'test'=>APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR . 'image.png' ],
    [ 'expected' => [ 'valid'     => TRUE, 'exception' => [ 'init' => 0, 'save' => TRUE ], 'info'      => [
                'width'    => 500, 'height'   => 375, 'type'     => IMAGETYPE_PNG, 'tag'      => 'width="500" height="375"',
                'mime'     => 'image/png', 'channels' => FALSE, 'bits'     => 8
                , 'string'   => 'a:7:{s:5:"width";i:500;s:6:"height";i:375;s:4:"type";i:3;s:3:"tag";s:24:"width="500" height="375"";s:4:"mime";s:9:"image/png";s:8:"channels";b:0;s:4:"bits";i:8;}' ] ] ],
//[ 'label'=>'TEST: image',      'test'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'image' ],
    [ 'expected' => [ 'valid'     => TRUE, 'exception' => [ 'init' => 0, 'save' => TRUE ], 'info'      => [
                'width'    => 500, 'height'   => 375, 'type'     => IMAGETYPE_PNG, 'tag'      => 'width="500" height="375"',
                'mime'     => 'image/png', 'channels' => FALSE, 'bits'     => 8
                , 'string'   => 'a:7:{s:5:"width";i:500;s:6:"height";i:375;s:4:"type";i:3;s:3:"tag";s:24:"width="500" height="375"";s:4:"mime";s:9:"image/png";s:8:"channels";b:0;s:4:"bits";i:8;}' ] ] ],
//[ 'label'=>'TEST: audio.mp3',  'test'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'audio.mp3' ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => TRUE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
//[ 'label'=>'TEST: audio',      'test'=>$sBuffer20121015 . DIRECTORY_SEPARATOR . 'audio' ],
    [ 'expected' => [ 'valid'     => FALSE, 'exception' => [ 'init' => 3, 'save' => TRUE ], 'info'      => [
                'width'    => FALSE, 'height'   => FALSE, 'type'     => FALSE, 'tag'      => FALSE, 'mime'     => FALSE,
                'channels' => FALSE, 'bits'     => FALSE, 'string'   => FALSE ] ] ],
];