<?php
namespace Foundation\Test\Gd;

defined('FOUNDATION_EXCEPTION_PATH') || define(
    'FOUNDATION_EXCEPTION_PATH',
    APPLICATION_PATH . '/src/Foundation/Exception'
);
interface_exists('\Foundation\Exception\ExceptionInterface') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
class_exists('\Foundation\Exception\InvalidArgumentException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');
interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));
class_exists('\Foundation\Type\Complex\CPath') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CPath.php'));

defined('FOUNDATION_GD_PATH') || define('FOUNDATION_GD_PATH', APPLICATION_PATH . '/src/Foundation/Gd');
class_exists('\Foundation\Gd\CResource') || require(realpath(FOUNDATION_GD_PATH . '/CResource.php'));

class_exists('\Foundation\Test\Framework\Provider\CDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php'));

class CResourceTest extends \PHPUnit_Framework_TestCase
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
            } else {
                static::$_aException[] = $test;
            }
        }
    }

    /** Test section
     * ************* */

    /**
     * Data error
     * @var array
     */
    public static $_aException = null;

    /**
     * Valid data
     * @var array
     */
    public static $_aValid = null;

    /**
     * @covers \Foundation\Gd\CResource
     * @group specification
     */
    public function testConstructException()
    {
        foreach (static::$_aException as $data) {
            $label = &$data['label'];
            $test  = &$data['test'];

            try {
                $pFile     = new \Foundation\Type\Complex\CPath($test['value']);
                $pResource = new \Foundation\Gd\CResource($pFile);
                unset($pResource, $pFile);
                $this->fail($label . ' No exception raised.');
            } catch (\Foundation\Exception\InvalidArgumentException $exc) {
                $this->assertTrue(true);
            } catch (\Exception $exc) {
                $this->fail($label . ' No the expected exception.');
            }
        }
    }

    /**
     * @covers \Foundation\Gd\CResource
     * @group specification
     */
    public function testOpenValid()
    {
        // Initialize
        $pFileOut01 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.01');
        $pFileOut02 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.02');
        $pFileOut03 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.03');

        foreach (static::$_aValid as $data) {
            $label     = &$data['label'];
            $test      = &$data['test'];
            $expected  = &$data['expected'];
            $pFile     = new \Foundation\Type\Complex\CPath($test['value']);
            $pResource = new \Foundation\Gd\CResource($pFile);
            unset($pFile);

            $this->assertTRUE(is_resource($pResource->getResource()), $label . ' resource');
            $this->assertTRUE($expected['info']['width'] === $pResource->getWidth(), $label . ' width');
            $this->assertTRUE($expected['info']['height'] === $pResource->getHeight(), $label . ' height');
            $this->assertTRUE($expected['info']['type'] === $pResource->getType(), $label . ' type');
            $this->assertTRUE($expected['info']['tag'] === $pResource->getTag(), $label . ' tag');
            $this->assertTRUE($expected['info']['mime'] === $pResource->getMime(), $label . ' mime');
            $this->assertTRUE($expected['info']['channels'] === $pResource->getChannels(), $label . ' channels');
            $this->assertTRUE($expected['info']['bits'] === $pResource->getBits(), $label . ' bits');
            $this->assertSame(0, strcasecmp($expected['info']['string'], (string)$pResource), $label . ' string');

            // Save same type
            $this->assertTRUE($pResource->save($pFileOut01, 0), $label . ' save-1');
            $aImageInfo = getimagesize((string)$pFileOut01);
            $this->assertTRUE($aImageInfo[2] === $pResource->getType(), $label . ' save-1-type');
            $this->assertTRUE(unlink((string)$pFileOut01), $label . ' unlink 1');

            // Save JPEG
            $this->assertTRUE($pResource->saveAs($pFileOut02, IMAGETYPE_JPEG, 0), $label . ' save-2');
            $aImageInfo = getimagesize((string)$pFileOut02);
            $this->assertTRUE($aImageInfo[2] === 2, $label . ' save-2-type');
            //$this->assertTRUE( unlink( (string)$pFileOut02 ), $label . ' unlink 2' );
            // Save PNG
            $this->assertTRUE($pResource->saveAs($pFileOut03, IMAGETYPE_PNG, 0), $label . ' save-3');
            $aImageInfo = getimagesize((string)$pFileOut03);
            $this->assertTRUE($aImageInfo[2] === 3, $label . ' save-3-type');
            $this->assertTRUE(unlink((string)$pFileOut03), $label . ' unlink 3');

            unset($pResource);
            sleep(1);
        }
        unset($pFileOut03, $pFileOut02, $pFileOut01);
    }

    /**
     * @covers \Foundation\Gd\CResource
     * @group specification
     */
    public function testCopyValid()
    {
        // Initialize
        $pFileOut01 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.01');
        $pFileOut02 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.02');
        $pFileOut03 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.03');

        foreach (static::$_aValid as $data) {
            $label     = &$data['label'];
            $test      = &$data['test'];
            $expected  = &$data['expected'];
            $pFile     = new \Foundation\Type\Complex\CPath($test['value']);
            $pTemp     = new \Foundation\Gd\CResource($pFile);
            $pResource = new \Foundation\Gd\CResource($pTemp);
            unset($pFile);

            $this->assertTRUE(is_resource($pResource->getResource()), $label . ' resource');
            $this->assertTRUE($expected['info']['width'] === $pResource->getWidth(), $label . ' width');
            $this->assertTRUE($expected['info']['height'] === $pResource->getHeight(), $label . ' height');
            $this->assertTRUE($expected['info']['type'] === $pResource->getType(), $label . ' type');
            $this->assertTRUE($expected['info']['tag'] === $pResource->getTag(), $label . ' tag');
            $this->assertTRUE($expected['info']['mime'] === $pResource->getMime(), $label . ' mime');
            $this->assertTRUE($expected['info']['channels'] === $pResource->getChannels(), $label . ' channels');
            $this->assertTRUE($expected['info']['bits'] === $pResource->getBits(), $label . ' bits');
            $this->assertSame(0, strcasecmp($expected['info']['string'], (string)$pResource), $label . ' string');

            // Save same type
            $this->assertTRUE($pResource->save($pFileOut01, 0), $label . ' save-1');
            $aImageInfo = getimagesize((string)$pFileOut01);
            $this->assertTRUE($aImageInfo[2] === $pResource->getType(), $label . ' save-1-type');
            $this->assertTRUE(unlink((string)$pFileOut01), $label . ' unlink 1');

            // Save JPEG
            $this->assertTRUE($pResource->saveAs($pFileOut02, IMAGETYPE_JPEG, 0), $label . ' save-2');
            $aImageInfo = getimagesize((string)$pFileOut02);
            $this->assertTRUE($aImageInfo[2] === 2, $label . ' save-2-type');
            //$this->assertTRUE( unlink( (string)$pFileOut02 ), $label . ' unlink 2' );
            // Save PNG
            $this->assertTRUE($pResource->saveAs($pFileOut03, IMAGETYPE_PNG, 0), $label . ' save-3');
            $aImageInfo = getimagesize((string)$pFileOut03);
            $this->assertTRUE($aImageInfo[2] === 3, $label . ' save-3-type');
            $this->assertTRUE(unlink((string)$pFileOut03), $label . ' unlink 3');

            unset($pResource, $pTemp);
            sleep(1);
        }
        unset($pFileOut03, $pFileOut02, $pFileOut01);
    }

    /**
     * @covers \Foundation\Gd\CResource
     * @group specification
     */
    public function testReplaceValid()
    {
        // Initialize
        $pFileOut02 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.02');
        $pFileOut03 = new \Foundation\Type\Complex\CPath(APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'todelete.03');

        foreach (static::$_aValid as $data) {
            $label     = $data['label'];
            $test      = &$data['test'];
            $expected  = &$data['expected'];
            $pFile     = new \Foundation\Type\Complex\CPath($test['value']);
            $pTemp     = new \Foundation\Gd\CResource($pFile);
            $pResource = new \Foundation\Gd\CResource($pTemp);
            unset($pFile);

            $rResource = imagecreatetruecolor($pResource->getWidth(), $pResource->getHeight());
            $pResource->setResource($rResource);

            $this->assertTRUE(is_resource($pResource->getResource()), $label . ' resource');

            // Save JPEG
            $this->assertTRUE($pResource->saveAs($pFileOut02, IMAGETYPE_JPEG, 0), $label . ' save-2');
            $aImageInfo = getimagesize((string)$pFileOut02);
            $this->assertTRUE($aImageInfo[2] === 2, $label . ' save-2-type');
            $this->assertTRUE(unlink((string)$pFileOut02), $label . ' unlink 2');

            // Save PNG
            $this->assertTRUE($pResource->saveAs($pFileOut03, IMAGETYPE_PNG, 0), $label . ' save-3');
            $aImageInfo = getimagesize((string)$pFileOut03);
            $this->assertTRUE($aImageInfo[2] === 3, $label . ' save-3-type');
            $this->assertTRUE(unlink((string)$pFileOut03), $label . ' unlink 3');

            imagedestroy($rResource);
            unset($pResource, $pTemp);
            sleep(1);
        }
        unset($pFileOut03, $pFileOut02);
    }

    /**
     * @covers \Foundation\Gd\CResource::save
     * @group specification
     */
    public function testSaveError()
    {
        // Initialize
        $aTests = [
            ['label' => 'Test: save to dir', 'test'  => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR ],
            ['label' => 'Test: save to void', 'test'  => '' ],
        ];

        $pFileIn = new \Foundation\Type\Complex\CPath(FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.png');

        // Tests
        foreach ($aTests as $data) {
            $label     = $data['label'];
            $test      = $data['test'];
            $pResource = new \Foundation\Gd\CResource($pFileIn);
            $pFileOut  = new \Foundation\Type\Complex\CPath($test);
            $this->assertFalse($pResource->save($pFileOut), $label);
            unset($pResource, $pFileOut);
        }

        unset($pFileIn);
    }

    /**
     * @covers \Foundation\Gd\CResource::saveAs
     * @group specification
     */
    public function testSaveAsError()
    {
        // Initialize
        $aTests = [
            [
                'label' => 'Test: save to file',
                'test'  => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'shouldnotexist.jpg',
                'type'  => -1 ],
            [
                'label' => 'Test: save to void',
                'test'  => '',
                'type'  => IMAGETYPE_JPEG ],
        ];

        $pFileIn = new \Foundation\Type\Complex\CPath(FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.jpg');

        // Tests
        foreach ($aTests as $data) {
            $label     = $data['label'];
            $test      = $data['test'];
            $type      = $data['type'];
            $pResource = new \Foundation\Gd\CResource($pFileIn);
            $pFileOut  = new \Foundation\Type\Complex\CPath($test);
            $this->assertFalse($pResource->saveAs($pFileOut, $type), $label);
            unset($pResource, $pFileOut);
        }

        unset($pFileIn);
    }
}
