<?php
return [
    ['label' => 'TEST: CString', 'test'  => new \Foundation\Type\Simple\CString(APPLICATION_PATH_UPLOADS) ],
    ['label' => 'TEST: CPath', 'test'  => new \Foundation\Type\Complex\CPath(APPLICATION_PATH_UPLOADS) ],
    [ 'label' => 'TEST: /', 'test'  => '/' ],
    [ 'label' => 'TEST: /', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '/' ],
    [ 'label' => 'TEST: \\', 'test'  => '\\' ],
    [ 'label' => 'TEST: \\', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '\\' ],
    [ 'label' => 'TEST: :', 'test'  => ':' ],
    [ 'label' => 'TEST: :', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . ':' ],
    [ 'label' => 'TEST: *', 'test'  => '*' ],
    [ 'label' => 'TEST: *', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '*' ],
    [ 'label' => 'TEST: ?', 'test'  => '?' ],
    [ 'label' => 'TEST: ?', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '?' ],
    [ 'label' => 'TEST: "', 'test'  => '"' ],
    [ 'label' => 'TEST: "', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '"' ],
    [ 'label' => 'TEST: <', 'test'  => '<' ],
    [ 'label' => 'TEST: <', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '<' ],
    [ 'label' => 'TEST: >', 'test'  => '>' ],
    [ 'label' => 'TEST: >', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '>' ],
    [ 'label' => 'TEST: |', 'test'  => '|' ],
    [ 'label' => 'TEST: |', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '|' ],
    [ 'label' => 'TEST: ""', 'test'  => '' ],
    [ 'label' => 'TEST: ""', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '' ],
    [ 'label' => 'TEST: "123-a_B.c"', 'test'  => '123-a_B.c' ],
    [ 'label' => 'TEST: "123-a_B.c"', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '123-a_B.c' ],
    [ 'label' => 'TEST: ../LICENSE', 'test'  => '..' . DIRECTORY_SEPARATOR . 'LICENSE' ],
    [ 'label' => 'TEST: ../LICENSE', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . '..'
        . DIRECTORY_SEPARATOR
        . '..'
        . DIRECTORY_SEPARATOR
        . 'LICENSE' ],
    [ 'label' => 'TEST: Iñtërnâtiônàlizætiøn.txt', 'test'  => 'Iñtërnâtiônàlizætiøn.txt' ],
    [ 'label' => 'TEST: Iñtërnâtiônàlizætiøn.txt', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn.txt' ],
    [ 'label' => 'TEST: Iñtërnâtiônàlizætiøn', 'test'  => 'Iñtërnâtiônàlizætiøn' ],
    [ 'label' => 'TEST: Iñtërnâtiônàlizætiøn', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . 'Iñtërnâtiônàlizætiøn' ],
];
