<?php
namespace Foundation\Test\Protocol\Download\Attachment;

trait_exists('\Foundation\Test\Protocol\Download\Provider\TAttachmentProvider') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Protocol/Download/provider/TAttachmentProvider.php'));

class_exists('\Foundation\Protocol\Download\Attachment\CAudio') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/Download/Attachment/CAudio.php'));

class CAudioTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Protocol\Download\Provider\TAttachmentProvider;

    /** Class section
     * ************** */

    /**
     * Returns the results path.
     *
     * @return string
     */
    public static function getResultPath()
    {
        return __DIR__ . '/../provider/result/caudio';
    }

    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAudio::getAttachmentMimeTypeFromExtension
     * @group specification
     */
    public function testFromExtensionException()
    {
        foreach (static::$_aFromExtensionException as $data) {
            $label = &$data['label'];
            $test  = &$data['test'];

            try {
                $pObject = new \Foundation\Protocol\Download\Attachment\CAudio(
                    static::$_pDownloadManager,
                    $test['value']
                );
                unset($pObject);
                $this->fail($label . ' No exception raised.');
            } catch (\Foundation\Exception\InvalidArgumentException $exc) {
                $this->assertTrue(true);
            } catch (\Exception $exc) {
                $this->fail($label . ' No the expected exception.');
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAudio::getAttachmentMimeTypeFromFile
     * @group specification
     */
    public function testFromFileException()
    {
        foreach (static::$_aFromFileException as $data) {
            $label = &$data['label'];
            $test  = &$data['test'];

            try {
                $pObject = new \Foundation\Protocol\Download\Attachment\CAudio(
                    static::$_pDownloadManager,
                    $test['value'],
                    false
                );
                unset($pObject);
                $this->fail($label . ' No exception raised.');
            } catch (\Foundation\Exception\InvalidArgumentException $exc) {
                $this->assertTrue(true);
            } catch (\Exception $exc) {
                $this->fail($label . ' No the expected exception.');
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAudio::getAttachmentMimeTypeFromExtension
     * @group specification
     */
    public function testFromExtensionValid()
    {
        foreach (static::$_aFromExtensionValid as $data) {
            $label = &$data['label'];
            $test  = &$data['test'];

            try {
                $pObject = new \Foundation\Protocol\Download\Attachment\CAudio(
                    static::$_pDownloadManager,
                    $test['value']
                );
                $this->assertTrue($pObject->send(true), $label);
                unset($pObject);
            } catch (\Exception $exc) {
                $this->fail($label . ' Unexpected exception.');
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAudio::getAttachmentMimeTypeFromFile
     * @group specification
     */
    public function testFromFileValid()
    {
        foreach (static::$_aFromFileValid as $data) {
            $label = &$data['label'];
            $test  = &$data['test'];

            try {
                $pObject = new \Foundation\Protocol\Download\Attachment\CAudio(
                    static::$_pDownloadManager,
                    $test['value'],
                    false
                );
                $this->assertTrue($pObject->send(true), $label);
                unset($pObject);
            } catch (\Exception $exc) {
                $this->fail($label . ' Unexpected exception.');
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAudio::getAttachmentMimeTypeFromFile
     * @group specification
     */
    public function testGetAttachmentMimeTypeFromFile()
    {
        $method = new \ReflectionMethod(
            '\Foundation\Protocol\Download\Attachment\CAudio',
            'getAttachmentMimeTypeFromFile'
        );
        $method->setAccessible(true);

        $pObject = new \Foundation\Protocol\Download\Attachment\CAudio(
            static::$_pDownloadManager,
            static::$_aFromExtensionValid[0]['test']['value'],
            true
        );

        $pFile = new \SplFileInfo(__DIR__);

        $this->assertSame('', $method->invokeArgs($pObject, [ $pFile ]));

        unset($pFile, $pObject);
    }
}
