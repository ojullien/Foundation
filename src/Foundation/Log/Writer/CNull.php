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
 * This class is a stub that does not write log data to anything. It is useful for disabling logging or stubbing out
 * logging during tests.
 *
 * @category   Foundation
 * @package    Log
 * @subpackage Writer
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CNull extends \Foundation\Log\Writer\CWriterAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct()
    {
        $this->_sDebugID = uniqid('cnull', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add($this->_sDebugID, __CLASS__, [ ]);
    }

    /**
     * Perform shutdown activities.
     *
     * @return void
     */
    public function shutdown()
    {
        // Do nothing
    }

    /**
     * Write a log message. Returns FALSE on error.
     *
     * @param \Foundation\Log\CMessage $pMessage Detailed message data.
     * @return boolean
     */
    public function write(\Foundation\Log\CMessage $pMessage)
    {
        // Do nothing
    }
}
