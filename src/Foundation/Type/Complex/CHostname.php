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
 * This class provides an hostname filter.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Complex
 * @version    1.0.0
 * @since      1.0.0
 */
final class CHostname extends \Foundation\Type\CTypeAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor
     *
     * @param string $value IP address.
     * @param array  $options [OPTIONAL] An array defining the options:
     *               - $options[0] specifies if TLD is mandatory, default is TRUE.
     *               - $options[1] specifies if IP address is allowed, default is TRUE.
     *               - $options[2] specifies if local domain is allowed, default is FALSE.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct($value, array $options = [ true, true, false ])
    {
        $this->_sDebugID = uniqid('chostname', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $value, $options ]
                );

        // Options
        $this->_bOptionTLD   = (( isset($options[0]) && is_bool($options[0]) ) ? $options[0] : true );
        $this->_bOptionIP    = (( isset($options[1]) && is_bool($options[1]) ) ? $options[1] : true );
        $this->_bOptionLocal = (( isset($options[2]) && is_bool($options[2]) ) ? $options[2] : false );

        // Value
        $this->setValue($value);
    }

    /** Hostname section
     * ***************** */

    /**
     * Domain punycode.
     * @var string
     */
    private $_sPunycode = null;

    /**
     * Returns punycode.
     *
     * @return string Returns NULL if the hostname is not valid.
     */
    public function getPunycode()
    {
        return $this->_sPunycode;
    }

    /**
     * Validates the domain part.
     *
     * @param string $value    Domain part to validate.
     * @param string $IDN      Contains the valid unicode name of the domain.
     * @param string $punycode Contains the valid punycode of the domain.
     * @return boolean Returns FALSE if the domain is not valid, TRUE otherwise.
     */
    private function validateDomainLabel($value, &$IDN, &$punycode)
    {
        // Check parameter
        if (! is_string($value)) {
            return false;
        }

        // Domain label consists of 1 to 63 characters
        $iLength = mb_strlen($value, 'UTF-8');
        if (( $iLength == 0 ) || ( $iLength > 63 )) {
            return false;
        }

        // Domain label must begin and end with an alpha (a-z)(x61-x7A) (A-Z)(x41-x5A)or numeric (0-9)(x30-x39)
        // character and may include hyphens (-)(x2D).
        if (( mb_strrpos($value, '-', 'UTF-8') === ($iLength - 1) ) || (preg_match(
            '/^[\p{L}\p{Nd}][\p{L}\p{Nd}\x2d]*$/u',
            $value
        ) != 1) ) {
            return false;
        }

        // The domain name is a punycode: decode it to IDN
        if (( $iLength > 3 ) && (strpos($value, 'xn--') === 0)) {
            $punycode = $value;
            $IDN      = idn_to_utf8($punycode);
            return ( ((false === $IDN) || (strpos($IDN, 'xn--') === 0) ) ? false : true);
        }

        // Check dash (-) does not appear in 3rd and 4th positions
        if (( $iLength > 2 ) && ( mb_strpos($value, '--', 2) == 2 )) {
            return false;
        }

        // Valid IDN unicode domain name.
        $IDN      = $value;
        $punycode = idn_to_ascii($value);

        return ((false === $punycode) ? false : true);
    }

    /**
     * Validates TLD.
     *
     * @param string $value    TLD to validate.
     * @param string $IDN      Contains the valid unicode TLD.
     * @param string $punycode Contains the valid punycode TLD.
     * @return boolean Returns FALSE if the TLD is not valid, TRUE otherwise.
     */
    private function validateTLD($value, &$IDN, &$punycode)
    {
        // Check parameter
        if (! is_string($value)) {
            return false;
        }

        // TLD consists of 2 to 63 characters
        $iLength = mb_strlen($value, 'UTF-8');
        if (( $iLength < 2 ) || ( $iLength > 63 )) {
            return false;
        }

        // TLD must begin and end with an alpha (a-z)(x61-x7A) (A-Z)(x41-x5A)or numeric (0-9)(x30-x39)
        // character and must contain at least one alpha character or hyphen (not all numeric).
        if (( mb_strrpos($value, '-', 'UTF-8') === ($iLength - 1) ) ||
                (preg_match('/^[\p{Nd}]+$/u', $value) == 1) ||
                (preg_match('/^[\p{L}\p{Nd}][\p{L}\p{Nd}\x2d]*$/u', $value) != 1) ) {
            return false;
        }

        // The TLD is a punycode: decode it to IDN
        if (( $iLength > 3 ) && (strpos($value, 'xn--') === 0)) {
            $punycode = $value;
            $IDN      = idn_to_utf8($punycode);
            return ( ((false === $IDN) || (strpos($IDN, 'xn--') === 0) ) ? false : true);
        }

        // Check dash (-) does not appear in 3rd and 4th positions
        if (mb_strpos($value, '--', 2) == 2) {
            return false;
        }

        // Valid IDN unicode TLD.
        $IDN      = $value;
        $punycode = idn_to_ascii($value);

        return ((false === $punycode) ? false : true);
    }

    /**
     * Validates IP address literal.
     * Returns TRUE if $value is a valid IP address and the IP address literal is allowed.
     * Returns FALSE if $value is a valid IP address and the IP address literal is not allowed.
     * Returns NULL if $value is not a valid IP address.
     *
     * @param string $value    Hostname to validate.
     * @return mixed
     */
    private function validateIP($value)
    {
        // Initialize
        $bReturn = null;

        // Validates
        $pValidator = new \Foundation\Type\Complex\CIp($value);

        if ($pValidator->isValid()) {
            if ($this->_bOptionIP) {
                // IP address is allowed
                $this->_Value     = $pValidator->getValue();
                $this->_sPunycode = $this->_Value;
                $bReturn          = true;
            } else {
                // IP address is not allowed
                $bReturn = false;
            }
        }

        unset($pValidator);

        return $bReturn;
    }

    /** Type section
     * ************* */

    /**
     * This option specifies if TLD is mandatory, default is TRUE.
     * @var boolean
     */
    private $_bOptionTLD = true;

    /**
     * This option specifies if IP address is allowed, default is TRUE.
     * @var boolean
     */
    private $_bOptionIP = true;

    /**
     * This option specifies if local domain is allowed, default is FALSE.
     * @var boolean
     */
    private $_bOptionLocal = false;

    /**
     * Writes data to variable.
     *
     * @param string $value The value to write.
     * @return \Foundation\Type\Complex\CHostname
     */
    public function setValue($value)
    {
        // Initialize
        $this->_Value     = null;
        $this->_sPunycode = null;

        // Check argument type
        if ($value instanceof \Foundation\Type\Complex\CHostname) {
            // Already an hostname: nothing to do
            $this->_Value     = $value->getValue();
            $this->_sPunycode = $value->getPunycode();
            return $this;
        }

        // Other types: only string are allowed
        if ($value instanceof \Foundation\Type\TypeInterface) {
            $value = $value->getValue();
        }

        if (! is_string($value)) {
            return $this;
        }

        $value   = trim($value);
        $iLength = mb_strlen($value, 'UTF-8');

        // Hostname has a maximum total length of 255 characters (including dot delimiters)
        if (($iLength < 1) || ($iLength > 255) || (false !== strpos($value, '..') )) {
            return $this;
        }

        // CASE: IP address literal
        if (( preg_match('/^[0-9a-f:.]*$/i', $value) == 1 ) && ( is_bool($this->validateIP($value)) )) {
            return $this;
        }

        // CASE: composition of series of labels concatenated with dots
        $aLabels     = explode('.', $value);
        $iLabelCount = count($aLabels);

        // Top-level domain name is mandatory
        if (( $iLabelCount < 2 ) && $this->_bOptionTLD) {
            return $this;
        }

        // Local domain are not allowed
        if (( $iLabelCount < 2 ) && ! $this->_bOptionLocal) {
            return $this;
        }

        // Check top-level domain name (may be a local domain)
        $sValidLabels    = '';
        $sValidPunycodes = '';
        $sLabel          = array_pop($aLabels);

        if ($iLabelCount == 1) {
            // CASE: local domain
            $isOK = $this->validateDomainLabel($sLabel, $sValidLabels, $sValidPunycodes);
        } else {
            // CASE: top-level domain
            $isOK = $this->validateTLD($sLabel, $sValidLabels, $sValidPunycodes);
        }

        // Check other labels
        while ($isOK && (count($aLabels) > 0)) {
            $sTmpIDN      = '';
            $sTmpPunycode = '';
            $sLabel       = array_pop($aLabels);
            $isOK         = $this->validateDomainLabel($sLabel, $sTmpIDN, $sTmpPunycode);
            if ($isOK) {
                $sValidLabels    = $sTmpIDN . '.' . $sValidLabels;
                $sValidPunycodes = $sTmpPunycode . '.' . $sValidPunycodes;
            }//if( ...
        }//while( ...

        if ($isOK) {
            $this->_Value     = $sValidLabels;
            $this->_sPunycode = $sValidPunycodes;
        }

        return $this;
    }
}
