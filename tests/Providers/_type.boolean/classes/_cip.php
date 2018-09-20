<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = [
//array( 'label'=>'TEST: boolean true'  , 'test'=>TRUE),
[ 'expected' => [ 'exception' => 0,
                           'isvalid' => [ 'exception' => 0, 'return' => false ],
                          'getValue' => [ 'exception' => 0, 'return' => null ],
                        '__toString' => [ 'exception' => 0, 'return' => '' ],
                        ]],
//array( 'label'=>'TEST: boolean false' , 'test'=>FALSE)
[ 'expected' => [  'exception' => 0,
                            'isvalid' => [ 'exception' => 0, 'return' => false ],
                           'getValue' => [ 'exception' => 0, 'return' => null ],
                         '__toString' => [ 'exception' => 0, 'return' => '' ],
                        ]],
];
