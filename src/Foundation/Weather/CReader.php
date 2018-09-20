<?php
namespace Foundation\Weather;

/**
 * Foundation Framework
 *
 * @package   Weather
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * This class implements usefull methods to read weather data from a file.
 * Additional strategies, like connector and convert, must be attached.
 *
 * @category   Foundation
 * @package    Weather
 * @version    1.0.0
 * @since      1.0.0
 */
final class CReader
{
    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    private $_sDebugID = '';

    /**
     * Constructor.
     *
     * @param \Foundation\Protocol\Connector\ConnectorInterface $connector Connector to the protocol to use to.
     * @param \Foundation\Weather\Converter\ConverterInterface $converter Converter to use.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct(
        \Foundation\Protocol\Connector\ConnectorInterface $connector,
        \Foundation\Weather\Converter\ConverterInterface $converter
    ) {
        $this->_sDebugID = uniqid('CReader', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $connector, $converter ]
                );

        // Attach the connector
        $this->_pConnector = $connector;

        // Attach the converter
        $this->_pConverter = $converter;

        // Set default connector options
        $this->_aConnectorOptionsConnect = [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 2,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_AUTOREFERER    => true,
        ];
        $this->_aConnectorOptionsWrite   = [
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER   => [
                'Accept: text/html, application/xml;q=0.9, */*;q=0.1',
                'Accept-Charset: iso-8859-1, utf-8, utf-16, *;q=0.1' ] ];
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_pConnector = null;
        $this->_pConverter = null;
        defined('FOUNDATION_DEBUG') && ! defined('FOUNDATION_DEBUG_OFF') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete($this->_sDebugID);
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __set($name, $value)
    {
        throw new \Foundation\Exception\BadMethodCallException('Writing data to inaccessible properties is not allowed.');
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Connector section
     * ****************** */

    /**
     * Protocol connector to use to.
     *
     * @var \Foundation\Protocol\Connector\ConnectorInterface
     */
    private $_pConnector = null;

    /**
     * Connector options to use for connect action.
     *
     * @var array
     */
    private $_aConnectorOptionsConnect;

    /**
     * Connector options to use for write action.
     *
     * @var array
     */
    private $_aConnectorOptionsWrite;

    /**
     * Attaches new protocol connector. Close the previous one.
     *
     * @param \Foundation\Protocol\Connector\ConnectorInterface $connector Connector to the protocol to use to.
     * @return void
     */
    public function setConnector(\Foundation\Protocol\Connector\ConnectorInterface $connector)
    {
        // Close the current connection
        $this->_pConnector->close();

        // Attache new connector
        $this->_pConnector = $connector;
    }

    /**
     * Overwrites the default connector options.
     * @see http://php.net/manual/en/function.curl-setopt.php for options to use.
     *
     * @param array $connect Options for connect action.
     * @param array $write   Options for write action.
     * @return void
     */
    public function setConnectorOptions(array $connect, array $write)
    {
        // We can't use the array_merge function because the keys are numerics.
        // And we can't use the + operator because we want to replace and not only to add.
        $tmp = $this->_aConnectorOptionsConnect;

        foreach ($connect as $key => $value) {
            $tmp[$key] = $value;
        }

        $this->_aConnectorOptionsConnect = $tmp;

        $tmp = $this->_aConnectorOptionsWrite;

        foreach ($write as $key => $value) {
            $tmp[$key] = $value;
        }

        $this->_aConnectorOptionsWrite = $tmp;
    }

    /** Converter section
     * ****************** */

    /**
     * Converter to use to.
     *
     * @var \Foundation\Weather\Converter\ConverterInterface
     */
    private $_pConverter = null;

    /**
     * Attaches new protocol connector. Close the previous one.
     *
     * @param \Foundation\Protocol\Connector\ConnectorInterface $connector Connector to the protocol to use to.
     * @return void
     */
    public function setConverter(\Foundation\Weather\Converter\ConverterInterface $converter)
    {
        $this->_pConverter = $converter;
    }

    /** Reader section
     * *************** */

    /**
     * Reads data. Returns the readed data or FALSE on failure.
     *
     * @param  string $url Uniform Resource Locator.
     * @return mixed
     * @throws \RuntimeException if the connection does not exist.
     * @throws \Foundation\Exception\InvalidArgumentException If an option could not be successfully set.
     */
    public function read($url)
    {
        // Initialize
        $sReturn = false;

        // Open the connection
        $this->_pConnector->connect($url, $this->_aConnectorOptionsConnect);

        // Write and read
        if ($this->_pConnector->write($url, $this->_aConnectorOptionsWrite)) {
            $sReturn = $this->_pConnector->read();
        }

        // Close the connection
        $this->_pConnector->close();

        // Transform
        if (false !== $sReturn) {
            $sReturn = $this->_pConverter->convert($sReturn);
        }

        return $sReturn;
    }
}
