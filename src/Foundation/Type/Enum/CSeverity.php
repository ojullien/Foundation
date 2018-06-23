<?php
namespace Foundation\Type\Enum;
/**
 * Foundation Framework
 *
 * @package   Type
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements enumeration type for severity.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Enumeration
 * @version    1.0.0
 * @since      1.0.0
 */
final class CSeverity
{
    /** Constants */
    // The severities come from the BSD syslog protocol, which is described
    // in the RFC-3164.

    const EMERG  = 0;  // Emergency: system is unusable
    const ALERT  = 1;  // Alert: action must be taken immediately
    const CRIT   = 2;  // Critical: critical conditions
    const ERR    = 3;  // Error: error conditions
    const WARN   = 4;  // Warning: warning conditions
    const NOTICE = 5;  // Notice: normal but significant condition
    const INFO   = 6;  // Informational: informational messages
    const DEBUG  = 7;  // Debug: debug messages

    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    private $_sDebugID = '';

    /**
     * Constructor
     *
     * @param integer $value [OPTIONAL]. One of the constants.
     * @throws \Foundation\Exception\UnexpectedValueException if the parameter is not valid.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $value = self::ERR )
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid( 'cseverity', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $value ] );
        //@codeCoverageIgnoreEnd

        if( is_integer( $value ) && ($value >= self::EMERG) && ($value <= self::DEBUG) )
        {
            $this->_Value = $value;
        }
        else
        {
            throw new \Foundation\Exception\UnexpectedValueException( 'Unexpected parameter value.' );
        }
    }

    /**
     * Destructor
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_Value = NULL;
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
    public function __set( $name, $value )
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
    public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /** Type section
     * ************* */

    /**
     * Current value
     * @var integer
     */
    private $_Value = self::CRIT;

    /**
     * Reads data from variable
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->_Value;
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        switch( $this->_Value )
        {
            case self::EMERG:
                $sReturn = 'emergency';
                break;
            case self::ALERT:
                $sReturn = 'alert';
                break;
            case self::CRIT:
                $sReturn = 'critical';
                break;
            case self::WARN:
                $sReturn = 'warning';
                break;
            case self::NOTICE:
                $sReturn = 'notice';
                break;
            case self::INFO:
                $sReturn = 'informational';
                break;
            case self::DEBUG:
                $sReturn = 'debug';
                break;
            default:
                $sReturn = 'error';
                break;
        }
        return $sReturn;
    }

}