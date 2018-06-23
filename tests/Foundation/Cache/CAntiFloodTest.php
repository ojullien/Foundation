<?php
namespace Test\Foundation\Cache;
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Exception/ExceptionInterface.php' ) );

class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Exception/InvalidArgumentException.php' ) );

interface_exists( '\Foundation\Cache\Storage\StorageInterface' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/Storage/StorageInterface.php' ) );

class_exists( '\Foundation\Cache\Storage\CStorageAbstract' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/Storage/CStorageAbstract.php' ) );

class_exists( '\Foundation\Cache\Storage\CApc' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/Storage/CApc.php' ) );

class_exists( '\Foundation\Cache\Storage\CArray' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/Storage/CArray.php' ) );

class_exists( '\Foundation\Cache\CAntiFlood' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/CAntiFlood.php' ) );

class CAntiFloodTest extends \PHPUnit_Framework_TestCase
{
    /** Class section
     * *************** */

    /**
     * Cache
     *
     * @var \Foundation\Cache\Storage\StorageInterface
     */
    private $_pCache = NULL;

    /**
     * Anti Flood
     *
     * @var \Foundation\Cache\CAntiFlood
     */
    private $_pObject = NULL;

    /**
     * Instances.
     */
    public function setUp()
    {
        $this->_pCache  = new \Foundation\Cache\Storage\CArray( APPLICATION_NAME . '_REG' );
        //$this->_pCache  = new \Foundation\Cache\Storage\CApc( APPLICATION_NAME . '_REG' );
        $this->_pObject = new \Foundation\Cache\CAntiFlood( $this->_pCache );
    }

    /**
     * Deinstances.
     */
    public function tearDown()
    {
        $this->_pCache->delete( $this->_pObject->getLockEntryLabel() );
        $this->_pCache->delete( $this->_pObject->getEventEntryLabel() );
        unset( $this->_pObject, $this->_pCache );
    }

    /** Test section
     * ************* */

    /**
     * @covers \Foundation\Cache\CAntiFlood::prevent
     * @group specification
     */
    public function testLocked()
    {
        $this->assertTrue( $this->_pCache->store( $this->_pObject->getLockEntryLabel(), 'on' ), 'store' );
        $this->assertTrue( $this->_pObject->prevent( $this->_pCache ), 'prevent' );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::prevent
     * @group specification
     */
    public function testNoData()
    {
        $this->assertFalse( $this->_pObject->prevent( $this->_pCache ) );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::prevent
     * @group specification
     */
    public function testOldData()
    {
        $this->assertTrue( $this->_pCache->store( $this->_pObject->getEventEntryLabel(),
                                                  [
                    'time'  => time() - 3600,
                    'count' => 1 ], 'store' ) );
        $this->assertFalse( $this->_pObject->prevent( $this->_pCache ) );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::prevent
     * @group specification
     */
    public function testThreshold()
    {
        $iThreshold = $this->_pObject->getEventThreshold();
        for( $iIndex = 0; $iIndex < $iThreshold; $iIndex++ )
        {
            $this->assertFalse( $this->_pObject->prevent( $this->_pCache ) );
            sleep( 1 );
        }
        $this->assertTrue( $this->_pObject->prevent( $this->_pCache ) );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setLockEntryLabel
     * @covers \Foundation\Cache\CAntiFlood::getLockEntryLabel
     * @group specification
     */
    public function testGetLockEntryLabel()
    {
        static $sValue = 'newvalue';
        $this->assertSame( $sValue, $this->_pObject->setLockEntryLabel( $sValue )->getLockEntryLabel() );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setLockEntryLabel
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testSetLockEntryLabelException()
    {
        $this->_pObject->setLockEntryLabel( '  ' );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setEventEntryLabel
     * @covers \Foundation\Cache\CAntiFlood::getEventEntryLabel
     * @group specification
     */
    public function testGetEventEntryLabel()
    {
        static $sValue = 'newvalue';
        $this->assertSame( $sValue, $this->_pObject->setEventEntryLabel( $sValue )->getEventEntryLabel() );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setEventEntryLabel
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testSetEventEntryLabelException()
    {
        $this->_pObject->setEventEntryLabel( '  ' );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setLockSleep
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testSetLockSleepException()
    {
        $this->_pObject->setLockSleep( -1 );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setLockRetry
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testSetLockRetryException()
    {
        $this->_pObject->setLockRetry( -1 );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setEventLifeTime
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testSetEventLifeTimeException()
    {
        $this->_pObject->setEventLifeTime( -1 );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setEventThreshold
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testSetEventThresholdException()
    {
        $this->_pObject->setEventThreshold( -1 );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setLockSleep
     * @covers \Foundation\Cache\CAntiFlood::setLockRetry
     * @covers \Foundation\Cache\CAntiFlood::setEventLifeTime
     * @group specification
     */
    public function testSetters()
    {
        $this->_pObject->setLockSleep( 10 )->setLockRetry( 20 )->setEventLifeTime( 30 );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Cache\CAntiFlood::setEventThreshold
     * @covers \Foundation\Cache\CAntiFlood::getEventThreshold
     * @group specification
     */
    public function testGetEventThreshold()
    {
        static $iValue = 666;
        $this->assertSame( $iValue, $this->_pObject->setEventThreshold( $iValue )->getEventThreshold() );
    }

}