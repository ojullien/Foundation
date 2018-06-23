<?php
namespace Foundation\Debug\Timer;
/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements a timer using PHP core functions.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Timer
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CCore implements \Foundation\Debug\Timer\TimerInterface
{
    /** Constants */

    const DEFAULT_VALUE = NULL;

    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->_dTimeStart = microtime( true );
    }

    /**
     * Clone is not allowed.
     *
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __clone()
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Cloning is not allowed.' );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __set( $name, $value )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @codeCoverageIgnore
     */
    public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /** Time section
     * ************* */

    /**
     * Script start time
     * @var double
     */
    private $_dTimeStart = self::DEFAULT_VALUE;

    /**
     * Script end time
     * @var double
     */
    private $_dTimeEnd = self::DEFAULT_VALUE;

    /**
     * Returns the current time index since the starting of the script in seconds.
     *
     * @return float
     */
    public function getCurrentDuration()
    {
        return microtime( true ) - $this->_dTimeStart;
    }

    /**
     * Timestamp of the end of the script.
     * Returns the script duration in seconds, with microsecond's precision.
     *
     * @return float
     */
    public function stopTime()
    {
        if( !isset( $this->_dTimeEnd ) )
        {
            $this->_dTimeEnd = microtime( true ) - $this->_dTimeStart;
        }
        return $this->_dTimeEnd;
    }

    /**
     * Returns the script duration in seconds, with microsecond's precision.
     *
     * @return float
     */
    public function getScriptDuration()
    {
        $fReturn = 0.0;
        if( !isset( $this->_dTimeEnd ) )
        {
            $fReturn = microtime( true ) - $this->_dTimeStart;
        }
        else
        {
            $fReturn = $this->_dTimeEnd;
        }
        return $fReturn;
    }

}