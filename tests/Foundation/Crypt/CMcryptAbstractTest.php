<?php
namespace Test\Foundation\Crypt;
class_exists( '\Test\Foundation\Crypt\Provider\CMcrypt' ) || require( realpath( APPLICATION_PATH . '/tests/Foundation/Crypt/Provider/CMcryptClasses.php' ) );

class CMcryptAbstractTest extends \PHPUnit_Framework_TestCase
{
    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Crypt\CMcryptAbstract
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testAlgoEmpty()
    {
        $p = new \Test\Foundation\Crypt\Provider\CMcryptAlgoEmpty();
    }

    /**
     * @covers \Foundation\Crypt\CMcryptAbstract
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testModeEmpty()
    {
        $p = new \Test\Foundation\Crypt\Provider\CMcryptModeEmpty();
    }

    /**
     * @covers \Foundation\Crypt\CMcryptAbstract
     * @group specification
     * @expectedException \RuntimeException
     */
    public function testAlgoNotValid()
    {
        $p = @new \Test\Foundation\Crypt\Provider\CMcryptAlgoNotValid();
    }

    /**
     * @covers \Foundation\Crypt\CMcryptAbstract
     * @group specification
     * @expectedException \RuntimeException
     */
    public function testModeNotValid()
    {
        $p = @new \Test\Foundation\Crypt\Provider\CMcryptModeNotValid();
    }

    /**
     * @covers \Foundation\Crypt\CMcryptAbstract
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testSetKeyException()
    {
        $pCypher = new \Test\Foundation\Crypt\Provider\CMcrypt();
        $pCypher->setKey( '   ' );
    }

    /**
     * @covers \Foundation\Crypt\CMcryptAbstract
     * @group specification
     */
    public function testSetKey()
    {
        $pCypher = new \Test\Foundation\Crypt\Provider\CMcrypt();
        $this->assertSame( '5d6c518bbda6a0da20a4c3d2', $pCypher->setKey( 'Olivier Jullien' )->getKey() );
        unset( $pCypher );
    }

}