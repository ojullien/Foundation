<?php
namespace Foundation\Test\Session\Config;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );
class_exists( '\Foundation\Exception\BadMethodCallException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php' ) );

defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );
interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Complex\CPath' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CPath.php' ) );

defined( 'FOUNDATION_SESSION_PATH' ) || define( 'FOUNDATION_SESSION_PATH',
                                                APPLICATION_PATH . '/src/Foundation/Session' );
class_exists( '\Foundation\Session\Config\CCookie' ) || require( realpath( FOUNDATION_SESSION_PATH . '/Config/CCookie.php' ) );

class CCookieTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Foundation\Session\Config\CCookie
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \Foundation\Session\Config\CCookie();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        if( strlen( session_id() ) > 0 )
        {
            session_destroy();
        }
        $this->object = NULL;
    }

    /**
     * @covers \Foundation\Session\Config\CCookie
     * @group specification
     */
    public function atestConstruct()
    {
        ini_set( 'session.use_cookies', FALSE );
        ini_set( 'session.use_only_cookies', FALSE );
        $this->object->setCookieParams( [ ] );
        $this->assertTrue( (bool)ini_get( 'session.use_cookies' ), 'use_cookies' );
        $this->assertTrue( (bool)ini_get( 'session.use_only_cookies' ), 'use_only_cookies' );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::verifyLifetime
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testVerifyLifetimeException()
    {
        $this->object->setCookieParams( [ 'lifetime' => -1,
            'path'     => NULL,
            'domain'   => NULL,
            'secure'   => NULL,
            'httponly' => NULL ] );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::verifyPath
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testVerifyPathException01()
    {
        $this->object->setCookieParams( [ 'lifetime' => NULL,
            'path'     => '/path?key=value',
            'domain'   => NULL,
            'secure'   => NULL,
            'httponly' => NULL ] );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::verifyPath
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testVerifyPathException02()
    {
        $this->object->setCookieParams( [ 'lifetime' => NULL,
            'path'     => FALSE,
            'domain'   => NULL,
            'secure'   => NULL,
            'httponly' => NULL ] );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::verifyDomain
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testVerifyDomainException()
    {
        $this->object->setCookieParams( [ 'lifetime' => NULL,
            'path'     => NULL,
            'domain'   => FALSE,
            'secure'   => NULL,
            'httponly' => NULL ] );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::setCookieParams
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     * @dataProvider getProviderSetCookieParamException
     */
    public function testSetCookieParamException( $label, array $aParams )
    {
        $this->object->setCookieParams( $aParams );
    }

    /**
     * Provider for testSetCookieParamException
     *
     * @return array
     */
    public function getProviderSetCookieParamException()
    {
        return [
            [ 'label' => 'secure', 'test'  => [ 'lifetime' => NULL,
                    'path'     => NULL,
                    'domain'   => NULL,
                    'secure'   => 'NULL',
                    'httponly' => NULL ] ],
            [ 'label' => 'httponly', 'test'  => [ 'lifetime' => NULL,
                    'path'     => NULL,
                    'domain'   => NULL,
                    'secure'   => NULL,
                    'httponly' => 'NULL' ] ],
        ];
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::setCookieParams
     * @group specification
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testSetCookieParamsRuntimeException()
    {
        if( strlen( session_id() ) == 0 )
        {
            $this->assertTrue( session_start(), 'session_start' );
        }
        $this->object->setCookieParams( [ ] );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::setCookieParams
     * @covers \Foundation\Session\Config\CCookie::getCookieParams
     * @covers \Foundation\Session\Config\CCookie::__tostring
     * @group specification
     */
    public function testSetCookieParams()
    {
        $aConfig01 = array( 'lifetime' => 666,
            'path'     => '/test/',
            'domain'   => '.e6510-foundation.com',
            'secure'   => TRUE,
            'httponly' => TRUE );
        $this->object->setCookieParams( $aConfig01 );
        $aConfig02 = $this->object->getCookieParams();
        $this->assertEquals( $aConfig02, $aConfig01, 'getCookieParams' );
        $this->assertEquals( 666, ini_get( 'session.cookie_lifetime' ), 'session.cookie_lifetime' );
        $this->assertEquals( '/test/', ini_get( 'session.cookie_path' ), 'session.cookie_path' );
        $this->assertEquals( '.e6510-foundation.com', ini_get( 'session.cookie_domain' ), 'session.cookie_domain' );
        $this->assertEquals( TRUE, ini_get( 'session.cookie_secure' ), 'session.cookie_secure' );
        $this->assertEquals( TRUE, ini_get( 'session.cookie_httponly' ), 'session.cookie_httponly' );
        $this->assertTrue( strlen( (string)$this->object ) > 0, '__toString' );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::setSavePath
     * @group specification
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testSetSavePathLogicException()
    {
        if( strlen( session_id() ) == 0 )
        {
            $this->assertTrue( session_start(), 'session_start' );
        }
        $this->object->setSavePath( '' );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::setSavePath
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testSetSavePathInvalidArgumentException()
    {
        $this->object->setSavePath( 'doesnotexist' );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::setSavePath
     * @covers \Foundation\Session\Config\CCookie::getSavePath
     * @group specification
     */
    public function testSetSavePath()
    {
        $sNewPath = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'sessions';
        $this->object->setSavePath( $sNewPath );
        $this->assertEquals( $sNewPath, ini_get( 'session.save_path' ), 'session.save_path' );
        $sPath    = $this->object->getSavePath();
        $this->assertEquals( $sPath, $sNewPath, 'getSavePath' );
    }

    /**
     * @covers \Foundation\Session\Config\CCookie::setUse
     * @group specification
     */
    public function testSetUse()
    {
        $method = new \ReflectionMethod( '\Foundation\Session\Config\CCookie', 'setUse' );
        $method->setAccessible( TRUE );

        $this->assertFalse( $method->invokeArgs( $this->object, array( NULL ) ), 'NULL' );

        $this->assertTrue( $method->invokeArgs( $this->object, array( 'use_cookies' ) ), 'use_cookies' );

        static $s = 'use_cookies';
        $a = ini_get( 'session.' . $s );
        ini_set( 'session.' . $s, '0' );
        $this->assertSame( '0', ini_get( 'session.' . $s ), 'PRE' );
        $this->assertTrue( $method->invokeArgs( $this->object, array( $s ) ), $s );
        $this->assertSame( '1', ini_get( 'session.' . $s ), 'PRE' );
        ini_set( $s, $a );
    }

}
