<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = [
//array( 'label'=>'TEST: boolean true'  , 'test'=>TRUE),
[ 'expected' => [ 'isvalid' => [ 'exception' => 0, 'return' => false ],
                         'getValue' => [ 'exception' => 0, 'return' => null ],
                       '__toString' => [ 'exception' => 0, 'return' => '' ],
                        'getLength' => [ 'exception' => 0, 'return' => 0 ],
                      'getBasename' => [ 'exception' => 0, 'return' => null ],
                      'getRealPath' => [ 'exception' => 0, 'return' => false ],
                         'exception' => 0 ]],
//array( 'label'=>'TEST: boolean false' , 'test'=>FALSE)
[ 'expected' => [ 'isvalid' => [ 'exception' => 0, 'return' => false ],
                         'getValue' => [ 'exception' => 0, 'return' => null ],
                       '__toString' => [ 'exception' => 0, 'return' => '' ],
                        'getLength' => [ 'exception' => 0, 'return' => 0 ],
                      'getBasename' => [ 'exception' => 0, 'return' => null ],
                      'getRealPath' => [ 'exception' => 0, 'return' => false ],
                         'exception' => 0 ]],
];
