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
 * This class enforces strong typing of the image dimension type.
 *
 * @category   Foundation
 * @package    GD
 * @subpackage Dimensions
 * @version    1.0.0
 * @since      1.0.0
 */
final class CDimensions
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
     * @param integer $width  Width, >=1.
     * @param integer $height Height, >=1.
     * @throws \Foundation\Exception\InvalidArgumentException if the parameters are not valid.
     */
    public function __construct( $width, $height )
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid( 'cdimensions', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ 'width="' . $width . '"', 'height="' . $height . '"' ] );
        //@codeCoverageIgnoreEnd

        $width  = (is_numeric( $width ) ) ? (int)($width + 0) : NULL;
        $height = (is_numeric( $height ) ) ? (int)($height + 0) : NULL;

        if( is_int( $width ) && ($width >= 1) )
            $this->_iWidth = $width;

        if( is_int( $height ) && ($height >= 1) )
            $this->_iHeight = $height;

        if( !isset( $this->_iHeight ) || !isset( $this->_iWidth ) )
            throw new \Foundation\Exception\InvalidArgumentException( 'Invalid dimensions.' );
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
        return serialize( [ 'width'  => (string)$this->_iWidth
            , 'height' => (string)$this->_iHeight ] );
    }

    /** Dimensions section
     * ******************* */

    /**
     * Width
     * @var integer
     */
    private $_iWidth = NULL;

    /**
     * Height
     * @var integer
     */
    private $_iHeight = NULL;

    /**
     * Returns width.
     * @return integer
     */
    public function getWidth()
    {
        return $this->_iWidth;
    }

    /**
     * Returns height.
     * @return integer
     */
    public function getHeight()
    {
        return $this->_iHeight;
    }

    /** Usefull functions
     * ****************** */

    /**
     * Computes the new size of $iSize based on the aspect ratio calculated from $iFrom and $iTo.
     *
     * Example: if $iFrom is old size of width, $iTo is new  size of width and $iSize is
     * old size of height then this function returns the new size of height.
     *
     * @param integer $iFrom
     * @param integer $iTo
     * @param integer $iSize
     * @return integer
     */
    private function scale( $iFrom, $iTo, $iSize )
    {
        $iRatio = 100 * $iTo / $iFrom;
        return ceil( $iSize * $iRatio / 100 );
    }

    /**
     * Computes new sizes by absolute pixel. The dimensions are either enlarged
     * or reduced to fit into the specified sizes.
     *
     * This function maintains the aspect ratio: if Width > Height then the
     * function will maintain a proportional height value, and vice versa.
     *
     * @param \Foundation\Gd\CDimensions $iSizes
     * @return \Foundation\Gd\CDimensions
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    public function resizeByAbsolute( \Foundation\Gd\CDimensions $iSizes )
    {
        // Sets width and calculates new height
        $newSizes = array( $iSizes->getWidth()
            , $this->scale( $this->_iWidth
                    , $iSizes->getWidth()
                    , $this->_iHeight ) );

        // Tests if computed sizes fit into the specified ones.
        if( ($newSizes[0] > $iSizes->getWidth()) || ($newSizes[1] > $iSizes->getHeight()) )
        {
            // Do not fit, sets height and calculates new width
            $newSizes = array( $this->scale( $this->_iHeight
                        , $iSizes->getHeight()
                        , $this->_iWidth )
                , $iSizes->getHeight() );
        }

        // Tests if computed sizes fit into the specified ones.
        //@codeCoverageIgnoreStart
        if( ($newSizes[0] > $iSizes->getWidth()) || ($newSizes[1] > $iSizes->getHeight()) )
        {
            // Do not fit, raise an exception
            $sBuffer = 'Invalid resize operation.';
            $sBuffer .= " From: " . $this->_iWidth . "*" . $this->_iHeight;
            $sBuffer .= " To: " . $iSizes->getWidth() . "*" . $iSizes->getHeight();
            $sBuffer .= " Values: " . $newSizes[0] . "*" . $newSizes[1];
            throw new \Foundation\Exception\RuntimeException( $sBuffer );
        }
        //@codeCoverageIgnoreEnd

        return new \Foundation\Gd\CDimensions( $newSizes[0], $newSizes[1] );
    }

    /**
     * Computes new sizes by relative percentage. Dimensions are either enlarged
     * or reduced to the specified size.
     *
     * This function maintains the aspect ratio.
     *
     * @param integer $value
     * @return \Foundation\Gd\CDimensions
     * @throws \Foundation\Exception\InvalidArgumentException if the parameter is not valid.
     */
    public function resizeByPercentage( $value )
    {
        if( !is_int( $value ) || ($value < 1) )
            throw new \Foundation\Exception\InvalidArgumentException( 'Invalid percentage value.' );

        $iWidth  = $this->_iWidth * $value / 100;
        $iHeight = $this->_iHeight * $value / 100;

        return new \Foundation\Gd\CDimensions( $iWidth, $iHeight );
    }

    /**
     * Computes new sizes by absolute pixel. The dimensions are either enlarged
     * or reduced to a closest match of the specified sizes.
     *
     * This function maintains the aspect ratio: if Width > Height then the
     * function will maintain a proportional height value, and vice versa.
     *
     * @param \Foundation\Gd\CDimensions $iSizes
     * @return \Foundation\Gd\CDimensions
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    public function resizeClose( \Foundation\Gd\CDimensions $iSizes )
    {
        // Sets height and calculates new width
        $newSizes = array( $this->scale( $this->_iHeight
                    , $iSizes->getHeight()
                    , $this->_iWidth )
            , $iSizes->getHeight() );

        // Tests if computed sizes are closed to the specified ones.
        if( ($newSizes[0] < $iSizes->getWidth()) || ($newSizes[1] < $iSizes->getHeight()) )
        {
            // Do not fit, sets width and calculates new height
            $newSizes = array( $iSizes->getWidth()
                , $this->scale( $this->_iWidth
                        , $iSizes->getWidth()
                        , $this->_iHeight ) );
        }

        // Tests if computed sizes are closed to the specified ones.
        //@codeCoverageIgnoreStart
        if( ($newSizes[0] < $iSizes->getWidth()) || ($newSizes[1] < $iSizes->getHeight()) )
        {
            // Do not fit, raise an exception
            $sBuffer = 'Invalid resize-close operation.';
            $sBuffer .= " From: " . $this->_iWidth . "*" . $this->_iHeight;
            $sBuffer .= " To: " . $iSizes->getWidth() . "*" . $iSizes->getHeight();
            $sBuffer .= " Values: " . $newSizes[0] . "*" . $newSizes[1];
            throw new \Foundation\Exception\RuntimeException( $sBuffer );
        }
        //@codeCoverageIgnoreEnd

        return new \Foundation\Gd\CDimensions( $newSizes[0], $newSizes[1] );
    }

}