<?php
namespace Foundation\Test\Protocol;

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
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));
class_exists('\Foundation\Type\Complex\CHostname') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CHostname.php'));
class_exists('\Foundation\Type\Complex\CIp') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CIp.php'));

defined('FOUNDATION_PROTOCOL_PATH') || define(
    'FOUNDATION_PROTOCOL_PATH',
    APPLICATION_PATH . '/src/Foundation/Protocol'
);
class_exists('\Foundation\Protocol\CRemoteAddress') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/CRemoteAddress.php'));

class_exists('\Foundation\Test\Framework\Provider\CDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php'));

class CRemoteAddressTest extends \PHPUnit_Framework_TestCase
{
    /** Class section
     * *************** */

    /**
     * Loads data.
     */
    public static function setUpBeforeClass()
    {
        static::$_aTests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_IP,
            require(realpath(__DIR__ . '/../Type/Complex/provider/result/cip.php'))
        );
    }

    /** Test section
     * ************* */

    /**
     * Data for test
     * @var array
     */
    public static $_aTests = null;

    /**
     * @covers \Foundation\Protocol\CRemoteAddress
     * @group specification
     * @expectedException \Foundation\Exception\InvalidArgumentException
     */
    public function testUseProxyException()
    {
        $object = new \Foundation\Protocol\CRemoteAddress([ ], 'not valid');
        unset($object);
    }

    /**
     * @covers \Foundation\Protocol\CRemoteAddress
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testSetProxyHeaderException()
    {
        $object = new \Foundation\Protocol\CRemoteAddress([ ], false, false);
        unset($object);
    }

    /**
     * @covers \Foundation\Protocol\CRemoteAddress
     * @group specification
     */
    public function testGetIpAddressFalse()
    {
        $object = new \Foundation\Protocol\CRemoteAddress([ ]);
        $this->assertFalse($object->isValid(), 'getIpAddress');
        unset($object);
    }

    /**
     * @covers \Foundation\Protocol\CRemoteAddress
     * @group specification
     */
    public function testGetDirectIpAddress()
    {
        foreach (static::$_aTests as $data) {
            $label    = &$data['label'];
            $value    = &$data['test'];
            $expected = &$data['expected'];
            $object   = new \Foundation\Protocol\CRemoteAddress([ 'REMOTE_ADDR' => $value ]);
            $this->assertSame($expected['isvalid']['return'], $object->isValid(), $label . ' isValid');
            $this->assertSame($expected['getValue']['return'], $object->getValue(), $label . ' getValue');
            $this->assertSame($expected['__toString']['return'], (string)$object, $label . ' __toString');
        }
    }

    /**
     * @covers \Foundation\Protocol\CRemoteAddress
     * @group specification
     */
    public function testGetProxyIpAddressHTTP_CLIENT_IP()
    {
        foreach (static::$_aTests as $data) {
            $label    = &$data['label'];
            $value    = &$data['test'];
            $expected = &$data['expected'];
            $object   = new \Foundation\Protocol\CRemoteAddress([ 'HTTP_CLIENT_IP' => $value ], true, 'CLIENT_IP');
            $this->assertSame($expected['isvalid']['return'], $object->isValid(), $label . ' isValid');
            $this->assertSame($expected['getValue']['return'], $object->getValue(), $label . ' getValue');
            $this->assertSame($expected['__toString']['return'], (string)$object, $label . ' __toString');
        }
    }

    /**
     * @covers \Foundation\Protocol\CRemoteAddress
     * @group specification
     */
    public function testGetProxyIpAddressHTTP_X_FORWARDED_FOR()
    {
        $object = new \Foundation\Protocol\CRemoteAddress(
            [
            'HTTP_X_FORWARDED_FOR' => '127.0.0.1,2001:db8::ff00:42:8329,10.27.44.61,::1' ],
            true,
            'HTTP_X_FORWARDED_FOR',
            [ '127.0.0.1', '::1' ]
        );
        $this->assertSame('10.27.44.61', $object->getValue(), 'getValue');
        unset($object);
    }
}
