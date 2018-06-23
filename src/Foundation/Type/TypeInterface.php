<?php
namespace Foundation\Type;
/**
 * Foundation Framework
 *
 * @package   Type
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Interface class for type implementation.
 *
 * @category Foundation
 * @package  Type
 * @version  1.0.0
 * @since    1.0.0
 */
interface TypeInterface
{

    /**
     * Writes data to variable.
     *
     * @param mixed $value The value to write.
     * @return \Foundation\Type\TypeInterface
     */
    public function setValue( $value );

    /**
     * Reads data from variable.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Determines if the variable is set and is not NULL.
     * Returns TRUE if the variable has value other than NULL, FALSE otherwise.
     *
     * @return boolean
     */
    public function isValid();

    /**
     * Return the variable like a string
     *
     * @return string
     */
    public function __toString();
}