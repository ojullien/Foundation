<?php
namespace Test\Foundation\Cache\Storage;
trait_exists( '\Test\Foundation\Cache\Storage\Provider\TCacheDataProvider' ) || require( realpath( APPLICATION_PATH . '/tests/Foundation/Cache/Storage/Provider/TCacheDataProvider.php' ) );

interface_exists( '\Foundation\Cache\Storage\StorageInterface' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/Storage/StorageInterface.php' ) );
class_exists( '\Foundation\Cache\Storage\CStorageAbstract' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/Storage/CStorageAbstract.php' ) );
class_exists( '\Foundation\Cache\Storage\CArray' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Cache/Storage/CArray.php' ) );

class CArrayTest extends \PHPUnit_Framework_TestCase
{

    use \Test\Foundation\Cache\Storage\Provider\TCacheDataProvider;

    /** Class section
     * *************** */

    /**
     * Cache
     *
     * @var \Foundation\Cache\Storage\StorageInterface
     */
    private $_pObject = NULL;

    /**
     * Instances.
     */
    public function setUp()
    {
        $this->_pObject = new \Foundation\Cache\Storage\CArray( 'FOUNDATION_TEST' );
    }

    /**
     * Deinstances.
     */
    public function tearDown()
    {
        unset( $this->_pObject );
    }

    /** Tests section
     * ************** */

    /**
     *
     * @param string $sLabel  Label for the test.
     * @param array  $aData   Input data.
     * @param array  $aResult Expected result.
     * @covers \Foundation\Cache\Storage\CArray
     * @covers \Foundation\Cache\Storage\CStorageAbstract
     * @group specification
     * @dataProvider getCacheData
     */
    public function testData( $sLabel, array $aData, array $aResult )
    {
        $this->assertFalse( $this->_pObject->exists( $aData['key'] ), 'Initial check for ' . $sLabel );

        $this->assertSame( $aResult['store'], $this->_pObject->store( $aData['key'], $aData['value'], $aData['ttl'] ),
                                                                      'store for ' . $sLabel );

        $this->assertSame( $aResult['exists'], $this->_pObject->exists( $aData['key'] ), 'exists for ' . $sLabel );

        $success = 'nuke';
        $this->assertSame( $aResult['fetch']['return'], $this->_pObject->fetch( $aData['key'], $success ),
                                                                                'fetch for ' . $sLabel );

        $this->assertSame( $aResult['fetch']['success'], $success, 'success for ' . $sLabel );

        $this->assertSame( $aResult['delete'], $this->_pObject->delete( $aData['key'] ), 'delete for ' . $sLabel );

        $this->assertFalse( $this->_pObject->exists( $aData['key'] ), 'final check for ' . $sLabel );
    }

    /**
     *
     * @param string $sLabel  Label for the test.
     * @param array  $aData   Input data.
     * @param array  $aResult Expected result.
     * @covers \Foundation\Cache\Storage\CArray
     * @covers \Foundation\Cache\Storage\CStorageAbstract
     * @group specification
     * @dataProvider getCacheDataTtl
     */
    public function testDataTTL( $sLabel, array $aData, array $aResult )
    {
        $this->assertFalse( $this->_pObject->exists( $aData['key'] ), 'Initial check for ' . $sLabel );

        $this->assertTrue( $this->_pObject->store( $aData['key'], $aData['value'], $aData['ttl'] ),
                                                   'store for ' . $sLabel );

        $this->assertTrue( $this->_pObject->exists( $aData['key'] ), 'exists for ' . $sLabel );

        $success = 'nuke';
        $this->assertSame( $aData['value'], $this->_pObject->fetch( $aData['key'], $success ), 'fetch for ' . $sLabel );

        $this->assertTrue( $success, 'success for ' . $sLabel );

        sleep( $aData['ttl'] + 2 );

        $this->assertFalse( $this->_pObject->exists( $aData['key'] ), 'exists after ttl for ' . $sLabel );

        $success = 'nuke';
        $this->assertFalse( $this->_pObject->fetch( $aData['key'], $success ), 'fetch after ttl for ' . $sLabel );

        $this->assertFalse( $success, 'success after ttl for ' . $sLabel );

        $this->assertFalse( $this->_pObject->delete( $aData['key'] ), 'delete after ttl for ' . $sLabel );
    }

    /**
     *
     * @param string $sLabel  Label for the test.
     * @param array  $aData   Input data.
     * @param array  $aResult Expected result.
     * @covers \Foundation\Cache\Storage\CArray
     * @covers \Foundation\Cache\Storage\CStorageAbstract
     * @group specification
     * @dataProvider getCacheDataTtl
     */
    public function testDataTTLDelete( $sLabel, array $aData, array $aResult )
    {
        $this->assertFalse( $this->_pObject->exists( $aData['key'] ), 'Initial check for ' . $sLabel );

        $this->assertTrue( $this->_pObject->store( $aData['key'], $aData['value'], $aData['ttl'] ),
                                                   'store for ' . $sLabel );

        $this->assertTrue( $this->_pObject->exists( $aData['key'] ), 'exists for ' . $sLabel );

        $success = 'nuke';
        $this->assertSame( $aData['value'], $this->_pObject->fetch( $aData['key'], $success ), 'fetch for ' . $sLabel );

        $this->assertTrue( $success, 'success for ' . $sLabel );

        $this->assertTrue( $this->_pObject->delete( $aData['key'] ), 'delete for ' . $sLabel );

        sleep( $aData['ttl'] + 2 );

        $this->assertFalse( $this->_pObject->exists( $aData['key'] ), 'exists after ttl for ' . $sLabel );

        $success = 'nuke';
        $this->assertFalse( $this->_pObject->fetch( $aData['key'], $success ), 'fetch after ttl for ' . $sLabel );

        $this->assertFalse( $success, 'success after ttl for ' . $sLabel );

        $this->assertFalse( $this->_pObject->delete( $aData['key'] ), 'delete after ttl for ' . $sLabel );
    }

    /**
     *
     * @param string $sLabel  Label for the test.
     * @param array  $aData   Input data.
     * @param array  $aResult Expected result.
     * @covers \Foundation\Cache\Storage\CArray
     * @covers \Foundation\Cache\Storage\CStorageAbstract
     * @group specification
     * @dataProvider getCacheKeyDoesNotExist
     */
    public function testKeyDoesNotExist( $sLabel, array $aData, array $aResult )
    {
        $success = 'nuke';

        $this->assertSame( $aResult['exists'], $this->_pObject->exists( $aData['key'] ), 'exists for ' . $sLabel );
        $this->assertSame( $aResult['fetch']['return'], $this->_pObject->fetch( $aData['key'], $success ),
                                                                                'fetch for ' . $sLabel );
        $this->assertSame( $aResult['fetch']['success'], $success, 'success for ' . $sLabel );
        $this->assertSame( $aResult['delete'], $this->_pObject->delete( $aData['key'] ), 'delete for ' . $sLabel );
    }

}