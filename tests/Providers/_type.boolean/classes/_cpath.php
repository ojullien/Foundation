<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = array(
//array( 'label'=>'TEST: boolean true'  , 'test'=>TRUE),
array( 'expected'=>array( 'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                         'getValue' => array( 'exception'=>0, 'return' => NULL ),
                       '__toString' => array( 'exception'=>0, 'return' => '' ),
                        'getLength' => array( 'exception'=>0, 'return' => 0 ),
                      'getBasename' => array( 'exception'=>0, 'return' => NULL ),
                      'getRealPath' => array( 'exception'=>0, 'return' => FALSE ),
                         'exception'=> 0 )),
//array( 'label'=>'TEST: boolean false' , 'test'=>FALSE)
array( 'expected'=>array( 'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                         'getValue' => array( 'exception'=>0, 'return' => NULL ),
                       '__toString' => array( 'exception'=>0, 'return' => '' ),
                        'getLength' => array( 'exception'=>0, 'return' => 0 ),
                      'getBasename' => array( 'exception'=>0, 'return' => NULL ),
                      'getRealPath' => array( 'exception'=>0, 'return' => FALSE ),
                         'exception'=> 0 )),
);