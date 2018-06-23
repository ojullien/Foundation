<?php
namespace Foundation\Test\Session\Storage;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );
class_exists( '\Foundation\Exception\BadMethodCallException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php' ) );
class_exists( '\Foundation\Exception\OutOfBoundsException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/OutOfBoundsException.php' ) );

defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );
interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );

defined( 'FOUNDATION_SESSION_PATH' ) || define( 'FOUNDATION_SESSION_PATH',
                                                APPLICATION_PATH . '/src/Foundation/Session' );
interface_exists( '\Foundation\Session\Storage\StorageInterface' ) || require( realpath( FOUNDATION_SESSION_PATH . '/Storage/StorageInterface.php' ) );
class_exists( '\Foundation\Session\Storage\CArray' ) || require( realpath( FOUNDATION_SESSION_PATH . '/Storage/CArray.php' ) );

trait_exists( '\Foundation\Test\Framework\Provider\TSessionDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/TSessionDataTestProvider.php' ) );

class CArrayTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Framework\Provider\TSessionDataTestProvider;

    /** Class section
     * ************** */

    /**
     * Returns the results path.
     *
     * @return string
     */
    private function getResultPath()
    {
        return __DIR__ . '/provider/result/cstorage';
    }

    /** Tests section
     * ************** */

    /**
     * @var \Foundation\Session\Storage\CArray
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \Foundation\Session\Storage\CArray();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object->destroy();
        $this->object = NULL;
    }

    /**
     * @covers \Foundation\Session\Storage\CArray::getName
     * @group specification
     */
    public function testGetName()
    {
        $this->proceedTestGetName();
    }

    /**
     * @covers \Foundation\Session\Storage\CArray::setName
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testSetNameException01()
    {
        $this->proceedTestSetNameException01();
    }

    /**
     * @covers \Foundation\Session\Storage\CArray::setName
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     * @dataProvider getDataForSetNameException
     */
    public function testSetNameException02( $label, $test, array $expected )
    {
        $this->proceedTestSetNameException02( $test );
    }

    /**
     * @covers \Foundation\Session\Storage\CArray
     * @group specification
     */
    public function testNotStarted()
    {
        $this->proceedTestNotStarted();
    }

    /**
     * @covers \Foundation\Session\Storage\CArray
     * @covers \Foundation\Session\Storage\StorageInterface
     * @group specification
     */
    public function testStarted()
    {
        $this->proceedTestStarted();
    }

    /**
     * @covers \Foundation\Session\Storage\CArray
     * @covers \Foundation\Session\Storage\StorageInterface
     * @group specification
     */
    public function testWriteAndClose()
    {
        $this->proceedTestWriteAndClose();
    }

    /**
     * @covers \Foundation\Session\Storage\CArray::setOffset
     * @group specification
     * @expectedException Foundation\Exception\OutOfBoundsException
     */
    public function testExceptionContainer()
    {
        $this->proceedTestExceptionContainer();
    }

    /**
     * @covers \Foundation\Session\Storage\CArray::setOffset
     * @group specification
     * @expectedException Foundation\Exception\OutOfBoundsException
     */
    public function testExceptionOffset()
    {
        $this->proceedTestExceptionOffset();
    }

    /**
     * @covers \Foundation\Session\Storage\CArray::setName
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testSetNameStartedException()
    {
        $this->proceedTestSetNameStartedException();
    }

}
