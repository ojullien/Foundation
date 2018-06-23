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
 * This class enforces strong typing of the RGBA color type.
 *
 * @category   Foundation
 * @package    GD
 * @subpackage Color
 * @version    1.0.0
 * @since      1.0.0
 */
final class CColor
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
     * Constructor
     *
     * @param integer $red          Red light value. [0,255].
     * @param integer $green        Green light value. [0,255].
     * @param integer $blue         Blue light value. [0,255].
     * @param integer $transparency Transparency value. [0,127].
     * @throws \Foundation\Exception\InvalidArgumentException if the parameter is not valid.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $red, $green, $blue, $transparency )
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid( 'ccolor', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $red, $green, $blue, $transparency ] );
        //@codeCoverageIgnoreEnd

        $red          = (is_numeric( $red ) ) ? (int)($red + 0) : NULL;
        $green        = (is_numeric( $green ) ) ? (int)($green + 0) : NULL;
        $blue         = (is_numeric( $blue ) ) ? (int)($blue + 0) : NULL;
        $transparency = (is_numeric( $transparency ) ) ? (int)($transparency + 0) : NULL;

        if( is_int( $red ) && ($red >= 0) && ($red <= 255) )
            $this->_iRed = $red;

        if( is_int( $green ) && ($green >= 0) && ($green <= 255) )
            $this->_iGreen = $green;

        if( is_int( $blue ) && ($blue >= 0) && ($blue <= 255) )
            $this->_iBlue = $blue;

        if( is_int( $transparency ) && ($transparency >= 0) && ($transparency <= 127) )
            $this->_iTransparency = $transparency;

        if( !isset( $this->_iRed ) || !isset( $this->_iGreen ) || !isset( $this->_iBlue ) || !isset( $this->_iTransparency ) )
            throw new \Foundation\Exception\InvalidArgumentException( 'Invalid color.' );
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
        return serialize( [
            'red'          => (string)$this->_iRed,
            'green'        => (string)$this->_iGreen,
            'blue'         => (string)$this->_iBlue,
            'transparency' => (string)$this->_iTransparency ] );
    }

    /** Color section
     * ************** */

    /**
     * Red light value.
     * @var integer
     */
    private $_iRed = NULL;

    /**
     * Green light value.
     * @var integer
     */
    private $_iGreen = NULL;

    /**
     * Blue light value.
     * @var integer
     */
    private $_iBlue = NULL;

    /**
     * Transparency value.
     * @var integer
     */
    private $_iTransparency = NULL;

    /**
     * Get red color.
     *
     * @return integer
     */
    public function getRed()
    {
        return $this->_iRed;
    }

    /**
     * Get green color.
     *
     * @return integer
     */
    public function getGreen()
    {
        return $this->_iGreen;
    }

    /**
     * Get blue color.
     *
     * @return integer
     */
    public function getBlue()
    {
        return $this->_iBlue;
    }

    /**
     * Get transparency.
     *
     * @return integer
     */
    public function getTransparency()
    {
        return $this->_iTransparency;
    }

}