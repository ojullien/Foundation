<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
return [
//[ 'label'=>'TEST: null'          , 'test'=>NULL],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: array'         , 'test'=>['This','is') ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: array empty'   , 'test'=>[]],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: object'        , 'test'=>(object)[]],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CFloat'        , 'test'=>new \Foundation\Type\Simple\CFloat(1.234) ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CInt'          , 'test'=>new \Foundation\Type\Simple\CInt(123) ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CByte'         , 'test'=>new \Foundation\Type\Complex\CByte('16M') ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CString'       , 'test'=>new \Foundation\Type\Simple\CString('ceci est une chaîne') ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CPath'         , 'test'=>new \Foundation\Type\Complex\CPath('/var/tmp') ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CEmailAddress' , 'test'=>new \Foundation\Type\Complex\CEmailAddress('toto@café-frappé.com') ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CIp'           , 'test'=>new \Foundation\Type\Complex\CIp('192.168.33.1') ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => true ],
            'getValue'   => [ 'exception' => 0, 'return'    => '192.168.33.1' ],
            '__toString' => [ 'exception' => 0, 'return'    => '192.168.33.1' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 12 ],
        ] ],
//[ 'label'=>'TEST: resource'      , 'test'=>new \SplFileObject(__FILE__) ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
//[ 'label'=>'TEST: CHostname'     , 'test'=>new \Foundation\Type\Complex\CHostname('domain.com') ],
    [ 'expected' => [ 'exception'  => 0,
            'isvalid'    => [ 'exception' => 0, 'return'    => false ],
            'getValue'   => [ 'exception' => 0, 'return'    => null ],
            '__toString' => [ 'exception' => 0, 'return'    => '' ],
            'getLength'  => [ 'exception' => 0, 'return'    => 0 ],
        ] ],
];
