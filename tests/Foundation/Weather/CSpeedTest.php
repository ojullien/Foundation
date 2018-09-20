<?php
defined('FOUNDATION_WEATHER_PATH') || define(
    'FOUNDATION_WEATHER_PATH',
    APPLICATION_PATH . '/src/Foundation/Weather'
);
require_once(FOUNDATION_WEATHER_PATH . '/CSpeed.php');

//require_once( APPLICATION_PATH . '/tests/Providers/CProviderFactory.php');

class CSpeedTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Foundation\Weather\CSpeed
     * @group specification
     */
    public function testSetMetersPerSecond()
    {
        $pObject = new \Foundation\Weather\CSpeed();
        $pObject->setMetersPerSecond(1);
        $this->assertTrue($pObject->isValid(), 'isValid');
        $this->assertSame(1, $pObject->getMetersPerSecond(), 'getMetersPerSecond');
        $this->assertSame(3.6, $pObject->getKilometersPerHour(), 'setKilometersPerHour');
        $this->assertSame(1.9438444924406, $pObject->getKnots(), 'getKnots');
        $this->assertSame(2.2369362920544, $pObject->getMilesPerHour(), 'getMilesPerHour');
        $this->assertSame(1, $pObject->getBeaufort(), 'getBeaufort');
        $this->assertSame('1 m/s', (string)$pObject, 'string');
        $this->assertSame(\Foundation\Weather\CSpeed::MPS, $pObject->getUnit(), 'getUnit');
        unset($pObject);
    }

    /**
     * @covers \Foundation\Weather\CSpeed
     * @group specification
     */
    public function testSetKilometersPerHour()
    {
        $pObject = new \Foundation\Weather\CSpeed();
        $pObject->setKilometersPerHour(1);
        $this->assertTrue($pObject->isValid(), 'isValid');
        $this->assertSame(0.27777777777778, $pObject->getMetersPerSecond(), 'getMetersPerSecond');
        $this->assertSame(1, $pObject->getKilometersPerHour(), 'setKilometersPerHour');
        $this->assertSame(0.539956803, $pObject->getKnots(), 'getKnots');
        $this->assertSame(0.621371192, $pObject->getMilesPerHour(), 'getMilesPerHour');
        $this->assertSame(0, $pObject->getBeaufort(), 'getBeaufort');
        $this->assertSame('1 km/h', (string)$pObject, 'string');
        $this->assertSame(\Foundation\Weather\CSpeed::KMPH, $pObject->getUnit(), 'getUnit');
        unset($pObject);
    }

    /**
     * @covers \Foundation\Weather\CSpeed
     * @group specification
     */
    public function testSetKnots()
    {
        $pObject = new \Foundation\Weather\CSpeed();
        $pObject->setKnots(1);
        $this->assertTrue($pObject->isValid(), 'isValid');
        $this->assertSame(0.51444444444444, $pObject->getMetersPerSecond(), 'getMetersPerSecond');
        $this->assertSame(1.85200, $pObject->getKilometersPerHour(), 'setKilometersPerHour');
        $this->assertSame(1, $pObject->getKnots(), 'getKnots');
        $this->assertSame(1.15077945, $pObject->getMilesPerHour(), 'getMilesPerHour');
        $this->assertSame(1, $pObject->getBeaufort(), 'getBeaufort');
        $this->assertSame('1 knot', (string)$pObject, 'string');
        $this->assertSame(\Foundation\Weather\CSpeed::KNOT, $pObject->getUnit(), 'getUnit');
        unset($pObject);
    }

    /**
     * @covers \Foundation\Weather\CSpeed
     * @group specification
     */
    public function testMilesPerHour()
    {
        $pObject = new \Foundation\Weather\CSpeed();
        $pObject->setMilesPerHour(1);
        $this->assertTrue($pObject->isValid(), 'isValid');
        $this->assertSame(0.44704, $pObject->getMetersPerSecond(), 'getMetersPerSecond');
        $this->assertSame(1.609344, $pObject->getKilometersPerHour(), 'setKilometersPerHour');
        $this->assertSame(0.868976242, $pObject->getKnots(), 'getKnots');
        $this->assertSame(1, $pObject->getMilesPerHour(), 'getMilesPerHour');
        $this->assertSame(1, $pObject->getBeaufort(), 'getBeaufort');
        $this->assertSame('1 mph', (string)$pObject, 'string');
        $this->assertSame(\Foundation\Weather\CSpeed::MPH, $pObject->getUnit(), 'getUnit');
        unset($pObject);
    }

    /**
     * @covers \Foundation\Weather\CSpeed
     * @group specification
     */
    public function testBeaufort()
    {
        $pObject = new \Foundation\Weather\CSpeed();
        $pObject->setBeaufort(6);
        $this->assertTrue($pObject->isValid(), 'isValid');
        $this->assertSame(12.248428509813, $pObject->getMetersPerSecond(), 'getMetersPerSecond');
        $this->assertSame(44.090815370097, $pObject->getKilometersPerHour(), 'setKilometersPerHour');
        $this->assertSame(23.809040299852, $pObject->getKnots(), 'getKnots');
        $this->assertSame(27.396762502769, $pObject->getMilesPerHour(), 'getMilesPerHour');
        $this->assertSame('6 bf', (string)$pObject, 'string');
        $this->assertSame(\Foundation\Weather\CSpeed::BFT, $pObject->getUnit(), 'getUnit');
        unset($pObject);
    }

    /**
     * @covers \Foundation\Weather\CSpeed
     * @group specification
     */
    public function testGetBeaufortSimple()
    {
        $pObject = new \Foundation\Weather\CSpeed();
        $pObject->setBeaufort(-1);
        $this->assertFalse($pObject->isValid(), 'TEST: -1 isValid');
        $this->assertNull($pObject->getBeaufort(), 'TEST: -1 getBeaufort');
        $this->assertNull($pObject->getUnit(), 'TEST: -1 getUnit');
        $this->assertSame('', (string)$pObject, 'TEST: -1 string');
        $pObject->setBeaufort(0);
        $this->assertTrue($pObject->isValid(), 'TEST: 0 isValid');
        $this->assertSame(0, $pObject->getBeaufort(), 'TEST: 0 getBeaufort');
        $this->assertSame(\Foundation\Weather\CSpeed::BFT, $pObject->getUnit(), 'TEST: 0 getUnit');
        $this->assertSame('0 bf', (string)$pObject, 'TEST: 0 string');
        $pObject->setBeaufort(12);
        $this->assertTrue($pObject->isValid(), 'TEST: 12 isValid');
        $this->assertSame(12, $pObject->getBeaufort(), 'TEST: 12 getBeaufort');
        $this->assertSame(\Foundation\Weather\CSpeed::BFT, $pObject->getUnit(), 'TEST: 12 getUnit');
        $this->assertSame('12 bf', (string)$pObject, 'TEST: 12 string');
        $pObject->setBeaufort(13);
        $this->assertFalse($pObject->isValid(), 'TEST: 13 isValid');
        $this->assertNull($pObject->getBeaufort(), 'TEST: 13 getBeaufort');
        $this->assertNull($pObject->getUnit(), 'TEST: 13 getUnit');
        $this->assertSame('', (string)$pObject, 'TEST: 13 string');
        unset($pObject);
    }

    /**
     * @covers \Foundation\Weather\CSpeed
     * @group specification
     * @dataProvider getProviderBeaufortComplexe
     */
    public function testGetBeaufortComplexe($label, $expected, array $test)
    {
        $pObject = new \Foundation\Weather\CSpeed();
        $speed   = &$test['kmph'];
        $pObject->setKilometersPerHour($speed['from']);
        $this->assertSame($expected, $pObject->getBeaufort(), $label . '=setKilometersPerHour(' . $speed['from'] . ')');
        $pObject->setKilometersPerHour($speed['to']);
        $this->assertSame($expected, $pObject->getBeaufort(), $label . '=setKilometersPerHour(' . $speed['to'] . ')');
//        $speed = &$test['mph'];
//        $pObject->setMilesPerHour( $speed['from'] );
//        $this->assertSame( $expected, $pObject->getBeaufort(), $label . '=setMilesPerHour(' . $speed['from'] . ')' );
//        $pObject->setMilesPerHour( $speed['to'] );
//        $this->assertSame( $expected, $pObject->getBeaufort(), $label . '=setMilesPerHour(' . $speed['to'] . ')' );
//        $speed = &$test['knot'];
//        $pObject->setKnots( $speed['from'] );
//        $this->assertSame( $expected, $pObject->getBeaufort(), $label . '=setKnots(' . $speed['from'] . ')' );
//        $pObject->setKnots( $speed['to'] );
//        $this->assertSame( $expected, $pObject->getBeaufort(), $label . '=setKnots(' . $speed['to'] . ')' );
//        $speed = &$test['mps'];
//        $pObject->setMetersPerSecond( $speed['from'] );
//        $this->assertSame( $expected, $pObject->getBeaufort(), $label . '=setMetersPerSecond(' . $speed['from'] . ')' );
//        $pObject->setMetersPerSecond( $speed['to'] );
//        $this->assertSame( $expected, $pObject->getBeaufort(), $label . '=setMetersPerSecond(' . $speed['to'] . ')' );
        unset($pObject);
    }

    /**
     * Provider for testReadException
     *
     * @return array
     */
    public function getProviderBeaufortComplexe()
    {
        return [
            [ 'label'    => 'TEST: 0', 'expected' => 0, 'test'     => [
                    'kmph' => [ 'from' => 0, 'to'   => 1 ],
                    'mph'  => [ 'from' => 0, 'to'   => 0.9 ],
                    'knot' => [ 'from' => 0, 'to'   => 0.9 ],
                    'mps'  => [ 'from' => 0, 'to'   => 0.2 ] ] ],
            [ 'label'    => 'TEST: 1', 'expected' => 1, 'test'     => [
                    'kmph' => [ 'from' => 1.1, 'to'   => 5 ],
                    'mph'  => [ 'from' => 1, 'to'   => 3 ],
                    'knot' => [ 'from' => 1, 'to'   => 3 ],
                    'mps'  => [ 'from' => 0.3, 'to'   => 1.5 ] ] ],
            [ 'label'    => 'TEST: 2', 'expected' => 2, 'test'     => [
                    'kmph' => [ 'from' => 6, 'to'   => 11 ],
                    'mph'  => [ 'from' => 4, 'to'   => 7 ],
                    'knot' => [ 'from' => 4, 'to'   => 6 ],
                    'mps'  => [ 'from' => 1.6, 'to'   => 3.4 ] ] ],
            [ 'label'    => 'TEST: 3', 'expected' => 3, 'test'     => [
                    'kmph' => [ 'from' => 12, 'to'   => 19 ],
                    'mph'  => [ 'from' => 8, 'to'   => 12 ],
                    'knot' => [ 'from' => 7, 'to'   => 10 ],
                    'mps'  => [ 'from' => 3.5, 'to'   => 5.4 ] ] ],
            [ 'label'    => 'TEST: 4', 'expected' => 4, 'test'     => [
                    'kmph' => [ 'from' => 20, 'to'   => 28 ],
                    'mph'  => [ 'from' => 13, 'to'   => 17 ],
                    'knot' => [ 'from' => 11, 'to'   => 16 ],
                    'mps'  => [ 'from' => 5.5, 'to'   => 7.9 ] ] ],
            [ 'label'    => 'TEST: 5', 'expected' => 5, 'test'     => [
                    'kmph' => [ 'from' => 29, 'to'   => 38 ],
                    'mph'  => [ 'from' => 18, 'to'   => 24 ],
                    'knot' => [ 'from' => 17, 'to'   => 21 ],
                    'mps'  => [ 'from' => 8.0, 'to'   => 10.7 ] ] ],
            [ 'label'    => 'TEST: 6', 'expected' => 6, 'test'     => [
                    'kmph' => [ 'from' => 39, 'to'   => 49 ],
                    'mph'  => [ 'from' => 25, 'to'   => 30 ],
                    'knot' => [ 'from' => 22, 'to'   => 27 ],
                    'mps'  => [ 'from' => 10.8, 'to'   => 13.8 ] ] ],
            [ 'label'    => 'TEST: 7', 'expected' => 7, 'test'     => [
                    'kmph' => [ 'from' => 50, 'to'   => 61 ],
                    'mph'  => [ 'from' => 31, 'to'   => 38 ],
                    'knot' => [ 'from' => 28, 'to'   => 33 ],
                    'mps'  => [ 'from' => 13.9, 'to'   => 17.1 ] ] ],
            [ 'label'    => 'TEST: 8', 'expected' => 8, 'test'     => [
                    'kmph' => [ 'from' => 62, 'to'   => 74 ],
                    'mph'  => [ 'from' => 39, 'to'   => 46 ],
                    'knot' => [ 'from' => 34, 'to'   => 40 ],
                    'mps'  => [ 'from' => 17.2, 'to'   => 20.7 ] ] ],
            [ 'label'    => 'TEST: 9', 'expected' => 9, 'test'     => [
                    'kmph' => [ 'from' => 75, 'to'   => 87.9 ],
                    'mph'  => [ 'from' => 47, 'to'   => 54 ],
                    'knot' => [ 'from' => 41, 'to'   => 47 ],
                    'mps'  => [ 'from' => 20.8, 'to'   => 24.4 ] ] ],
            [ 'label'    => 'TEST: 10', 'expected' => 10, 'test'     => [
                    'kmph' => [ 'from' => 88, 'to'   => 102 ],
                    'mph'  => [ 'from' => 55, 'to'   => 63 ],
                    'knot' => [ 'from' => 48, 'to'   => 55 ],
                    'mps'  => [ 'from' => 24.5, 'to'   => 28.4 ] ] ],
            [ 'label'    => 'TEST: 11', 'expected' => 11, 'test'     => [
                    'kmph' => [ 'from' => 103, 'to'   => 117 ],
                    'mph'  => [ 'from' => 64, 'to'   => 73 ],
                    'knot' => [ 'from' => 56, 'to'   => 63 ],
                    'mps'  => [ 'from' => 28.5, 'to'   => 32.6 ] ] ],
            [ 'label'    => 'TEST: 12', 'expected' => 12, 'test'     => [
                    'kmph' => [ 'from' => 118, 'to'   => 300 ],
                    'mph'  => [ 'from' => 74, 'to'   => 100 ],
                    'knot' => [ 'from' => 64, 'to'   => 100 ],
                    'mps'  => [ 'from' => 32.7, 'to'   => 100 ] ] ]
        ];
    }
}
