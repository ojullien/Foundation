<?php
namespace Foundation\Test\Protocol\Download\Attachment;

/**
 * class for image download.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Download
 * @version    1.0.0
 * @since      1.0.0
 */
final class CAttachmentAbstractMock extends \Foundation\Protocol\Download\Attachment\CAttachmentAbstract
{
    /** Test section
     * ************* */

    /**
     * Forced mime type
     * @var string
     */
    private $_sForcedMime = '';

    /**
     *
     * @param string $value
     */
    public function forceMime( $value )
    {
        $this->_sMIME = $value;
    }

    /** File section
     * ************* */

    /**
     * Get the mime type from filename extension.
     *
     * @param \SplFileInfo $pFile File from extract mime type.
     * @return string
     */
    protected function getAttachmentMimeTypeFromExtension( \SplFileInfo $pFile )
    {
        return '';
    }

    /**
     * Get the mime type from file. The file should not be empty.
     *
     * @param \SplFileInfo $pFile File from extract mime type.
     * @return string
     */
    protected function getAttachmentMimeTypeFromFile( \SplFileInfo $pFile )
    {
        return 'text/plain';
    }

}