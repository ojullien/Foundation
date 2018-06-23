<?php
namespace Foundation\Test\Protocol\Connector;
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Simple\CString' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Simple/CString.php' ) );
class_exists( '\Foundation\Type\Complex\CPath' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CPath.php' ) );

trait_exists( '\Foundation\Test\Protocol\Connector\Provider\TConnectorProvider' ) || require( realpath( APPLICATION_PATH . '/tests/Foundation/Protocol/Connector/provider/TConnectorProvider.php' ) );

class_exists( '\Foundation\Protocol\Connector\CFile' ) || require( realpath( FOUNDATION_PROTOCOL_PATH . '/Connector/CFile.php' ) );

class CFileTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Protocol\Connector\Provider\TConnectorProvider;

    /** Class section
     * ************** */
    protected function setUp()
    {
        $this->loadData();
        $this->_pConnector = new \Foundation\Protocol\Connector\CFile();
    }

    /** Test section
     * ************* */

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testCheckURL01()
    {
        $this->proceedEmptyHost();
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testCheckURL02()
    {
        $sHost        = 'donotexist.fr';
        $sDestination = realpath( APPLICATION_PATH . '/data/logs' ) . '/cfiletest.log';
        $pFile        = fopen( $sDestination, 'wb' );
        $this->assertTrue( is_resource( $pFile ), 'is_resource' );

        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );

        $this->the_OptionsWrite[CURLOPT_FILE] = $pFile;
        $this->assertFalse( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        fflush( $pFile );
        fclose( $pFile );
        $this->assertSame( CURLE_COULDNT_RESOLVE_HOST, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( (strlen( $this->_pConnector->getErrorText() ) > 0 ), 'getErrorText' );
        $this->assertFalse( $this->_pConnector->read(), 'read' );

        unlink( $sDestination );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testCheckOUTPUT()
    {
        $this->the_OptionsWrite[CURLOPT_FILE] = TRUE;
        $sHost                                = APPLICATION_PATH . '/LICENSE';
        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->_pConnector->write( $sHost, $this->the_OptionsWrite );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWrite01()
    {
        $sHost  = APPLICATION_PATH . '/LICENSE';
        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( (strlen( $this->_pConnector->getErrorText() ) == 0 ), 'getErrorText' );
        $return = $this->_pConnector->read();
        $size   = mb_strlen( $return, 'UTF-8' );
        $this->assertTrue( is_string( $return ), 'read' );
        $this->assertTrue( ($size > 0 ), 'mb_strlen' );
        $info   = $this->_pConnector->getInformation();
        $this->assertSame( $info['size_download'], $size, 'size_download' );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWrite01Nobody()
    {
        $sHost = APPLICATION_PATH . '/LICENSE';

        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->the_OptionsWrite[CURLOPT_NOBODY] = TRUE;
        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );

        $return = $this->_pConnector->read();
        $size   = mb_strlen( $return, 'UTF-8' );

        $this->assertTrue( is_string( $return ), 'read' );
        $this->assertTrue( ($size === 0 ), 'mb_strlen' );

        $info = $this->_pConnector->getInformation();
        $this->assertSame( $info['size_download'], $size, 'size_download' );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWrite02()
    {
        $sHost = APPLICATION_PATH . '/tests/framework/provider/resource/notadir';
        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( is_string( $this->_pConnector->read() ), 'read' );
        $info  = $this->_pConnector->getInformation();
        $this->assertSame( $info['size_download'], mb_strlen( $this->_pConnector->read(), 'UTF-8' ), 'size_download' );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWrite02Nobody()
    {
        $sHost = APPLICATION_PATH . '/tests/framework/provider/resource/notadir';

        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->the_OptionsWrite[CURLOPT_NOBODY] = TRUE;
        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );

        $return = $this->_pConnector->read();
        $size   = mb_strlen( $return, 'UTF-8' );

        $this->assertTrue( is_string( $return ), 'read' );
        $this->assertTrue( ($size === 0 ), 'mb_strlen' );

        $info = $this->_pConnector->getInformation();
        $this->assertSame( $info['size_download'], $size, 'size_download' );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWriteFile01()
    {
        $sHost        = APPLICATION_PATH . '/LICENSE';
        $sDestination = realpath( APPLICATION_PATH . '/data/logs' ) . '/cfiletest.log';
        $pFile        = fopen( $sDestination, 'wb' );
        $this->assertTrue( is_resource( $pFile ), 'is_resource' );

        $this->the_OptionsWrite[CURLOPT_FILE] = $pFile;
        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( $this->_pConnector->read(), 'read' );
        fflush( $pFile );
        fclose( $pFile );
        $this->assertTrue( (filesize( $sHost ) == filesize( $sDestination ) ), 'filesize' );

        $info = $this->_pConnector->getInformation();
        $this->assertTrue( ($info['size_download'] > 0 ), 'size_download' );
        unlink( $sDestination );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWriteFile01Nobody()
    {
        $sHost        = APPLICATION_PATH . '/LICENSE';
        $sDestination = realpath( APPLICATION_PATH . '/data/logs' ) . '/cfiletest.log';
        $pFile        = fopen( $sDestination, 'wb' );
        $this->assertTrue( is_resource( $pFile ), 'is_resource' );

        $this->the_OptionsWrite[CURLOPT_FILE]   = $pFile;
        $this->the_OptionsWrite[CURLOPT_NOBODY] = TRUE;

        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );

        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( $this->_pConnector->read(), 'read' );
        fflush( $pFile );
        fclose( $pFile );
        $this->assertTrue( (0 == filesize( $sDestination ) ), 'filesize' );

        $info = $this->_pConnector->getInformation();
        $this->assertTrue( (0 == $info['size_download'] ), 'size_download' );
        unlink( $sDestination );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWriteFile02()
    {
        $sHost        = APPLICATION_PATH . '/tests/framework/provider/resource/notadir';
        $sDestination = realpath( APPLICATION_PATH . '/data/logs' ) . '/cfiletest.log';
        $pFile        = fopen( $sDestination, 'wb' );
        $this->assertTrue( is_resource( $pFile ), 'is_resource' );

        $this->the_OptionsWrite[CURLOPT_FILE] = $pFile;
        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( $this->_pConnector->read(), 'read' );
        fflush( $pFile );
        fclose( $pFile );
        $this->assertTrue( (filesize( $sHost ) == filesize( $sDestination ) ), 'filesize' );

        $info = $this->_pConnector->getInformation();
        $this->assertTrue( ($info['size_download'] == 0 ), 'size_download' );
        unlink( $sDestination );
    }

    /**
     * @covers \Foundation\Protocol\Connector\CFile
     * @group specification
     */
    public function testWriteFile02Nobody()
    {
        $sHost        = APPLICATION_PATH . '/tests/framework/provider/resource/notadir';
        $sDestination = realpath( APPLICATION_PATH . '/data/logs' ) . '/cfiletest.log';
        $pFile        = fopen( $sDestination, 'wb' );
        $this->assertTrue( is_resource( $pFile ), 'is_resource' );

        $this->the_OptionsWrite[CURLOPT_FILE]   = $pFile;
        $this->the_OptionsWrite[CURLOPT_NOBODY] = TRUE;

        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );

        $this->assertTrue( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( $this->_pConnector->read(), 'read' );
        fflush( $pFile );
        fclose( $pFile );
        $this->assertTrue( (0 == filesize( $sDestination ) ), 'filesize' );

        $info = $this->_pConnector->getInformation();
        $this->assertTrue( (0 == $info['size_download'] ), 'size_download' );
        unlink( $sDestination );
    }

}