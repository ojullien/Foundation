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
 * class for image processing.
 *
 * @category   Foundation
 * @package    GD
 * @subpackage Image
 * @version    1.0.0
 * @since      1.0.0
 */
final class CImage extends \Foundation\Gd\CGDAbstract
{
    /** Class section
     * ************** */

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset( $this->_pResource );
        parent::__destruct();
    }

    /**
     * Constructor. The file should exists.
     *
     * @param mixed $resource \Foundation\Gd\CResource opened resource
     *                        \Foundation\Type\Complex\CPath   File to open
     * @throws \Foundation\Exception\InvalidArgumentException if the resource is not valid.
     */
    public function __construct( $resource )
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid( 'cimage', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $resource ] );

        //@codeCoverageIgnoreEnd
        if( $resource instanceof \Foundation\Gd\CResource )
        {
            $this->_pResource = $resource;
        }
        elseif( $resource instanceof \Foundation\Type\Complex\CPath && $resource->isValid() )
        {
            $this->_pResource = new \Foundation\Gd\CResource( $resource );
        }
        else
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Invalid resource.' );
        }
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->_pResource;
    }

    /** Resource section
     * ***************** */

    /**
     * Image resource
     * @var \Foundation\Gd\CResource
     */
    private $_pResource = NULL;

    /**
     * Creates a image file from the given image.
     *
     * @param \Foundation\Type\Complex\CPath $sFilename The path to save the file to.
     * @param integer                        $iQuality  [OPTIONAL] Compression level.
     *                                                  JPEG: from 0 (worst quality, smaller file) to 100 (best quality, biggest file).
     *                                                  PNG: compression level, from 0 (no compression) to 9.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function save( \Foundation\Type\Complex\CPath $sFilename, $iQuality = NULL )
    {
        return $this->_pResource->save( $sFilename, $iQuality );
    }

    /**
     * Creates a image file from the given image to the specified format.
     *
     * @param \Foundation\Type\Complex\CPath $sFilename  The path to save the file to.
     * @param integer                        $iImageType One of the IMAGETYPE_XXX constants.
     * @param integer                        $iQuality   [OPTIONAL] Compression level.
     *                                                   JPEG: from 0 (worst quality, smaller file) to 100 (best quality, biggest file).
     *                                                   PNG: compression level, from 0 (no compression) to 9.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function saveAs( \Foundation\Type\Complex\CPath $sFilename, $iImageType, $iQuality = NULL )
    {
        return $this->_pResource->saveAs( $sFilename, $iImageType, $iQuality );
    }

    /** Resize section
     * *************** */

    /**
     * Changes the size of the image. This method will replace a rectangular area
     * from the current resource at position $sourcePosition and replace it in
     * a rectangular area of dimensions $destinationDimensions at position
     * $destinationPosition.
     *
     * @param \Foundation\Gd\CDimensions  $destinationDimensions Dimension of the destination image.
     * @param \Foundation\Gd\CCoordinates $destinationPosition   Destination start position
     * @param \Foundation\Gd\CDimensions  $sourceDimensions      Dimension of the source image.
     * @param \Foundation\Gd\CCoordinates $sourcePosition        Source start position
     * @param boolean                     $bKeepTransparency     If TRUE then keep transparency in PNG format.
     * @return void
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    private function resample( \Foundation\Gd\CDimensions $destinationDimensions
    , \Foundation\Gd\CCoordinates $destinationPosition
    , \Foundation\Gd\CDimensions $sourceDimensions
    , \Foundation\Gd\CCoordinates $sourcePosition
    , $bKeepTransparency = TRUE )
    {
        // Check parameters
        $bKeepTransparency = ($bKeepTransparency === FALSE) ? FALSE : TRUE;

        // Create a new true color image
        $rNewResource = imagecreatetruecolor( $destinationDimensions->getWidth(), $destinationDimensions->getHeight() );
        if( !is_resource( $rNewResource ) )
            throw new \Foundation\Exception\RuntimeException( 'Resource is not allocated.' );

        // Preserve transparency
        if( $bKeepTransparency && ($this->_pResource->getType() == IMAGETYPE_PNG) )
        {
            $pStartPoint = new \Foundation\Gd\CCoordinates( 0, 0, 0 );
            $pMask       = new \Foundation\Gd\CColor( 255, 255, 255, 0 );
            $this->addAlphaBlending( $rNewResource, $pMask, $pStartPoint );
            unset( $pMask, $pStartPoint );
        }

        // Resize
        if( !imagecopyresampled( $rNewResource, $this->_pResource->getResource(), $destinationPosition->getX(),
                                 $destinationPosition->getY(), $sourcePosition->getX(), $sourcePosition->getY(),
                                 $destinationDimensions->getWidth(), $destinationDimensions->getHeight(),
                                 $sourceDimensions->getWidth(), $sourceDimensions->getHeight() ) )
            throw new \Foundation\Exception\RuntimeException( 'Resize failure.' );

        // On success, replace the original resource
        $this->_pResource->setResource( $rNewResource );
    }

    /**
     * Changes the size of an image by absolute pixel. The image is either
     * enlarged or reduced to fit the specified sizes.
     *
     * If $bMaintainAspectRatio is TRUE then the image maintains the aspect
     * ratio: if Width > Height then the image will maintain a proportional
     * height value, and vice versa.
     *
     * @param \Foundation\Gd\CDimensions $newDimensions Resize image to.
     * @param boolean                    $bMaintainAspectRatio if TRUE then keep aspect ratio.
     * @param boolean                    $bKeepTransparency    if TRUE then keep transparency in PNG format.
     * @return void
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    public function resizeByAbsolute( \Foundation\Gd\CDimensions $newDimensions, $bMaintainAspectRatio = TRUE,
                                      $bKeepTransparency = TRUE )
    {
        // Check parameters
        $bMaintainAspectRatio = ($bMaintainAspectRatio === FALSE) ? FALSE : TRUE;

        // Compute new dimensions
        if( $bMaintainAspectRatio )
        {
            $pCurrentDimensions = new \Foundation\Gd\CDimensions( $this->_pResource->getWidth(),
                                                                  $this->_pResource->getHeight() );
            $pDimensions        = $pCurrentDimensions->resizeByAbsolute( $newDimensions );
            unset( $pCurrentDimensions );
        }
        else
        {
            $pDimensions = $newDimensions;
        }

        // Resize
        if( $this->_pResource->getWidth() != $pDimensions->getWidth() || $this->_pResource->getHeight() != $pDimensions->getHeight() )
        {
            $pDestinationPosition = new \Foundation\Gd\CCoordinates( 0, 0, 0 );
            $pSourcePosition      = new \Foundation\Gd\CCoordinates( 0, 0, 0 );
            $pSourceDimensions    = new \Foundation\Gd\CDimensions( $this->_pResource->getWidth(),
                                                                    $this->_pResource->getHeight() );
            $this->resample( $pDimensions, $pDestinationPosition, $pSourceDimensions, $pSourcePosition,
                             $bKeepTransparency );
            unset( $pSourceDimensions, $pSourcePosition, $pDestinationPosition );
        }
    }

    /**
     * Changes the size of an image by relative percentage. The image is either
     * enlarged or reduced to fit the specified sizes.
     *
     * @param integer $value             Percentage.
     * @param boolean $bKeepTransparency if TRUE then keep transparency in PNG format.
     * @return void
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    public function resizeByPercentage( $value, $bKeepTransparency = TRUE )
    {
        // Compute new dimensions
        $pCurrentDimensions = new \Foundation\Gd\CDimensions( $this->_pResource->getWidth(),
                                                              $this->_pResource->getHeight() );
        $newDimensions      = $pCurrentDimensions->resizeByPercentage( $value );
        unset( $pCurrentDimensions );

        // Resize
        $pDestinationPosition = new \Foundation\Gd\CCoordinates( 0, 0, 0 );
        $pSourcePosition      = new \Foundation\Gd\CCoordinates( 0, 0, 0 );
        $pSourceDimensions    = new \Foundation\Gd\CDimensions( $this->_pResource->getWidth(),
                                                                $this->_pResource->getHeight() );
        $this->resample( $newDimensions, $pDestinationPosition, $pSourceDimensions, $pSourcePosition, $bKeepTransparency );
        unset( $pSourceDimensions, $pSourcePosition, $pDestinationPosition, $newDimensions );
    }

    /**
     * Shrink a portion of the image without affecting the size of the image.
     *
     * @param \Foundation\Gd\CCoordinates $position          Starting point of the region to crop
     * @param \Foundation\Gd\CDimensions  $dimensions        Size of the region
     * @param boolean                 $bKeepTransparency if TRUE then keep transparency in PNG format.
     * @return void
     * @throws \Foundation\Exception\RangeException If the region does not belong to the image.
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    public function crop( \Foundation\Gd\CCoordinates $position, \Foundation\Gd\CDimensions $dimensions,
                          $bKeepTransparency = TRUE )
    {
        // Position shall be int the image
        if( ($position->getX() > $this->_pResource->getWidth()) || ($position->getY() > $this->_pResource->getHeight()) )
            throw new \Foundation\Exception\RangeException( 'Invalid region.' );

        // Cannot crop outside the image
        $width                  = ( ($dimensions->getWidth() + $position->getX()) > $this->_pResource->getWidth() ) ? $this->_pResource->getWidth() : $dimensions->getWidth();
        $height                 = ( ($dimensions->getHeight() + $position->getY()) > $this->_pResource->getHeight() ) ? $this->_pResource->getHeight() : $dimensions->getHeight();
        $pDestinationDimensions = new \Foundation\Gd\CDimensions( $width, $height );
        $pDestinationPosition   = new \Foundation\Gd\CCoordinates( 0, 0, 0 );

        // Resample
        $this->resample( $pDestinationDimensions, $pDestinationPosition, $pDestinationDimensions, $position,
                         $bKeepTransparency );
        unset( $pDestinationPosition, $pDestinationDimensions );
    }

    /**
     * Shrink a portion of the image from the center and without affecting the
     * size of the image.
     *
     * @param \Foundation\Gd\CDimensions  $dimensions        Size of the region
     * @param boolean                     $bKeepTransparency if TRUE then keep transparency in PNG format.
     * @return void
     * @throws \Foundation\Exception\RangeException If the region does not belong to the image.
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    public function cropFromCenter( \Foundation\Gd\CDimensions $dimensions, $bKeepTransparency = TRUE )
    {
        // Cannot crop outside the image
        $width       = ( $dimensions->getWidth() > $this->_pResource->getWidth() ) ? $this->_pResource->getWidth() : $dimensions->getWidth();
        $height      = ( $dimensions->getHeight() > $this->_pResource->getHeight() ) ? $this->_pResource->getHeight() : $dimensions->getHeight();
        $pDimensions = new \Foundation\Gd\CDimensions( $width, $height );
        $pPosition   = new \Foundation\Gd\CCoordinates( ($this->_pResource->getWidth() - $width) / 2,
                                                        ($this->_pResource->getHeight() - $height) / 2, 0 );

        // Resample
        $this->crop( $pPosition, $pDimensions, $bKeepTransparency );
        unset( $pPosition, $pDimensions );
    }

    /**
     * Resizes the image down to the closest match and then crops from the
     * centre the desired dimensions.
     *
     * @param \Foundation\Gd\CDimensions $pFrame            Dimension of the frame the image shall fit to.
     * @param boolean                $bKeepTransparency if TRUE then keep transparency in PNG format.
     * @return void
     * @throws \Foundation\Exception\RangeException If the region does not belong to the image.
     * @throws \Foundation\Exception\RuntimeException if something bad occured
     */
    public function resizeAdaptive( \Foundation\Gd\CDimensions $pFrame
    , $bKeepTransparency = TRUE )
    {
        // Compute new dimensions
        $pCurrentDimensions = new \Foundation\Gd\CDimensions( $this->_pResource->getWidth(),
                                                              $this->_pResource->getHeight() );
        $pNewDimensions     = $pCurrentDimensions->resizeClose( $pFrame );
        unset( $pCurrentDimensions );

        // Resize
        if( $this->_pResource->getWidth() != $pNewDimensions->getWidth() || $this->_pResource->getHeight() != $pNewDimensions->getHeight() )
        {
            $pDestinationPosition = new \Foundation\Gd\CCoordinates( 0, 0, 0 );
            $pSourcePosition      = new \Foundation\Gd\CCoordinates( 0, 0, 0 );
            $pSourceDimensions    = new \Foundation\Gd\CDimensions( $this->_pResource->getWidth(),
                                                                    $this->_pResource->getHeight() );
            $this->resample( $pNewDimensions, $pDestinationPosition, $pSourceDimensions, $pSourcePosition,
                             $bKeepTransparency );
            unset( $pSourceDimensions, $pSourcePosition, $pDestinationPosition );
        }
        unset( $pNewDimensions );

        // Crop from center
        if( $this->_pResource->getWidth() != $pFrame->getWidth() || $this->_pResource->getHeight() != $pFrame->getHeight() )
        {
            $this->cropFromCenter( $pFrame, $bKeepTransparency );
        }
    }

}