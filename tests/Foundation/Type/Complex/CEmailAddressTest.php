<?php
namespace Foundation\Test\Type\Complex;
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );
class_exists( '\Foundation\Type\Complex\CIp' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CIp.php' ) );
class_exists( '\Foundation\Type\Complex\CHostname' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CHostname.php' ) );
class_exists( '\Foundation\Type\Complex\CEmailAddress' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CEmailAddress.php' ) );

trait_exists( '\Foundation\Test\Framework\Provider\TDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/TDataTestProvider.php' ) );

trait_exists( '\Foundation\Test\Framework\Provider\TOnlineTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/TOnlineTestProvider.php' ) );

class CEmailAddressTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Framework\Provider\TDataTestProvider,
        \Foundation\Test\Framework\Provider\TOnlineTestProvider;

    /** Class section
     * ************** */

    /**
     * Returns the results path.
     *
     * @return string
     */
    private function getResultPath()
    {
        return __DIR__ . '/provider/result/cemailaddress';
    }

    /** Tests section
     * ************** */
    private function proceed( $label, $value, array $expected )
    {
        $type = new \Foundation\Type\Complex\CEmailAddress( $value );
        $this->assertSame( $expected['isvalid']['return'], $type->isValid(), $label . ' isValid' );
        $this->assertSame( $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
        $this->assertSame( $expected['__toString']['return'], (string)$type, $label . ' __toString' );
        $this->assertSame( $expected['getLength']['return'], $type->getLength(), $label . ' getLength' );
        $this->assertSame( $expected['getRaw']['return'], $type->getRaw(), $label . ' getRaw' );
        unset( $type );
    }

    private function proceed_LocalPart( $label, $value, array $expected )
    {
        $type = new \Foundation\Type\Complex\CEmailAddress( $value . '@valid.com' );
        $this->assertSame( $expected['isvalid']['return'], $type->isValid(), $label . ' isValid' );
        if( $expected['isvalid']['return'] === TRUE )
        {
            $this->assertSame( $expected['getValue']['return'] . '@valid.com', $type->getValue(), $label . ' getValue' );
            $this->assertSame( $expected['__toString']['return'] . '@valid.com', (string)$type, $label . ' __toString' );
            $this->assertSame( $expected['getLength']['return'] + 10, $type->getLength(), $label . ' getLength' );
        }
        else
        {
            $this->assertSame( $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
            $this->assertSame( $expected['__toString']['return'], (string)$type, $label . ' __toString' );
            $this->assertSame( $expected['getLength']['return'], $type->getLength(), $label . ' getLength' );
        }
        $this->assertSame( trim( $expected['getRaw']['return'] ) . '@valid.com', $type->getRaw(), $label . ' getRaw' );
        unset( $type );
    }

    private function proceed_DomainPart( $label, $value, array $expected )
    {
        $iSize = strlen( 'valid@' );
        $type  = new \Foundation\Type\Complex\CEmailAddress( 'valid@' . $value );
        $this->assertSame( $expected['isvalid']['return'], $type->isValid(), $label . ' isValid' );

        if( $expected['isvalid']['return'] === TRUE )
        {
            $this->assertSame( 'valid@' . $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
            $this->assertSame( 'valid@' . $expected['__toString']['return'], (string)$type, $label . ' __toString' );
            $this->assertSame( $expected['getLength']['return'] + $iSize, $type->getLength(), $label . ' getLength' );
        }
        else
        {
            $this->assertSame( $expected['getValue']['return'], $type->getValue(), $label . ' getValue' );
            $this->assertSame( $expected['__toString']['return'], (string)$type, $label . ' __toString' );
            $this->assertSame( $expected['getLength']['return'], $type->getLength(), $label . ' getLength' );
        }
        unset( $type );
    }

    private function proceedHostname( $label, $value, array $expected )
    {
        $iSize = strlen( 'valid@' );
        $type  = new \Foundation\Type\Complex\CEmailAddress( 'valid@' . $value );
        $this->assertSame( $expected['isvalid'], $type->isValid(), $label . ' isValid' );

        if( $expected['isvalid'] === TRUE )
        {
            $this->assertSame( 'valid@' . $expected['getValue'], $type->getValue(), $label . ' getValue' );
            $this->assertSame( 'valid@' . $expected['__toString'], (string)$type, $label . ' __toString' );
            $this->assertSame( 'valid@' . $expected['getPunycode'], $type->getPunycode(), $label . ' getPunycode' );
            $this->assertSame( $expected['getLength'] + $iSize, $type->getLength(), $label . ' getLength' );
        }
        else
        {
            $this->assertSame( $expected['getValue'], $type->getValue(), $label . ' getValue' );
            $this->assertSame( $expected['__toString'], (string)$type, $label . ' __toString' );
            $this->assertSame( $expected['getPunycode'], $type->getPunycode(), $label . ' getPunycode' );
            $this->assertSame( $expected['getLength'], $type->getLength(), $label . ' getLength' );
        }
        unset( $type );
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::setLocalPart
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testTypeNumeric_LocalPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_NUMERIC,
                require( realpath( __DIR__ . '/provider/result/cemailaddress_numeric_localpart.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_LocalPart( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testTypeNumeric_DomainPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_NUMERIC,
                require( realpath( __DIR__ . '/provider/result/cemailaddress_numeric_hostname.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_DomainPart( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::setLocalPart
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testTypeString_LocalPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_STRING,
                require( realpath( __DIR__ . '/provider/result/cemailaddress_string_localpart.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_LocalPart( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testTypeString_DomainPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_STRING,
                require( realpath( __DIR__ . '/provider/result/chostname_string.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_DomainPart( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::setLocalPart
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testUTF8_LocalPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_UTF8,
                require( realpath( __DIR__ . '/provider/result/cemailaddress_utf8_localpart.php' ) ) );
        foreach( $tests as $test )
        {
            if( !is_null( $test['expected']['getValue']['return'] ) )
            {
                $test['expected']['getValue']['return'] .= $test['expected']['getValue']['return'];
            }
            $test['expected']['__toString']['return'] .= $test['expected']['__toString']['return'];
            $test['expected']['getLength']['return'] = $test['expected']['getLength']['return'] * 2;
            $test['expected']['getRaw']['return'] .= $test['expected']['getRaw']['return'];
            $this->proceed_LocalPart( $test['label'], $test['test'] . $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testUTF8_DomainPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_UTF8,
                require( realpath( __DIR__ . '/provider/result/chostname_utf8.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_DomainPart( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::setLocalPart
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testXSS_LocalPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_XSS,
                require( realpath( __DIR__ . '/provider/result/cemailaddress_xss_localpart.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_LocalPart( $test['label'], $test['test'], $test['expected'] );
        }
        unset( $pProvider );
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testXSS_DomainPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_XSS,
                require( realpath( __DIR__ . '/provider/result/chostname_xss.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_DomainPart( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::setLocalPart
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getRaw
     * @group specification
     */
    public function testClass_LocalPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_EMAILADDRESS_LOCALPART,
                require( realpath( __DIR__ . '/provider/result/cemailaddress_localpart.php' ) ) );
        foreach( $tests as $test )
        {
            $this->proceed_LocalPart( $test['label'], $test['test'], $test['expected'] );
        }
    }

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::isValid
     * @covers \Foundation\Type\Complex\CEmailAddress::getValue
     * @covers \Foundation\Type\Complex\CEmailAddress::__tostring
     * @covers \Foundation\Type\Complex\CEmailAddress::getLength
     * @covers \Foundation\Type\Complex\CEmailAddress::getPunycode
     * @group specification
     */
    public function testClass_DomainPart()
    {
        $tests = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_HOSTNAME,
                require( realpath( __DIR__ . '/provider/result/chostname.php' ) ) );
        foreach( $tests as $test )
        {
            // IDN with tld
            $this->proceedHostname( $test['label'], $test['test']['idn'], $test['expected-idn']['tldmandatory'] );
            // Punycode with tld
            $this->proceedHostname( $test['label'], $test['test']['punycode'],
                                    $test['expected-punycode']['tldmandatory'] );
        }
    }

    /** DNS
     * **** */

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::checkDNS
     * @group specification
     */
    public function testDNS()
    {
        $bExpected = $this->isOnline();

        // No punycode
        $pEmail = new \Foundation\Type\Complex\CEmailAddress( '' );
        $this->assertFalse( $pEmail->checkDNS( FALSE ), 'Test: no punycode' );

        // Regular
        $pEmail->setValue( 'olivierjullien@outlook.com' );
        $this->assertSame( $bExpected, $pEmail->checkDNS( FALSE ), 'regular' );

        // UTF8
        $pEmail->setValue( 'contact@supernovæ.fr' );
        $this->assertSame( $bExpected, $pEmail->checkDNS( FALSE ), 'contact@supernovæ.fr' );

        // Deeper
        $pEmail->setValue( 'contact@上海世博会.中国' );
        $this->assertFalse( $pEmail->checkDNS( FALSE ), 'contact@上海世博会.中国 MX' );
        $this->assertSame( $bExpected, $pEmail->checkDNS( TRUE ), 'contact@上海世博会.中国 MX' );
    }

    /** TypeInterface
     * ************** */

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::setValue
     * @covers \Foundation\Type\Complex\CEmailAddress::getLocalPart
     * @covers \Foundation\Type\Complex\CEmailAddress::getDomainPart
     * @group specification
     */
    public function testTypeInterface()
    {
        $pValue = new \Foundation\Type\Complex\CEmailAddress( 'valid@上海世博会.中国' );
        $type   = new \Foundation\Type\Complex\CEmailAddress( $pValue );
        $this->assertTrue( $type->isValid(), 'CEmailAddress isValid' );
        $this->assertSame( 'valid@上海世博会.中国', $type->getValue(), 'CEmailAddress getValue' );
        $this->assertSame( 'valid@上海世博会.中国', (string)$type, 'CEmailAddress __toString' );
        $this->assertSame( 14, $type->getLength(), 'CEmailAddress getLength' );
        $this->assertSame( 'valid@xn--fhqya62el8j7s3b.xn--fiqs8s', $type->getPunycode(), 'CEmailAddress getPunycode' );
        $this->assertSame( 'valid@上海世博会.中国', $type->getRaw(), 'CEmailAddress getRaw' );
        $this->assertSame( '上海世博会.中国', $type->getDomainPart(), 'CEmailAddress getDomainPart' );
        $this->assertSame( 'valid', $type->getLocalPart(), 'CEmailAddress getLocalPart' );
        unset( $type, $pValue );

        $pValue = new \Foundation\Type\Simple\CString( 'valid@مثال.آزمایشی' );
        $type   = new \Foundation\Type\Complex\CEmailAddress( $pValue );
        $this->assertTrue( $type->isValid(), 'CString isValid' );
        $this->assertSame( 'valid@مثال.آزمایشی', $type->getValue(), 'CString getValue' );
        $this->assertSame( 'valid@مثال.آزمایشی', (string)$type, 'CString __toString' );
        $this->assertSame( 18, $type->getLength(), 'CString getLength' );
        $this->assertSame( 'valid@xn--mgbh0fb.xn--hgbk6aj7f53bba', $type->getPunycode(), 'CString getPunycode' );
        $this->assertSame( 'valid@مثال.آزمایشی', $type->getRaw(), 'CString getRaw' );
        $this->assertSame( 'مثال.آزمایشی', $type->getDomainPart(), 'CString getDomainPart' );
        $this->assertSame( 'valid', $type->getLocalPart(), 'CString getLocalPart' );
        unset( $type, $pValue );

        $type = new \Foundation\Type\Complex\CEmailAddress( TRUE );
        $this->assertFalse( $type->isValid(), 'NULL isValid' );
        $this->assertSame( NULL, $type->getValue(), 'NULL getValue' );
        $this->assertSame( '', (string)$type, 'NULL __toString' );
        $this->assertSame( 0, $type->getLength(), 'NULL getLength' );
        $this->assertSame( NULL, $type->getPunycode(), 'NULL getPunycode' );
        $this->assertSame( '', $type->getRaw(), 'NULL getRaw' );
        $this->assertSame( NULL, $type->getDomainPart(), 'NULL getDomainPart' );
        $this->assertSame( NULL, $type->getLocalPart(), 'NULL getLocalPart' );
        unset( $type );
    }

    /** Patterns
     * ********* */

    /**
     * @covers \Foundation\Type\Complex\CEmailAddress::getPatternEmailAddressLocalPartNoQuoted
     * @covers \Foundation\Type\Complex\CEmailAddress::getPatternEmailAddressLocalPartQuoted
     * @group specification
     */
    public function testGetPatterns()
    {
        $this->assertTrue( strlen( \Foundation\Type\Complex\CEmailAddress::getPatternEmailAddressLocalPartNoQuoted() ) > 0,
                                   'getPatternEmailAddressLocalPartNoQuoted' );
        $this->assertTrue( strlen( \Foundation\Type\Complex\CEmailAddress::getPatternEmailAddressLocalPartQuoted() ) > 0,
                                   'getPatternEmailAddressLocalPartQuoted' );
    }

}