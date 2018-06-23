<?php
namespace Foundation\Gd;
/**
 * Foundation Framework
 *
 * @package   GD
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class enforces strong typing of the image coordinate type.
 *
 * @category   Foundation
 * @package    GD
 * @subpackage Coordinate
 * @version    1.0.0
 * @since      1.0.0
 */
final class CCoordinates
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
     * @param float $x X-axis, >=0
     * @param float $y Y-axis, >=0
     * @param float $z Z-axis, >=0
     * @throws \Foundation\Exception\InvalidArgumentException if the parameters are not valid.
     */
    public function __construct( $x, $y, $z )
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid( 'ccoordinates', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ 'x="' . $x . '"', 'y="' . $y . '"',
                    'z="' . $z . '"' ] );
        //@codeCoverageIgnoreEnd

        $x = (is_numeric( $x ) ) ? $x + 0 : NULL;
        $y = (is_numeric( $y ) ) ? $y + 0 : NULL;
        $z = (is_numeric( $z ) ) ? $z + 0 : NULL;

        if( is_numeric( $x ) && ($x >= 0.0) )
            $this->_fX = $x;

        if( is_numeric( $y ) && ($y >= 0.0) )
            $this->_fY = $y;

        if( is_numeric( $z ) && ($z >= 0.0) )
            $this->_fZ = $z;

        if( !isset( $this->_fX ) || !isset( $this->_fY ) || !isset( $this->_fZ ) )
            throw new \Foundation\Exception\InvalidArgumentException( 'Invalid coordinates.' );
    }

    /**
     * Destructor
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
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
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return serialize( [ 'x' => (string)$this->_fX
            , 'y' => (string)$this->_fY
            , 'z' => (string)$this->_fZ ] );
    }

    /** Coordinates section
     * ******************** */

    /**
     * X-axis
     * @var float
     */
    private $_fX = NULL;

    /**
     * Y-axis
     * @var float
     */
    private $_fY = NULL;

    /**
     * Z-axis
     * @var float
     */
    private $_fZ = NULL;

    /**
     * Returns X-axis value
     * @return float
     */
    public function getX()
    {
        return $this->_fX;
    }

    /**
     * Returns Y-axis value
     * @return float
     */
    public function getY()
    {
        return $this->_fY;
    }

    /**
     * Returns Z-axis value
     * @return float
     */
    public function getZ()
    {
        return $this->_fZ;
    }

}