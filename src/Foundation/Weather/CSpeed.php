<?php
namespace Foundation\Weather;
/**
 * Foundation Framework
 *
 * @package   Weather
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements usefull methods to convert wind speed units.
 *
 * @category   Foundation
 * @package    Weather
 * @version    1.0.0
 * @since      1.0.0
 */
final class CSpeed
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
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->_sDebugID = uniqid( 'cwindspeed', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__, array( ) );
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_Value = NULL;
        $this->_Unit  = NULL;
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

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        $sReturn = '';
        static $aUnit   = array( 'm/s', 'km/h', 'knot', 'mph', 'bf' );
        if( isset( $this->_Value ) && isset( $this->_Unit ) )
        {
            $sReturn = (string)$this->_Value . ' ' . $aUnit[$this->_Unit];
        }//if( isset(...
        return $sReturn;
    }

    /** Type section
     * ************* */

    /**
     * Wind speed in m/s
     * @var float
     */
    private $_Value = NULL;

    /**
     * Unit. 0:m/s, 1:km/h, 2:knots, 3:mph
     * @var integer
     */
    private $_Unit = NULL;

    /**
     * Determines if the variable is set and is not NULL.
     * Returns TRUE if the variable has value other than NULL, FALSE otherwise.
     *
     * @return boolean
     */
    public function isValid()
    {
        return isset( $this->_Value );
    }

    /** Speed section
     * ************** */
    /**
     * Unit: meters per second
     */

    const MPS = 0;

    /**
     * Unit: kilometers per hour
     */
    const KMPH = 1;

    /**
     * Unit: knots
     */
    const KNOT = 2;

    /**
     * Unit: miles per hour
     */
    const MPH = 3;

    /**
     * Unit: Beaufort
     */
    const BFT = 4;

    /**
     * Set meters per second unit.
     *
     * @param numeric $value
     */
    public function setMetersPerSecond( $value )
    {
        $this->_Value = NULL;
        $this->_Unit  = NULL;
        if( is_numeric( $value ) )
        {
            $this->_Value = $value;
            $this->_Unit  = self::MPS;
        }
    }

    /**
     * Set kilometers per hour unit.
     *
     * @param numeric $value
     */
    public function setKilometersPerHour( $value )
    {
        $this->_Value = NULL;
        $this->_Unit  = NULL;
        if( is_numeric( $value ) )
        {
            $this->_Value = $value;
            $this->_Unit  = self::KMPH;
        }
    }

    /**
     * Set knots unit.
     *
     * @param numeric $value
     */
    public function setKnots( $value )
    {
        $this->_Value = NULL;
        $this->_Unit  = NULL;
        if( is_numeric( $value ) )
        {
            $this->_Value = $value;
            $this->_Unit  = self::KNOT;
        }
    }

    /**
     * Set miles per hour unit.
     *
     * @param numeric $value
     */
    public function setMilesPerHour( $value )
    {
        $this->_Value = NULL;
        $this->_Unit  = NULL;
        if( is_numeric( $value ) )
        {
            $this->_Value = $value;
            $this->_Unit  = self::MPH;
        }
    }

    /**
     * Set Beaufort unit.
     *
     * @param integer $value
     */
    public function setBeaufort( $value )
    {
        $this->_Value = NULL;
        $this->_Unit  = NULL;
        if( is_integer( $value ) && ($value >= 0) && ($value < 13) )
        {
            $this->_Value = $value;
            $this->_Unit  = self::BFT;
        }
    }

    /**
     * Get the unit of the value
     *
     * @return int
     */
    public function getUnit()
    {
        return $this->_Unit;
    }

    /**
     * Get meters per second unit.
     * About Beaufort conversion read:
     * @see http://fr.wikipedia.org/wiki/Échelle_de_Beaufort
     *
     * @return int|float
     */
    public function getMetersPerSecond()
    {
        $fReturn = NULL;
        if( isset( $this->_Value ) && isset( $this->_Unit ) )
        {
            switch( $this->_Unit )
            {
                case self::KMPH: // km/h
                    $fReturn = $this->_Value / 3.6;
                    break;
                case self::KNOT: // knots
                    $fReturn = $this->_Value * (0.51 + 4 / 900);
                    break;
                case self::MPH: // mph
                    $fReturn = $this->_Value * 0.44704;
                    break;
                case self::BFT: // bft
                    $fReturn = 0.8334 * pow( $this->_Value, 1.5 );
                    break;
                default:
                    $fReturn = $this->_Value;
            }
        }
        return $fReturn;
    }

    /**
     * Get kilometers per hour unit.
     * About Beaufort conversion read:
     * @see http://fr.wikipedia.org/wiki/Échelle_de_Beaufort
     *
     * @return int|float
     */
    public function getKilometersPerHour()
    {
        $fReturn = NULL;
        if( isset( $this->_Value ) && isset( $this->_Unit ) )
        {
            switch( $this->_Unit )
            {
                case self::MPS: // m/s
                    $fReturn = $this->_Value * 3.6;
                    break;
                case self::KNOT: // knots
                    $fReturn = $this->_Value * 1.85200;
                    break;
                case self::MPH: // mph
                    $fReturn = $this->_Value * 1.609344;
                    break;
                case self::BFT: // bft
                    $fReturn = 3 * pow( $this->_Value, 1.5 );
                    break;
                default: // km/h
                    $fReturn = $this->_Value;
            }
        }
        return $fReturn;
    }

    /**
     * Get knots unit.
     * About Beaufort conversion read:
     * @see http://fr.wikipedia.org/wiki/Échelle_de_Beaufort
     *
     * @return int|float
     */
    public function getKnots()
    {
        $fReturn = NULL;
        if( isset( $this->_Value ) && isset( $this->_Unit ) )
        {
            switch( $this->_Unit )
            {
                case self::MPS: // m/s
                    $fReturn = $this->_Value / (0.51 + 4 / 900);
                    break;
                case self::KMPH: // km/h
                    $fReturn = $this->_Value * 0.539956803;
                    break;
                case self::MPH: // mph
                    $fReturn = $this->_Value * 0.868976242;
                    break;
                case self::BFT: // bft
                    $fReturn = 1.62 * pow( $this->_Value, 1.5 );
                    break;
                default: // knots
                    $fReturn = $this->_Value;
            }
        }
        return $fReturn;
    }

    /**
     * Get miles per hour unit.
     * About Beaufort conversion read:
     * @see http://fr.wikipedia.org/wiki/Échelle_de_Beaufort
     *
     * @return int|float
     */
    public function getMilesPerHour()
    {
        $fReturn = NULL;
        if( isset( $this->_Value ) && isset( $this->_Unit ) )
        {
            switch( $this->_Unit )
            {
                case self::MPS: // m/s
                    $fReturn = $this->_Value / 0.44704;
                    break;
                case self::KMPH: // km/h
                    $fReturn = $this->_Value * 0.621371192;
                    break;
                case self::KNOT: // knots
                    $fReturn = $this->_Value * 1.15077945;
                    break;
                case self::BFT: // bft
                    // Convert to km/h then to mph
                    $fReturn = (3 * pow( $this->_Value, 1.5 )) * 0.621371192;
                    break;
                default: // mph
                    $fReturn = $this->_Value;
            }
        }
        return $fReturn;
    }

    /**
     * Get Beaufort unit.
     * The fonction converts the current unit to km/h. Then converts to Beaufort using the function described here:
     * @see http://fr.wikipedia.org/wiki/Échelle_de_Beaufort
     *
     * @return int
     */
    public function getBeaufort()
    {
        $iReturn = NULL;
        if( isset( $this->_Value ) && isset( $this->_Unit ) )
        {
            if( self::BFT == $this->_Unit )
            {
                // Beaufort to beaufort
                $iReturn = $this->_Value;
            }
            else
            {
                // Convert to km/s
                switch( $this->_Unit )
                {
                    case self::MPS: // m/s
                        $kmph    = $this->_Value * 3.6;
                        break;
                    case self::KNOT: // knots
                        $kmph    = $this->_Value * 1.85200;
                        break;
                    case self::MPH: // mph
                        $kmph    = $this->_Value * 1.609344;
                        break;
                    default: // km/h
                        $kmph    = $this->_Value;
                }//switch( ...
                // Convert to Beaufort
                $iReturn = (int)round( round( pow( (($kmph * $kmph) / 9 ), (1 / 3 ) ), 2 ), 0, PHP_ROUND_HALF_DOWN );
                if( $iReturn > 12 )
                    $iReturn = 12;
            }
        }
        return $iReturn;
    }

}