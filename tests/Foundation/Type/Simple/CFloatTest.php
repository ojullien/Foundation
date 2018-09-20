<?php
namespace Foundation\Test\Type\Simple;

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');

interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CFloat') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CFloat.php'));
class_exists('\Foundation\Type\Simple\CInt') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CInt.php'));
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));

trait_exists('\Foundation\Test\Framework\Provider\TDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php'));

class_exists('\Foundation\Test\Type\Simple\CFloatMock') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Type/Simple/provider/CFloatMock.php'));

class CFloatTest extends \PHPUnit_Framework_TestCase
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
        return __DIR__ . '/provider/result/cfloat';
    }

    /** Tests section
     * ************** */
    private function proceed($label, $value, array $expected)
    {
        $type = new \Foundation\Type\Simple\CFloat($value);
        $this->assertSame($expected['isvalid']['return'], $type->isValid(), $label . ' isValid');
        $this->assertSame($expected['getValue']['return'], $type->getValue(), $label . ' getValue');
        $this->assertSame($expected['__toString']['return'], (string)$type, $label . ' __toString');
        $this->assertSame($expected['getLength']['return'], $type->getLength(), $label . ' getLength');
        unset($type);
    }

    private function proceedClass($label, $test, array $expected)
    {
        $type = new \Foundation\Type\Simple\CFloat($test['value'], $test['options']);
        $this->assertSame($expected['isvalid']['return'], $type->isValid(), $label . ' isValid');
        $this->assertSame($expected['getValue']['return'], $type->getValue(), $label . ' getValue');
        $this->assertSame($expected['__toString']['return'], (string)$type, $label . ' __toString');
        $this->assertSame($expected['getLength']['return'], $type->getLength(), $label . ' getLength');
        unset($type);
    }

    /**
     * @covers \Foundation\Type\Simple\CFloat::setOptions
     * @group specification
     */
    public function testSetOptions()
    {
        static $aEmpty = [ ];
        static $aFull  = [
        '<'  => 0,
        '<=' => 1,
        '>'  => 2,
        '>=' => 3,
        '='  => 4,
        '!=' => 5 ];

        $type = new \Foundation\Test\Type\Simple\CFloatMock(0.1);
        $this->assertSame($aEmpty, $type->getOptions(), 'Test 01');
        unset($type);

        $type = new \Foundation\Test\Type\Simple\CFloatMock(0.2, $aEmpty);
        $this->assertSame($aEmpty, $type->getOptions(), 'Test 02');
        unset($type);

        $type = new \Foundation\Test\Type\Simple\CFloatMock(0.3, $aFull);
        $this->assertSame($aFull, $type->getOptions(), 'Test 03');
        unset($type);

        $type = new \Foundation\Test\Type\Simple\CFloatMock(
            0.4,
            [
            '<'         => 0,
            '<='        => 1,
            '>'         => false,
            'donothing' => 2,
            '>='        => 3,
            '='         => 4,
            '!='        => 5 ]
        );
        $this->assertSame([
            '<'  => 0,
            '<=' => 1,
            '>=' => 3,
            '='  => 4,
            '!=' => 5 ], $type->getOptions(), 'Test 04');
        unset($type);

        $type = new \Foundation\Test\Type\Simple\CFloatMock(0.5, [
            '>' => false ]);
        $this->assertSame($aEmpty, $type->getOptions(), 'Test 05');
        unset($type);
    }

    /**
     * @covers \Foundation\Type\Simple\CFloat::setValue
     * @covers \Foundation\Type\Simple\CFloat::setNumeric
     * @group specification
     */
    public function testClass()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_FLOAT,
            require(realpath(__DIR__ . '/provider/result/cfloat.php'))
        );
        foreach ($tests as $test) {
            $this->proceedClass($test['label'], $test['test'], $test['expected']);
        }
    }

    /**
     * @covers \Foundation\Type\CTypeAbstract::isEqual
     * @covers \Foundation\Type\CTypeAbstract::isIdentical
     * @group specification
     */
    public function testIsEqualIsIdentical()
    {
        $o1 = new \Foundation\Type\Simple\CFloat(1.2);
        $o2 = new \Foundation\Type\Simple\CFloat(1.2);

        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 01');
        // Identiqual
        $this->assertSame(true, $o1->isIdentical($o2), 'TEST 02');

        $o2->setValue('1.2');
        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 11');
        // Identiqual
        $this->assertSame(true, $o1->isIdentical($o2), 'TEST 12');

        $o2->setValue('2.3');
        // Equal
        $this->assertSame(false, $o1->isEqual($o2), 'TEST 21');
        // Identiqual
        $this->assertSame(false, $o1->isIdentical($o2), 'TEST 22');

        unset($o1, $o2);

        $o1 = new \Foundation\Type\Simple\CFloat(1.2);
        $o2 = new \Foundation\Type\Simple\CString('1.2');

        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 31');
        // Identiqual
        $this->assertSame(false, $o1->isIdentical($o2), 'TEST 32');

        unset($o1, $o2);
    }
}
