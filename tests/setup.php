<?php
define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production' ));
define('APPLICATION_NAME', 'foundation');
define('APPLICATION_VERSION', '2013.06.04');
define('APPLICATION_PATH', dirname(__DIR__));
//$buffer = getenv( 'APPLICATION_HOST' );
//if( FALSE === $buffer )
//{
//    define( 'APPLICATION_HOST', '' );
//}
//else
//{
//    define( 'APPLICATION_HOST', $buffer . '-' );
//}
//define( 'APPLICATION_DOMAIN_SHORT', 'http://' . APPLICATION_HOST . APPLICATION_NAME . '.com' );
//define( 'APPLICATION_DOMAIN', APPLICATION_DOMAIN_SHORT );
//define( 'APPLICATION_BASE', APPLICATION_DOMAIN . 'public/' );

define('APPLICATION_PATH_UPLOADS', APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'uploads');
//define( 'APPLICATION_PATH_CACHE',
//        APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR );
