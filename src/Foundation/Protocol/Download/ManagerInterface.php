<?php
namespace Foundation\Protocol\Download;

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
 * Interface class for download manager implementation.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Download
 * @version    1.0.0
 * @since      1.0.0
 */
interface ManagerInterface
{

    /**
     * Sends a file. Returns FALSE on error.
     * Throws an exception if the attachment cannot be opened or if the mime type is not valid.
     *
     * @param \SplFileInfo $pAttachment Attachment to download.
     * @param string       $sMime       Mime type of the attachment
     * @param array        $options     [OPTIONAL] An array defining the options.
     *                                  $options['test'] specifies the test mode: if TRUE does not send headers nor
     *                                  attachment.
     * @return boolean Returns FALSE on error.
     * @throws \Foundation\Exception\InvalidArgumentException If the attachment cannot be opened or if the mime type is
     *                                                        not valid.
     */
    public function send(\SplFileInfo $pAttachment, $sMime, array $options = [ ]);
}
