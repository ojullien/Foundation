<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
//[ 'label'=>'TEST: integer 0'                       , 'test'='>0'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '0' ],
            '__toString' => [ 'exception' => 0, 'return'    => '0' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 1 ],
        ] ],
//[ 'label'=>'TEST: decimal number 1234'             , 'test'=>'1234'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '1234' ],
            '__toString' => [ 'exception' => 0, 'return'    => '1234' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 4 ],
        ] ],
//[ 'label'=>'TEST: negative integer -123'           , 'test'=>'-123'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '-123' ],
            '__toString' => [ 'exception' => 0, 'return'    => '-123' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 4 ],
        ] ],
//[ 'label'=>'TEST: octal number 0123 (83)'          , 'test'=>'0123'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '0123' ],
            '__toString' => [ 'exception' => 0, 'return'    => '0123' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 4 ],
        ] ],
//[ 'label'=>'TEST: hexadecimal number 0x1A (26)'    , 'test'=>'0x1A'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '0x1A' ],
            '__toString' => [ 'exception' => 0, 'return'    => '0x1A' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 4 ],
        ] ],
//[ 'label'=>'TEST: float 0.0'                       , 'test'=>'0.0'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '0.0' ],
            '__toString' => [ 'exception' => 0, 'return'    => '0.0' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 3 ],
        ] ],
//[ 'label'=>'TEST: float 3.5714285714286'           , 'test'=>'3.5714285714286'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '3.5714285714286' ],
            '__toString' => [ 'exception' => 0, 'return'    => '3.5714285714286' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 15 ],
        ] ],
//[ 'label'=>'TEST: double 1.1258999068426E+15'      , 'test'=>'1125899906842624'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '1125899906842624' ],
            '__toString' => [ 'exception' => 0, 'return'    => '1125899906842624' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 16 ],
        ] ],
//[ 'label'=>'TEST: real 7E-10'                      , 'test'=>'7E-10'],
    [ 'expected' => [ 'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '7E-10' ],
            '__toString' => [ 'exception' => 0, 'return'    => '7E-10' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 5 ],
        ] ],
//[ 'label'=>'TEST: range 2147483647'                , 'test'=>'2147483647'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '2147483647' ],
            '__toString' => [ 'exception' => 0, 'return'    => '2147483647' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 10 ],
        ] ],
//[ 'label'=>'TEST: range -2147483648'               , 'test'=>'-2147483648'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '-2147483648' ],
            '__toString' => [ 'exception' => 0, 'return'    => '-2147483648' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 11 ],
        ] ],
//[ 'label'=>'TEST: range 2147483648'                , 'test'=>'2147483648' ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '2147483648' ],
            '__toString' => [ 'exception' => 0, 'return'    => '2147483648' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 10 ],
        ] ],
//[ 'label'=>'TEST: range -2147483649'               , 'test'=>'-2147483649' ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '-2147483649' ],
            '__toString' => [ 'exception' => 0, 'return'    => '-2147483649' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 11 ],
        ] ],
//[ 'label'=>'TEST: range 9223372036854775807'       , 'test'=>'9223372036854775807' ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '9223372036854775807' ],
            '__toString' => [ 'exception' => 0, 'return'    => '9223372036854775807' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 19 ],
        ] ],
//[ 'label'=>'TEST: range -9223372036854775808'      , 'test'=>'-9223372036854775808' ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '-9223372036854775808' ],
            '__toString' => [ 'exception' => 0, 'return'    => '-9223372036854775808' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 20 ],
        ] ],
//[ 'label'=>'TEST: range 9223372036854775808'       , 'test'=>'9223372036854775808' ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '9223372036854775808' ],
            '__toString' => [ 'exception' => 0, 'return'    => '9223372036854775808' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 19 ],
        ] ],
//[ 'label'=>'TEST: range -9223372036854775809'      , 'test'=>'-9223372036854775809' ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '-9223372036854775809' ],
            '__toString' => [ 'exception' => 0, 'return'    => '-9223372036854775809' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 20 ],
        ] ],
//[ 'label'=>'TEST: 128M'                             , 'test'=>'128M'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '128M' ],
            '__toString' => [ 'exception' => 0, 'return'    => '128M' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 4 ],
        ] ],
//[ 'label'=>'TEST: 0x20'                             , 'test'=>chr(0x20]],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '' ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: string empty'                     , 'test'=>''],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '' ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: string empty with space'          , 'test'=>' '],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '' ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: string "This is a simple string"' , 'test'=>'This is a simple string'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 'This is a simple string' ],
            '__toString' => [ 'exception' => 0, 'return'    => 'This is a simple string' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 23 ],
        ] ],
//[ 'label'=>'TEST: Iñtërnâtiônàlizætiøn'             , 'test'=>'Iñtërnâtiônàlizætiøn'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            '__toString' => [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 20 ],
        ] ],
//[ 'label'=>'TEST: mail user+mailbox/department=shipping@café.glacé.com' , 'test'=>'user+mailbox/department=shipping@café.glacé.com'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 'user+mailbox/department=shipping@café.glacé.com' ],
            '__toString' => [ 'exception' => 0, 'return'    => 'user+mailbox/department=shipping@café.glacé.com' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 47 ],
        ] ],
//[ 'label'=>'TEST: hostname domain.com'              , 'test'=>'domain.com'],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 'domain.com' ],
            '__toString' => [ 'exception' => 0, 'return'    => 'domain.com' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 10 ],
        ] ],
];
