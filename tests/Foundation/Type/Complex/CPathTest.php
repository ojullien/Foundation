<?php
namespace Foundation\Test\Type\Complex;
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );
class_exists( '\Foundation\Type\Simple\CFloat' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CFloat.php' ) );
class_exists( '\Foundation\Type\Complex\CPath' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CPath.php' ) );

trait_exists( '\Foundation\Test\Framework\Provider\TDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php' ) );

class CPathTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Framework\Provider\TDataTestProvider;

    /** Class section
     * ************** */

    /**
     * Returns the results path.
     *
     * @return string
     */
    private function getResultPath( )
    {
        return __DIR__ . '/provider/result/cpath';
    }

    /** Tests section
     * ************** */
    private function proceed( $label, $value, array $expected )
    {
        $type = new \Foundation\Type\Complex\CPath( $value );
        $this->assertSame( $expected['isvalid']['return'], $type->isValid(), $label . ' isValid' );
        $this->assertSame( $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString']['return'], (string)$type, $label . ' __toString' );
        $this->assertSame( $expected['getLength']['return'], $type->getLength(), $label . ' getLength' );
        $this->assertSame( $expected['getBasename']['return'], $type->getBasename(), $label . ' getBasename' );
        $this->assertSame( $expected['getRealPath']['return'], $type->getRealPath(), $label . ' getRealPath' );
        unset( $type );
    }

    /**
     * @group specification
     */
    public function testIsEqualIsIdentical()
    {
        $o1 = new \Foundation\Type\Complex\CPath( '/var/log' );
        $o2 = new \Foundation\Type\Complex\CPath( '/var/log' );

        // Equal
        $this->assertSame( TRUE, $o1->isEqual( $o2 ), 'TEST: 01' );
        // Identiqual
        $this->assertSame( TRUE, $o1->isIdentical( $o2 ), 'TEST: 02' );

        $o2->setValue( '/var/log/mail' );
        // Equal
        $this->assertSame( FALSE, $o1->isEqual( $o2 ), 'TEST: 21' );
        // Identiqual
        $this->assertSame( FALSE, $o1->isIdentical( $o2 ), 'TEST: 22' );

        unset( $o2 );
        $o2 = new \Foundation\Type\Simple\CString( '/var/log' );

        // Equal
        $this->assertSame( TRUE, $o1->isEqual( $o2 ), 'TEST: 31' );
        // Identiqual
        $this->assertSame( TRUE, $o1->isIdentical( $o2 ), 'TEST: 32' );

        unset( $o1, $o2 );
        $o1 = new \Foundation\Type\Complex\CPath( '1.2' );
        $o2 = new \Foundation\Type\Simple\CFloat( 1.2 );

        // Equal
        $this->assertSame( TRUE, $o1->isEqual( $o2 ), 'TEST: 31' );
        // Identiqual
        $this->assertSame( FALSE, $o1->isIdentical( $o2 ), 'TEST: 32' );

        unset( $o1, $o2 );
    }

    /**
     * @covers \Foundation\Type\Complex\CPath::setValue
     * @covers \Foundation\Type\Complex\CPath::getValue
     * @covers \Foundation\Type\Complex\CPath::getLength
     * @covers \Foundation\Type\Complex\CPath::getBasename
     * @covers \Foundation\Type\Complex\CPath::getRealPath
     * @covers \Foundation\Type\Complex\CPath::__tostring
     * @group specification
     */
    public function testClass()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_PATH,
                require( realpath( __DIR__ . '/provider/result/cpath.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed( $test['label'], $test['test'], $test['expected'] );
        }
    }

}