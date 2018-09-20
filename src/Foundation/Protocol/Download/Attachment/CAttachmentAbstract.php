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
 * Parent class for all download.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Download
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CAttachmentAbstract
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
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_pManager = null;
        unset($this->_pAttachment);
        defined('FOUNDATION_DEBUG') && ! defined('FOUNDATION_DEBUG_OFF') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete($this->_sDebugID);
    }

    /**
     * Constructor. The file should exists and should be readable.
     * Throws an exception If the $sFilename is not valid, if the file is not readable or if the mime type is not valid.
     *
     * @param \Foundation\Protocol\Download\ManagerInterface $pDownloadmanager      The download manager.
     * @param string                                         $sFilename             The file to send.
     * @param boolean                                        $bGetMimeFromExtension [OPTIONAL] If TRUE, use the extension
     * of the file to get the correspondant MIME type of the audio. If FALSE, the correspondant MIME type of the audio
     * is extracted from the file itself. In this case, the file should not be empty!!
     * @throws \Foundation\Exception\InvalidArgumentException
     */
    public function __construct(
        \Foundation\Protocol\Download\ManagerInterface $pDownloadmanager,
        $sFilename,
        $bGetMimeFromExtension = true
    ) {
        // Check filename argument
        $sFilename = ( is_string($sFilename) ) ? trim($sFilename) : '';
        if ('' == $sFilename) {
            throw new \Foundation\Exception\InvalidArgumentException('The filename argument is not valid.');
        }

        // Save attachment
        $this->_pAttachment = new \SplFileInfo($sFilename);
        if (! $this->_pAttachment->isFile() || ! $this->_pAttachment->isReadable()) {
            throw new \Foundation\Exception\InvalidArgumentException('The file cannot be opened.');
        }

        // Save mime type
        if (! extension_loaded('fileinfo') || $bGetMimeFromExtension) {
            $this->_sMIME = $this->getAttachmentMimeTypeFromExtension($this->_pAttachment);
        } else {
            $this->_sMIME = $this->getAttachmentMimeTypeFromFile($this->_pAttachment);
        }

        // Error
        if ('' == $this->_sMIME) {
            unset($this->_pAttachment);
            throw new \Foundation\Exception\InvalidArgumentException('The file mime type is not valid.');
        }

        // Save download manager
        $this->_pManager = $pDownloadmanager;
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
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
    public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Download manager section
     * ************************* */

    /**
     * Download manager
     * @var \Foundation\Protocol\Download\ManagerInterface
     */
    private $_pManager = null;

    /**
     * Sends the attachment.
     * Throws an exception If the attachment cannot be opened or if the mime type is not valid.
     *
     * @param boolean $bUnitTest [OPTIONAL] If TRUE does not send headers nor attachment.
     * @return boolean
     * @throws \Foundation\Exception\InvalidArgumentException
     */
    final public function send($bUnitTest = false)
    {
        return ( isset($this->_pManager) && isset($this->_pAttachment) ) ?
                $this->_pManager->send($this->_pAttachment, $this->_sMIME, [ 'test' => $bUnitTest ]) : false;
    }

    /** Attachment section
     * ******************* */

    /**
     * Attachment to download
     * @var \SplFileInfo
     */
    protected $_pAttachment = null;

    /**
     * MIME type of the attachment
     * @var string
     */
    protected $_sMIME = ''; //'application/octet-stream'

    /**
     * Get the mime type from filename extension.
     *
     * @param \SplFileInfo $pFile File from extract mime type.
     * @return string
     */
    abstract protected function getAttachmentMimeTypeFromExtension(\SplFileInfo $pFile);

    /**
     * Get the mime type from file.
     *
     * @param \SplFileInfo $pFile File from extract mime type.
     * @return string
     */
    abstract protected function getAttachmentMimeTypeFromFile(\SplFileInfo $pFile);
}
