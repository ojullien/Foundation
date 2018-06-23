<?php
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );
class_exists( '\Foundation\Type\Simple\CFloat' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CFloat.php' ) );
class_exists( '\Foundation\Type\Simple\CInt' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CInt.php' ) );
class_exists( '\Foundation\Type\Complex\CByte' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CByte.php' ) );
class_exists( '\Foundation\Type\Complex\CEmailAddress' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CEmailAddress.php' ) );
class_exists( '\Foundation\Type\Complex\CPath' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CPath.php' ) );
class_exists( '\Foundation\Type\Complex\CIp' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CIp.php' ) );
class_exists( '\Foundation\Type\Complex\CHostname' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CHostname.php' ) );

return [
    ['label' => 'TEST: null', 'test'  => NULL ],
    ['label' => 'TEST: array', 'test'  => ['This', 'is' ] ],
    ['label' => 'TEST: array empty', 'test'  => [ ] ],
    ['label' => 'TEST: object', 'test'  => (object)[ ] ],
    ['label' => 'TEST: CFloat', 'test'  => new \Foundation\Type\Simple\CFloat( 1.234 ) ],
    ['label' => 'TEST: CInt', 'test'  => new \Foundation\Type\Simple\CInt( 123 ) ],
    ['label' => 'TEST: CByte', 'test'  => new \Foundation\Type\Complex\CByte( '16M' ) ],
    ['label' => 'TEST: CString', 'test'  => new \Foundation\Type\Simple\CString( 'ceci est une chaîne' ) ],
    ['label' => 'TEST: CPath', 'test'  => new \Foundation\Type\Complex\CPath( '/var/tmp' ) ],
    ['label' => 'TEST: CEmailAddress', 'test'  => new \Foundation\Type\Complex\CEmailAddress( 'toto@café-frappé.com' ) ],
    ['label' => 'TEST: CIp', 'test'  => new \Foundation\Type\Complex\CIp( '192.168.33.1' ) ],
    ['label' => 'TEST: resource', 'test'  => new \SplFileObject( __FILE__ ) ],
    ['label' => 'TEST: CHostname', 'test'  => new \Foundation\Type\Complex\CHostname( 'domain.com' ) ],
];