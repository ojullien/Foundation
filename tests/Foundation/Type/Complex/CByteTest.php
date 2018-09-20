<?php
namespace Foundation\Test\Type\Complex;

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');

interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CFloat') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CFloat.php'));
class_exists('\Foundation\Type\Simple\CInt') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CInt.php'));
class_exists('\Foundation\Type\Complex\CByte') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CByte.php'));

trait_exists('\Foundation\Test\Framework\Provider\TDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php'));

class CByteTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Framework\Provider\TDataTestProvider;

    /** Class section
     * ************** */

    /**
     * Path to the test results.
     *
     * @var array of string
     */
    private $_aResultPath = [ ];

    /**
     * Returns the results path.
     *
     * @param string $sNamespace
     * @return string
     * @throws \InvalidArgumentException
     */
    private function getResultPath($sNamespace)
    {
        // Check argument
        $sNamespace = (is_string($sNamespace)) ? trim($sNamespace) : '';
        if ('' == $sNamespace) {
            throw new \InvalidArgumentException();
        }

        // Initialize
        $sResultPath = '/provider/result/';

        if (count($this->_aResultPath) == 0) {
            $this->_aResultPath[\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_BOOLEAN] = __DIR__ . '/../Simple' . $sResultPath . 'cfloat';
            $this->_aResultPath[\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_XSS]     = __DIR__ . '/../Simple' . $sResultPath . 'cfloat';
        }

        return ( isset($this->_aResultPath[$sNamespace]) ) ? $this->_aResultPath[$sNamespace] : __DIR__ . $sResultPath . 'cbyte';
    }

    /** Tests section
     * ************** */
    private function proceed($label, $value, array $expected)
    {
        $type = new \Foundation\Type\Complex\CByte($value);
        $this->assertSame($expected['isvalid']['return'], $type->isValid(), $label . ' isValid');
        $this->assertSame($expected['getValue']['return'], $type->getValue(), $label . ' getValue');
        $this->assertSame($expected['__toString']['return'], (string)$type, $label . ' __toString');
        $this->assertSame($expected['getLength']['return'], $type->getLength(), $label . ' getLength');
        unset($type);
    }

    private function proceedClass($label, $value, array $expected)
    {
        $method = new \ReflectionMethod('\Foundation\Type\Complex\CByte', 'isShorthanded');
        $method->setAccessible(true);
        $type   = new \Foundation\Type\Complex\CByte($value);
        $this->assertSame(
            $expected['isShorthanded']['return'],
            $method->invokeArgs($type, [ $value ]),
            $label . ' isShorthanded'
        );
        $this->assertSame($expected['isvalid']['return'], $type->isValid(), $label . ' isValid');
        $this->assertSame($expected['getValue']['return'], $type->getValue(), $label . ' getValue');
        $this->assertSame($expected['__toString']['return'], (string)$type, $label . ' __toString');
        $this->assertSame($expected['getLength']['return'], $type->getLength(), $label . ' getLength');
        $this->assertSame(
            $expected['convertToByte']['return']['numeric'],
            $type->convertToByte(),
            $label . ' convertToByte'
        );

        $this->assertSame(
            $expected['convertToKByte']['return']['numeric'],
            $type->convertToKByte(),
            $label . ' convertToKByte'
        );
        $this->assertSame(
            $expected['convertToKByte']['return']['shorthanded'],
            $type->convertToKByte(true),
            $label . ' convertToKByte SH'
        );

        $this->assertSame(
            $expected['convertToMByte']['return']['numeric'],
            $type->convertToMByte(),
            $label . ' convertToMByte'
        );
        $this->assertSame(
            $expected['convertToMByte']['return']['shorthanded'],
            $type->convertToMByte(true),
            $label . ' convertToMByte SH'
        );

        $this->assertSame(
            $expected['convertToGByte']['return']['numeric'],
            $type->convertToGByte(),
            $label . ' convertToGByte'
        );
        $this->assertSame(
            $expected['convertToGByte']['return']['shorthanded'],
            $type->convertToGByte(true),
            $label . ' convertToGByte SH'
        );


        unset($type, $method);
    }

    /**
     * @covers \Foundation\Type\Complex\CByte::setValue
     * @covers \Foundation\Type\Complex\CByte::isShorthanded
     * @covers \Foundation\Type\Complex\CByte::convertToByte
     * @covers \Foundation\Type\Complex\CByte::convertToKByte
     * @covers \Foundation\Type\Complex\CByte::convertToMByte
     * @covers \Foundation\Type\Complex\CByte::convertToGByte
     * @group specification
     */
    public function testClass()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_BYTE,
            require(realpath(__DIR__ . '/provider/result/cbyte.php'))
        );
        foreach ($tests as $test) {
            $this->proceedClass($test['label'], $test['test'], $test['expected']);
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CByte::isEqual
     * @group specification
     */
    public function testIsEqualIsIdentical()
    {
        $o1 = new \Foundation\Type\Complex\CByte(10485760);
        $o2 = new \Foundation\Type\Complex\CByte(10485760);

        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 01');
        // Identiqual
        $this->assertSame(true, $o1->isIdentical($o2), 'TEST 02');

        $o2->setValue('10485760');
        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 11');
        // Identiqual
        $this->assertSame(true, $o1->isIdentical($o2), 'TEST 12');

        $o1->setValue('10240K');
        $o2->setValue('10M');
        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 21');
        // Identiqual
        $this->assertSame(false, $o1->isIdentical($o2), 'TEST 22');

        $o1->setValue(10240);
        $o2->setValue('10M');
        // Equal
        $this->assertSame(false, $o1->isEqual($o2), 'TEST 31');
        // Identiqual
        $this->assertSame(false, $o1->isIdentical($o2), 'TEST 32');

        unset($o1, $o2);

        $o1 = new \Foundation\Type\Complex\CByte(10485760);
        $o2 = new \Foundation\Type\Simple\CFloat(10485760);

        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 41');
        // Identiqual
        $this->assertSame(true, $o1->isIdentical($o2), 'TEST 42');

        unset($o1, $o2);

        //
        $o1 = new \Foundation\Type\Complex\CByte(null);
        $o2 = new \Foundation\Type\Complex\CByte(10485760);
        $this->assertSame(false, $o1->isEqual($o2), 'TEST 51');
        unset($o1, $o2);
    }
}
