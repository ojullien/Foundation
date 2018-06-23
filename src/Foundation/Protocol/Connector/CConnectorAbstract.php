<?php
namespace Foundation\Protocol\Connector;
/**
 * Foundation Framework
 *
 * @package   Protocol
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Parent class for all connectors. Implements error functionnalities.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Connector
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CConnectorAbstract implements \Foundation\Protocol\Connector\ConnectorInterface
{
    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    protected $_sDebugID = '';

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->close();
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __set( $name, $value )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /** Connector section
     * ****************** */

    /**
     * Response from the remote server.
     * If the CURLOPT_FILE option is not set, it contains the result on success, FALSE on failure.
     * If the CURLOPT_FILE option is set, it contains TRUE on success or FALSE on failure.
     *
     * @var string|boolean
     */
    protected $_sResponse = FALSE;

    /**
     * Returns the response from the remote server.
     * If the CURLOPT_FILE option is not set, it contains the result  of the transfert on success, FALSE on failure.
     * If the CURLOPT_FILE option is set, it contains TRUE on transfert success or FALSE on failure.
     *
     * @var string|boolean
     */
    final public function read()
    {
        return $this->_sResponse;
    }

    /** Error section
     * ************** */

    /**
     * Information about the last operation.
     * @see http://www.php.net/manual/en/function.curl-getinfo.php
     *
     * @var array
     */
    protected $_aInformation = [
        'url'           => '',
        'size_download' => 0 ];

    /**
     * Error number for the last operation.
     *
     * @var integer
     */
    protected $_iError = CURLE_OK;

    /**
     * Text error for the last operation.
     *
     * @var string
     */
    protected $_sError = '';

    /**
     * Get information about the last operation.
     * @see http://www.php.net/manual/en/function.curl-getinfo.php
     *
     * @return array
     */
    final public function getInformation()
    {
        return $this->_aInformation;
    }

    /**
     * Returns the error number for the last operation.
     *
     * @return integer
     */
    final public function getErrorNumber()
    {
        return $this->_iError;
    }

    /**
     * Returns text error for the last operation.
     *
     * @return string
     */
    final public function getErrorText()
    {
        return $this->_sError;
    }

}
