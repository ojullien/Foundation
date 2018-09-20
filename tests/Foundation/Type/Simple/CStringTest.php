<?php
namespace Foundation\Test\Type\Simple;

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');

interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CFloat') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CFloat.php'));
class_exists('\Foundation\Type\Simple\CInt') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CInt.php'));
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));

trait_exists('\Foundation\Test\Framework\Provider\TDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php'));

class CStringTest extends \PHPUnit_Framework_TestCase
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
        return __DIR__ . '/provider/result/cstring';
    }

    /** Tests section
     * ************** */
    private function proceed($label, $value, array $expected)
    {
        $type = new \Foundation\Type\Simple\CString($value);
        $this->assertSame($expected['isvalid']['return'], $type->isValid(), $label . ' isValid');
        $this->assertSame($expected['getValue']['return'], $type->getValue(), $label . ' getValue');
        $this->assertSame($expected['__toString']['return'], (string)$type, $label . ' __toString');
        $this->assertSame($expected['getLength']['return'], $type->getLength(), $label . ' getLength');
        unset($type);
    }

    private function proceedOptions($label, $value, array $options, array $expected)
    {
        $type = new \Foundation\Type\Simple\CString($value, $options);
        $this->assertSame($expected['isvalid']['return'], $type->isValid(), $label . ' isValid');
        $this->assertSame($expected['getValue']['return'], $type->getValue(), $label . ' getValue');
        $this->assertSame($expected['__toString']['return'], (string)$type, $label . ' __toString');
        $this->assertSame($expected['getLength']['return'], $type->getLength(), $label . ' getLength');
        unset($type);
    }

    /**
     * @covers \Foundation\Type\Simple\CString::setValue
     * @group specification
     */
    public function testFilter()
    {
        // 01
        static $expected = [
        'exception'  => 0,
        'isvalid'    => [
        'exception' => 0,
        'return'    => true ],
        'getValue'   => [
        'exception' => 0,
        'return'    => '1' ],
        '__toString' => [
        'exception' => 0,
        'return'    => '1' ],
        'getLength'  => [
        'exception' => 0,
        'return'    => 1 ] ];

        $this->proceedOptions('TEST 01', '1', [ ], $expected);

        // 02
        $this->proceedOptions('TEST 02', '1', [ /* 'filter' => */ null ], $expected);

        // 03
        $expected['isvalid']    = [
            'exception' => 0,
            'return'    => false ];
        $expected['getValue']   = [
            'exception' => 0,
            'return'    => null ];
        $expected['__toString'] = [
            'exception' => 0,
            'return'    => '' ];
        $expected['getLength']  = [
            'exception' => 0,
            'return'    => 0 ];
        $this->proceedOptions('TEST 03', '1', [ /* 'filter' => */ 1 ], $expected);

        // 04
        $pattern = '/^[\s\p{L}]+$/u';
        $this->proceedOptions('TEST 04', '1', [ /* 'filter' => */ $pattern ], $expected);

        // 06
        $expected['isvalid']    = [ 'exception' => 0, 'return'    => true ];
        $expected['getValue']   = [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ];
        $expected['__toString'] = [ 'exception' => 0, 'return'    => 'Iñtërnâtiônàlizætiøn' ];
        $expected['getLength']  = [ 'exception' => 0, 'return'    => 20 ];
        $this->proceedOptions('TEST 06', 'Iñtërnâtiônàlizætiøn', [ /* 'filter' => */ $pattern ], $expected);
    }

    /**
     * @covers \Foundation\Type\Simple\CString::matches
     * @group specification
     */
    public function testMatches()
    {
        $type    = new \Foundation\Type\Simple\CString('joe@example.org');
        // 01
        $this->assertSame(true, $type->matches('/^(.+)@([^@]+)$/'), 'TEST 01');
        // 02
        $matched = [ ];
        $this->assertSame(true, $type->matches('/^(.+)@([^@]+)$/', $matched), 'TEST 02');
        // 03
        $this->assertSame([ 'joe@example.org', 'joe', 'example.org' ], $matched, 'TEST 03');
        // 04
        $type->setValue('joeexample.org');
        $this->assertSame(false, $type->matches('/^(.+)@([^@]+)$/'), 'TEST 04');
        // 05
        $matched = [ ];
        $this->assertSame(false, $type->matches('/^(.+)@([^@]+)$/', $matched), 'TEST 05');
        // 06
        $this->assertSame([ ], $matched, 'TEST 06');
        unset($type);
    }

    /**
     * @covers \Foundation\Type\Simple\CString::trimFromEnd
     * @group specification
     */
    public function testTrimFromEnd()
    {
        static $aData = [
        [ 'TEST 01', '/\\', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь' ],
        [ 'TEST 02', '/\\', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь\\', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь' ],
        [ 'TEST 03', '/\\', '\\абвгдеёжз\\ийклмнопрст\\уфхцчшщэюяъыь\\\\', '\\абвгдеёжз\\ийклмнопрст\\уфхцчшщэюяъыь' ],
        [ 'TEST 04', '/\\', '/абвгдеёжз/ийклмнопрст/уфхцчшщэюяъыь', '/абвгдеёжз/ийклмнопрст/уфхцчшщэюяъыь' ],
        [ 'TEST 05', '/\\', '/абвгдеёжз/ийклмнопрст/уфхцчшщэюяъыь/', '/абвгдеёжз/ийклмнопрст/уфхцчшщэюяъыь' ],
        [ 'TEST 06', '/\\', '//абвгдеёжз//ийклмнопрст//уфхцчшщэюяъыь//', '//абвгдеёжз//ийклмнопрст//уфхцчшщэюяъыь' ],
        [ 'TEST 07', '', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь\\', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь\\' ],
        [ 'TEST 08', null, '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь\\', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь\\' ],
        [ 'TEST 09', [ ], '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь\\', '\абвгдеёжз\ийклмнопрст\уфхцчшщэюяъыь\\' ],
        ];

        foreach ($aData as $value) {
            $type = new \Foundation\Type\Simple\CString($value[2]);
            $type->trimFromEnd($value[1]);
            $this->assertSame($value[3], $type->getValue(), $value[0]);
            unset($type);
        }
    }

    /**
     * @covers \Foundation\Type\Simple\CString::contains
     * @group specification
     */
    public function testContains()
    {
        static $sHaystack = 'Iñtërnâtiônàlizætiøn';
        $aData     = [
            [ 'TEST 01', '', '', false, false ],
            [ 'TEST 02', $sHaystack, '', false, false ],
            [ 'TEST 03', '', $sHaystack, false, false ],
            [ 'TEST 04', $sHaystack, '1', false, false ],
            [ 'TEST 05', $sHaystack, 'ô', false, true ],
            [ 'TEST 06', $sHaystack, 'ônà', false, true ],
            [ 'TEST 07', $sHaystack, 'ôà', false, false ],
            [ 'TEST 08', $sHaystack, 1, false, false ],
            [ 'TEST 11', '', new \Foundation\Type\Simple\CString(''), false, false ],
            [ 'TEST 12', $sHaystack, new \Foundation\Type\Simple\CString(''), false, false ],
            [ 'TEST 13', '', new \Foundation\Type\Simple\CString($sHaystack), false, false ],
            [ 'TEST 14', $sHaystack, new \Foundation\Type\Simple\CString('1'), false, false ],
            [ 'TEST 15', $sHaystack, new \Foundation\Type\Simple\CString('ô'), false, true ],
            [ 'TEST 16', $sHaystack, new \Foundation\Type\Simple\CString('ônà'), false, true ],
            [ 'TEST 17', $sHaystack, new \Foundation\Type\Simple\CString('ôà'), false, false ],
            [ 'TEST 18', $sHaystack, new \Foundation\Type\Simple\CInt(1), false, false ],
            [ 'TEST 19', $sHaystack, 'ôNà', true, true ],
            [ 'TEST 20', $sHaystack, 'ôNà', false, false ],
            [ 'TEST 21', $sHaystack, new \Foundation\Type\Simple\CString('ôNà'), true, true ],
            [ 'TEST 22', $sHaystack, new \Foundation\Type\Simple\CString('ôNà'), false, false ],
        ];

        foreach ($aData as $value) {
            $pHaystack = new \Foundation\Type\Simple\CString($value[1]);
            $this->assertSame($value[4], $pHaystack->contains($value[2], $value[3]), $value[0]);
            unset($pHaystack);
        }
    }

    /**
     * @covers \Foundation\Type\CTypeAbstract::isEqual
     * @covers \Foundation\Type\CTypeAbstract::isIdentical
     * @group specification
     */
    public function testIsEqualIsIdentical()
    {
        $o1 = new \Foundation\Type\Simple\CString('1.2');
        $o2 = new \Foundation\Type\Simple\CString('1.2');

        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 01');
        // Identiqual
        $this->assertSame(true, $o1->isIdentical($o2), 'TEST 02');

        $o2->setValue(1.2);
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

        $o1 = new \Foundation\Type\Simple\CString('1.2');
        $o2 = new \Foundation\Type\Simple\CFloat(1.2);

        // Equal
        $this->assertSame(true, $o1->isEqual($o2), 'TEST 31');
        // Identiqual
        $this->assertSame(false, $o1->isIdentical($o2), 'TEST 32');

        unset($o1, $o2);
    }
}
