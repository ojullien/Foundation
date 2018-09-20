<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = [
//array( 'label'=>'TEST: integer 0'                       , 'test'=>0),
[ 'expected' => [ 'exception' => 0,
                           'getValue' => 0,
                         '__toString' => 'emergency',
                        ]],
//array( 'label'=>'TEST: decimal number 1234'             , 'test'=>1234),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: negative integer -123'           , 'test'=>-123),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: octal number 0123 (83)'          , 'test'=>0123),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: hexadecimal number 0x1A (26)'    , 'test'=>0x1A),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: float 0.0'                       , 'test'=>0.0),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: float 3.5714285714286'           , 'test'=>25/7),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: double 1.1258999068426E+15'      , 'test'=>pow(2,50)),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: real 7E-10'                      , 'test'=>7E-10),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range 2147483647'                , 'test'=>2147483647),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range -2147483648'               , 'test'=>-2147483648),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range 2147483648'                , 'test'=>2147483648 ),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range -2147483649'               , 'test'=>-2147483649 ),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range 9223372036854775807'       , 'test'=>9.2233720368548E+18 ),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range -9223372036854775808'      , 'test'=>-9.2233720368548E+18 ),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range 9223372036854775808'       , 'test'=>9223372036854775808 ),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: range -9223372036854775809'      , 'test'=>-9223372036854775809 ),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
];
