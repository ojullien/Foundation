<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
//['label' => 'TEST: CString', 'test'  => new \Foundation\Type\Simple\CString( APPLICATION_PATH_UPLOADS ) ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS, 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'uploads' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
        ] ],
//['label' => 'TEST: CPath', 'test'  => new \Foundation\Type\Complex\CPath( APPLICATION_PATH_UPLOADS ) ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS, 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'uploads' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
        ] ],
//[ 'label'=>'TEST: /'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '/' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS, 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'uploads' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
        ] ],
//[ 'label'=>'TEST: \\'                       , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '\\' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS, 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'uploads' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
        ] ],
//[ 'label'=>'TEST: :'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . ':' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: *'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '*' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: ?'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '?' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: "'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '"' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: <'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '<' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: >'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '>' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: |'                        , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '|' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: ""'                       , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => false ],
            'getValue'    => [ 'exception' => 0, 'return'    => null ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => null ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS, 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'uploads' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS ],
        ] ],
//[ 'label'=>'TEST: "123-a_B.c"'              , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '123-a_B.c' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => '123-a_B.c' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '123-a_B.c' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen('123-a_B.c', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => '123-a_B.c' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                . '123-a_B.c' ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                . '123-a_B.c' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                        . '123-a_B.c', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => '123-a_B.c' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: ../LICENSE'           , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . '..'
//                                                                    . DIRECTORY_SEPARATOR . 'LICENSE' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => '..' . DIRECTORY_SEPARATOR . 'LICENSE' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '..' . DIRECTORY_SEPARATOR . 'LICENSE' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen('..' . DIRECTORY_SEPARATOR
                        . 'LICENSE', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'LICENSE' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH . DIRECTORY_SEPARATOR
                . 'LICENSE' ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH . DIRECTORY_SEPARATOR
                . 'LICENSE' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH . DIRECTORY_SEPARATOR
                        . 'LICENSE', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'LICENSE' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => APPLICATION_PATH . DIRECTORY_SEPARATOR
                . 'LICENSE' ],
        ] ],
//[ 'label'=>'TEST: Iñtërnâtiônàlizætiøn.txt' , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn.txt' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn.txt' ],
            '__toString'  => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn.txt' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen('Iñtërnâtiônàlizætiøn.txt', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn.txt' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                . 'Iñtërnâtiônàlizætiøn.txt' ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                . 'Iñtërnâtiônàlizætiøn.txt' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                        . 'Iñtërnâtiônàlizætiøn.txt', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn.txt' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
//[ 'label'=>'TEST: Iñtërnâtiônàlizætiøn'     , 'test'=>APPLICATION_PATH . '/data/uploads' . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn' )
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            '__toString'  => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen('Iñtërnâtiônàlizætiøn', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => true ],
            'getValue'    => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                . 'Iñtërnâtiônàlizætiøn' ],
            '__toString'  => [ 'exception' => 0, 'return'    => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                . 'Iñtërnâtiônàlizætiøn' ],
            'getLength'   => [ 'exception' => 0, 'return'    => mb_strlen(APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR
                        . 'Iñtërnâtiônàlizætiøn', 'UTF-8') ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => false ],
        ] ],
];
