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
 * This class implements usefull local filesystem methods using core library.
 * This class is a connector for a protocol.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Connector
 * @version    1.0.0
 * @since      1.0.0
 */
final class CFile extends \Foundation\Protocol\Connector\CConnectorAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->_sDebugID = uniqid('cfile', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add($this->_sDebugID, __CLASS__, [ ]);
    }

    /** Connector section
     * ******************* */

    /**
     * Close the cURL session.
     *
     * @return void
     */
    public function close()
    {
        $this->_sResponse                     = false;
        $this->_iError                        = CURLE_OK;
        $this->_sError                        = '';
        $this->_aInformation['url']           = '';
        $this->_aInformation['size_download'] = 0;
    }

    /**
     * Initialize context.
     *
     * @param  string  $host    Not used.
     * @param  array   $options Not used.
     * @return \Foundation\Protocol\Connector\CFile
     * @throws \Foundation\Exception\RuntimeException If unable to connect.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function connect($host, array $options = [ ])
    {
        // Close the current session if already connected
        $this->close();
        return $this;
    }

    /**
     * Performs a filesystem session and write the output to a file.
     * Returns TRUE on success or FALSE on failure.
     *
     * @param  string  $url     Path of the local file.
     * @param  array   $options Write options to use.
     * @return boolean
     * @throws \Foundation\Exception\RuntimeException If the connection does not exist.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    private function performToFile($url, array $options)
    {
        // Reset response
        $this->_sResponse = false;

        // Initialize error
        $this->_iError = CURLE_OK;
        $this->_sError = '';

        // Check and set URL
        $pValidator = new \Foundation\Type\Complex\CPath($url);
        $url        = $pValidator->getRealPath();
        unset($pValidator);

        $this->_aInformation['url']           = $url;
        $this->_aInformation['size_download'] = 0;

        if (false === $url) {
            $this->_iError = CURLE_COULDNT_RESOLVE_HOST;
            $this->_sError = 'Could not resolve host';
            return false;
        }

        // Check OUTPUT
        if (! isset($options[CURLOPT_FILE])) {
            throw new \Foundation\Exception\InvalidArgumentException('CURLOPT_FILE could not be successfully set');
        }

        if (! is_resource($options[CURLOPT_FILE])) {
            throw new \Foundation\Exception\InvalidArgumentException('CURLOPT_FILE option should be a valid File-Handle resource');
        }

        // Check CURLOPT_NOBODY
        $bNobody = ( isset($options[CURLOPT_NOBODY]) && ( true === $options[CURLOPT_NOBODY] ) ) ? true : false;

        // Open source
        $pIn = fopen($url, 'rb');

        //@codeCoverageIgnoreStart
        if (false === $pIn) {
            $tmp = error_get_last();
            if (is_array($tmp)) {
                $this->_iError = $tmp['type'];
                $this->_sError = $tmp['message'];
            } else {
                $this->_iError = CURLE_FILE_COULDNT_READ_FILE;
                $this->_sError = 'Failed to open stream';
            }
            return false;
        }
        //@codeCoverageIgnoreEnd

        $this->_sResponse = true;

        // Copy if requested
        if (! $bNobody) {
            while (! feof($pIn)) {
                $iCount = fwrite($options[CURLOPT_FILE], fread($pIn, 1024));

                //@codeCoverageIgnoreStart
                if (false === $iCount) {
                    // Error
                    $tmp = error_get_last();
                    if (is_array($tmp)) {
                        $this->_iError = $tmp['type'];
                        $this->_sError = $tmp['message'];
                    } else {
                        $this->_iError = CURLE_WRITE_ERROR;
                        $this->_sError = 'Failed to write to file';
                    }

                    $this->_sResponse = false;

                    break;
                }
                //@codeCoverageIgnoreEnd
                else {
                    // No error
                    $this->_aInformation['size_download'] += $iCount;
                }
            }
        }

        fclose($pIn);
        return $this->_sResponse;
    }

    /**
     * Performs a filesystem session. Returns TRUE on success or FALSE on failure.
     *
     * @param  string  $url     Path of the local file.
     * @param  array   $options Write options to use.
     * @return boolean
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    private function perform($url, array $options)
    {
        // Reset response
        $this->_sResponse = false;

        // Initialize error
        $this->_iError = CURLE_OK;
        $this->_sError = '';

        // Check and set URL
        $pValidator = new \Foundation\Type\Complex\CPath($url);
        $url        = $pValidator->getRealPath();
        unset($pValidator);

        $this->_aInformation['url']           = $url;
        $this->_aInformation['size_download'] = 0;

        if (false === $url) {
            $this->_iError = CURLE_COULDNT_RESOLVE_HOST;
            $this->_sError = 'Could not resolve host';
            return false;
        }

        // Check CURLOPT_NOBODY
        $bNobody = ( isset($options[CURLOPT_NOBODY]) && ( true === $options[CURLOPT_NOBODY] ) ) ? true : false;

        // Read if requested
        if ($bNobody) {
            $this->_sResponse = '';
        } else {
            $this->_sResponse = file_get_contents($url);

            //@codeCoverageIgnoreStart
            if (false === $this->_sResponse) {
                $tmp = error_get_last();
                if (is_array($tmp)) {
                    $this->_iError = $tmp['type'];
                    $this->_sError = $tmp['message'];
                } else {
                    $this->_iError = CURLE_READ_ERROR;
                    $this->_sError = 'Failed to get content from file';
                }
            }
            //@codeCoverageIgnoreEnd
            else {
                $this->_aInformation['size_download'] = mb_strlen($this->_sResponse, 'UTF-8');
            }//if( ...
        }

        return ( ( is_bool($this->_sResponse) ) ? $this->_sResponse : true );
    }

    /**
     * Send request to the remote server. Returns TRUE on success or FALSE on failure.
     *
     * @param string $url     Path of the local file.
     * @param array  $options [OPTIONAL] write options to use. Valid keys may be:
     *                        CURLOPT_FILE   => The a valid File-Handle resource that the transfer should be written to.
     *                        CURLOPT_NOBODY => TRUE to exclude the body from the output.
     * @return boolean
     * @throws \RuntimeException if the connection does not exist.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function write($url, array $options = [ ])
    {
        if (isset($options[CURLOPT_FILE])) {
            return $this->performToFile($url, $options);
        } else {
            return $this->perform($url, $options);
        }
    }
}
