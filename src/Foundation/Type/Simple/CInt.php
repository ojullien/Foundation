<?php
namespace Foundation\Type\Simple;
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
 * This class provides an integer filter.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Simple
 * @version    1.0.0
 * @since      1.0.0
 */
final class CInt extends \Foundation\Type\Simple\CFloat
{
    /** Class section
     * ************** */

    /**
     * Constructor
     *
     * @param integer $value   The value to write.
     * @param array   $options [OPTIONAL] An array defining the options. Valid key are:
     *                         '<'  : less than
     *                         '<=' : less than or equal to
     *                         '>'  : greater than
     *                         '>=' : greater than or equal to
     *                         '='  : equals
     *                         '!=' : not equals
     *                         Valid values are numeric.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $value, array $options = [ ] )
    {
        $this->_sDebugID = uniqid( 'cint', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $value, $options ] );
        $this->setOptions( $options );
        $this->setValue( $value );
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return ( isset( $this->_Value ) ) ? (string)((int)$this->_Value) : '';
    }

    /** Type section
     * ************* */

    /**
     * Reads data from variable.
     *
     * @return mixed Returns an integer or NULL
     */
    public function getValue()
    {
        return ( isset( $this->_Value ) ) ? (int)$this->_Value : NULL;
    }

    /**
     * Gets variable length.
     *
     * @return integer
     */
    public function getLength()
    {
        return ( isset( $this->_Value ) ) ? strlen( (string)((int)$this->_Value) ) : 0;
    }

}