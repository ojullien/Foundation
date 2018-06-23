<?php
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );
interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Complex\CHostname' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CHostname.php' ) );
class_exists( '\Foundation\Type\Complex\CEmailAddress' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CEmailAddress.php' ) );
class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );

defined( 'FOUNDATION_FORM_PATH' ) || define( 'FOUNDATION_FORM_PATH', APPLICATION_PATH . '/src/Foundation/Form' );
interface_exists( '\Foundation\Form\ValidatorInterface' ) || require( realpath( FOUNDATION_FORM_PATH . '/ValidatorInterface.php' ) );
class_exists( '\Foundation\Form\CValidatorAbstract' ) || require( realpath( FOUNDATION_FORM_PATH . '/CValidatorAbstract.php' ) );
class_exists( '\Foundation\Test\Form\CValidateVar' ) || require( realpath( __DIR__ . '/provider/CValidateVar.php' ) );
class_exists( '\Foundation\Test\Form\CValidateCheckboxVar' ) || require( realpath( __DIR__ . '/provider/CValidateCheckboxVar.php' ) );
class_exists( '\Foundation\Test\Form\CValidateEmailVar' ) || require( realpath( __DIR__ . '/provider/CValidateEmailVar.php' ) );
class_exists( '\Foundation\Test\Form\CValidator' ) || require( realpath( __DIR__ . '/provider/CValidator.php' ) );

class CValidatorAbstractTest extends \PHPUnit_Framework_TestCase
{
    /** Test section
     * ************** */

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateVar
     * @group specification
     */
    public function testValidateVarNull()
    {
        $pObject = new \Foundation\Test\Form\CValidateVar( ['DOESNOTEXIST' => FILTER_UNSAFE_RAW ] );
        $this->assertFalse( $pObject->setData( ['DOESEXIST' => 1 ] )->isValid(), 'isValid' );
        $this->assertSame( ['DOESEXIST' => 1 ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['DOESNOTEXIST' => NULL ], $pObject->getData(), 'getData' );
        $this->assertSame( ['DOESNOTEXIST' => 'DOESNOTEXIST is mandatory.' ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateVar
     * @group specification
     */
    public function testValidateVarFalse()
    {
        $pObject = new \Foundation\Test\Form\CValidateVar( ['NOTANIP' => FILTER_VALIDATE_IP ] );
        $this->assertFalse( $pObject->setData( ['NOTANIP' => 'NOTANIP' ] )->isValid(), 'isValid' );
        $this->assertSame( ['NOTANIP' => 'NOTANIP' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['NOTANIP' => FALSE ], $pObject->getData(), 'getData' );
        $this->assertSame( ['NOTANIP' => 'NOTANIP is not valid.' ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateVar
     * @group specification
     */
    public function testValidateVar()
    {
        $pObject = new \Foundation\Test\Form\CValidateVar( ['IPV6' => FILTER_VALIDATE_IP ] );
        $this->assertTrue( $pObject->setData( ['IPV6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334' ] )->isValid(),
                                              'isValid' );
        $this->assertSame( ['IPV6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['IPV6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334' ], $pObject->getData(), 'getData' );
        $this->assertSame( [ ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateCheckboxVar
     * @group specification
     */
    public function testValidateCheckboxVarNull()
    {
        $pObject = new \Foundation\Test\Form\CValidateCheckboxVar( ['DOESNOTEXIST' => FILTER_UNSAFE_RAW ] );
        $this->assertFalse( $pObject->setData( ['DOESEXIST' => 1 ] )->isValid(), 'isValid' );
        $this->assertSame( ['DOESEXIST' => 1 ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['DOESNOTEXIST' => NULL ], $pObject->getData(), 'getData' );
        $this->assertSame( ['DOESNOTEXIST' => 'DOESNOTEXIST is mandatory.' ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateCheckboxVar
     * @group specification
     */
    public function testValidateCheckboxVarFalse()
    {
        $pObject = new \Foundation\Test\Form\CValidateCheckboxVar( ['NOTANIP' => FILTER_VALIDATE_IP ] );
        $this->assertFalse( $pObject->setData( ['NOTANIP' => 'NOTANIP' ] )->isValid(), 'isValid' );
        $this->assertSame( ['NOTANIP' => 'NOTANIP' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['NOTANIP' => FALSE ], $pObject->getData(), 'getData' );
        $this->assertSame( ['NOTANIP' => 'NOTANIP is not valid.' ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateCheckboxVar
     * @group specification
     */
    public function testValidateCheckboxVar()
    {
        $pObject = new \Foundation\Test\Form\CValidateCheckboxVar( ['IPV6' => FILTER_VALIDATE_IP ] );
        $this->assertTrue( $pObject->setData( ['IPV6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334' ] )->isValid(),
                                              'isValid' );
        $this->assertSame( ['IPV6' => '2001:0db8:85a3:08d3:1319:8a2e:0370:7334' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['IPV6' => TRUE ], $pObject->getData(), 'getData' );
        $this->assertSame( [ ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::setMessage
     * @covers \Foundation\Form\CValidatorAbstract::getMessages
     * @covers \Foundation\Form\CValidatorAbstract::setData
     * @covers \Foundation\Form\CValidatorAbstract::getData
     * @covers \Foundation\Form\CValidatorAbstract::getDataRaw
     * @covers \Foundation\Form\CValidatorAbstract::hasValidated
     * @group specification
     */
    public function testAll()
    {
        static $aData = [ 'THE_KEY' => 'THE_DATA' ];

        $pObject = new \Foundation\Test\Form\CValidator( ['THE_KEY' => FILTER_UNSAFE_RAW ] );
        $this->assertTrue( $pObject->setData( $aData )->isValid(), 'setData' );
        $this->assertTrue( $pObject->hasValidated(), 'hasValidated' );
        $this->assertSame( $aData, $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( $aData, $pObject->getData(), 'getData' );
        $this->assertSame( [ 'ELEMENT_1' => 'The description for element 1',
            'ELEMENT_2' => 'The description for element 2' ], $pObject->getMessages(), 'getMessages' );
        $this->assertSame( [ 'ELEMENT_1' => 'The description for element 1' ], $pObject->getMessages( 'ELEMENT_1' ),
                                                                                                      'getMessages ELEMENT_1' );
        $this->assertSame( [ ], $pObject->getMessages( 'ELEMENT_3' ), 'getMessages ELEMENT_3' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateEmailVar
     * @group specification
     */
    public function testValidateEmailVarNull()
    {
        $pObject = new \Foundation\Test\Form\CValidateEmailVar( ['DOESNOTEXIST' => FILTER_UNSAFE_RAW ] );
        $this->assertFalse( $pObject->setData( ['DOESEXIST' => 'olivierjullien@outlook.com' ] )->isValid(), 'isValid' );
        $this->assertSame( ['DOESEXIST' => 'olivierjullien@outlook.com' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['DOESNOTEXIST' => NULL ], $pObject->getData(), 'getData' );
        $this->assertSame( ['DOESNOTEXIST' => 'DOESNOTEXIST is mandatory.' ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateEmailVar
     * @group specification
     */
    public function testValidateEmailVarFalse()
    {
        $pObject = new \Foundation\Test\Form\CValidateEmailVar( ['NOTANEMAIL' => FILTER_VALIDATE_IP ] );
        $this->assertFalse( $pObject->setData( ['NOTANEMAIL' => 'NOTANEMAIL' ] )->isValid(), 'isValid' );
        $this->assertSame( ['NOTANEMAIL' => 'NOTANEMAIL' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['NOTANEMAIL' => FALSE ], $pObject->getData(), 'getData' );
        $this->assertSame( ['NOTANEMAIL' => 'NOTANEMAIL is not valid.' ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateEmailVar
     * @group specification
     */
    public function testValidateEmailVarNotValid()
    {
        $pObject = new \Foundation\Test\Form\CValidateEmailVar( ['NOTANEMAIL' => FILTER_UNSAFE_RAW ] );
        $this->assertFalse( $pObject->setData( ['NOTANEMAIL' => 'NOTANEMAIL' ] )->isValid(), 'isValid' );
        $this->assertSame( ['NOTANEMAIL' => 'NOTANEMAIL' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['NOTANEMAIL' => FALSE ], $pObject->getData(), 'getData' );
        $this->assertSame( ['NOTANEMAIL' => 'NOTANEMAIL is not valid.' ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateEmailVar
     * @group specification
     */
    public function testValidateEmailVar()
    {
        $pObject = new \Foundation\Test\Form\CValidateEmailVar( ['ISANEMAIL' => FILTER_UNSAFE_RAW ] );
        $this->assertTrue( $pObject->setData( ['ISANEMAIL' => 'user.03@上海世博会.中国' ] )->isValid(), 'isValid' );
        $this->assertSame( ['ISANEMAIL' => 'user.03@上海世博会.中国' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['ISANEMAIL' => 'user.03@xn--fhqya62el8j7s3b.xn--fiqs8s' ], $pObject->getData(), 'getData' );
        $this->assertSame( [ ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateEmailVar
     * @group specification
     */
    public function testValidateEmailVarMXNotValid()
    {
        $pObject = new \Foundation\Test\Form\CValidateEmailVar( ['ISANEMAIL' => FILTER_UNSAFE_RAW ], TRUE );
        $this->assertFalse( $pObject->setData( ['ISANEMAIL' => 'user.03@上海世博会.中国' ] )->isValid(), 'isValid' );
        $this->assertSame( ['ISANEMAIL' => 'user.03@上海世博会.中国' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['ISANEMAIL' => FALSE ], $pObject->getData(), 'getData' );
        $this->assertSame( [ 'ISANEMAIL' => 'ISANEMAIL has not an resolvable to MX domain name system record.' ],
                           $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Form\CValidatorAbstract::validateEmailVar
     * @group specification
     */
    public function testValidateEmailVarMXValid()
    {
        $pObject = new \Foundation\Test\Form\CValidateEmailVar( ['ISANEMAIL' => FILTER_UNSAFE_RAW ], TRUE );
        $this->assertTrue( $pObject->setData( ['ISANEMAIL' => 'ojullien@supernovæ.fr' ] )->isValid(), 'isValid' );
        $this->assertSame( ['ISANEMAIL' => 'ojullien@supernovæ.fr' ], $pObject->getDataRaw(), 'getDataRaw' );
        $this->assertSame( ['ISANEMAIL' => 'ojullien@xn--supernov-q0a.fr' ], $pObject->getData(), 'getData' );
        $this->assertSame( [ ], $pObject->getMessages(), 'getMessages' );
        unset( $pObject );
    }

}