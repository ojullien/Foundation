<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = array(
//array( 'label' => 'TEST: dir is file "notadir"', 'test' => $sCache20121105 .'notadir'),
array( 'expected' => array( 'exception' => 0,
                           '__toString' => array( 'exception' => 0, 'return' => $sCache20121105 .'notadir' ),
                      'createDirectory' => array( 'exception' => 0, 'return' => FALSE ),
                               'exists' => TRUE,
                             'todelete' => FALSE)),
//array( 'label' => 'TEST: dir already exists', 'test' => $sUploads20121105),
array( 'expected' => array( 'exception' => 0,
                           '__toString' => array( 'exception' => 0, 'return' => $sUploads20121105 ),
                      'createDirectory' => array( 'exception' => 0, 'return' => TRUE ),
                               'exists' => TRUE,
                             'todelete' => FALSE)),
//array( 'label' => 'TEST: dir does not exist', 'test' => $sUploads20121105 . DIRECTORY_SEPARATOR . 'todelete'),
array( 'expected' => array( 'exception' => 0,
                           '__toString' => array( 'exception' => 0, 'return' => $sUploads20121105 . DIRECTORY_SEPARATOR .'todelete' ),
                      'createDirectory' => array( 'exception' => 0, 'return' => TRUE ),
                               'exists' => FALSE,
                             'todelete' => TRUE)),
);