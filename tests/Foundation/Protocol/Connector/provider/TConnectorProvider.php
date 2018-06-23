<?php
namespace Foundation\Test\Protocol\Connector\Provider;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );
class_exists( '\Foundation\Exception\RuntimeException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/RuntimeException.php' ) );

defined( 'FOUNDATION_PROTOCOL_PATH' ) || define( 'FOUNDATION_PROTOCOL_PATH',
                                                 APPLICATION_PATH . '/src/Foundation/Protocol' );
interface_exists( '\Foundation\Protocol\Connector\ConnectorInterface' ) || require( realpath( FOUNDATION_PROTOCOL_PATH . '/Connector/ConnectorInterface.php' ) );
class_exists( '\Foundation\Protocol\Connector\CConnectorAbstract' ) || require( realpath( FOUNDATION_PROTOCOL_PATH . '/Connector/CConnectorAbstract.php' ) );

trait TConnectorProvider
{
    /** Class section
     * *************** */

    /**
     *
     * @var array
     */
    protected $the_OptionsConnect;

    /**
     *
     * @var array
     */
    protected $the_OptionsWrite;

    /**
     *
     * @var \Foundation\Protocol\Connector\ConnectorInterface
     */
    protected $_pConnector;

    /**
     *
     */
    protected function loadData()
    {
        $this->the_OptionsConnect = [
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_MAXREDIRS      => 2,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => FALSE,
            CURLOPT_AUTOREFERER    => TRUE,
        ];
        $this->the_OptionsWrite   = [
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER     => [
                'Accept: text/html, application/xml;q=0.9, */*;q=0.1',
                'Accept-Charset: iso-8859-1, utf-8, utf-16, *;q=0.1' ] ];
    }

    /**
     *
     */
    protected function tearDown()
    {
        $this->_pConnector = NULL;
    }

    /** Test section
     * ************* */

    /**
     *
     */
    public function proceedEmptyHost()
    {
        static $sHost = '';
        $this->_pConnector->connect( $sHost, $this->the_OptionsConnect );
        $this->assertFalse( $this->_pConnector->write( $sHost, $this->the_OptionsWrite ), 'write' );
        $this->assertSame( CURLE_COULDNT_RESOLVE_HOST, $this->_pConnector->getErrorNumber(), 'getErrorNumber' );
        $this->assertTrue( (strlen( $this->_pConnector->getErrorText() ) > 0 ), 'getErrorText' );
        $this->assertFalse( $this->_pConnector->read(), 'read' );
    }

}