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
 * Interface class for weather decoder objects that implement a concrete decoder strategy.
 *
 * @category   Foundation
 * @package    Weather
 * @subpackage Decoder
 * @version    1.0.0
 * @since      1.0.0
 */
interface DecoderInterface
{
    /** Error section
     * ************** */

    /**
     * Returns the error number for the last operation or 0 (zero) if no error occurred.
     *
     * @return integer
     */
    public function getErrorNumber();

    /**
     * Returns text error for the last operation.
     *
     * @return string
     */
    public function getErrorText();

    /** Decoder section
     * **************** */

    /**
     * Decodes data into an associative array according to the DTD.
     * The returned array will have the same structure as the DTD.
     * In case of failure, use getErrorNumber and getErrorText methods to determine the exact nature of error.
     * @see \Foundation\Weather\Decoder\Dtd\wu_dtd for a DTD explanation.
     *
     * @param  array $dtd  Defines the legal structure of the returned array. Should not be empty.
     * @param  array $data The data being decoded. Should not be empty.
     * @return array Returns the decoded data on success, NULL on failure.
     */
    public function decode(array $dtd, $data);
}
