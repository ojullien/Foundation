<?php
namespace Foundation\Test\Framework\Provider;
class_exists( '\Foundation\Test\Framework\Provider\CDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php' ) );

trait TSessionDataTestProvider
{
    /** Tests section
     * ************** */

    /**
     * Provides data for tests.
     *
     * @param string $sNamespace Namespace of the data to test.
     * @param array  $aResult    Expected results.
     * @return array
     */
    public function getDataForTest( $sNamespace, array $aResult )
    {
        return \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests( $sNamespace, $aResult );
    }

    /**
     *
     */
    public function proceedTestGetName()
    {
        $this->assertTrue( (strlen( $this->object->getName() ) > 0 ), 'session_id' );
    }

    /**
     *
     * @throw \Foundation\Exception\BadMethodCallException
     */
    public function proceedTestSetNameException01()
    {
        $this->object->setName( APPLICATION_NAME . 'TSESSID' );
        $this->assertTrue( $this->object->start(), 'session_start' );
        $this->object->setName( APPLICATION_NAME . 'TSESSID' );
    }

    /**
     *
     * @param string $value
     * @throw \Foundation\Exception\InvalidArgumentException
     */
    public function proceedTestSetNameException02( $value )
    {
        $this->object->setName( 'a' . $value );
    }

    /**
     * Provider for testSetNameException
     *
     * @return array
     */
    public function getDataForSetNameException()
    {
        $tests   = $this->getDataForTest(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_UTF8,
                require( realpath( $this->getResultPath( \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_UTF8 ) . '_utf8.php' ) ) );
        $aReturn = [ ];
        foreach( $tests as $test )
        {
            if( $test['expected']['exception'] == 3 )
                $aReturn[] = $test;
        }
        return $aReturn;
    }

    /**
     *
     */
    public function proceedTestNotStarted()
    {
        // Check session_status
        $this->assertSame( PHP_SESSION_NONE, $this->object->status(), 'session_status' );
        // Check session_id
        $this->assertTrue( (strlen( $this->object->id() ) === 0 ), 'session_id' );
        // Check session_regenerate_id
        $this->assertFalse( $this->object->regenerateId(), 'session_regenerate_id' );
        $this->assertTrue( (strlen( $this->object->id() ) === 0 ), 'session_id after session_regenerate_id' );
        // Check write and read
        $this->object->setOffset( 0, 1 );
        $this->assertFalse( $this->object->existsOffset( 0 ), 'existsOffset 0 after setOffset' );
        $this->assertNull( $this->object->getOffset( 0 ), 'getOffset 0' );
        $this->object->unsetOffset( 0 );
        $this->object->setOffset( 'the_key', 'the_value' );
        $this->assertFalse( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after setOffset' );
        $this->assertNull( $this->object->getOffset( 'the_key' ), 'getOffset "the_key"' );
        $this->object->unsetOffset( 'the_key' );
        $this->object->setOffset( 'the_array', array( 'the_key' => 'the_value' ) );
        $this->assertFalse( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array" after setOffset' );
        $this->assertNull( $this->object->getOffset( 'the_array' ), 'getOffset "the_array"' );
        $this->object->unsetOffset( 'the_array' );
        // Check __tostring
        $this->assertTrue( (strlen( (string)$this->object ) === 0 ), 'string' );
        // Check session_unset
        $this->object->unsetSession();
        // Check session_write_close
        $this->object->writeAndClose();
        // Check write and read after session_write_close
        $this->object->setOffset( 0, 1 );
        $this->assertFalse( $this->object->existsOffset( 0 ), 'existsOffset 0 after session_write_close' );
        $this->assertNull( $this->object->getOffset( 0 ), 'getOffset 0 after session_write_close' );
        $this->object->unsetOffset( 0 );
        $this->object->setOffset( 'the_key', 'the_value' );
        $this->assertFalse( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after session_write_close' );
        $this->assertNull( $this->object->getOffset( 'the_key' ), 'getOffset "the_key" after session_write_close' );
        $this->object->unsetOffset( 'the_key' );
        $this->object->setOffset( 'the_array', array( 'the_key' => 'the_value' ) );
        $this->assertFalse( $this->object->existsOffset( 'the_array' ),
                                                         'existsOffset "the_array" after session_write_close' );
        $this->assertNull( $this->object->getOffset( 'the_array' ), 'getOffset "the_array" after session_write_close' );
        $this->object->unsetOffset( 'the_array' );
        // Check __tostring after session_write_close
        $this->assertTrue( (strlen( (string)$this->object ) === 0 ), 'string session_write_close' );
        // Check session_destroy
        $this->assertFalse( $this->object->destroy(), 'session_destroy' );
        $this->assertSame( PHP_SESSION_NONE, $this->object->status(), 'session_status' );
        $this->assertTrue( (strlen( $this->object->id() ) === 0 ), 'session_id' );
        // Check write and read after session_destroy
        $this->object->setOffset( 0, 1 );
        $this->assertFalse( $this->object->existsOffset( 0 ), 'existsOffset 0 after session_destroy' );
        $this->assertNull( $this->object->getOffset( 0 ), 'getOffset 0 after session_destroy' );
        $this->object->unsetOffset( 0 );
        $this->object->setOffset( 'the_key', 'the_value' );
        $this->assertFalse( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after session_destroy' );
        $this->assertNull( $this->object->getOffset( 'the_key' ), 'getOffset "the_key" after session_destroy' );
        $this->object->unsetOffset( 'the_key' );
        $this->object->setOffset( 'the_array', array( 'the_key' => 'the_value' ) );
        $this->assertFalse( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array" after session_destroy' );
        $this->assertNull( $this->object->getOffset( 'the_array' ), 'getOffset "the_array" after session_destroy' );
        $this->object->unsetOffset( 'the_array' );
        // Check __tostringafter session_destroy
        $this->assertTrue( (strlen( (string)$this->object ) === 0 ), 'string after session_destroy' );
    }

    /**
     *
     */
    public function proceedTestStarted()
    {
        // Set name
        $this->object->setName( APPLICATION_NAME . 'TSESSID' );
        // Check session_start
        $this->assertTrue( $this->object->start(), 'session_start' );
        $this->assertSame( PHP_SESSION_ACTIVE, $this->object->status(), 'session_status' );
        $this->assertTrue( $this->object->start(), 'session_start after session_start' );
        $this->assertSame( PHP_SESSION_ACTIVE, $this->object->status(), 'session_status after session_start' );
        // Check write and read
        $this->object->setOffset( 'the_key', 'the_value' );
        $this->assertTrue( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after setOffset' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ), 'getOffset "the_key"' );
        // Check session_id and session_regenerate_id
        $SessionIdOld = $this->object->id();
        $this->assertTrue( (strlen( $SessionIdOld ) > 0 ), 'session_id old' );
        $this->assertTrue( $this->object->regenerateId(), 'session_regenerate_id' );
        $SessionIdNew = $this->object->id();
        $this->assertTrue( (strlen( $SessionIdNew ) > 0 ), 'session_id new' );
        $this->assertFalse( $SessionIdOld == $SessionIdNew, 'session_id comparaison' );
        // Check write and read after session_regenerate_id
        $this->assertTrue( $this->object->existsOffset( 'the_key' ),
                                                        'existsOffset "the_key" after session_regenerate_id' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ),
                                                                  'getOffset "the_key" after session_regenerate_id' );
        $this->object->setOffset( 0, 1 );
        $this->assertTrue( $this->object->existsOffset( 0 ), 'existsOffset 0 after setOffset' );
        $this->assertSame( 1, $this->object->getOffset( 0 ), 'getOffset 0' );
        $this->object->setOffset( 'the_array', array( 'the_key' => 'the_value' ) );
        $this->assertTrue( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array" after setOffset' );
        $this->assertEquals( array( 'the_key' => 'the_value' ), $this->object->getOffset( 'the_array' ),
                                                                                          'getOffset "the_array"' );
        // Check unset
        $this->object->unsetOffset( 0 );
        $this->assertFalse( $this->object->existsOffset( 0 ), 'existsOffset 0 after unsetOffset' );
        $this->assertNull( $this->object->getOffset( 0 ), 'getOffset 0 after unsetOffset' );
        $this->object->unsetOffset( 'the_array' );
        $this->assertFalse( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array" after unsetOffset' );
        $this->assertNull( $this->object->getOffset( 'the_array' ), 'getOffset "the_array" after unsetOffset' );
        $this->assertTrue( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after unsetOffset' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ), 'getOffset "the_key" unsetOffset' );
        // Check Does not exist
        $this->assertFalse( $this->object->existsOffset( 'doesnotexist' ), 'existsOffset "doesnotexist"' );
        $this->assertNull( $this->object->getOffset( 'doesnotexist' ), 'getOffset "doesnotexist"' );
        // Check __tostring
        $this->assertTrue( (strlen( (string)$this->object ) > 0 ), 'string' );
        // Check session_unset
        $this->object->unsetSession();
        $this->assertFalse( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after session_unset' );
        $this->assertNull( $this->object->getOffset( 'the_key' ), 'getOffset "the_key" after session_unset' );
        // Check __tostring
        $this->assertTrue( (strlen( (string)$this->object ) > 0 ), 'string after session_unset' );
        // Check write and read after session_unset
        $this->object->setOffset( 'the_key', 'the_value' );
        $this->assertTrue( $this->object->existsOffset( 'the_key' ),
                                                        'existsOffset "the_key" after setOffset after session_unset' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ),
                                                                  'getOffset "the_key" after setOffset after session_unset' );
        // Check session_destroy
        $this->assertTrue( $this->object->destroy(), 'session_destroy' );
        $this->assertSame( PHP_SESSION_NONE, $this->object->status(), 'session_status after session_destroy' );
        $this->assertTrue( (strlen( $this->object->id() ) === 0 ), 'session_id after session_destroy' );
        // Check write and read after session_destroy
        $this->object->setOffset( 0, 1 );
        $this->assertFalse( $this->object->existsOffset( 0 ), 'existsOffset 0 after session_destroy' );
        $this->assertNull( $this->object->getOffset( 0 ), 'getOffset 0 after session_destroy' );
        $this->object->setOffset( 'the_key', 'the_value' );
        $this->assertFalse( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after session_destroy' );
        $this->assertNull( $this->object->getOffset( 'the_key' ), 'getOffset "the_key" after session_destroy' );
        $this->object->setOffset( 'the_array', array( 'the_key' => 'the_value' ) );
        $this->assertFalse( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array" after session_destroy' );
        $this->assertNull( $this->object->getOffset( 'the_array' ), 'getOffset "the_array" after session_destroy' );
        // Check __tostring after session_destroy
        $this->assertTrue( (strlen( (string)$this->object ) === 0 ), 'string after session_destroy' );
    }

    /**
     *
     */
    public function proceedTestWriteAndClose()
    {
        // Set name
        $this->object->setName( APPLICATION_NAME . 'TSESSID' );
        // Check session_start
        $this->assertTrue( $this->object->start(), 'session_start' );
        $this->assertSame( PHP_SESSION_ACTIVE, $this->object->status(), 'session_status' );
        // Check write and read
        $this->object->setOffset( 'the_key', 'the_value' );
        $this->assertTrue( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key"' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ), 'getOffset "the_key"' );
        $this->object->setOffset( 0, 1 );
        $this->assertTrue( $this->object->existsOffset( 0 ), 'existsOffset 0' );
        $this->assertSame( 1, $this->object->getOffset( 0 ), 'getOffset 0' );
        $this->object->setOffset( 'the_array', array( 'the_key' => 'the_value' ) );
        $this->assertTrue( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array"' );
        $this->assertEquals( array( 'the_key' => 'the_value' ), $this->object->getOffset( 'the_array' ),
                                                                                          'getOffset "the_array"' );
        // Keep session id
        $SessionIdBefore = $this->object->id();
        $this->assertTrue( (strlen( $SessionIdBefore ) > 0 ), 'session_id before session_write_close' );
        // Check session_write_close
        $this->object->writeAndClose();
        // Check session_status
        $this->assertSame( PHP_SESSION_NONE, $this->object->status(), 'session_status' );
        // Check session_id
        $SessionIdOld    = $this->object->id();
        $this->assertTrue( $SessionIdOld == $SessionIdBefore, 'session_id comparaison 1' );
        // Check session_regenerate_id
        $this->assertFalse( $this->object->regenerateId(), 'session_regenerate_id' );
        $SessionIdNew    = $this->object->id();
        $this->assertTrue( $SessionIdOld == $SessionIdNew, 'session_id comparaison 2' );
        $this->assertTrue( $SessionIdBefore == $SessionIdNew, 'session_id comparaison 3' );
        // Check unset
        $this->object->unsetOffset( 'the_key' );
        $this->object->unsetOffset( 0 );
        $this->object->unsetOffset( 'the_array' );
        // Check session_unset
        $this->object->unsetSession();
        // Check read
        $this->assertTrue( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after session_write_close' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ),
                                                                  'getOffset "the_key" after session_write_close' );
        $this->assertTrue( $this->object->existsOffset( 0 ), 'existsOffset 0 after session_write_close' );
        $this->assertSame( 1, $this->object->getOffset( 0 ), 'getOffset 0 after session_write_close' );
        $this->assertTrue( $this->object->existsOffset( 'the_array' ),
                                                        'existsOffset "the_array" after session_write_close' );
        $this->assertEquals( array( 'the_key' => 'the_value' ), $this->object->getOffset( 'the_array' ),
                                                                                          'getOffset "the_array" after session_write_close' );
        // Check write
        $this->object->setOffset( 'the_key', 'the_new_value' );
        $this->assertTrue( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after update' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ), 'getOffset "the_key" after update' );
        $this->object->setOffset( 0, 2 );
        $this->assertTrue( $this->object->existsOffset( 0 ), 'existsOffset 0 after update' );
        $this->assertSame( 1, $this->object->getOffset( 0 ), 'getOffset 0 after update' );
        $this->object->setOffset( 'the_array', array( 'the_key' => 'the_new_value' ) );
        $this->assertTrue( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array" after update' );
        $this->assertEquals( array( 'the_key' => 'the_value' ), $this->object->getOffset( 'the_array' ),
                                                                                          'getOffset "the_array" after update' );
        // Check __tostring
        $this->assertTrue( (strlen( (string)$this->object ) > 0 ), 'string' );
        // Check session_destroy
        $this->assertFalse( $this->object->destroy(), 'session_destroy' );
        $this->assertSame( PHP_SESSION_NONE, $this->object->status(), 'session_status after session_destroy' );
        $this->assertTrue( (strlen( $this->object->id() ) > 0 ), 'session_id after session_destroy' );
        $this->assertTrue( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" after session_write_close' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ),
                                                                  'getOffset "the_key" after session_write_close' );
        $this->assertTrue( $this->object->existsOffset( 0 ), 'existsOffset 0 after session_write_close' );
        $this->assertSame( 1, $this->object->getOffset( 0 ), 'getOffset 0 after session_write_close' );
        $this->assertTrue( $this->object->existsOffset( 'the_array' ),
                                                        'existsOffset "the_array" after session_write_close' );
        $this->assertEquals( array( 'the_key' => 'the_value' ), $this->object->getOffset( 'the_array' ),
                                                                                          'getOffset "the_array" after session_write_close' );
        $this->assertTrue( (strlen( (string)$this->object ) > 0 ), 'string' );
        // Check session_start
        $this->assertTrue( $this->object->start(), 'session_start again' );
        $this->assertSame( PHP_SESSION_ACTIVE, $this->object->status(), 'session_status again' );
        $this->assertTrue( $this->object->existsOffset( 'the_key' ), 'existsOffset "the_key" again' );
        $this->assertSame( 'the_value', $this->object->getOffset( 'the_key' ), 'getOffset "the_key" again' );
        $this->assertTrue( $this->object->existsOffset( 0 ), 'existsOffset 0 again' );
        $this->assertSame( 1, $this->object->getOffset( 0 ), 'getOffset 0 again' );
        $this->assertTrue( $this->object->existsOffset( 'the_array' ), 'existsOffset "the_array" again' );
        $this->assertEquals( array( 'the_key' => 'the_value' ), $this->object->getOffset( 'the_array' ),
                                                                                          'getOffset "the_array" again' );
        $this->assertTrue( (strlen( (string)$this->object ) > 0 ), 'string again' );
        $SessionIdNew    = $this->object->id();
        $this->assertTrue( $SessionIdBefore == $SessionIdNew, 'session_id comparaison again' );
        // Destroy
        $this->assertTrue( $this->object->destroy(), 'session_destroy' );
    }

    /**
     * @throw Foundation\Exception\OutOfBoundsException
     */
    public function proceedTestExceptionContainer()
    {
        $this->assertTrue( $this->object->start(), 'session_start' );
        $this->assertSame( PHP_SESSION_ACTIVE, $this->object->status(), 'session_status' );
        $this->object->setOffset( 'the_key', 'the_value', 123 );
    }

    /**
     * @throw Foundation\Exception\OutOfBoundsException
     */
    public function proceedTestExceptionOffset()
    {
        $this->assertTrue( $this->object->start(), 'session_start' );
        $this->assertSame( PHP_SESSION_ACTIVE, $this->object->status(), 'session_status' );
        $this->object->setOffset( TRUE, 'the_value' );
    }

    /**
     * @throw Foundation\Exception\BadMethodCallException
     */
    public function proceedTestSetNameStartedException()
    {
        $this->assertTrue( $this->object->start(), 'session_start' );
        $this->assertSame( PHP_SESSION_ACTIVE, $this->object->status(), 'session_status' );
        $this->object->setName( APPLICATION_NAME . 'TSESSID' );
    }

}