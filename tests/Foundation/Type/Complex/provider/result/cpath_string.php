<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
//[ 'label'=>'TEST: integer 0'                       , 'test'=>'0'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '0' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '0' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 1 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '0' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: decimal number 1234'             , 'test'=>'1234'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '1234' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '1234' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 4 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '1234' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: negative integer -123'           , 'test'=>'-123'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '-123' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '-123' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 4 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '-123' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: octal number 0123 (83)'          , 'test'=>'0123'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '0123' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '0123' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 4 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '0123' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: hexadecimal number 0x1A (26)'    , 'test'=>'0x1A'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '0x1A' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '0x1A' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 4 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '0x1A' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: float 0.0'                       , 'test'=>'0.0'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '0.0' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '0.0' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 3 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '0.0' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: float 3.5714285714286'           , 'test'=>'3.5714285714286'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '3.5714285714286' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '3.5714285714286' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 15 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '3.5714285714286' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: double 1.1258999068426E+15'      , 'test'=>'1125899906842624'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '1125899906842624' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '1125899906842624' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 16 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '1125899906842624' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: real 7E-10'                      , 'test'=>'7E-10'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '7E-10' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '7E-10' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 5 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '7E-10' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range 2147483647'                , 'test'=>'2147483647'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '2147483647' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '2147483647' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 10 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '2147483647' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range -2147483648'               , 'test'=>'-2147483648'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '-2147483648' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '-2147483648' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 11 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '-2147483648' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range 2147483648'                , 'test'=>'2147483648' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '2147483648' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '2147483648' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 10 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '2147483648' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range -2147483649'               , 'test'=>'-2147483649' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '-2147483649' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '-2147483649' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 11 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '-2147483649' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range 9223372036854775807'       , 'test'=>'9223372036854775807' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '9223372036854775807' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '9223372036854775807' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 19 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '9223372036854775807' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range -9223372036854775808'      , 'test'=>'-9223372036854775808' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '-9223372036854775808' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '-9223372036854775808' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 20 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '-9223372036854775808' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range 9223372036854775808'       , 'test'=>'9223372036854775808' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '9223372036854775808' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '9223372036854775808' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 19 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '9223372036854775808' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: range -9223372036854775809'      , 'test'=>'-9223372036854775809' ],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '-9223372036854775809' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '-9223372036854775809' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 20 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '-9223372036854775809' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: 128M'                             , 'test'=>'128M'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => '128M' ],
            '__toString'  => [ 'exception' => 0, 'return'    => '128M' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 4 ],
            'getBasename' => [ 'exception' => 0, 'return'    => '128M' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: 0x20'                             , 'test'=>chr(0x20]],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => FALSE ],
            'getValue'    => [ 'exception' => 0, 'return'    => NULL ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => NULL ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: string empty'                     , 'test'=>''],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => FALSE ],
            'getValue'    => [ 'exception' => 0, 'return'    => NULL ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => NULL ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: string empty with space'          , 'test'=>' '],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => FALSE ],
            'getValue'    => [ 'exception' => 0, 'return'    => NULL ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => NULL ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: string "This is a simple string"' , 'test'=>'This is a simple string'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => FALSE ],
            'getValue'    => [ 'exception' => 0, 'return'    => NULL ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => NULL ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: Iñtërnâtiônàlizætiøn'             , 'test'=>'Iñtërnâtiônàlizætiøn'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            '__toString'  => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 20 ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: mail user+mailbox/department=shipping@café.glacé.com' , 'test'=>'user+mailbox/department=shipping@café.glacé.com'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => FALSE ],
            'getValue'    => [ 'exception' => 0, 'return'    => NULL ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => NULL ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
//[ 'label'=>'TEST: hostname domain.com'              , 'test'=>'domain.com'],
    [ 'expected' => [ 'exception'   => 0,
            'isvalid'     => [ 'exception' => 0, 'return'    => TRUE ],
            'getValue'    => [ 'exception' => 0, 'return'    => 'domain.com' ],
            '__toString'  => [ 'exception' => 0, 'return'    => 'domain.com' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 10 ],
            'getBasename' => [ 'exception' => 0, 'return'    => 'domain.com' ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
        ] ],
];