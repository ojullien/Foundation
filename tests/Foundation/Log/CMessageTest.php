<?php
namespace Foundation\Test\Log;

defined('FOUNDATION_EXCEPTION_PATH') || define(
    'FOUNDATION_EXCEPTION_PATH',
    APPLICATION_PATH . '/src/Foundation/Exception'
);
interface_exists('\Foundation\Exception\ExceptionInterface') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
class_exists('\Foundation\Exception\InvalidArgumentException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));
class_exists('\Foundation\Exception\BadMethodCallException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php'));

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');
interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
//class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );
//class_exists( '\Foundation\Type\Complex\CHostname' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CHostname.php' ) );
class_exists('\Foundation\Type\Complex\CIp') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CIp.php'));
class_exists('\Foundation\Type\Enum\CSeverity') || require(realpath(FOUNDATION_TYPE_PATH . '/Enum/CSeverity.php'));

defined('FOUNDATION_PROTOCOL_PATH') || define(
    'FOUNDATION_PROTOCOL_PATH',
    APPLICATION_PATH . '/src/Foundation/Protocol'
);
class_exists('\Foundation\Protocol\CRemoteAddress') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/CRemoteAddress.php'));

defined('FOUNDATION_LOG_PATH') || define('FOUNDATION_LOG_PATH', APPLICATION_PATH . '/src/Foundation/Log');
class_exists('\Foundation\Log\CMessage') || require(realpath(FOUNDATION_LOG_PATH . '/CMessage.php'));

class CMessageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Foundation\Log\CMessage
     */
    protected $object = null;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before the tests are executed.
     */
    public function setUp()
    {
        $this->object = new \Foundation\Log\CMessage(
            new \Foundation\Type\Enum\CSeverity(),
            [
            'REMOTE_ADDR'           => '127.0.0.1',
            'REQUEST_URI'           => 'The REQUEST_URI',
            'HTTP_X_REQUESTED_WITH' => 'The HTTP_X_REQUESTED_WITH',
            'HTTP_USER_AGENT'       => 'The HTTP_USER_AGENT',
            'HTTP_REFERER'          => 'The HTTP_REFERER' ],
            [ 'SESSION' => 'The SESSION' ]
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after the tests are executed.
     */
    public function tearDown()
    {
        $this->object = null;
    }

    /**
     * @covers \Foundation\Log\CMessage::__toString
     * @group specification
     */
    public function test__toString()
    {
        $pObject = new \Foundation\Log\CMessage(
            new \Foundation\Type\Enum\CSeverity(),
            [
            'REMOTE_ADDR'           => '127.0.0.1',
            'REQUEST_URI'           => null,
            'HTTP_X_REQUESTED_WITH' => 'The HTTP_X_REQUESTED_WITH',
            'HTTP_USER_AGENT'       => 'The HTTP_USER_AGENT',
            'HTTP_REFERER'          => 'The HTTP_REFERER' ],
            [ 'SESSION' => 'The SESSION' ]
        );
        $return  = (string)$pObject;
        unset($pObject);
        $this->assertFALSE(empty($return), '__toString');
    }

    /**
     * @covers \Foundation\Log\CMessage::getServer
     * @group specification
     */
    public function testServer()
    {
        $this->assertTRUE(is_array($this->object->getServer()), 'getServer');
    }

    /**
     * @covers \Foundation\Log\CMessage::getSession
     * @group specification
     */
    public function testSession()
    {
        $this->assertTRUE(is_array($this->object->getSession()), 'getSession');
    }

    /**
     * @covers \Foundation\Log\CMessage::setDateTime
     * @covers \Foundation\Log\CMessage::getDateTime
     * @group specification
     */
    public function testDateTime()
    {
        $value  = new \DateTime('now');
        $this->object->setDateTime($value);
        $return = $this->object->getDateTime();
        $this->assertSame($value->format('D M d G:i:s Y'), $return->format('D M d G:i:s Y'), 'DateTime');
    }

    /**
     * @covers \Foundation\Log\CMessage::setModule
     * @covers \Foundation\Log\CMessage::getModule
     * @group specification
     */
    public function testModule()
    {
        $this->object->setModule('Module TypeInterface');
        $this->assertSame('Module TypeInterface', $this->object->getModule(), 'Module TypeInterface');
        $this->object->setModule(false);
        $this->assertSame('', $this->object->getModule(), 'FALSE');
    }

    /**
     * @covers \Foundation\Log\CMessage::setUser
     * @covers \Foundation\Log\CMessage::getUser
     * @group specification
     */
    public function testUser()
    {
        $value = 'User TypeInterface';
        $this->object->setUser($value);
        $this->assertSame($value, $this->object->getUser(), 'User TypeInterface');
        $this->object->setUser(false);
        $this->assertSame('', $this->object->getUser(), 'FALSE');
    }

    /**
     * @covers \Foundation\Log\CMessage::setTitle
     * @covers \Foundation\Log\CMessage::getTitle
     * @group specification
     */
    public function testTitle()
    {
        $value = 'Title TypeInterface';
        $this->object->setTitle($value);
        $this->assertSame($value, $this->object->getTitle(), 'Title TypeInterface');
        $this->object->setTitle(false);
        $this->assertSame('', $this->object->getTitle(), 'FALSE');
    }

    /**
     * @covers \Foundation\Log\CMessage::setMessage
     * @covers \Foundation\Log\CMessage::getMessage
     * @group specification
     */
    public function testMessage()
    {
        $value = 'Message TypeInterface';
        $this->object->setMessage($value);
        $this->assertSame($value, $this->object->getMessage(), 'Message TypeInterface');
        $this->object->setMessage(false);
        $this->assertSame('', $this->object->getMessage(), 'FALSE');
    }

    /**
     * @covers \Foundation\Log\CMessage::setRemoteAddress
     * @covers \Foundation\Log\CMessage::getRemoteAddress
     * @group specification
     */
    public function testRemoteAddress()
    {
        $value  = new \Foundation\Protocol\CRemoteAddress([ 'REMOTE_ADDR' => '192.168.33.1' ]);
        $this->object->setRemoteAddress($value);
        $return = $this->object->getRemoteAddress();
        $this->assertSame($value->getValue(), $return, 'RemoteAddress');
        unset($value);
    }

    /**
     * @covers \Foundation\Log\CMessage::setSeverity
     * @covers \Foundation\Log\CMessage::getSeverity
     * @group specification
     */
    public function testSeverity()
    {
        $value  = new \Foundation\Type\Enum\CSeverity(\Foundation\Type\Enum\CSeverity::DEBUG);
        $this->object->setSeverity($value);
        $return = $this->object->getSeverity();
        $this->assertSame((string)$value, $return, 'Severity');
        unset($value);
    }
}
