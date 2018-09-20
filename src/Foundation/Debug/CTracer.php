<?php
namespace Foundation\Debug;

/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_NAME')) {
    die('-1');
}

/**
 * This class implements usefull methods for tracing.
 *
 * @category Foundation
 * @package  Debug
 * @version  1.0.0
 * @since    1.0.0
 * @codeCoverageIgnore
 */
final class CTracer
{
    /** Singleton pattern
     * ****************** */

    /**
     * Singleton
     * @var \Foundation\Debug\CTracer
     */
    private static $_pInstance = null;

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->_fStart = isset($_SERVER['REQUEST_TIME_FLOAT']) ? $_SERVER['REQUEST_TIME_FLOAT'] : microtime(true);
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset($this->_pFile);
    }

    /**
     * Clone is not allowed.
     *
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __clone()
    {
        throw new \Foundation\Exception\BadMethodCallException('Cloning is not allowed.');
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __set($name, $value)
    {
        throw new \Foundation\Exception\BadMethodCallException('Writing data to inaccessible properties is not allowed.');
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @codeCoverageIgnore
     */
    public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /**
     * Retrieves the default class instance.
     *
     * @return \Foundation\Debug\CTracer
     */
    public static function getInstance()
    {
        if (! isset(self::$_pInstance)) {
            self::$_pInstance = new \Foundation\Debug\CTracer();
        }
        return self::$_pInstance;
    }

    /**
     * Deletes instance
     */
    public static function deleteInstance()
    {
        if (isset(self::$_pInstance)) {
            $tmp = self::$_pInstance;
            self::$_pInstance = null;
            unset($tmp);
        }
    }

    /** Tracer section
     * *************** */

    /**
     * Script start in microtime.
     *
     * @var float
     */
    private $_fStart = 0;

    /**
     * Last write call in microtime.
     *
     * @var float
     */
    private $_fLastCall = 0;

    /**
     * File.
     *
     * @var \SplFileObject
     */
    private $_pFile = null;

    /**
     * Opens file. Throws a RuntimeException if the filename cannot be opened.
     *
     * @param string $filename The file to write.
     * @throws \RuntimeException
     */
    public function open($filename)
    {
        // Sanitize parameter
        $filename = (is_string($filename) ) ? trim($filename) : '';

        // Open the file
        if (strlen($filename) > 0) {
            $this->_pFile = new \SplFileObject($filename, 'a+b');

            $pDate = new \DateTime("now", new \DateTimeZone('Europe/Paris'));

            $this->_pFile->fwrite('START: ' . $pDate->format('H:i:s, u')
                    . PHP_EOL);

            unset($pDate);

            $this->_fLastCall = microtime(true);
        } else {
            throw new \RuntimeException('the file cannot be opened.');
        }
    }

    /**
     * Trace.
     *
     * @param string $location location
     * @param string $trace    trace to write
     */
    public function trace($location, $data)
    {
        // Sanitize parameters
        $location = ( is_string($location) ) ? trim($location) : 'NOWHERE';
        $data     = ( is_string($data) ) ? trim($data) : 'NOTHING';

        // Write
        if (null !== $this->_pFile) {
            $fCurrent = microtime(true);

            $this->_pFile->fwrite(
                '[' . round(( $fCurrent - $this->_fStart ) * 1000, 2) . ' ms] '
                    . '[' . round(( $fCurrent - $this->_fLastCall ) * 1000, 2) . ' ms] '
                    . '[' . $location . '] '
                . $data . PHP_EOL
            );

            $this->_fLastCall = $fCurrent;
        }
    }
}

define('FOUNDATION_DEBUG_TRACE', 1);

// Create tracer
\Foundation\Debug\CTracer::getInstance()->open(
    APPLICATION_PATH
        . DIRECTORY_SEPARATOR . 'data'
        . DIRECTORY_SEPARATOR . 'log'
        . DIRECTORY_SEPARATOR . 'trace'
    . date('Ymd') . '.log'
);
