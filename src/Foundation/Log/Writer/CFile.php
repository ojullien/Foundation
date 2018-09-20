<?php
namespace Foundation\Log\Writer;

/**
 * Foundation Framework
 *
 * @package   Log
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * This class implements usefull methods to record log data to a file.
 * This class is a writer for the logger.
 *
 * @category   Foundation
 * @package    Log
 * @subpackage Writer
 * @version    1.0.0
 * @since      1.0.0
 */
final class CFile extends \Foundation\Log\Writer\CWriterAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @param \Foundation\Type\Complex\CPath $filename Name of the file. May contains path.
     * @throws \Foundation\Exception\InvalidArgumentException If $filename is not valid.
     * @throws \RuntimeException If an error occures.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct(\Foundation\Type\Complex\CPath $filename)
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid('cfile', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $filename ]
                );
        //@codeCoverageIgnoreEnd
        if ($filename->isValid()) {
            $this->_pFile = new \SplFileObject($filename->getValue(), 'a+b');
        } else {
            throw new \Foundation\Exception\InvalidArgumentException('filename is not valid.');
        }
    }

    /** File section
     * ************* */

    /**
     * File.
     * @var \SplFileObject
     */
    private $_pFile = null;

    /**
     * Close the file resource.
     *
     * @return void
     */
    public function shutdown()
    {
        if (isset($this->_pFile)) {
            $this->_pFile->fflush();
            $this->_pFile = null;
        }
        if (isset($this->_pSuccessor)) {
            $this->_pSuccessor->shutdown();
        }//if( isset(...
    }

    /**
     * Write a log message. Returns FALSE on error.
     *
     * @param \Foundation\Log\CMessage $pMessage Detailed message data.
     * @return void
     */
    public function write(\Foundation\Log\CMessage $pMessage)
    {
        if (isset($this->_pFile)) {
            // Build message
            $sBuffer = '[' . $pMessage->getDateTime()->format('D M d G:i:s Y') . ']'
                    . ' [' . $pMessage->getSeverity() . ']'
                    . ' [client ' . $pMessage->getRemoteAddress() . ']'
                    . ' [user ' . $pMessage->getUser() . ']'
                    . ' [module ' . $pMessage->getModule() . ']'
                    . ' ' . $pMessage->getMessage() . PHP_EOL;
            // Write
            $this->_pFile->fwrite($sBuffer);
        }//if( isset(...
        // Chain of Responsibility
        if (isset($this->_pSuccessor)) {
            $this->_pSuccessor->write($pMessage);
        }
    }
}
