<?php
namespace Foundation\Test\Type\Complex;

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');

interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));
class_exists('\Foundation\Type\Complex\CHostname') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CHostname.php'));
class_exists('\Foundation\Type\Complex\CIp') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CIp.php'));

trait_exists('\Foundation\Test\Framework\Provider\TDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php'));

class CIpTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Framework\Provider\TDataTestProvider;

    /** Class section
     * ************** */

    /**
     * Returns the results path.
     *
     * @return string
     */
    private function getResultPath()
    {
        return __DIR__ . '/provider/result/cip';
    }

    /** Tests section
     * ************** */
    private function proceed($label, $value, array $expected)
    {
        $type = new \Foundation\Type\Complex\CIp($value);
        $this->assertSame($expected['isvalid']['return'], $type->isValid(), $label . ' isValid');
        $this->assertSame($expected['getValue']['return'], $type->getValue(), $label . ' getValue');
        $this->assertSame($expected['__toString']['return'], (string)$type, $label . ' __toString');
        $this->assertSame($expected['getLength']['return'], $type->getLength(), $label . ' getLength');
        unset($type);
    }

    /**
     * @covers \Foundation\Type\Complex\CIp::setValue
     * @covers \Foundation\Type\Complex\CIp::filterIPv4Special
     * @group specification
     */
    public function testIP()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_IP,
            require(realpath(__DIR__ . '/provider/result/cip.php'))
        );
        foreach ($tests as $test) {
            $this->proceed($test['label'], $test['test'], $test['expected']);
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CIp::setValue
     * @group specification
     */
    public function testTypeInterface()
    {
        $pValue = new \Foundation\Type\Complex\CIp('127.0.0.1');
        $type   = new \Foundation\Type\Complex\CIp($pValue);
        $this->assertTrue($type->isValid(), 'CIp isValid');
        $this->assertSame('127.0.0.1', $type->getValue(), 'CIp getValue');
        $this->assertSame('127.0.0.1', (string)$type, 'CIp __toString');
        $this->assertSame(9, $type->getLength(), 'CIp getLength');
        unset($type, $pValue);

        $pValue = new \Foundation\Type\Simple\CString('127.0.0.1');
        $type   = new \Foundation\Type\Complex\CIp($pValue);
        $this->assertTrue($type->isValid(), 'CString isValid');
        $this->assertSame('127.0.0.1', $type->getValue(), 'CString getValue');
        $this->assertSame('127.0.0.1', (string)$type, 'CString __toString');
        $this->assertSame(9, $type->getLength(), 'CString getLength');
        unset($type, $pValue);

        $pValue = new \Foundation\Type\Complex\CHostname('127.0.0.1');
        $type   = new \Foundation\Type\Complex\CIp($pValue);
        $this->assertTrue($type->isValid(), 'CHostname isValid');
        $this->assertSame('127.0.0.1', $type->getValue(), 'CHostname getValue');
        $this->assertSame('127.0.0.1', (string)$type, 'CHostname __toString');
        $this->assertSame(9, $type->getLength(), 'CHostname getLength');
        unset($type, $pValue);
    }
}
