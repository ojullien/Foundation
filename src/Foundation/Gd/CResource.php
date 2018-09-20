<?php
namespace Foundation\Gd;

/**
 * Foundation Framework
 *
 * @package   GD
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * This class enforces strong typing of the image resource type.
 *
 * @category   Foundation
 * @package    GD
 * @subpackage Resource
 * @version    1.0.0
 * @since      1.0.0
 */
final class CResource
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
     * @param mixed $resource Resource From an image resource, returned by one of the image creation functions
     *                        , such as imagecreatetruecolor() or from a \Foundation\Gd\CResource object or filename
     *                        (\Foundation\Type\Complex\CPath)
     * @throws \Foundation\Exception\InvalidArgumentException if the resource is not valid.
     * @codeCoverageIgnore
     */
    public function __construct($resource)
    {
        $this->_sDebugID = uniqid('cresource', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $resource ]
                );

        $this->setResource($resource);
    }

    /**
     * Destructor
     * @codeCoverageIgnore
     */
    public function __destruct()
    {
        if (is_resource($this->_rResource)) {
            imagedestroy($this->_rResource);
        }

        $this->_rResource = null;

        defined('FOUNDATION_DEBUG') && ! defined('FOUNDATION_DEBUG_OFF') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete($this->_sDebugID);
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return serialize([
            'width'    => imagesx($this->_rResource),
            'height'   => imagesy($this->_rResource),
            'type'     => $this->_iType,
            'tag'      => 'width="' . imagesx($this->_rResource) . '" height="' . imagesy($this->_rResource) . '"',
            'mime'     => $this->_sMime,
            'channels' => $this->_iChannels,
            'bits'     => $this->_iBits ]);
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
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

    /** open resource section
     * ********************** */

    /**
     * Sets the resource from a file.
     *
     * @param \Foundation\Type\Complex\CPath $filename
     * @return void
     */
    private function open(\Foundation\Type\Complex\CPath $filename)
    {
        $sFile = $filename->getRealPath();
        if ($sFile && is_file($sFile)) {
            $aImageInfo = getimagesize($sFile);
            if (is_array($aImageInfo)) {
                switch ($aImageInfo[2]) {
                    case IMAGETYPE_JPEG:
                        $this->_rResource = imagecreatefromjpeg($filename->getValue());
                        break;
                    case IMAGETYPE_PNG:
                        $this->_rResource = imagecreatefrompng($filename->getValue());
                        break;
                    default:
                        $this->_rResource = null;
                        break;
                }
                $this->_iType     = (isset($aImageInfo[2])) ? $aImageInfo[2] : false;
                $this->_sMime     = (isset($aImageInfo['mime'])) ? $aImageInfo['mime'] : false;
                $this->_iChannels = (isset($aImageInfo['channels'])) ? $aImageInfo['channels'] : false;
                $this->_iBits     = (isset($aImageInfo['bits'])) ? $aImageInfo['bits'] : false;
            }
        }
    }

    /**
     * Sets the resource from a \Foundation\Gd\CResource object.
     *
     * @param \Foundation\Gd\CResource $resource
     * @return void
     */
    private function reference(\Foundation\Gd\CResource $resource)
    {
        $this->_rResource = $resource->getResource();
        $this->_iType     = $resource->getType();
        $this->_sMime     = $resource->getMime();
        $this->_iChannels = $resource->getChannels();
        $this->_iBits     = $resource->getBits();
    }

    /**
     * Sets the resource from an image resource, returned by one of the image
     * creation functions, such as imagecreatetruecolor().
     *
     * @param resource $resource
     * @return void
     */
    private function replace($resource)
    {
        if (is_resource($resource) && ( strcasecmp(get_resource_type($resource), 'gd') == 0 )) {
            $this->_rResource = $resource;
            $this->_iChannels = false;
            $this->_iBits     = false;
        }
    }

    /** Resource section
     * ***************** */

    /**
     * Resource identifier
     * @var resource
     */
    private $_rResource = null;

    /**
     * IMAGETYPE_XXX constants indicating the type of the image
     * @var integer
     */
    private $_iType = false;

    /**
     * MIME type of the image. This information can be used to deliver
     * images with the correct HTTP Content-type header.
     * @var string
     */
    private $_sMime = false;

    /**
     * Alpha channel: will be 3 for RGB pictures and 4 for CMYK pictures.
     * @var integer
     */
    private $_iChannels = false;

    /**
     * Number of bits for each color
     * @var integer
     */
    private $_iBits = false;

    /**
     * Set the resource.
     *
     * @param mixed $resource
     * @return void
     * @throws \Foundation\Exception\InvalidArgumentException if the resource is not valid.
     */
    public function setResource($resource)
    {
        // Destroy old resource
        if (is_resource($this->_rResource)) {
            imagedestroy($this->_rResource);
        }

        $this->_rResource = null;

        // Check parameter
        try {
            if ($resource instanceof \Foundation\Type\Complex\CPath && $resource->isValid()) {
                $this->open($resource);
            } elseif ($resource instanceof \Foundation\Gd\CResource) {
                $this->reference($resource);
            } else {
                $this->replace($resource);
            }
        } catch (\Exception $exc) {
            if (is_resource($this->_rResource)) {
                imagedestroy($this->_rResource);
            }
            $this->_rResource = null;
        }

        // Check error
        if (! is_resource($this->_rResource)) {
            throw new \Foundation\Exception\InvalidArgumentException('Invalid resource.');
        }
    }

    /**
     * Get the resource
     * @return resource or NULL on errors.
     */
    public function getResource()
    {
        return $this->_rResource;
    }

    /**
     * Get the image width.
     * @return integer Return the width of the image or FALSE on errors.
     */
    public function getWidth()
    {
        return imagesx($this->_rResource);
    }

    /**
     * Get the image height.
     * @return integer Return the height of the image or FALSE on errors.
     */
    public function getHeight()
    {
        return imagesy($this->_rResource);
    }

    /**
     * Get the IMAGETYPE_XXX constants indicating the type of the image.
     * @return integer Return the type of the image or FALSE on errors.
     */
    public function getType()
    {
        return $this->_iType;
    }

    /**
     * Get text string with the correct height="yyy" width="xxx" string that can
     * be used directly in an IMG tag.
     * @return string
     */
    public function getTag()
    {
        return 'width="' . imagesx($this->_rResource)
                . '" height="' . imagesy($this->_rResource) . '"';
    }

    /**
     * Get the MIME type of the image. This information can be used to deliver
     * images with the correct HTTP Content-type header.
     * @return string Return the mime type of the image or FALSE on errors.
     */
    public function getMime()
    {
        return $this->_sMime;
    }

    /**
     * Get the alpha channel: will be 3 for RGB pictures and 4 for CMYK pictures.
     * @return integer Return the alpha channel of the image or FALSE on errors.
     */
    public function getChannels()
    {
        return $this->_iChannels;
    }

    /**
     * Get the number of bits for each color
     * @return integer Return the number of bits for each color or FALSE on errors.
     */
    public function getBits()
    {
        return $this->_iBits;
    }

    /** Saving section
     * *************** */

    /**
     * Creates a JPEG file from the given image.
     *
     * @param \Foundation\Type\Complex\CPath $sFilename The path to save the file to.
     * @param integer                    $iQuality  Compression level, optional. From 0 (worst quality, smaller file) to
     *                                              100 (best quality, biggest file).
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    private function saveJPEG(\Foundation\Type\Complex\CPath $sFilename, $iQuality = 75)
    {
        $bReturn = $sFilename->isValid();
        if ($bReturn) {
            // Quality
            if (! is_integer($iQuality) || ($iQuality < 0) || ($iQuality > 100)) {
                $iQuality = 75;
            }

            // Create the file
            $bReturn = imagejpeg($this->_rResource, $sFilename->getValue(), $iQuality);
        }
        return $bReturn;
    }

    /**
     * Creates a PNG file from the given image.
     *
     * @param \Foundation\Type\Complex\CPath $sFilename The path to save the file to.
     * @param integer                    $iQuality  Compression level, optional .From 0 (no compression) to 9.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    private function savePNG(\Foundation\Type\Complex\CPath $sFilename, $iQuality = 9)
    {
        $bReturn = $sFilename->isValid();
        if ($bReturn) {
            // Quality
            if (! is_integer($iQuality) || ($iQuality < 0) || ($iQuality > 9)) {
                $iQuality = 9;
            }

            // Create the file
            $bReturn = imagepng($this->_rResource, $sFilename->getValue(), $iQuality);
        }
        return $bReturn;
    }

    /**
     * Creates a image file from the given image.
     *
     * @param \Foundation\Type\Complex\CPath $sFilename The path to save the file to.
     * @param integer                    $iQuality  [OPTIONAL] Compression level.
     *                                              JPEG: from 0 (worst quality, smaller file) to 100 (best quality, biggest file).
     *                                              PNG: compression level, from 0 (no compression) to 9.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function save(\Foundation\Type\Complex\CPath $sFilename, $iQuality = null)
    {
        try {
            if ($this->_iType === IMAGETYPE_JPEG) {
                $bReturn = $this->saveJPEG($sFilename, $iQuality);
            } else {
                //case IMAGETYPE_PNG:
                $bReturn = $this->savePNG($sFilename, $iQuality);
            }
        } catch (\Exception $exc) {
            $bReturn = false;
        }

        return $bReturn;
    }

    /**
     * Creates a image file from the given image to the specified format.
     *
     * @param \Foundation\Type\Complex\CPath $sFilename  The path to save the file to.
     * @param integer                    $iImageType One of the IMAGETYPE_XXX constants.
     * @param integer                    $iQuality   [OPTIONAL] Compression level.
     *                                               JPEG: from 0 (worst quality, smaller file) to 100 (best quality, biggest file).
     *                                               PNG: compression level, from 0 (no compression) to 9.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function saveAs(\Foundation\Type\Complex\CPath $sFilename, $iImageType, $iQuality = null)
    {
        switch ($iImageType) {
            case IMAGETYPE_JPEG:
                $bReturn = $this->saveJPEG($sFilename, $iQuality);
                break;
            case IMAGETYPE_PNG:
                $bReturn = $this->savePNG($sFilename, $iQuality);
                break;
            default:
                $bReturn = false;
                break;
        }
        return $bReturn;
    }
}
