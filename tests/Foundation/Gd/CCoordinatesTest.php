<?php
namespace Foundation\Test\Gd;

defined('FOUNDATION_EXCEPTION_PATH') || define(
    'FOUNDATION_EXCEPTION_PATH',
    APPLICATION_PATH . '/src/Foundation/Exception'
);

interface_exists('\Foundation\Exception\ExceptionInterface') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
class_exists('\Foundation\Exception\InvalidArgumentException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));

defined('FOUNDATION_GD_PATH') || define('FOUNDATION_GD_PATH', APPLICATION_PATH . '/src/Foundation/Gd');
class_exists('\Foundation\Gd\CCoordinates') || require(realpath(FOUNDATION_GD_PATH . '/CCoordinates.php'));

class CCoordinatesTest extends \PHPUnit_Framework_TestCase
{
    /** Test section
     * ************* */

    /**
     * @covers \Foundation\Gd\CCoordinates::__construct
     * @group specification
     */
    public function testConstructException()
    {
        $aTests = [
            [ 'label' => 'Test: FALSE, 0.0, 0.0', 'test'  => [ false, 0.0, 0.0 ] ],
            [ 'label' => 'Test: 0.0, FALSE, 0.0', 'test'  => [ 0.0, false, 0.0 ] ],
            [ 'label' => 'Test: 0.0, 0.0, FALSE', 'test'  => [ 0.0, 0.0, false ] ],
            [ 'label' => 'Test: -1, 0.0, 0.0', 'test'  => [ -1, 0.0, 0.0 ] ],
            [ 'label' => 'Test: 0.0, -1, 0.0', 'test'  => [ 0.0, -1, 0.0 ] ],
            [ 'label' => 'Test: 0.0, 0.0, -1', 'test'  => [ 0.0, 0.0, -1 ] ],
        ];

        foreach ($aTests as $data) {
            $label = &$data['label'];
            $value = &$data['test'];
            try {
                $pObject = new \Foundation\Gd\CCoordinates($value[0], $value[1], $value[2]);
                unset($pObject);
                $this->fail($label . ' No exception raised.');
            } catch (\Foundation\Exception\InvalidArgumentException $exc) {
                $this->assertTrue(true);
            } catch (\Exception $exc) {
                $this->fail($label . ' No the expected exception.');
            }
        }
    }

    /**
     * @covers \Foundation\Gd\CCoordinates
     * @group specification
     */
    public function testClass()
    {
        $pObject = new \Foundation\Gd\CCoordinates(1.11, 22.2, 0.333);
        $this->assertSame(1.11, $pObject->getX(), 'getX');
        $this->assertSame(22.2, $pObject->getY(), 'getY');
        $this->assertSame(0.333, $pObject->getZ(), 'getZ');
        $this->assertSame(serialize([ 'x' => '1.11', 'y' => '22.2', 'z' => '0.333' ]), (string)$pObject, 'string');
        unset($pObject);
    }
}
