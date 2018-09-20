<?php
namespace Foundation\Type;

/**
 * Foundation Framework
 *
 * @package   Type
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * Parent class for all types
 *
 * @category Foundation
 * @package  Type
 * @version  1.0.0
 * @since    1.0.0
 */
abstract class CTypeAbstract implements \Foundation\Type\TypeInterface
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
     * Destructor
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_Value = null;
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

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        return isset($this->_Value) ? (string)$this->_Value : '';
    }

    /** Type section
     * ************* */

    /**
     * Value
     * @var mixed
     */
    protected $_Value = null;

    /**
     * Reads data from variable.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->_Value;
    }

    /**
     * Determines if the variable is set and is not NULL.
     * Returns TRUE if the variable has value other than NULL, FALSE otherwise.
     *
     * @return boolean
     */
    public function isValid()
    {
        return isset($this->_Value);
    }

    /**
     * Gets variable length.
     *
     * @return int
     */
    public function getLength()
    {
        return isset($this->_Value) ? mb_strlen($this->_Value, 'UTF-8') : 0;
    }

    /**
     * Compare two objects. TRUE if the types and values are equals.
     *
     * @param \Foundation\Type\TypeInterface $pType
     * @return boolean
     */
    final public function isIdentical(\Foundation\Type\TypeInterface $pType)
    {
        return ($this->getValue() === $pType->getValue() ) ? true : false;
    }

    /**
     * Compare two objects. TRUE if the the values are equals.
     *
     * @param \Foundation\Type\TypeInterface $pType
     * @return boolean
     */
    public function isEqual(\Foundation\Type\TypeInterface $pType)
    {
        return ($this->getValue() == $pType->getValue()) ? true : false;
    }
}
