<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = [
//array( 'label'=>'TEST: boolean true'  , 'test'=>TRUE),
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
//array( 'label'=>'TEST: boolean false' , 'test'=>FALSE)
[ 'expected' => [ 'exception' => 3,
                           'getValue' => 2,
                         '__toString' => 'error',
                        ]],
];
