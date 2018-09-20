<?php
namespace Foundation\Protocol\Connector;

/**
 * Foundation Framework
 *
 * @package   Protocol
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

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
final class CCurl extends \Foundation\Protocol\Connector\CConnectorAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @throws \Foundation\Exception\RuntimeException if the extention is not loaded.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->_sDebugID = uniqid('ccurl', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add($this->_sDebugID, __CLASS__, [ ]);

        // cUrl is an extention
        if (! extension_loaded('curl')) {
            throw new \Foundation\Exception\RuntimeException('cURL extension is not loaded');
        }
    }

    /** Connector section
     * ******************* */

    /**
     * Resource.
     *
     * @var resource
     */
    private $_pResource = null;

    /**
     * Close the cURL session.
     *
     * @return void
     */
    public function close()
    {
        if (is_resource($this->_pResource)) {
            curl_close($this->_pResource);
        }
        $this->_pResource                     = null;
        $this->_sResponse                     = false;
        $this->_sResponse                     = false;
        $this->_iError                        = CURLE_OK;
        $this->_sError                        = '';
        $this->_aInformation['url']           = '';
        $this->_aInformation['size_download'] = 0;
    }

    /**
     * Initialize cUrl.
     *
     * @param  string  $host    Remote server to connect to. Not used in cURL connector.
     * @param  array   $options [OPTIONAL] Connection options to use. Valid keys may be:
     *                          CURLOPT_PORT           => An alternative port number to connect to.
     *                          CURLOPT_CONNECTTIMEOUT => The number of seconds to wait while trying to connect.
     *                          CURLOPT_MAXREDIRS      => The maximum amount of HTTP redirections to follow.
     *                          CURLOPT_SSLCERT        => The name of a file containing a PEM formatted certificate.
     *                          CURLOPT_SSLCERTPASSWD  => The password required to use the CURLOPT_SSLCERT certificate.
     *                          @see http://php.net/manual/en/function.curl-setopt.php for more options to use.
     * @return \Foundation\Protocol\Connector\CCurl
     * @throws \Foundation\Exception\RuntimeException If unable to connect.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function connect($host, array $options = [ ])
    {
        // Close the current session if already connected
        $this->close();

        // Initialize the cURL session
        $this->_pResource = curl_init();
        if (! is_resource($this->_pResource)) {
            throw new \Foundation\Exception\RuntimeException('Unable to initialize the cURL session');
        }

        // Set the options related to the connection
        if (! curl_setopt_array($this->_pResource, $options)) {
            throw new \Foundation\Exception\InvalidArgumentException('An option could not be successfully set');
        }
        return $this;
    }

    /**
     * Send request to the remote server.  Returns TRUE on success or FALSE on failure.
     *
     * @param  string  $url     Uniform Resource Locator.
     * @param  array   $options [OPTIONAL] write options to use. Valid keys may be:
     *                          CURLOPT_HTTPGET   => boolean.
     *                          or CURLOPT_POST   => boolean and CURLOPT_POSTFIELDS => The full data to post.
     *                          or CURLOPT_UPLOAD => boolean;  The file to UPLOAD must be set with CURLOPT_INFILE and CURLOPT_INFILESIZE.
     *                          CURLOPT_FILE      => The a valid File-Handle resource that the transfer should be written to.
     *                          Remarks:
     *                          $url parameter overwrites CURLOPT_URL option.
     *                          CURLOPT_RETURNTRANSFER is set automatically.
     *                          CURLOPT_POST option should be set before CURLOPT_POSTFIELDS.
     *                          CURLOPT_HTTPHEADER option should contain 'Accept: '
     *                          @see http://php.net/manual/en/function.curl-setopt.php for more options to use.
     * @return boolean
     * @throws \Foundation\Exception\RuntimeException If the connection does not exist.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function write($url, array $options = [ ])
    {
        // Initialize
        $this->_sResponse = false;

        // Check connection
        if (! is_resource($this->_pResource)) {
            throw new \Foundation\Exception\RuntimeException("No connection");
        }

        // Check and set URL
        unset($options[CURLOPT_URL]);

        $url = ( is_string($url) ) ? trim($url) : '';

        $this->_aInformation['url']           = $url;
        $this->_aInformation['size_download'] = 0;

        if (( strlen($url) == 0 ) || ( false === curl_setopt($this->_pResource, CURLOPT_URL, $url) )) {
            $this->_iError = CURLE_COULDNT_RESOLVE_HOST;
            $this->_sError = 'Could not resolve host';
            return false;
        }

        // Check the UPLOAD method
        if (isset($options[CURLOPT_UPLOAD]) && (! isset($options[CURLOPT_INFILE]) || ! isset($options[CURLOPT_INFILESIZE]) )) {
            throw new \Foundation\Exception\InvalidArgumentException('The file to UPLOAD must be set with CURLOPT_INFILE and CURLOPT_INFILESIZE');
        }

        // Check the PUT method
        if (isset($options[CURLOPT_PUT]) && (! isset($options[CURLOPT_INFILE]) || ! isset($options[CURLOPT_INFILESIZE]) )) {
            throw new \Foundation\Exception\InvalidArgumentException('The file to PUT must be set with CURLOPT_INFILE and CURLOPT_INFILESIZE');
        }

        // Check resource
        if (isset($options[CURLOPT_INFILE]) && ! is_resource($options[CURLOPT_INFILE])) {
            throw new \Foundation\Exception\InvalidArgumentException('The file to UPLOAD or PUT is not a valid File-Handle resource');
        }

        // Check and set OUTPUT
        unset($options[CURLOPT_RETURNTRANSFER]);

        if (isset($options[CURLOPT_FILE])) {
            if (! is_resource($options[CURLOPT_FILE])) {
                throw new \Foundation\Exception\InvalidArgumentException('CURLOPT_FILE option should be a valid File-Handle resource');
            }

            curl_setopt($this->_pResource, CURLOPT_RETURNTRANSFER, false);

            if (! curl_setopt($this->_pResource, CURLOPT_FILE, $options[CURLOPT_FILE])) {
                throw new \Foundation\Exception\InvalidArgumentException('CURLOPT_FILE could not be successfully set');
            }

            unset($options[CURLOPT_FILE]);
        } else {
            curl_setopt($this->_pResource, CURLOPT_RETURNTRANSFER, true);
        }

        // set additional options
        if (! curl_setopt_array($this->_pResource, $options)) {
            throw new \Foundation\Exception\InvalidArgumentException('An option could not be successfully set');
        }

        // Perform a cURL session
        $this->_sResponse    = curl_exec($this->_pResource);
        $this->_aInformation = curl_getinfo($this->_pResource);
        $this->_iError       = curl_errno($this->_pResource);
        $this->_sError       = curl_error($this->_pResource);

        return ( ( is_bool($this->_sResponse) ) ? $this->_sResponse : true );
    }
}
