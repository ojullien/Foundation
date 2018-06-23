<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
//[ 'label'=>'TEST: boolean true'  , 'test'=>TRUE],
    [ 'expected' => [ 'isvalid'     => [ 'exception' => 0, 'return'    => FALSE ],
            'getValue'    => [ 'exception' => 0, 'return'    => NULL ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => NULL ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
            'exception'   => 0 ] ],
//[ 'label'=>'TEST: boolean false' , 'test'=>FALSE)
    [ 'expected' => [ 'isvalid'     => [ 'exception' => 0, 'return'    => FALSE ],
            'getValue'    => [ 'exception' => 0, 'return'    => NULL ],
            '__toString'  => [ 'exception' => 0, 'return'    => '' ],
            'getLength'   => [ 'exception' => 0, 'return'    => 0 ],
            'getBasename' => [ 'exception' => 0, 'return'    => NULL ],
            'getRealPath' => [ 'exception' => 0, 'return'    => FALSE ],
            'exception'   => 0 ] ],
];