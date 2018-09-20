<?php
namespace Foundation\Type\Complex;

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
 * This complex class implements byte type and usefull conversion methods for bytes.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Complex
 * @version    1.0.0
 * @since      1.0.0
 */
final class CByte extends \Foundation\Type\Simple\CFloat
{
    /** Class section
     * ************** */

    /**
     * Constructor
     *
     * @param mixed $value The value to write.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct($value)
    {
        $this->_sDebugID = uniqid('cbyte', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add($this->_sDebugID, __CLASS__, [ $value ]);

        // Only values >=0 are allowed
        $this->_aOptions = [ '>=' => 0 ];
        $this->setValue($value);
    }

    /** Type section
     * ************* */

    /**
     * Compare two objects. TRUE if the the values are equals.
     *
     * @param \Foundation\Type\TypeInterface $pType
     * @return boolean
     */
    final public function isEqual(\Foundation\Type\TypeInterface $pType)
    {
        if (isset($this->_Value)) {
            if ($pType instanceof \Foundation\Type\Complex\CByte) {
                $bReturn = ( $this->convertToByte() == $pType->convertToByte() ) ? true : false;
            } else {
                $bReturn = ( $this->getValue() == $pType->getValue() ) ? true : false;
            }
        } else {
            $bReturn = false;
        }

        return $bReturn;
    }

    /** Bytes section
     * ************** */

    /**
     * Test shorthand notation.
     * Returns TRUE if the value is a shorthand notation, FALSE otherwise.
     *
     * @param string $sValue   The input value.
     * @param array  $aMatches [OPTIONAL] If $aMatches is provided then it is filled with the results of the search.
     * @return boolean
     */
    private function isShorthanded($sValue, array& $aMatches = null)
    {
        // Check parameter
        $sValue = ( is_string($sValue) ) ? trim($sValue) : 0;

        if (is_numeric($sValue)) {
            $bReturn = false;
        } else {
            static $sPattern = '/^[[:digit:].]+[kmg]$/i';
            $bReturn  = (@preg_match($sPattern, $sValue)) ? true : false;

            // Explode result
            if (isset($aMatches) && $bReturn) {
                $aMatches = str_split($sValue, strlen($sValue) - 1);
            }
        }

        return $bReturn;
    }

    /**
     * Convert the variable to GBytes.
     *
     * @param  boolean $bShorthanded [OPTIONAL] Shorthand notation
     * @return string
     */
    public function convertToGByte($bShorthanded = false)
    {
        // Initialize
        $bShorthanded = ( is_bool($bShorthanded) ) ? $bShorthanded : false;
        $return       = $this->_Value;
        $aMatches     = [ ];

        // Convert
        if (isset($return)) {
            if ($this->isShorthanded($return, $aMatches)) {
                // Shorthanded notation case
                switch (strtolower($aMatches[1])) {
                    case 'k':
                        // KByte to GByte.
                        $return = $aMatches[0] / 1024 / 1024;
                        break;
                    case 'm':
                        // MByte to GByte.
                        $return = $aMatches[0] / 1024;
                        break;
                    default:
                        // Mbyte to MByte.
                        $return = $aMatches[0] + 0;
                        break;
                }//switch ( strtolower(...
            } else {
                // Convert from Byte to GByte
                $return = $return / 1024 / 1024 / 1024;
            }

            // Shorthand notation
            if ($bShorthanded) {
                $return = round($return, 0) . 'G';
            }
        }

        return $return;
    }

    /**
     * Convert the variable to MBytes.
     *
     * @param  boolean $bShorthanded [OPTIONAL] Shorthand notation
     * @return string
     */
    public function convertToMByte($bShorthanded = false)
    {
        // Initialize
        $bShorthanded = ( is_bool($bShorthanded) ) ? $bShorthanded : false;
        $return       = $this->_Value;
        $aMatches     = [ ];

        // Convert
        if (isset($return)) {
            if ($this->isShorthanded($return, $aMatches)) {
                // Shorthanded notation case
                switch (strtolower($aMatches[1])) {
                    case 'k':
                        // KByte to MByte.
                        $return = $aMatches[0] / 1024;
                        break;
                    case 'g':
                        // GByte to MByte.
                        $return = $aMatches[0] * 1024;
                        break;
                    default:
                        // Mbyte to MByte.
                        $return = $aMatches[0] + 0;
                        break;
                }
            } else {
                // Convert from Byte to MByte
                $return = $return / 1024 / 1024;
            }

            // Shorthand notation
            if ($bShorthanded) {
                $return = round($return, 0) . 'M';
            }
        }

        return $return;
    }

    /**
     * Convert the variable to KBytes.
     *
     * @param  boolean $bShorthanded [OPTIONAL] Shorthand notation
     * @return string
     */
    public function convertToKByte($bShorthanded = false)
    {
        // Initialize
        $bShorthanded = ( is_bool($bShorthanded) ) ? $bShorthanded : false;
        $return       = $this->_Value;
        $aMatches     = [ ];

        // Convert
        if (isset($return)) {
            if ($this->isShorthanded($return, $aMatches)) {
                // Shorthanded notation case
                switch (strtolower($aMatches[1])) {
                    case 'm':
                        // MByte to KByte.
                        $return = $aMatches[0] * 1024;
                        break;
                    case 'g':
                        // GByte to KByte.
                        $return = $aMatches[0] * 1024 * 1024;
                        break;
                    default:
                        // Kbyte to KByte.
                        $return = $aMatches[0] + 0;
                        break;
                }//switch ( strtolower(...
            } else {
                // Convert from Byte to KByte
                $return = $return / 1024;
            }

            // Shorthand notation
            if ($bShorthanded) {
                $return = round($return, 0) . 'K';
            }
        }

        return $return;
    }

    /**
     * Convert the variable to Bytes.
     *
     * @return string
     */
    public function convertToByte()
    {
        // Initialize
        $return   = $this->_Value;
        $aMatches = [ ];

        // Convert
        if (isset($return)) {
            if ($this->isShorthanded($return, $aMatches)) {
                // Shorthanded notation case
                switch (strtolower($aMatches[1])) {
                    case 'k':
                        // KByte to Byte.
                        $return = $aMatches[0] * 1024;
                        break;
                    case 'g':
                        // GByte to Byte.
                        $return = $aMatches[0] * 1024 * 1024 * 1024;
                        break;
                    default:
                        // Mbyte to Byte.
                        $return = $aMatches[0] * 1024 * 1024;
                        break;
                }
            }
            $return = $return + 0;
        }

        return $return;
    }

    /** Type section
     * ************* */

    /**
     * Writes data to variable.
     *
     * @param mixed $value The value to write. Accept integer value and shorthand notation.
     * @return \Foundation\Type\Complex\CByte
     */
    public function setValue($value)
    {
        // Already a byte: nothing to do
        if ($value instanceof \Foundation\Type\Complex\CByte) {
            $this->_Value = $value->getValue();
            return $this;
        }
        // Other types
        elseif ($value instanceof \Foundation\Type\TypeInterface) {
            $value = $value->getValue();
        } elseif (is_string($value)) {
            $value = trim($value);
        }

        // Write the value
        if (! $this->setNumeric($value) && $this->isShorthanded($value)) {
            $this->_Value = $value;
        }

        return $this;
    }
}
