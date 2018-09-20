<?php
namespace Foundation\Test\Gd;

defined('FOUNDATION_EXCEPTION_PATH') || define(
    'FOUNDATION_EXCEPTION_PATH',
    APPLICATION_PATH . '/src/Foundation/Exception'
);
interface_exists('\Foundation\Exception\ExceptionInterface') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
class_exists('\Foundation\Exception\InvalidArgumentException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));
class_exists('\Foundation\Exception\RangeException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/RangeException.php'));

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');
interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));
class_exists('\Foundation\Type\Complex\CPath') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CPath.php'));

defined('FOUNDATION_GD_PATH') || define('FOUNDATION_GD_PATH', APPLICATION_PATH . '/src/Foundation/Gd');
class_exists('\Foundation\Gd\CResource') || require(realpath(FOUNDATION_GD_PATH . '/CResource.php'));
class_exists('\Foundation\Gd\CDimensions') || require(realpath(FOUNDATION_GD_PATH . '/CDimensions.php'));
class_exists('\Foundation\Gd\CCoordinates') || require(realpath(FOUNDATION_GD_PATH . '/CCoordinates.php'));
class_exists('\Foundation\Gd\CColor') || require(realpath(FOUNDATION_GD_PATH . '/CColor.php'));
class_exists('\Foundation\Gd\CGDAbstract') || require(realpath(FOUNDATION_GD_PATH . '/CGDAbstract.php'));
class_exists('\Foundation\Gd\CImage') || require(realpath(FOUNDATION_GD_PATH . '/CImage.php'));

class_exists('\Foundation\Test\Framework\Provider\CDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php'));

class CImageTest extends \PHPUnit_Framework_TestCase
{
    /** Class section
     * *************** */

    /**
     * Loads object.
     */
    public static function setUpBeforeClass()
    {
        $tests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_RESOURCE,
            require(realpath(__DIR__ . '/provider/result/cresource.php'))
        );

        foreach ($tests as $test) {
            $expected = &$test['expected'];

            if ($expected['valid']) {
                static::$_aValid[] = $test;
            }
        }
    }

    /** Test section
     * ************* */

    /**
     * Valid data
     * @var array
     */
    public static $_aValid = null;

    private function getExtension($filename)
    {
        // Check extension
        $info      = new \SplFileInfo($filename);
        $extension = '';
        if (version_compare(phpversion(), '5.3.6', '>=')) {
            $extension = $info->getExtension();
        } else {
            $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
        }//if( version_compare(...
        // Check file
        if (empty($extension)) {
            $aInfos = getimagesize($info->getRealPath());
            if (isset($aInfos['mime']) && strlen($aInfos['mime']) > 3) {
                $extension = substr($aInfos['mime'], -3);
            }//if( isset(...
        }
        unset($info);
        return strtolower($extension);
    }

    private function verify(array $aInfoIn, array $aInfoOut)
    {
//        $s = 'In' . print_r($aInfoIn,true);
//        $s .= ' Out' . print_r($aInfoOut,true);
//        die($s);
        $breturn = ($aInfoIn[0] == $aInfoOut[0]) ? true : false;
        $breturn = $breturn && ($aInfoIn[1] == $aInfoOut[1]) ? true : false;
        $breturn = $breturn && ($aInfoIn[2] == $aInfoOut[2]) ? true : false;
        return $breturn;
    }

    private function save($extension, \Foundation\Gd\CImage $pImage, array $aInfoIn)
    {
        $bReturn   = false;
        $sFileSave = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'test-generated-ST';
        if (strcasecmp('jpg', $extension) == 0) {
            $sFileSave .= '.jpg';
        } elseif (strcasecmp('png', $extension) == 0) {
            $sFileSave .= '.png';
        } else {
            die('unknow extension: ' . print_r($extension, true) . ' (' . __LINE__ . ')');
        }
        $pFileSave = new \Foundation\Type\Complex\CPath($sFileSave);
        if ($pImage->save($pFileSave, 0)) {
            $bReturn = $this->verify($aInfoIn, getimagesize($sFileSave));
            $this->assertTRUE(unlink($sFileSave), 'unlink');
        }
        unset($pFileSave);
        return $bReturn;
    }

    private function saveAs($iType, \Foundation\Gd\CImage $pImage, array $aInfoIn)
    {
        $bReturn    = false;
        $sFileSave  = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'test-generated';
        $aInfoIn[2] = $iType;
        switch ($iType) {
            case IMAGETYPE_JPEG:
                $sFileSave .= '.jpg';
                break;
            case IMAGETYPE_PNG:
                $sFileSave .= '.png';
                break;
            default:
                die('unknow extension: ' . print_r($iType, true) . ' (' . __LINE__ . ')');
                break;
        }
        $pFileSave = new \Foundation\Type\Complex\CPath($sFileSave);
        if ($pImage->saveAs($pFileSave, $iType, 0)) {
            $bReturn = $this->verify($aInfoIn, getimagesize($sFileSave));
            $this->assertTRUE(unlink($sFileSave), 'unlink');
        }
        unset($pFileSave);
        return $bReturn;
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testSaveAndSaveAs()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testResizeByAbsoluteRatio()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Resize
            $newDimensions = new \Foundation\Gd\CDimensions(100, 100);
            $pImage->resizeByAbsolute($newDimensions, true, true);
            unset($newDimensions);
            $aImageInfo[0] = 100;
            $aImageInfo[1] = 75;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testResizeByAbsoluteNoRatio()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Resize
            $newDimensions = new \Foundation\Gd\CDimensions(100, 100);
            $pImage->resizeByAbsolute($newDimensions, false, false);
            unset($newDimensions);
            $aImageInfo[0] = 100;
            $aImageInfo[1] = 100;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testResizeByPercentageDown()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Resize
            $pImage->resizeByPercentage(50);
            $aImageInfo[0] = 250;
            $aImageInfo[1] = 187;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testResizeByPercentageUp()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Resize
            $pImage->resizeByPercentage(150);
            $aImageInfo[0] = 750;
            $aImageInfo[1] = 562;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testReference()
    {
        foreach (static::$_aValid as $data) {
            $value     = $data['test']['value'];
            $pFile     = new \Foundation\Type\Complex\CPath($value);
            $pResource = new \Foundation\Gd\CResource($pFile);

            // Create image
            $pImage = new \Foundation\Gd\CImage($pResource);

            // tostring
            $s1 = (string)$pResource;
            $s2 = (string)$pImage;
            $this->assertTRUE((strcasecmp($s1, $s2) === 0 ), 'reference toString.');

            unset($pImage, $pResource, $pFile);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @expectedException Foundation\Exception\InvalidArgumentException
     * @group specification
     */
    public function testResourceNotValid()
    {
        $sFilename = FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.gif';
        $pResource = fopen($sFilename, 'r');

        $pImage = new \Foundation\Gd\CImage($pResource);
        fclose($pResource);
        unset($pResource, $pImage);
        $this->fail('should never happen.');
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testCrop()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Crop
            $pPosition     = new \Foundation\Gd\CCoordinates(100, 100, 0);
            $newDimensions = new \Foundation\Gd\CDimensions(300, 200);
            $pImage->crop($pPosition, $newDimensions);
            unset($newDimensions);
            $aImageInfo[0] = 300;
            $aImageInfo[1] = 200;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     * @expectedException Foundation\Exception\RangeException
     * @dataProvider getProviderCropException
     */
    public function testCropException($label, array $value)
    {
        $pFile  = new \Foundation\Type\Complex\CPath(FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.jpg');
        $pImage = new \Foundation\Gd\CImage($pFile);
        unset($pFile);

        // Crop
        $pPosition     = new \Foundation\Gd\CCoordinates($value['x'], $value['y'], 0);
        $newDimensions = new \Foundation\Gd\CDimensions(300, 200);
        $pImage->crop($pPosition, $newDimensions);
        $this->fail($label . ' should never happen.');
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testCropFromCenter()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Crop
            $newDimensions = new \Foundation\Gd\CDimensions(200, 100);
            $pImage->cropFromCenter($newDimensions);
            unset($newDimensions);
            $aImageInfo[0] = 200;
            $aImageInfo[1] = 100;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testCropFromCenterSquare()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Crop
            $newDimensions = new \Foundation\Gd\CDimensions(50, 50);
            $pImage->cropFromCenter($newDimensions);
            unset($newDimensions);
            $aImageInfo[0] = 50;
            $aImageInfo[1] = 50;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /**
     * @covers \Foundation\Gd\CImage
     * @covers \Foundation\Gd\CGDAbstract
     * @group specification
     */
    public function testAdaptive()
    {
        foreach (static::$_aValid as $data) {
            $label  = $data['label'];
            $value  = $data['test']['value'];
            $pFile  = new \Foundation\Type\Complex\CPath($value);
            $pImage = new \Foundation\Gd\CImage($pFile);

            // Get informations
            $aImageInfo = getimagesize($value);

            // Resize
            $newDimensions = new \Foundation\Gd\CDimensions(175, 175);
            $pImage->resizeAdaptive($newDimensions);
            unset($newDimensions);
            $aImageInfo[0] = 175;
            $aImageInfo[1] = 175;

            // Save as same type
            $this->assertTRUE(
                $this->save($this->getExtension($value), $pImage, $aImageInfo),
                $label . ' save as same type'
            );

            // Save as JPEG
            $this->assertTRUE($this->saveAs(IMAGETYPE_JPEG, $pImage, $aImageInfo), $label . ' save as JPEG');

            // Save as PNG
            $this->assertTRUE($this->saveAs(IMAGETYPE_PNG, $pImage, $aImageInfo), $label . ' save as PNG');

            unset($pImage, $pFile);
            sleep(1);
        }
    }

    /** Provider section
     * ***************** */

    /**
     * Provider for testCropException
     *
     * @return array
     */
    public function getProviderCropException()
    {
        return [
            [ 'label' => 'Test: 1000,100', [ 'x' => 1000, 'y' => 100 ] ],
            [ 'label' => 'Test: 100,1000', [ 'x' => 1000, 'y' => 100 ] ],
        ];
    }
}
