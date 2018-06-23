<?php
namespace Foundation\Test\Protocol\Download\Attachment;
trait_exists( '\Foundation\Test\Protocol\Download\Provider\TAttachmentProvider' ) || require( realpath( APPLICATION_PATH . '/tests/Foundation/Protocol/Download/provider/TAttachmentProvider.php' ) );

class_exists( '\Foundation\Protocol\Download\Attachment\CImage' ) || require( realpath( FOUNDATION_PROTOCOL_PATH . '/Download/Attachment/CImage.php' ) );

class CImageTest extends \PHPUnit_Framework_TestCase
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
        return __DIR__ . '/../provider/result/cimage';
    }

    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CImage::getAttachmentMimeTypeFromExtension
     * @group specification
     */
    public function testFromExtensionException()
    {
        foreach( static::$_aFromExtensionException as $data )
        {
            $label = &$data['label'];
            $test  = &$data['test'];

            try
            {
                $pObject = new \Foundation\Protocol\Download\Attachment\CImage( static::$_pDownloadManager,
                                                                                $test['value'] );
                unset( $pObject );
                $this->fail( $label . ' No exception raised.' );
            }
            catch( \Foundation\Exception\InvalidArgumentException $exc )
            {
                $this->assertTrue( TRUE );
            }
            catch( \Exception $exc )
            {
                $this->fail( $label . ' No the expected exception.' );
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CImage::getAttachmentMimeTypeFromFile
     * @group specification
     */
    public function testFromFileException()
    {
        foreach( static::$_aFromFileException as $data )
        {
            $label = &$data['label'];
            $test  = &$data['test'];

            try
            {
                $pObject = new \Foundation\Protocol\Download\Attachment\CImage( static::$_pDownloadManager,
                                                                                $test['value'], FALSE );
                unset( $pObject );
                $this->fail( $label . ' No exception raised.' );
            }
            catch( \Foundation\Exception\InvalidArgumentException $exc )
            {
                $this->assertTrue( TRUE );
            }
            catch( \Exception $exc )
            {
                $this->fail( $label . ' No the expected exception.' );
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CImage::getAttachmentMimeTypeFromExtension
     * @group specification
     */
    public function testFromExtensionValid()
    {
        foreach( static::$_aFromExtensionValid as $data )
        {
            $label = &$data['label'];
            $test  = &$data['test'];

            try
            {
                $pObject = new \Foundation\Protocol\Download\Attachment\CImage( static::$_pDownloadManager,
                                                                                $test['value'] );
                $this->assertTrue( $pObject->send( TRUE ), $label );
                unset( $pObject );
            }
            catch( \Exception $exc )
            {
                $this->fail( $label . ' Unexpected exception.' );
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CImage::getAttachmentMimeTypeFromFile
     * @group specification
     */
    public function testFromFileValid()
    {
        foreach( static::$_aFromFileValid as $data )
        {
            $label = &$data['label'];
            $test  = &$data['test'];

            try
            {
                $pObject = new \Foundation\Protocol\Download\Attachment\CImage( static::$_pDownloadManager,
                                                                                $test['value'], FALSE );
                $this->assertTrue( $pObject->send( TRUE ), $label );
                unset( $pObject );
            }
            catch( \Exception $exc )
            {
                $this->fail( $label . ' Unexpected exception.' );
            }
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\Attachment\CImage::getAttachmentMimeTypeFromFile
     * @group specification
     */
    public function testGetAttachmentMimeTypeFromFile()
    {
        $method = new \ReflectionMethod( '\Foundation\Protocol\Download\Attachment\CImage',
                                         'getAttachmentMimeTypeFromFile' );
        $method->setAccessible( TRUE );

        $pObject = new \Foundation\Protocol\Download\Attachment\CImage( static::$_pDownloadManager,
                                                                        static::$_aFromExtensionValid[0]['test']['value'],
                                                                        TRUE );

        $pFile = new \SplFileInfo( __DIR__ );

        $this->assertSame( '', $method->invokeArgs( $pObject, array( $pFile ) ) );

        unset( $pFile, $pObject );
    }

}