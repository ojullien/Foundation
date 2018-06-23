<?php
namespace Foundation\Test\Type\Simple;
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Simple\CFloat' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CFloat.php' ) );
class_exists( '\Foundation\Type\Simple\CInt' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CInt.php' ) );

trait_exists( '\Foundation\Test\Framework\Provider\TDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php' ) );

class CIntTest extends \PHPUnit_Framework_TestCase
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
    private function getResultPath( $sNamespace )
    {
        // Check argument
        $sNamespace = (is_string( $sNamespace )) ? trim( $sNamespace ) : '';
        if( '' == $sNamespace )
            throw new \InvalidArgumentException();

        // Initialize
        $sResultPath = __DIR__ . '/provider/result/';

        if( count( $this->_aResultPath ) == 0 )
        {
            $this->_aResultPath[\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_BOOLEAN] = $sResultPath . 'cfloat';
            $this->_aResultPath[\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_XSS]     = $sResultPath . 'cfloat';
        }

        return ( isset( $this->_aResultPath[$sNamespace] ) ) ? $this->_aResultPath[$sNamespace] : $sResultPath . 'cint';
    }

    /** Tests section
     * ************** */
    private function proceed( $label, $value, array $expected )
    {
        $type = new \Foundation\Type\Simple\CInt( $value );
        $this->assertSame( $expected['isvalid']['return'], $type->isValid(), $label . ' isValid' );
        $this->assertSame( $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString']['return'], (string)$type, $label . ' __toString' );
        $this->assertSame( $expected['getLength']['return'], $type->getLength(), $label . ' getLength' );
        unset( $type );
    }

    private function proceedClass( $label, $test, array $expected )
    {
        $type = new \Foundation\Type\Simple\CInt( $test['value'], $test['options'] );
        $this->assertSame( $expected['isvalid']['return'], $type->isValid(), $label . ' isValid' );
        $this->assertSame( $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString']['return'], (string)$type, $label . ' __toString' );
        $this->assertSame( $expected['getLength']['return'], $type->getLength(), $label . ' getLength' );
        unset( $type );
    }

    /**
     * @covers \Foundation\Type\Simple\CInt::__toString
     * @covers \Foundation\Type\Simple\CInt::getValue
     * @covers \Foundation\Type\Simple\CInt::getLength
     * @group specification
     */
    public function testClass()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_INT,
                require( realpath( __DIR__ . '/provider/result/cint.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceedClass( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\CTypeAbstract::isEqual
     * @covers \Foundation\Type\CTypeAbstract::isIdentical
     * @group specification
     */
    public function testIsEqualIsIdentical()
    {
        $o1 = new \Foundation\Type\Simple\CInt( 1 );
        $o2 = new \Foundation\Type\Simple\CInt( 1 );

        // Equal
        $this->assertSame( TRUE, $o1->isEqual( $o2 ), 'TEST 01' );
        // Identiqual
        $this->assertSame( TRUE, $o1->isIdentical( $o2 ), 'TEST 02' );

        $o2->setValue( '1' );
        // Equal
        $this->assertSame( TRUE, $o1->isEqual( $o2 ), 'TEST 11' );
        // Identiqual
        $this->assertSame( TRUE, $o1->isIdentical( $o2 ), 'TEST 12' );

        $o2->setValue( '2' );
        // Equal
        $this->assertSame( FALSE, $o1->isEqual( $o2 ), 'TEST 21' );
        // Identiqual
        $this->assertSame( FALSE, $o1->isIdentical( $o2 ), 'TEST 22' );

        unset( $o1, $o2 );

        $o1 = new \Foundation\Type\Simple\CInt( 1 );
        $o2 = new \Foundation\Type\Simple\CFloat( '1.0' );

        // Equal
        $this->assertSame( TRUE, $o1->isEqual( $o2 ), 'TEST 41' );
        // Identiqual
        $this->assertSame( FALSE, $o1->isIdentical( $o2 ), 'TEST 42' );

        unset( $o1, $o2 );
    }

}