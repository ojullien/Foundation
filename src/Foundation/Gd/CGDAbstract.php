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
 * Parent class for image and graph processing.
 *
 * @category  Foundation
 * @package   GD
 * @version   1.0.0
 * @since     1.0.0
 */
abstract class CGDAbstract
{
    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    protected $_sDebugID = '';

    /**
     * Destructor
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        defined('FOUNDATION_DEBUG') && ! defined('FOUNDATION_DEBUG_OFF') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete($this->_sDebugID);
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __set($name, $value)
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
    final public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Usefull images drawing section
     * ******************************* */

    /**
     * Adds an alpha layer on a TRUE COLOR image (PNG format).
     *
     * @param type $rResource
     * @param \Foundation\Gd\CColor $pColor Colors mask and transparency
     * @param \Foundation\Gd\CImageSize $pStartPoint Coordinates of start point
     * @return boolean FALSE on error.
     */
    final protected function addAlphaBlending(
        $rResource,
        \Foundation\Gd\CColor $pColor,
        \Foundation\Gd\CCoordinates $pStartPoint
    ) {
        $bReturn = false;
        if (is_resource($rResource)) {
            // Set the blending mode
            $bReturn = imagealphablending($rResource, false);

            // Allocate alpha color
            if ($bReturn) {
                $iColor  = imagecolorallocatealpha(
                    $rResource,
                    $pColor->getRed(),
                    $pColor->getGreen(),
                    $pColor->getBlue(),
                    $pColor->getTransparency()
                );
                $bReturn = ($iColor === false) ? false : true;
            }

            // Flood the color
            $bReturn = $bReturn && imagefill(
                $rResource,
                $pStartPoint->getX(),
                $pStartPoint->getY(),
                $iColor
            );

            // Save alpha channel
            $bReturn = $bReturn && imagesavealpha($rResource, true);
        }//if( is_resource(...
        return $bReturn;
    }
}
