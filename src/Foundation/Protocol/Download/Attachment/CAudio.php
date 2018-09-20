<?php
namespace Foundation\Protocol\Download\Attachment;

/**
 * Foundation Framework
 *
 * @package   Protocol
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * class for audio download.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Download
 * @version    1.0.0
 * @since      1.0.0
 */
final class CAudio extends \Foundation\Protocol\Download\Attachment\CAttachmentAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor. The file should exists and should be readable. Only mp3 file is allowed.
     * Throws an exception If the $sFilename is not valid, if the file is not readable or if the mime type is not valid.
     *
     * @param \Foundation\Protocol\Download\ManagerInterface $pDownloadmanager      The download manager.
     * @param string                                         $sFilename             The file to send.
     * @param boolean                                        $bGetMimeFromExtension [OPTIONAL] If TRUE, use the extension
     * of the file to get the correspondant MIME type of the audio. If FALSE, the correspondant MIME type of the audio
     * is extracted from the file itself. In this case, the file should not be empty!!
     * @throws \Foundation\Exception\InvalidArgumentException
     * @codeCoverageIgnore
     */
    public function __construct(
        \Foundation\Protocol\Download\ManagerInterface $pDownloadmanager,
        $sFilename,
        $bGetMimeFromExtension = true
    ) {
        $this->_sDebugID = uniqid('caudio', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $pDownloadmanager, $sFilename, $bGetMimeFromExtension ]
                );
        parent::__construct($pDownloadmanager, $sFilename, $bGetMimeFromExtension);
    }

    /** File section
     * ************* */

    /**
     * Get the mime type from filename extension.
     *
     * @param \SplFileInfo $pFile File from extract mime type.
     * @return string
     */
    protected function getAttachmentMimeTypeFromExtension(\SplFileInfo $pFile)
    {
        switch (strtolower($pFile->getExtension())) {
            case 'mp3':
                $sReturn = 'audio/mpeg';
                break;
            default:
                $sReturn = '';
                break;
        }

        return $sReturn;
    }

    /**
     * Get the mime type from file.
     *
     * @param \SplFileInfo $pFile File from extract mime type.
     * @return string
     */
    protected function getAttachmentMimeTypeFromFile(\SplFileInfo $pFile)
    {
        if ($pFile->isFile() && $pFile->isReadable()) {
            $pFinfo  = new \finfo(FILEINFO_MIME_TYPE);
            $sMime   = $pFinfo->file($pFile->getRealPath());
            unset($pFinfo);
            $sReturn = (! empty($sMime) && ( strncasecmp($sMime, 'audio/', 6) === 0 ) ) ? $sMime : '';
        } else {
            $sReturn = '';
        }

        return $sReturn;
    }
}
