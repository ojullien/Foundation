<?php
namespace Foundation\Test\Log\Writer;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\BadFunctionCallException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/BadFunctionCallException.php' ) );
class_exists( '\Foundation\Exception\BadMethodCallException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php' ) );
class_exists( '\Foundation\Exception\DomainException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/DomainException.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );
class_exists( '\Foundation\Exception\LengthException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/LengthException.php' ) );
class_exists( '\Foundation\Exception\OutOfBoundsException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/OutOfBoundsException.php' ) );
class_exists( '\Foundation\Exception\OutOfRangeException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/OutOfRangeException.php' ) );
class_exists( '\Foundation\Exception\OverflowException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/OverflowException.php' ) );
class_exists( '\Foundation\Exception\RangeException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/RangeException.php' ) );
class_exists( '\Foundation\Exception\RuntimeException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/RuntimeException.php' ) );
class_exists( '\Foundation\Exception\UnderflowException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/UnderflowException.php' ) );
class_exists( '\Foundation\Exception\UnexpectedValueException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/UnexpectedValueException.php' ) );

class CExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Foundation\Exception\BadFunctionCallException
     * @group specification
     * @expectedException Foundation\Exception\BadFunctionCallException
     */
    public function testBadFunctionCallException()
    {
        throw new \Foundation\Exception\BadFunctionCallException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\BadMethodCallException
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testBadMethodCallException()
    {
        throw new \Foundation\Exception\BadMethodCallException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\DomainException
     * @group specification
     * @expectedException Foundation\Exception\DomainException
     */
    public function testDomainException()
    {
        throw new \Foundation\Exception\DomainException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\InvalidArgumentException
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testInvalidArgumentException()
    {
        throw new \Foundation\Exception\InvalidArgumentException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\LengthException
     * @group specification
     * @expectedException Foundation\Exception\LengthException
     */
    public function testLengthException()
    {
        throw new \Foundation\Exception\LengthException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\OutOfBoundsException
     * @group specification
     * @expectedException Foundation\Exception\OutOfBoundsException
     */
    public function testOutOfBoundsException()
    {
        throw new \Foundation\Exception\OutOfBoundsException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\OutOfRangeException
     * @group specification
     * @expectedException Foundation\Exception\OutOfRangeException
     */
    public function testOutOfRangeException()
    {
        throw new \Foundation\Exception\OutOfRangeException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\OverflowException
     * @group specification
     * @expectedException Foundation\Exception\OverflowException
     */
    public function testOverflowException()
    {
        throw new \Foundation\Exception\OverflowException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\RuntimeException
     * @group specification
     * @expectedException Foundation\Exception\RuntimeException
     */
    public function testRuntimeException()
    {
        throw new \Foundation\Exception\RuntimeException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\UnderflowException
     * @group specification
     * @expectedException Foundation\Exception\UnderflowException
     */
    public function testUnderflowException()
    {
        throw new \Foundation\Exception\UnderflowException( __METHOD__ );
    }

    /**
     * @covers \Foundation\Exception\UnexpectedValueException
     * @group specification
     * @expectedException Foundation\Exception\UnexpectedValueException
     */
    public function testUnexpectedValueException()
    {
        throw new \Foundation\Exception\UnexpectedValueException( __METHOD__ );
    }

}