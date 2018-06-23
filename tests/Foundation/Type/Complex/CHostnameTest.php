<?php
namespace Foundation\Test\Type\Complex;
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Complex\CIp' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CIp.php' ) );
class_exists( '\Foundation\Type\Complex\CHostname' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CHostname.php' ) );

trait_exists( '\Foundation\Test\Framework\Provider\TDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php' ) );

class CHostnameTest extends \PHPUnit_Framework_TestCase
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
        return __DIR__ . '/provider/result/chostname';
    }

    /** Tests section
     * ************** */
    private function proceedClassTLD( $label, $value, array $expected )
    {
        // TLD mandatory and Local allowed
        $type = new \Foundation\Type\Complex\CHostname( $value, [ TRUE, FALSE, TRUE ] );
        $this->assertSame( $expected['isvalid'], $type->isValid(), $label . ' isValid' );
        $this->assertSame( $expected['getValue'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString'], (string)$type, $label . ' __toString' );
        $this->assertSame( $expected['getLength'], $type->getLength(), $label . ' getLength' );
        $this->assertSame( $expected['getPunycode'], $type->getPunycode(), $label . ' getPunycode' );
        unset( $type );
    }

    private function proceedClassNoTLD( $label, $value, array $expected )
    {
        // TLD not mandatory and Local allowed
        $type = new \Foundation\Type\Complex\CHostname( $value, [ FALSE, FALSE, TRUE ] );
        $this->assertSame( $expected['isvalid'], $type->isValid(), $label . ' isValid' );
        $this->assertSame( $expected['getValue'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString'], (string)$type, $label . ' __toString' );
        $this->assertSame( $expected['getLength'], $type->getLength(), $label . ' getLength' );
        $this->assertSame( $expected['getPunycode'], $type->getPunycode(), $label . ' getPunycode' );
        unset( $type );
    }

    private function proceed( $label, $value, array $expected )
    {
        $type = new \Foundation\Type\Complex\CHostname( $value );
        $this->assertSame( $expected['isvalid']['return'], $type->isValid(), $label . ' isValid' );
        $this->assertSame( $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString']['return'], (string)$type, $label . ' __toString' );
        $this->assertSame( $expected['getLength']['return'], $type->getLength(), $label . ' getLength' );
        $this->assertSame( $expected['getPunycode']['return'], $type->getPunycode(), $label . ' getPunycode' );
        unset( $type );
    }

    /**
     * @covers \Foundation\Type\Complex\CHostname::setValue
     * @covers \Foundation\Type\Complex\CHostname::validateDomainLabel
     * @covers \Foundation\Type\Complex\CHostname::validateIP
     * @group specification
     */
    public function testSetValueError()
    {
        $type = new \Foundation\Type\Complex\CHostname( '192.168.33.1', array( TRUE, FALSE, TRUE ) );
        $this->assertFalse( $type->isValid(), 'TEST: not authorized \'192.168.33.1\'' );
        unset( $type );
        $type = new \Foundation\Type\Complex\CHostname( '192.168.33.1', array( TRUE, TRUE, TRUE ) );
        $this->assertTrue( $type->isValid(), 'TEST: authorized \'192.168.33.1\'' );
        unset( $type );
        $type = new \Foundation\Type\Complex\CHostname( 'localhost', array( FALSE, FALSE, FALSE ) );
        $this->assertFalse( $type->isValid(), 'TEST: not authorized \'localhost\'' );
        unset( $type );
        $type = new \Foundation\Type\Complex\CHostname( 'localhost', array( FALSE, FALSE, TRUE ) );
        $this->assertTrue( $type->isValid(), 'TEST: authorized \'localhost\'' );
        unset( $type );
    }

    /**
     * @covers \Foundation\Type\Complex\CHostname::setValue
     * @covers \Foundation\Type\Complex\CHostname::validateTLD
     * @covers \Foundation\Type\Complex\CHostname::validateIP
     * @covers \Foundation\Type\Complex\CHostname::validateDomainLabel
     * @covers \Foundation\Type\Complex\CHostname::getPunycode
     * @group specification
     */
    public function testClass()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_HOSTNAME,
                require( realpath( __DIR__ . '/provider/result/chostname.php' ) ) );
        foreach( $tests as $test )
        {
            // IDN with tld
            $this->proceedClassTLD( $test['label'], $test['test']['idn'], $test['expected-idn']['tldmandatory'] );
            // IDN without tld
            $this->proceedClassNoTLD( $test['label'], $test['test']['idn'], $test['expected-idn']['tldnomandatory'] );
            // Punycode with tld
            $this->proceedClassTLD( $test['label'], $test['test']['punycode'],
                                    $test['expected-punycode']['tldmandatory'] );
            // Punycode without tld
            $this->proceedClassNoTLD( $test['label'], $test['test']['punycode'],
                                      $test['expected-punycode']['tldnomandatory'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CHostname::setValue
     * @group specification
     */
    public function testTypeCHostname()
    {
        $pValue = new \Foundation\Type\Complex\CHostname( 'domain.com' );
        $type   = new \Foundation\Type\Complex\CHostname( $pValue );
        $this->assertTrue( $type->isValid(), ' isValid' );
        $this->assertSame( 'domain.com', $type->getValue(), ' getValue' );
        $this->assertSame( 'domain.com', (string)$type, ' __toString' );
        $this->assertSame( 10, $type->getLength(), ' getLength' );
        $this->assertSame( 'domain.com', $type->getPunycode(), ' getPunycode' );
        unset( $type, $pValue );
    }

}