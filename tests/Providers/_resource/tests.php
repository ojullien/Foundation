<?php
$sBuffer20121015 = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'cache';
$this->_aTests[self::KEY_TEST] = [
[ 'label' => 'TEST: NULL',       'test' => [ 'value' => null                                                 , 'mime' => null ] ],
[ 'label' => 'TEST: EMPTY',      'test' => [ 'value' => ''                                                   , 'mime' => null ] ],
[ 'label' => 'TEST: DIRECTORY',  'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR               , 'mime' => 'directory' ]],
[ 'label' => 'TEST: notadir',    'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'notadir'   , 'mime' => 'inode/x-empty' ] ],
[ 'label' => 'TEST: source.php', 'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'source.php', 'mime' => 'text/x-php' ] ],
[ 'label' => 'TEST: image.bmp',  'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.bmp' , 'mime' => 'image/x-ms-bmp' ] ],
[ 'label' => 'TEST: image.gif',  'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.gif' , 'mime' => 'image/gif' ] ],
[ 'label' => 'TEST: image.jpg',  'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.jpg' , 'mime' => 'image/jpeg' ] ],
[ 'label' => 'TEST: image.png',  'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'image.png' , 'mime' => 'image/png' ] ],
[ 'label' => 'TEST: image',      'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'image'     , 'mime' => 'image/png' ] ],
[ 'label' => 'TEST: audio.mp3',  'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'audio.mp3' , 'mime' => 'audio/mpeg' ] ],
[ 'label' => 'TEST: audio',      'test' => [ 'value' => $sBuffer20121015 . DIRECTORY_SEPARATOR . 'audio'     , 'mime' => 'audio/mpeg' ] ],
];
