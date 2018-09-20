<?php
$this->_aTests[self::KEY_TEST] = [
[ 'label' => 'TEST: null'          , 'test' => null],
[ 'label' => 'TEST: array'         , 'test' => ['This','is']],
[ 'label' => 'TEST: array empty'   , 'test' => []],
[ 'label' => 'TEST: object'        , 'test' => (object)[]],
[ 'label' => 'TEST: CFloat'        , 'test' => new \Foundation\Type\Simple\CFloat(1.234) ],
[ 'label' => 'TEST: CInt'          , 'test' => new \Foundation\Type\Simple\CInt(123) ],
[ 'label' => 'TEST: CByte'         , 'test' => new \Foundation\Type\Complex\CByte('16M') ],
[ 'label' => 'TEST: CString'       , 'test' => new \Foundation\Type\Simple\CString('ceci est une chaîne') ],
[ 'label' => 'TEST: CPath'         , 'test' => new \Foundation\Type\Complex\CPath('/var/tmp') ],
[ 'label' => 'TEST: CEmailAddress' , 'test' => new \Foundation\Type\Complex\CEmailAddress('toto@café-frappé.com') ],
[ 'label' => 'TEST: CIp'           , 'test' => new \Foundation\Type\Complex\CIp('192.168.33.1') ],
[ 'label' => 'TEST: resource'      , 'test' => new \SplFileObject(__FILE__) ],
[ 'label' => 'TEST: CHostname'     , 'test' => new \Foundation\Type\Complex\CHostname('domain.com') ],
];
