<?php
namespace Foundation\Weather\Decoder;

/**
 * Foundation Framework
 *
 * @package   Weather
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * Parent class for decoder class. Add error functionnalities.
 *
 * @category   Foundation
 * @package    Weather
 * @subpackage Decoder
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CDecoderAbstract implements \Foundation\Weather\Decoder\DecoderInterface
{
    /** Class section
     * ************** */

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

    /** Error section
     * ************** */

    /**
     * Error code when the type of the decoded value is not the one expected.
     *
     * @var integer
     */
    const FWD_BAD_TYPE = 200;

    /**
     * Error code when the data are invalid or malformed and cannot be decoded.
     *
     * @var integer
     */
    const FWD_ERROR_SYNTAX = 201;

    /**
     * Error code when a key is missing.
     *
     * @var integer
     */
    const FWD_KEY_MISSING = 202;

    /**
     * Error number for the last operation.
     *
     * @var integer
     */
    protected $_iError = 0;

    /**
     * Text error for the last operation.
     *
     * @var string
     */
    protected $_sError = '';

    /**
     * Returns the error number for the last operation or 0 (zero) if no error occurred.
     *
     * @return integer
     */
    final public function getErrorNumber()
    {
        return $this->_iError;
    }

    /**
     * Returns text error for the last operation.
     *
     * @return string
     */
    final public function getErrorText()
    {
        return $this->_sError;
    }
}
