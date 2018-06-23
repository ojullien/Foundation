<?php
namespace Foundation\Test\Loader;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\BadMethodCallException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );

defined( 'FOUNDATION_LOADER_PATH' ) || define( 'FOUNDATION_LOADER_PATH', APPLICATION_PATH . '/src/Foundation/Loader' );
interface_exists( '\Foundation\Loader\LoaderInterface' ) || require( realpath( FOUNDATION_LOADER_PATH . '/LoaderInterface.php' ) );
class_exists( '\Foundation\Loader\CClassMapLoader' ) || require( realpath( FOUNDATION_LOADER_PATH . '/CClassMapLoader.php' ) );

class CClassMapLoaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Contains original autoloaders.
     * @var array
     */
    protected $_aLoaders = null;

    /**
     * Instance of the current autoloader.
     * @var \Foundation\Loader\CClassMapLoader
     */
    protected $_pLoader = null;

    /**
     * Contains original include_path.
     * @var string
     */
    protected $_sIncludePath = null;

    /**
     *
     */
    public function setUp()
    {
        // Store original autoloaders
        $this->_aLoaders = spl_autoload_functions();
        if( !is_array( $this->_aLoaders ) )
        {
            // spl_autoload_functions does not return empty array when no
            // autoloaders registered...
            $this->_aLoaders = [ ];
        }

        // Store original include_path
        $this->_sIncludePath = get_include_path();

        $this->_pLoader = new \Foundation\Loader\CClassMapLoader();
    }

    /**
     *
     */
    public function tearDown()
    {
        // Restore original autoloaders
        $loaders = spl_autoload_functions();
        if( is_array( $loaders ) )
        {
            foreach( $loaders as $loader )
            {
                spl_autoload_unregister( $loader );
            }
        }

        foreach( $this->_aLoaders as $loader )
        {
            spl_autoload_register( $loader );
        }

        // Restore original include_path
        set_include_path( $this->_sIncludePath );

        $this->_pLoader = NULL;
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testRegisteringNonExistentAutoloadMapRaisesInvalidArgumentException()
    {
        $file = __DIR__ . '__foobar__';
        $this->_pLoader->setOptions( [ $file ] );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testValidMapFileNotReturningMapRaisesInvalidArgumentException()
    {
        $file = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tests'
                . DIRECTORY_SEPARATOR . 'Providers'
                . DIRECTORY_SEPARATOR . 'loader'
                . DIRECTORY_SEPARATOR . 'badmap.php';
        $this->_pLoader->setOptions( [ $file ] );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testAllowsRegisteringArrayAutoloadMapDirectly()
    {
        $map  = array(
            'Foundation\Exception\UnderflowException' => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'src'
            . DIRECTORY_SEPARATOR . 'Foundation'
            . DIRECTORY_SEPARATOR . 'Exception'
            . DIRECTORY_SEPARATOR . 'UnderflowException.php' );
        $this->_pLoader->setOptions( [ $map ] );
        $test = $this->_pLoader->getAutoloadMap();
        $this->assertSame( $map, $test );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testAllowsRegisteringArrayAutoloadMapViaConstructor()
    {
        $map    = array(
            'Foundation\Exception\UnderflowException' => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'src'
            . DIRECTORY_SEPARATOR . 'Foundation'
            . DIRECTORY_SEPARATOR . 'Exception'
            . DIRECTORY_SEPARATOR . 'UnderflowException.php' );
        $loader = new \Foundation\Loader\CClassMapLoader( [ $map ] );
        $test   = $loader->getAutoloadMap();
        $this->assertSame( $map, $test );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testRegisteringValidMapFilePopulatesAutoloader()
    {
        $file = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tests'
                . DIRECTORY_SEPARATOR . 'Providers'
                . DIRECTORY_SEPARATOR . 'loader'
                . DIRECTORY_SEPARATOR . 'goodmap.php';
        $this->_pLoader->setOptions( [ $file ] );
        $map1 = $this->_pLoader->getAutoloadMap();
        $this->assertTrue( is_array( $map1 ) );
        $this->assertEquals( 2, count( $map1 ) );
        // Just to make sure nothing changes after loading the same map again
        // (loadMapFromFile should just return)
        $this->_pLoader->setOptions( [ $file ] );
        $map2 = $this->_pLoader->getAutoloadMap();
        $this->assertTrue( is_array( $map2 ) );
        $this->assertEquals( 2, count( $map2 ) );
        $this->assertSame( $map1, $map2 );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testRegisteringMultipleMapsMergesThem()
    {
        $exceptionPath = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'src'
                . DIRECTORY_SEPARATOR . 'Foundation'
                . DIRECTORY_SEPARATOR . 'Exception';

        $map = array(
            'Foundation\Exception\OutOfBoundsException' => $exceptionPath . DIRECTORY_SEPARATOR . 'OutOfBoundsException.php',
            'Foundation\Exception\UnderflowException'   => $exceptionPath . DIRECTORY_SEPARATOR . 'bogus.php' );

        $this->_pLoader->setOptions( [ $map ] );

        $file = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tests'
                . DIRECTORY_SEPARATOR . 'Providers'
                . DIRECTORY_SEPARATOR . 'loader'
                . DIRECTORY_SEPARATOR . 'goodmap.php';

        $this->_pLoader->setOptions( [ $file ] );

        $test = $this->_pLoader->getAutoloadMap();
        $this->assertTrue( is_array( $test ) );
        $this->assertEquals( 3, count( $test ) );
        $this->assertNotEquals( $map['Foundation\Exception\UnderflowException'],
                                $test['Foundation\Exception\UnderflowException'] );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testCanRegisterMultipleMapsAtOnce()
    {
        $exceptionPath = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'src'
                . DIRECTORY_SEPARATOR . 'Foundation'
                . DIRECTORY_SEPARATOR . 'Exception';

        $map = [
            'Foundation\Exception\OutOfBoundsException' => $exceptionPath . DIRECTORY_SEPARATOR . 'OutOfBoundsException.php',
            'Foundation\Exception\UnderflowException'   => $exceptionPath . DIRECTORY_SEPARATOR . 'bogus.php' ];

        $file = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tests'
                . DIRECTORY_SEPARATOR . 'Providers'
                . DIRECTORY_SEPARATOR . 'loader'
                . DIRECTORY_SEPARATOR . 'goodmap.php';

        $this->_pLoader->setOptions( [ $map, $file ] );

        $test = $this->_pLoader->getAutoloadMap();
        $this->assertTrue( is_array( $test ) );
        $this->assertEquals( 3, count( $test ) );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testRegisterMapsThrowsExceptionForNonTraversableArguments()
    {
        $tests = [ true, NULL, 1, 1.0, new \stdClass ];
        foreach( $tests as $test )
        {
            try
            {
                $this->_pLoader->setOptions( array( $test ) );
                $this->fail( 'Should not register non-traversable arguments' );
            }
            catch( \Foundation\Exception\InvalidArgumentException $exc )
            {
                $this->assertTrue( TRUE );
            }
            catch( \Exception $exc )
            {
                $this->fail( $label . ' No the expected exception.' );
            }
        }
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testAutoloadLoadsClasses()
    {
        $file   = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tests'
                . DIRECTORY_SEPARATOR . 'Providers'
                . DIRECTORY_SEPARATOR . 'loader'
                . DIRECTORY_SEPARATOR . 'ClassMappedClass.php';
        $map    = array( 'FoundationTest\UnusualNamespace\ClassMappedClass' => $file );
        $this->_pLoader->setOptions( [ $map ] );
        $loaded = $this->_pLoader->autoload( 'FoundationTest\UnusualNamespace\ClassMappedClass' );
        $this->assertSame( 'FoundationTest\UnusualNamespace\ClassMappedClass', $loaded );
        $this->assertTrue( class_exists( 'FoundationTest\UnusualNamespace\ClassMappedClass', false ) );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testIgnoresClassesNotInItsMap()
    {
        $file = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tests'
                . DIRECTORY_SEPARATOR . 'Providers'
                . DIRECTORY_SEPARATOR . 'loader'
                . DIRECTORY_SEPARATOR . 'ClassMappedClass.php';
        $map  = array( 'FoundationTest\UnusualNamespace\ClassMappedClass' => $file );
        $this->_pLoader->setOptions( [ $map ] );
        $this->assertFalse( $this->_pLoader->autoload( 'FoundationTest\UnusualNamespace\UnMappedClass' ) );
        $this->assertFalse( class_exists( 'FoundationTest\UnusualNamespace\UnMappedClass', false ) );
    }

    /**
     * @covers \Foundation\Loader\CClassMapLoader
     * @group specification
     */
    public function testRegisterRegistersCallbackWithSplAutoload()
    {
        $this->_pLoader->register();
        $loaders = spl_autoload_functions();
        $this->assertTrue( count( $this->_aLoaders ) < count( $loaders ) );
        $test    = array_shift( $loaders );
        $this->assertEquals( array( $this->_pLoader, 'autoload' ), $test );
    }

}