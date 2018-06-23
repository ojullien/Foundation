<?php
namespace Foundation\Test\Log\Writer;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );

defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );
interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );
class_exists( '\Foundation\Type\Complex\CPath' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CPath.php' ) );

defined( 'FOUNDATION_FILE_PATH' ) || define( 'FOUNDATION_FILE_PATH', APPLICATION_PATH . '/src/Foundation/File' );
class_exists( '\Foundation\File\CDirectory' ) || require( realpath( FOUNDATION_FILE_PATH . '/CDirectory.php' ) );

class_exists( '\Foundation\Test\Framework\Provider\CDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php' ) );

class CDirectoryTest extends \PHPUnit_Framework_TestCase
{
    /** Class section
     * *************** */

    /**
     * Loads data.
     */
    public static function setUpBeforeClass()
    {
        static::$_pPath = new \Foundation\Type\Complex\CPath( NULL );

        $aTests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_PATH,
                require( realpath( __DIR__ . '/provider/result/cdirectory_path.php' ) ) );

        foreach( $aTests as $test )
        {
            $expected = &$test['expected'];
            if( $expected['exception'] == 3 )
            {
                static::$_aException[] = $test;
            }
            elseif( $expected['exception'] == 0 )
            {
                static::$_aValid[] = $test;
            }
        }
    }

    public static function tearDownAfterClass()
    {
        static::$_pPath = NULL;
    }

    /** Test section
     * ************* */
    protected static $_pPath      = NULL;
    protected static $_aException = NULL;
    protected static $_aValid     = NULL;

    /**
     * @covers \Foundation\File\CDirectory
     * @group specification
     */
    public function testException()
    {
        foreach( static::$_aException as $data )
        {
            $label = $data['label'];
            $value = $data['test'];

            try
            {
                static::$_pPath->setValue( $value );
                $pObject = new \Foundation\File\CDirectory( static::$_pPath );
                unset( $pObject );
                $this->fail( $label . ' No exception raised.' );
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
     * @covers \Foundation\File\CDirectory
     * @group specification
     */
    public function testValid()
    {
        foreach( static::$_aValid as $data )
        {
            $label    = $data['label'];
            $value    = $data['test'];
            $expected = &$data['expected'];

            static::$_pPath->setValue( $value );
            $pObject = new \Foundation\File\CDirectory( static::$_pPath );
            $this->assertSame( $expected['__toString']['return'], (string)$pObject, $label . ' __toString' );
            unset( $pObject );
        }
    }

    /**
     * @covers \Foundation\File\CDirectory::createDirectory
     * @group specification
     */
    public function testCreateDirectory()
    {
        $aTests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_DIRECTORY,
                require( realpath( __DIR__ . '/provider/result/cdirectory.php' ) ) );

        foreach( $aTests as $data )
        {
            $label    = $data['label'];
            $value    = $data['test'];
            $expected = &$data['expected'];

            static::$_pPath->setValue( $value );
            $pDirectory = new \Foundation\File\CDirectory( static::$_pPath );
            $this->assertSame( $expected['__toString']['return'], (string)$pDirectory, $label . ' tostring' );
            $this->assertSame( $expected['exists'], file_exists( $value ), $label . ' file_exists' );
            $this->assertSame( $expected['createDirectory']['return'], $pDirectory->createDirectory(),
                               $label . ' createDirectory' );
            sleep( 1 );
            unset( $pDirectory );
            if( $expected['todelete'] )
            {
                $this->assertTRUE( is_dir( $value ), $label . ' created' );
                $this->assertTRUE( rmdir( $value ), $label . ' rmdir' );
                $this->assertFALSE( is_dir( $value ), $label . ' deleted' );
            }
        }
    }

}