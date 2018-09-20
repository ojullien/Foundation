<?php
namespace Foundation\Type\Simple;

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
 * This class provides a float/double filter.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Simple
 * @version    1.0.0
 * @since      1.0.0
 */
class CFloat extends \Foundation\Type\CTypeAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor
     *
     * @param float $value   The value to write.
     * @param array $options [OPTIONAL] An array defining the options. Valid key are:
     *                       '<'  : less than
     *                       '<=' : less than or equal to
     *                       '>'  : greater than
     *                       '>=' : greater than or equal to
     *                       '='  : equals
     *                       '!=' : not equals
     *                       Valid values are numeric.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct($value, array $options = [ ])
    {
        $this->_sDebugID = uniqid('cfloat', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $value, $options ]
                );
        $this->setOptions($options);
        $this->setValue($value);
    }

    /** Numeric section
     * **************** */

    /**
     * Options
     * @var array
     */
    protected $_aOptions = [ ];

    /**
     * Writes options to variable.
     *
     * @param array $options An array defining the options. Valid key are:
     *                       '<'  : less than
     *                       '<=' : less than or equal to
     *                       '>'  : greater than
     *                       '>=' : greater than or equal to
     *                       '='  : equals
     *                       '!=' : not equals
     *                       Valid values are numeric.
     *
     * @return \Foundation\Type\Complex\CFloat
     */
    final protected function setOptions(array $options)
    {
        if (! empty($options)) {
            $this->_aOptions = array_filter(array_intersect_key(
                $options,
                [
                '<'  => 0,
                '<=' => 0,
                '>'  => 0,
                '>=' => 0,
                '='  => 0,
                '!=' => 0 ]
            ), 'is_numeric');
        } else {
            $this->_aOptions = [ ];
        }

        return $this;
    }

    /**
     * Writes mumeric data to variable.
     *
     * @param numeric $value The value to write.
     * @return boolean
     */
    final protected function setNumeric($value)
    {
        // Initialize
        $this->_Value = null;

        // Check value
        if (is_numeric($value)) {
            // Numeric case - Cast
            $value = $value + 0;

            // Test options
            foreach ($this->_aOptions as $sOperator => $iOperand) {
                // Applies operators
                switch ($sOperator) {
                    case '<':
                        $value = ( $value < $iOperand ) ? $value : false;
                        break;
                    case '<=':
                        $value = ( $value <= $iOperand ) ? $value : false;
                        break;
                    case '>':
                        $value = ( $value > $iOperand ) ? $value : false;
                        break;
                    case '>=':
                        $value = ( $value >= $iOperand ) ? $value : false;
                        break;
                    case '!=':
                        $value = ( $value != $iOperand ) ? $value : false;
                        break;
                    default:
                        $value = ( $value == $iOperand ) ? $value : false;
                        break;
                }

                // Error case
                if (false === $value) {
                    break;
                }
            }

            // Ok
            if (false !== $value) {
                $this->_Value = $value;
            }
        }

        return isset($this->_Value);
    }

    /** Type section
     * ************* */

    /**
     * Writes data to variable.
     *
     * @param numeric $value The value to write.
     * @return \Foundation\Type\TypeInterface
     */
    public function setValue($value)
    {
        // Convert the value
        if ($value instanceof \Foundation\Type\TypeInterface) {
            $value = $value->getValue();
        } elseif (is_string($value)) {
            $value = trim($value);
        }

        // Write the value
        $this->setNumeric($value);

        return $this;
    }
}
