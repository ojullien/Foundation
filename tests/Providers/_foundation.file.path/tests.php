<?php
$sBuffer10031 = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'uploads';
$this->_aTests[self::KEY_TEST] = array(
array( 'label'=>'TEST: /'                        , 'test'=>'/' ),
array( 'label'=>'TEST: /'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '/' ),
array( 'label'=>'TEST: \\'                       , 'test'=>'\\' ),
array( 'label'=>'TEST: \\'                       , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '\\' ),
array( 'label'=>'TEST: :'                        , 'test'=>':' ),
array( 'label'=>'TEST: :'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . ':' ),
array( 'label'=>'TEST: *'                        , 'test'=>'*' ),
array( 'label'=>'TEST: *'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '*' ),
array( 'label'=>'TEST: ?'                        , 'test'=>'?' ),
array( 'label'=>'TEST: ?'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '?' ),
array( 'label'=>'TEST: "'                        , 'test'=>'"' ),
array( 'label'=>'TEST: "'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '"' ),
array( 'label'=>'TEST: <'                        , 'test'=>'<' ),
array( 'label'=>'TEST: <'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '<' ),
array( 'label'=>'TEST: >'                        , 'test'=>'>' ),
array( 'label'=>'TEST: >'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '>' ),
array( 'label'=>'TEST: |'                        , 'test'=>'|' ),
array( 'label'=>'TEST: |'                        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '|' ),
array( 'label'=>'TEST: ""'                       , 'test'=>'' ),
array( 'label'=>'TEST: ""'                       , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '' ),
array( 'label'=>'TEST: "123-a_B.c"'              , 'test'=>'123-a_B.c' ),
array( 'label'=>'TEST: "123-a_B.c"'              , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '123-a_B.c' ),
array( 'label'=>'TEST: ../LICENSE'        , 'test'=>'..' . DIRECTORY_SEPARATOR . 'LICENSE' ),
array( 'label'=>'TEST: ../LICENSE'        , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . '..'
                                                                                               . DIRECTORY_SEPARATOR
                                                                                               . '..'
                                                                                               . DIRECTORY_SEPARATOR
                                                                                               . 'LICENSE' ),
array( 'label'=>'TEST: Iñtërnâtiônàlizætiøn.txt' , 'test'=>'Iñtërnâtiônàlizætiøn.txt' ),
array( 'label'=>'TEST: Iñtërnâtiônàlizætiøn.txt' , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn.txt' ),
array( 'label'=>'TEST: Iñtërnâtiônàlizætiøn'     , 'test'=>'Iñtërnâtiônàlizætiøn' ),
array( 'label'=>'TEST: Iñtërnâtiônàlizætiøn'     , 'test'=>$sBuffer10031 . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn' ),
);