<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = [
//array( 'label' => 'TEST: dir is file "notadir"', 'test' => $sCache20121105 .'notadir'),
[ 'expected' => [ 'exception' => 0,
                           '__toString' => [ 'exception' => 0, 'return' => $sCache20121105 .'notadir' ],
                      'createDirectory' => [ 'exception' => 0, 'return' => false ],
                               'exists' => true,
                             'todelete' => false]],
//array( 'label' => 'TEST: dir already exists', 'test' => $sUploads20121105),
[ 'expected' => [ 'exception' => 0,
                           '__toString' => [ 'exception' => 0, 'return' => $sUploads20121105 ],
                      'createDirectory' => [ 'exception' => 0, 'return' => true ],
                               'exists' => true,
                             'todelete' => false]],
//array( 'label' => 'TEST: dir does not exist', 'test' => $sUploads20121105 . DIRECTORY_SEPARATOR . 'todelete'),
[ 'expected' => [ 'exception' => 0,
                           '__toString' => [ 'exception' => 0, 'return' => $sUploads20121105 . DIRECTORY_SEPARATOR .'todelete' ],
                      'createDirectory' => [ 'exception' => 0, 'return' => true ],
                               'exists' => false,
                             'todelete' => true]],
];
