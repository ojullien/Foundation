<?php
namespace Foundation\Test\Type;

class_exists('\Foundation\Test\Type\CTypeMock') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Type/provider/CTypeMock.php'));

class CTypeAbstractTest extends \PHPUnit_Framework_TestCase
{
    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Type\CTypeAbstract::__toString
     * @covers \Foundation\Type\CTypeAbstract::getValue
     * @covers \Foundation\Type\CTypeAbstract::isValid
     * @covers \Foundation\Type\CTypeAbstract::getLength
     * @group specification
     */
    public function testClass()
    {
        $pEmpty = new \Foundation\Test\Type\CTypeMock();
        $this->assertSame('', (string)$pEmpty, 'empty __toString');
        $this->assertSame(null, $pEmpty->getValue(), 'empty getValue');
        $this->assertSame(false, $pEmpty->isValid(), 'empty isValid');
        $this->assertSame(0, $pEmpty->getLength(), 'empty getLength');
        unset($pEmpty);

        $pNotEmpty = new \Foundation\Test\Type\CTypeMock();
        $pNotEmpty->setValue('test');
        $this->assertSame('test', (string)$pNotEmpty, 'not_empty __toString');
        $this->assertSame('test', $pNotEmpty->getValue(), 'not_empty getValue');
        $this->assertSame(true, $pNotEmpty->isValid(), 'not_empty isValid');
        $this->assertSame(4, $pNotEmpty->getLength(), 'not_empty getLength');
        unset($pNotEmpty);
    }
}
