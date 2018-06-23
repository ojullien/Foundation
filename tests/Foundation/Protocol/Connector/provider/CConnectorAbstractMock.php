<?php
namespace Foundation\Test\Protocol\Connector;
/**
 * Foundation Framework
 *
 * @package   Protocol
 * @copyright (©) 2010-2013, Olivier Jullien <olivier.jullien@outlook.com>
 * @license   Private
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements usefull http and ftp methods using cURL client library.
 * This class is a connector for a protocol.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Connector
 * @version    1.0.0
 * @since      1.0.0
 */
final class CConnectorAbstractMock extends \Foundation\Protocol\Connector\CConnectorAbstract
{
    /** Connector section
     * ******************* */

    /**
     * Close the cURL session.
     *
     * @return void
     */
    public function close()
    {
        // Do nothing
    }

    public function connect( $host, array $options = [ ] )
    {
        return $this;
    }

    public function write( $url, array $options = [ ] )
    {
        return ( ( is_bool( $this->_sResponse ) ) ? $this->_sResponse : TRUE );
    }

    /** Test section
     * ************* */
    public function setResponse( $value )
    {
        $this->_sResponse = $value;
    }

    public function setError( $value )
    {
        $this->_sError = $value;
    }

}