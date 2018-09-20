<?php
$sBuffer10031 = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'uploads';
$this->_aTests[self::KEY_TEST] = [
[ 'label' => 'TEST: /'                        , 'test' => '/' ],
[ 'label' => 'TEST: /'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '/' ],
[ 'label' => 'TEST: \\'                       , 'test' => '\\' ],
[ 'label' => 'TEST: \\'                       , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '\\' ],
[ 'label' => 'TEST: :'                        , 'test' => ':' ],
[ 'label' => 'TEST: :'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . ':' ],
[ 'label' => 'TEST: *'                        , 'test' => '*' ],
[ 'label' => 'TEST: *'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '*' ],
[ 'label' => 'TEST: ?'                        , 'test' => '?' ],
[ 'label' => 'TEST: ?'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '?' ],
[ 'label' => 'TEST: "'                        , 'test' => '"' ],
[ 'label' => 'TEST: "'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '"' ],
[ 'label' => 'TEST: <'                        , 'test' => '<' ],
[ 'label' => 'TEST: <'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '<' ],
[ 'label' => 'TEST: >'                        , 'test' => '>' ],
[ 'label' => 'TEST: >'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '>' ],
[ 'label' => 'TEST: |'                        , 'test' => '|' ],
[ 'label' => 'TEST: |'                        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '|' ],
[ 'label' => 'TEST: ""'                       , 'test' => '' ],
[ 'label' => 'TEST: ""'                       , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '' ],
[ 'label' => 'TEST: "123-a_B.c"'              , 'test' => '123-a_B.c' ],
[ 'label' => 'TEST: "123-a_B.c"'              , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '123-a_B.c' ],
[ 'label' => 'TEST: ../LICENSE'        , 'test' => '..' . DIRECTORY_SEPARATOR . 'LICENSE' ],
[ 'label' => 'TEST: ../LICENSE'        , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . '..'
                                                                                               . DIRECTORY_SEPARATOR
                                                                                               . '..'
                                                                                               . DIRECTORY_SEPARATOR
                                                                                               . 'LICENSE' ],
[ 'label' => 'TEST: Iñtërnâtiônàlizætiøn.txt' , 'test' => 'Iñtërnâtiônàlizætiøn.txt' ],
[ 'label' => 'TEST: Iñtërnâtiônàlizætiøn.txt' , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn.txt' ],
[ 'label' => 'TEST: Iñtërnâtiônàlizætiøn'     , 'test' => 'Iñtërnâtiônàlizætiøn' ],
[ 'label' => 'TEST: Iñtërnâtiônàlizætiøn'     , 'test' => $sBuffer10031 . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn' ],
];
