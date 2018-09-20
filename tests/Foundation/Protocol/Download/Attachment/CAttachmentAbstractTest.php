<?php
namespace Foundation\Test\Protocol\Download\Attachment;

trait_exists('\Foundation\Test\Protocol\Download\Provider\TAttachmentProvider') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Protocol/Download/provider/TAttachmentProvider.php'));

class_exists('\Foundation\Test\Protocol\Download\Attachment\CAttachmentAbstractMock') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Protocol/Download/provider/CAttachmentAbstractMock.php'));

class CAttachmentAbstractTest extends \PHPUnit_Framework_TestCase
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
        return __DIR__ . '/../provider/result/cattachmentabstract';
    }

    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAttachmentAbstract::__construct
     * @group specification
     */
    public function testConstructFilenameException()
    {
        foreach (static::$_aFromExtensionException as $data) {
            $label = &$data['label'];
            $test  = &$data['test'];

            try {
                $pObject = new \Foundation\Test\Protocol\Download\Attachment\CAttachmentAbstractMock(
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
     * @covers \Foundation\Protocol\Download\Attachment\CAttachmentAbstract::__construct
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testConstructMimeException()
    {
        $pObject = new \Foundation\Test\Protocol\Download\Attachment\CAttachmentAbstractMock(
            static::$_pDownloadManager,
            __FILE__
        );

        $this->fail(' No exception raised.');
        unset($pObject);
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAttachmentAbstract::__construct
     * @group specification
     */
    public function testConstructValid()
    {
        $pObject = new \Foundation\Test\Protocol\Download\Attachment\CAttachmentAbstractMock(
            static::$_pDownloadManager,
            __FILE__,
            false
        );
        $this->assertTrue(true);
        unset($pObject);
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAttachmentAbstract::send
     * @group specification
     */
    public function testSendValid()
    {
        $pObject = new \Foundation\Test\Protocol\Download\Attachment\CAttachmentAbstractMock(
            static::$_pDownloadManager,
            __FILE__,
            false
        );

        $this->assertTrue($pObject->send(true));
        unset($pObject);
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CAttachmentAbstract::send
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testSendException()
    {
        $pObject = new \Foundation\Test\Protocol\Download\Attachment\CAttachmentAbstractMock(
            static::$_pDownloadManager,
            __FILE__,
            false
        );
        $pObject->forceMime('');
        $pObject->send(true);
        $this->fail(' No exception raised.');
        unset($pObject);
    }
}
