<?php
namespace Foundation\Test\Type\Simple;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\UnexpectedValueException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/UnexpectedValueException.php' ) );

defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

class_exists( '\Foundation\Type\Enum\CSeverity' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Enum/CSeverity.php' ) );

class CSeverity extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Foundation\Type\Enum\CSeverity::__construct
     * @group specification
     * @expectedException \Foundation\Exception\UnexpectedValueException
     * @dataProvider getProviderConstructException
     */
    public function testConstructException( $label, $value )
    {
        $type = new \Foundation\Type\Enum\CSeverity( $value );
        $this->fail( 'Should not happen!' );
        unset( $type );
    }

    /**
     * Provider for testConstructException
     *
     * @return array
     */
    public function getProviderConstructException()
    {
        return [
            ['Test: 01', 1.1 ],
            ['Test: 02', (\Foundation\Type\Enum\CSeverity::EMERG - 1) ],
            ['Test: 03', (\Foundation\Type\Enum\CSeverity::DEBUG + 1) ],
        ];
    }

    private function proceed( $label, $value, array $expected )
    {
        $type = new \Foundation\Type\Enum\CSeverity( $value );
        $this->assertEquals( $expected['getValue'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString'], (string)$type, $label . ' __toString' );
        unset( $type );
    }

    /**
     * @covers \Foundation\Type\Enum\CSeverity::__construct
     * @covers \Foundation\Type\Enum\CSeverity::getValue
     * @covers \Foundation\Type\Enum\CSeverity::__tostring
     * @group specification
     */
    public function testClass()
    {
        $this->proceed( 'TEST EMERG', \Foundation\Type\Enum\CSeverity::EMERG,
                        [ 'getValue'   => 0,
            '__toString' => 'emergency' ] );
        $this->proceed( 'TEST ALERT', \Foundation\Type\Enum\CSeverity::ALERT,
                        [ 'getValue'   => 1,
            '__toString' => 'alert' ] );
        $this->proceed( 'TEST CRIT', \Foundation\Type\Enum\CSeverity::CRIT,
                        [ 'getValue'   => 2,
            '__toString' => 'critical' ] );
        $this->proceed( 'TEST ERR', \Foundation\Type\Enum\CSeverity::ERR,
                        [ 'getValue'   => 3,
            '__toString' => 'error' ] );
        $this->proceed( 'TEST WARN', \Foundation\Type\Enum\CSeverity::WARN,
                        [ 'getValue'   => 4,
            '__toString' => 'warning' ] );
        $this->proceed( 'TEST NOTICE', \Foundation\Type\Enum\CSeverity::NOTICE,
                        [ 'getValue'   => 5,
            '__toString' => 'notice' ] );
        $this->proceed( 'TEST INFO', \Foundation\Type\Enum\CSeverity::INFO,
                        [ 'getValue'   => 6,
            '__toString' => 'informational' ] );
        $this->proceed( 'TEST DEBUG', \Foundation\Type\Enum\CSeverity::DEBUG,
                        [ 'getValue'   => 7,
            '__toString' => 'debug' ] );
    }

    /**
     * @group specification
     */
    public function testDefault()
    {
        $type = new \Foundation\Type\Enum\CSeverity();
        $this->assertSame( 3, $type->getValue(), 'getValue' );
        $this->assertSame( 'error', (string)$type, 'string' );
        unset( $type );
    }

}