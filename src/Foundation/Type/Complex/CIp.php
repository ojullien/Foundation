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
 * This class provides an IP address filter. Accepts IPv6 format and IPv4 dotted (decimal/hexadecimal/octal) format.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Complex
 * @version    1.0.0
 * @since      1.0.0
 */
final class CIp extends \Foundation\Type\CTypeAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor
     *
     * @param string $value IP address.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct($value)
    {
        $this->_sDebugID = uniqid('cip', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add($this->_sDebugID, __CLASS__, [ $value ]);
        $this->setValue($value);
    }

    /** Type section
     * ************* */

    /**
     * Writes data to variable.
     *
     * @param string|\Foundation\Type\Complex\CIp|\Foundation\Type\Simple\CString|\Foundation\Type\Complex\CHostname $value The value to write.
     * @return \Foundation\Type\Complex\CIp
     */
    public function setValue($value)
    {
        // Initialize
        $this->_Value = null;

        // Check argument type
        if ($value instanceof \Foundation\Type\Complex\CIp) {
            // Already an IP: nothing to do
            $this->_Value = $value->getValue();
            return $this;
        }
        // Other types: cast to string
        elseif ($value instanceof \Foundation\Type\Simple\CString || $value instanceof \Foundation\Type\Complex\CHostname) {
            $value = $value->getValue();
        } else {
            $value = is_string($value) ? trim($value) : '';
        }

        // Validate argument value
        if (strlen($value) > 1) {
            // Ipv6 or IPv4
            $this->_Value = filter_var($value, FILTER_VALIDATE_IP);
            if (false === $this->_Value) {
                // Not an IPv6 address or "octet dotted" IPv4 address.
                // Maybe an "octal dotted", "hex dotted" or "binary dotted" IPv4 address
                $this->_Value = $this->filterIPv4Special($value);
            }
        }

        return $this;
    }

    /** IP section
     * *********** */

    /**
     * Converts "octal dotted", "hex dotted" and "binary dotted" IPv4 address to "octet dotted"  IPv4 address.
     * Returns the filtered data, or NULL if the filter fails.
     *
     * @param string $value "not octet dotted" IPv4.
     * @return string
     */
    private function filterIPv4Special($value)
    {
        // Initialize
        $sReturn = null;

        // Convert
        if (is_string($value) && strlen($value) > 10) {
            if (preg_match('/^[0-9a-f]{2}\.[0-9a-f]{2}\.[0-9a-f]{2}\.[0-9a-f]{2}$/i', $value)) {
                // Dotted hexadecimal format: ff.ff.ff.ff
                $aParts  = explode('.', $value);
                $sReturn = hexdec($aParts[0]) . '.'
                        . hexdec($aParts[1]) . '.'
                        . hexdec($aParts[2]) . '.'
                        . hexdec($aParts[3]);
            } elseif (preg_match('/^[01]{8}\.[01]{8}\.[01]{8}\.[01]{8}$/i', $value)) {
                // Dotted binary format: 00000000.00000000.00000000.00000000
                $aParts  = explode('.', $value);
                $sReturn = bindec($aParts[0]) . '.'
                        . bindec($aParts[1]) . '.'
                        . bindec($aParts[2]) . '.'
                        . bindec($aParts[3]);
            } elseif (preg_match('/^[0-7]{4}\.[0-7]{4}\.[0-7]{4}\.[0-7]{4}$/i', $value)) {
                // Dotted octal format: 7777.7777.7777.7777
                $aParts  = explode('.', $value);
                $sReturn = octdec($aParts[0]) . '.'
                        . octdec($aParts[1]) . '.'
                        . octdec($aParts[2]) . '.'
                        . octdec($aParts[3]);
            }//if( preg_match(...
        }//if( is_string(...
        // Filters
        if (isset($sReturn)) {
            $sReturn = filter_var($sReturn, FILTER_VALIDATE_IP);
        }

        return (false === $sReturn) ? null : $sReturn;
    }
}
