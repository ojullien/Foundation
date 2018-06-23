<?php
namespace Foundation\Test\Session\Storage;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );
class_exists( '\Foundation\Exception\BadMethodCallException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php' ) );

defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );
interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Complex\CIp' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CIp.php' ) );

defined( 'FOUNDATION_SESSION_PATH' ) || define( 'FOUNDATION_SESSION_PATH',
                                                APPLICATION_PATH . '/src/Foundation/Session' );
interface_exists( '\Foundation\Session\Storage\StorageInterface' ) || require( realpath( FOUNDATION_SESSION_PATH . '/Storage/StorageInterface.php' ) );
class_exists( '\Foundation\Session\Storage\CArray' ) || require( realpath( FOUNDATION_SESSION_PATH . '/Storage/CArray.php' ) );
class_exists( '\Foundation\Session\CSecureSession' ) || require( realpath( FOUNDATION_SESSION_PATH . '/CSecureSession.php' ) );

defined( 'FOUNDATION_PROTOCOL_PATH' ) || define( 'FOUNDATION_PROTOCOL_PATH',
                                                 APPLICATION_PATH . '/src/Foundation/Protocol' );
class_exists( '\Foundation\Protocol\CRemoteAddress' ) || require( realpath( FOUNDATION_PROTOCOL_PATH . '/CRemoteAddress.php' ) );

class CSecureSessionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Foundation\Session\Storage\CArray
     */
    protected $storage;

    /**
     * @var \Foundation\Protocol\CRemoteAddress
     */
    protected $remoteAddress;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->storage       = new \Foundation\Session\Storage\CArray();
        $this->remoteAddress = new \Foundation\Protocol\CRemoteAddress( [ 'REMOTE_ADDR' => '127.0.0.1' ] );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->storage       = NULL;
        $this->remoteAddress = NULL;
    }

    /**
     * @covers \Foundation\Session\CSecureSession
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testException()
    {
        $pRemoteAddress = new \Foundation\Protocol\CRemoteAddress( [ ] );
        $pContainer     = new \Foundation\Session\CSecureSession( $this->storage, $pRemoteAddress, '' );
        unset( $pContainer, $pRemoteAddress );
    }

    /**
     * @covers \Foundation\Session\CSecureSession
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testSaveException()
    {
        $pContainer = new \Foundation\Session\CSecureSession( $this->storage, $this->remoteAddress, '' );
        $pContainer->save();
        unset( $pContainer );
    }

    /**
     * @covers \Foundation\Session\CSecureSession
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testIsValidException()
    {
        $pContainer = new \Foundation\Session\CSecureSession( $this->storage, $this->remoteAddress, '' );
        $pContainer->isValid();
        unset( $pContainer );
    }

    /**
     * @covers \Foundation\Session\CSecureSession
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testExistsException()
    {
        $pContainer = new \Foundation\Session\CSecureSession( $this->storage, $this->remoteAddress, '' );
        $pContainer->exists();
        unset( $pContainer );
    }

    /**
     * @covers \Foundation\Session\CSecureSession
     * @group specification
     */
    public function testSave()
    {
        $pContainer = new \Foundation\Session\CSecureSession( $this->storage, $this->remoteAddress, '' );
        $this->storage->start();
        $this->assertFalse( $pContainer->exists(), 'exists' );
        $pContainer->save();
        $this->assertTrue( $pContainer->exists(), 'exists after save' );
        $this->assertTrue( $pContainer->isValid(), 'isValid' );
        $this->storage->setOffset( \Foundation\Session\CSecureSession::UID, 0, APPLICATION_NAME );
        $this->assertFalse( $pContainer->isValid(), 'isValid after update' );
        unset( $pContainer );
    }

}
