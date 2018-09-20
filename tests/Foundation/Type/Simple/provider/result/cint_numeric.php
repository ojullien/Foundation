<?php
if (PHP_INT_MAX > 2147483647) {
    //64bit
    $aBuffer32 = [ 'max'  => [ 'i' => 2147483647, 's' => '2147483647' ],
        'min'  => [ 'i' => (int) - 2147483648, 's' => '-2147483648' ],
        'maxo' => [ 'i' => 2147483648, 's' => '2147483648' ],
        'mino' => [ 'i' => -2147483649, 's' => '-2147483649' ],
    ];
    $aBuffer64 = [ 'max'  => [ 'i' => 9223372036854775807, 's' => '9223372036854775807' ],
        'min'  => [ 'i' => -9223372036854775808, 's' => '-9223372036854775808' ],
        'maxo' => [ 'i' => -9223372036854775808, 's' => '-9223372036854775808' ],
        'mino' => [ 'i' => 9223372036854775807, 's' => '9223372036854775807' ],
    ];
} else {
    //32bit
    $aBuffer32 = [ 'max'  => [ 'i' => 2147483647, 's' => '2147483647' ],
        'min'  => [ 'i' => (int) - 2147483648, 's' => '-2147483648' ],
        'maxo' => [ 'i' => (int) - 2147483648, 's' => '-2147483648' ],
        'mino' => [ 'i' => 2147483647, 's' => '2147483647' ],
    ];
    $aBuffer64 = [ 'max'  => [ 'i' => 0, 's' => '0' ],
        'min'  => [ 'i' => 0, 's' => '0' ],
        'maxo' => [ 'i' => 0, 's' => '0' ],
        'mino' => [ 'i' => 0, 's' => '0' ],
    ];
}

// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
//[ 'label'=>'TEST: integer 0'                       , 'test'=>0],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 0 ],
            '__toString' => [ 'exception' => 0, 'return'    => '0' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 1 ],
        ] ],
//[ 'label'=>'TEST: decimal number 1234'             , 'test'=>1234],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 1234 ],
            '__toString' => [ 'exception' => 0, 'return'    => '1234' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 4 ],
        ] ],
//[ 'label'=>'TEST: negative integer -123'           , 'test'=>-123],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => -123 ],
            '__toString' => [ 'exception' => 0, 'return'    => '-123' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 4 ],
        ] ],
//[ 'label'=>'TEST: octal number 0123 (83)'          , 'test'=>0123],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 83 ],
            '__toString' => [ 'exception' => 0, 'return'    => '83' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 2 ],
        ] ],
//[ 'label'=>'TEST: hexadecimal number 0x1A (26)'    , 'test'=>0x1A],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 26 ],
            '__toString' => [ 'exception' => 0, 'return'    => '26' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 2 ],
        ] ],
//[ 'label'=>'TEST: float 0.0'                       , 'test'=>0.0],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 0 ],
            '__toString' => [ 'exception' => 0, 'return'    => '0' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 1 ],
        ] ],
//[ 'label'=>'TEST: float 3.5714285714286'           , 'test'=>25/7],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 3 ],
            '__toString' => [ 'exception' => 0, 'return'    => '3' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 1 ],
        ] ],
//[ 'label'=>'TEST: double 1.1258999068426E+15'      , 'test'=>pow(2,50]],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 0 ],
            '__toString' => [ 'exception' => 0, 'return'    => '0' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 1 ],
        ] ],
//[ 'label'=>'TEST: real 7E-10'                      , 'test'=>7E-10],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 0 ],
            '__toString' => [ 'exception' => 0, 'return'    => '0' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 1 ],
        ] ],
//[ 'label'=>'TEST: range 2147483647'                , 'test'=>2147483647],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => 2147483647 ],
            '__toString' => [ 'exception' => 0, 'return'    => '2147483647' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 10 ],
        ] ],
//[ 'label'=>'TEST: range -2147483648'               , 'test'=>-2147483648],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => (int) - 2147483648 ],
            '__toString' => [ 'exception' => 0, 'return'    => '-2147483648' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 11 ],
        ] ],
//[ 'label'=>'TEST: range 2147483648'                , 'test'=>2147483648 ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => $aBuffer32['maxo']['i'] ],
            '__toString' => [ 'exception' => 0, 'return'    => $aBuffer32['maxo']['s'] ],
            'getLength'  => [ 'exception' => 0, 'return'    => strlen($aBuffer32['maxo']['s']) ],
        ] ],
//[ 'label'=>'TEST: range -2147483649'               , 'test'=>-2147483649 ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => $aBuffer32['mino']['i'] ],
            '__toString' => [ 'exception' => 0, 'return'    => $aBuffer32['mino']['s'] ],
            'getLength'  => [ 'exception' => 0, 'return'    => strlen($aBuffer32['mino']['s']) ],
        ] ],
//[ 'label'=>'TEST: range 9223372036854775807'       , 'test'=>9.2233720368548E+18 ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => $aBuffer64['max']['i'] ],
            '__toString' => [ 'exception' => 0, 'return'    => $aBuffer64['max']['s'] ],
            'getLength'  => [ 'exception' => 0, 'return'    => strlen($aBuffer64['max']['s']) ],
        ] ],
//[ 'label'=>'TEST: range -9223372036854775808'      , 'test'=>-9.2233720368548E+18 ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => $aBuffer64['min']['i'] ],
            '__toString' => [ 'exception' => 0, 'return'    => $aBuffer64['min']['s'] ],
            'getLength'  => [ 'exception' => 0, 'return'    => strlen($aBuffer64['min']['s']) ],
        ] ],
//[ 'label'=>'TEST: range 9223372036854775808'       , 'test'=>9223372036854775808 ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => $aBuffer64['maxo']['i'] ],
            '__toString' => [ 'exception' => 0, 'return'    => $aBuffer64['maxo']['s'] ],
            'getLength'  => [ 'exception' => 0, 'return'    => strlen($aBuffer64['maxo']['s']) ],
        ] ],
//[ 'label'=>'TEST: range -9223372036854775809'      , 'test'=>-9223372036854775809 ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => $aBuffer64['mino']['i'] ],
            '__toString' => [ 'exception' => 0, 'return'    => $aBuffer64['mino']['s'] ],
            'getLength'  => [ 'exception' => 0, 'return'    => strlen($aBuffer64['mino']['s']) ],
        ] ],
];
