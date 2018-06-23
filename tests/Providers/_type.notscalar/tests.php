<?php
$this->_aTests[self::KEY_TEST] = array(
array( 'label'=>'TEST: null'          , 'test'=>NULL),
array( 'label'=>'TEST: array'         , 'test'=>array('This','is')),
array( 'label'=>'TEST: array empty'   , 'test'=>array()),
array( 'label'=>'TEST: object'        , 'test'=>(object)array()),
array( 'label'=>'TEST: CFloat'        , 'test'=>new \Foundation\Type\Simple\CFloat(1.234) ),
array( 'label'=>'TEST: CInt'          , 'test'=>new \Foundation\Type\Simple\CInt(123) ),
array( 'label'=>'TEST: CByte'         , 'test'=>new \Foundation\Type\Complex\CByte('16M') ),
array( 'label'=>'TEST: CString'       , 'test'=>new \Foundation\Type\Simple\CString('ceci est une chaîne') ),
array( 'label'=>'TEST: CPath'         , 'test'=>new \Foundation\Type\Complex\CPath('/var/tmp') ),
array( 'label'=>'TEST: CEmailAddress' , 'test'=>new \Foundation\Type\Complex\CEmailAddress('toto@café-frappé.com') ),
array( 'label'=>'TEST: CIp'           , 'test'=>new \Foundation\Type\Complex\CIp('192.168.33.1') ),
array( 'label'=>'TEST: resource'      , 'test'=>new \SplFileObject(__FILE__) ),
array( 'label'=>'TEST: CHostname'     , 'test'=>new \Foundation\Type\Complex\CHostname('domain.com') ),
);