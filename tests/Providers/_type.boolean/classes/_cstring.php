<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = array(
//array( 'label'=>'TEST: boolean true'  , 'test'=>TRUE),
array( 'expected'=>array( 'exception'=>0,
                           'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                          'getValue' => array( 'exception'=>0, 'return' => '1' ),
                        '__toString' => array( 'exception'=>0, 'return' => '1' ),
                         'getLength' => array( 'exception'=>0, 'return' => 1 ),
                        )),
//array( 'label'=>'TEST: boolean false' , 'test'=>FALSE)
array( 'expected'=>array(  'exception'=>0,
       'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '' ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                        )),
);