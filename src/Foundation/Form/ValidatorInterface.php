<?php
namespace Foundation\Form;
/**
 * Foundation Framework
 *
 * @package   Form
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
defined( 'APPLICATION_VERSION' ) || die( '-1' );

/**
 * Interface for form validator implementations.
 *
 * @category   Foundation
 * @package    Log
 * @subpackage Writer
 * @version    1.0.0
 * @since      1.0.0
 */
interface ValidatorInterface
{
    /** Message section
     * **************** */

    /**
     * Get validation error messages, if any
     *
     * Returns a list of validation failure messages, if any.
     *
     * @return array|\Traversable
     */
    public function getMessages();

    /** Validation section
     * ******************* */

    /**
     * Set data to validate.
     *
     * @param array $data the data being validated
     * @return \Foundation\Form\ValidatorInterface
     */
    public function setData( array $data = [ ] );

    /**
     * Return validated data. A valid key is a string containing a variable name and a valid value is either a value or
     * FALSE if the filter fails or NULL if the variable is not set.
     *
     * @return bool|array Return FALSE on failure.
     */
    public function getData();

    /**
     * Return Data being validated.
     *
     * @return array
     */
    public function getDataRaw();

    /**
     * Check if the form has been validated.
     *
     * @return bool
     */
    public function hasValidated();

    /**
     * Validate the form.
     *
     * @return bool
     */
    public function isValid();
}