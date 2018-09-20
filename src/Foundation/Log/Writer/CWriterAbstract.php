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
 * Parent class for all writer.
 *
 * @category   Foundation
 * @package    Log
 * @subpackage Writer
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CWriterAbstract implements \Foundation\Log\Writer\WriterInterface
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
        $this->_pSuccessor = null;
        defined('FOUNDATION_DEBUG') && ! defined('FOUNDATION_DEBUG_OFF') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete($this->_sDebugID);
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
    final public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Chain of Responsibility Design Pattern
     * *************************************** */

    /**
     * Download manager
     * @var \Foundation\Log\Writer\WriterInterface
     */
    protected $_pSuccessor = null;

    /**
     * Add successor to the chain.
     *
     * @param \Foundation\Log\Writer\WriterInterface $successor
     */
    final public function setSuccessor(\Foundation\Log\Writer\WriterInterface $successor)
    {
        $this->_pSuccessor = $successor;
    }
}
