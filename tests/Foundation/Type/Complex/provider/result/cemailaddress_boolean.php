<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
// TEST: boolean true'
    [ 'expected' => [
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
            'getRaw'     => [ 'exception' => 0, 'return'    => '' ],
            'exception'  => 0 ] ],
// 'TEST: boolean false'
    [ 'expected' => [
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
            'getRaw'     => [ 'exception' => 0, 'return'    => '' ],
            'exception'  => 0 ] ],
];
