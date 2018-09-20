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
 * Interface class for protocol connector implementations.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Connector
 * @version    1.0.0
 * @since      1.0.0
 */
interface ConnectorInterface
{
    /** Connector section
     * ****************** */

    /**
     * Close the connector session.
     *
     * @return void
     */
    public function close();

    /**
     * Connect to the remote server
     *
     * @param  string  $host    Remote server to connect to.
     * @param  array   $options [OPTIONAL] Connection options to use. Valid key are the same as cURL.
     *                          @see http://php.net/manual/en/function.curl-setopt.php
     * @return Foundation\Protocol\Connector\ConnectorInterface
     * @throws \Foundation\Exception\RuntimeException If unable to connect.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function connect($host, array $options = [ ]);

    /**
     * Send request to the remote server. Returns TRUE on success or FALSE on failure.
     *
     * @param  string  $url     Uniform Resource Locator.
     * @param  array   $options [OPTIONAL] write options to use. Valid key are the same as cURL.
     *                          @see http://php.net/manual/en/function.curl-setopt.php
     * @return boolean
     * @throws \Foundation\Exception\RuntimeException If the connection does not exist.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function write($url, array $options = [ ]);

    /**
     * Return the response from the remote server.
     * If the CURLOPT_FILE option is not set, it contains the result of the transfert on success, FALSE on failure.
     * If the CURLOPT_FILE option is set, it contains TRUE on transfert success or FALSE on failure.
     *
     * @var string|boolean
     */
    public function read();

    /** Error section
     * ************** */

    /**
     * Get information about the last operation.
     * @see http://www.php.net/manual/en/function.curl-getinfo.php
     *
     * @return array
     */
    public function getInformation();

    /**
     * Returns the error number for the last operation.
     *
     * @return integer
     */
    public function getErrorNumber();

    /**
     * Returns text error for the last operation.
     *
     * @return string
     */
    public function getErrorText();
}
