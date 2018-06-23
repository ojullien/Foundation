<?php
namespace Foundation\Type\Complex;
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
 * This class provides an email address filter.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Complex
 * @version    1.0.0
 * @since      1.0.0
 */
final class CEmailAddress implements \Foundation\Type\TypeInterface
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
     * Constructor
     *
     * @param string $value The value to write.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $value )
    {
        $this->_sDebugID = uniqid( 'cemailaddress', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__, [ $value ] );

        $this->setValue( $value );
    }

    /**
     * Destructor
     *
     * @codeCoverageIgnore
     */
    public function __destruct()
    {
        $this->_sRaw        = '';
        $this->_sPartLocal  = NULL;
        $this->_sPartDomain = NULL;
        $this->_sPunycode   = NULL;
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __set( $name, $value )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /**
     * Converts to string
     *
     * @return string
     */
    public function __toString()
    {
        return ( isset( $this->_sPartLocal ) && isset( $this->_sPartDomain ) ) ? $this->_sPartLocal . '@' . $this->_sPartDomain : '';
    }

    /** Type section
     * ************* */

    /**
     * Reads data from variables. Returns a string or NULL.
     *
     * @return string
     */
    public function getValue()
    {
        return ( isset( $this->_sPartLocal ) && isset( $this->_sPartDomain ) ) ? $this->_sPartLocal . '@' . $this->_sPartDomain : NULL;
    }

    /**
     * Determines if the email address is valid.
     *
     * @return boolean
     */
    public function isValid()
    {
        return ( isset( $this->_sPartLocal ) && isset( $this->_sPartDomain ) );
    }

    /**
     * Gets variable length.
     *
     * @return int
     */
    public function getLength()
    {
        return ( isset( $this->_sPartLocal ) && isset( $this->_sPartDomain ) ) ? mb_strlen( $this->_sPartLocal . '@' . $this->_sPartDomain,
                                                                                            'UTF-8' ) : 0;
    }

    /**
     * Writes data to variable.
     *
     * @param string $value|\Foundation\Type\Complex\CEmailAddress|\Foundation\Type\Simple\CString The value to write.
     * @return \Foundation\Type\Complex\CEmailAddress
     */
    public function setValue( $value )
    {
        // Initialize
        $this->_sRaw        = '';
        $this->_sPartLocal  = NULL;
        $this->_sPartDomain = NULL;
        $this->_sPunycode   = NULL;

        // Check argument type
        if( $value instanceof \Foundation\Type\Complex\CEmailAddress && $value->isValid() )
        {
            // Already an email address: nothing to do
            $this->_sRaw        = $value->getRaw();
            $this->_sPartLocal  = $value->getLocalPart();
            $this->_sPartDomain = $value->getDomainPart();
            $this->_sPunycode   = substr( $value->getPunycode(), mb_strlen( $this->_sPartLocal ) + 1 );
            return $this;
        }
        // We're working with the raw value
        elseif( $value instanceof \Foundation\Type\Simple\CString )
        {
            $this->_sRaw = $value->getValue();
        }
        elseif( is_string( $value ) )
        {
            $this->_sRaw = trim( $value );
        }
        else
        {
            return $this;
        }

        // An email address must consist of a local part and a domain part separated by an @ symbol (x40) with a
        // combined length of no more than 256 characters.
        // Do not accept ip address: local@[129.126.118.1]
        $aMatches = [ ];
        $iLength  = mb_strlen( $this->_sRaw, 'UTF-8' );
        if( ($iLength > 2) && ($iLength < 257) && ( preg_match( '/^(.+)@([^@]+)$/', $this->_sRaw, $aMatches ) == 1 ) )
        {
            // Validate local part and domain part
            if( isset( $aMatches[1] ) && isset( $aMatches[2] ) && $this->setLocalPart( $aMatches[1] ) )
            {
                $pHostname = new \Foundation\Type\Complex\CHostname( $aMatches[2], array( TRUE, FALSE, FALSE ) );
                if( $pHostname->isValid() )
                {
                    $this->_sPartDomain = $pHostname->getValue();
                    $this->_sPunycode   = $pHostname->getPunycode();
                }
                unset( $pHostname );
            }//if( isset( ...
        }//if( (...

        return $this;
    }

    /** Raw section
     * ************ */

    /**
     * Raw data.
     * @var string
     */
    private $_sRaw = '';

    /**
     * Returns raw value of the email address.
     *
     * @return string
     */
    public function getRaw()
    {
        return $this->_sRaw;
    }

    /** Local part section
     * ******************* */

    /**
     * Local part of the email address.
     * @var string
     */
    private $_sPartLocal = NULL;

    /**
     * Returns the local part of the email address.
     *
     * @return string|NULL
     */
    public function getLocalPart()
    {
        return $this->_sPartLocal;
    }

    /**
     * Returns the regex pattern for a non quoted local part of an email address.
     * Extended version of the RFC2822.
     *
     * @return string
     */
    public static function getPatternEmailAddressLocalPartNoQuoted()
    {
        // A non-quoted local part may consist of alpha (a-z) (x61-x7A) (A-Z) (x41-x5A), numeric (0-9) (x30-x39) and the
        // following characters: !#$%&'*+-/=?^_`{|}~ (x21, x23, x24, x25, x26, x27, x2A, x2B, x2D, x2F, x3D, x3F, x5E,
        // x5F, x60, x7B, x7C, x7D, x7E) respectively.
        static $sSubPattern = 'a-zA-Z0-9\x21\x23\x24\x25\x26\x27\x2a\x2b\x2d\x2f\x3d\x3f\x5e\x5f\x60\x7b\x7c\x7d\x7e';
        return '/^[' . $sSubPattern . ']+(?:\x2e+[' . $sSubPattern . ']+)*$/';
    }

    /**
     * Returns the regex pattern for a quoted local part of an email address.
     * Extended version of the RFC2822.
     *
     * @return string
     */
    public static function getPatternEmailAddressLocalPartQuoted()
    {
        // The local part may be a double quoted (") (x22) string consisting of any ASCII characters except the
        // following: NULL (x00), TAB (x09), LF (x0A), CR (x0D), " (x22), \ (x5C).  However the following are permitted
        // in a local part double quoted string if escaped (preceded by a backslash, (\), (x5C)): x01 thru x09, x0B,
        // x0C, x0E thru x7F.
        static $sSubPattern = '\sa-zA-Z0-9\x5c\x21\x23\x24\x25\x26\x27\x2a\x2b\x2d\x2f\x3d\x3f\x5e\x5f\x60\x7b\x7c\x7d\x7e\x5b\x5d\x40';
        return '/^\x22[' . $sSubPattern . ']+(?:\x2e+[' . $sSubPattern . ']+)*\x22$/';
    }

    /**
     * Writes data to local part variable. Return TRUE if the value is valid.
     *
     * @param string $value
     * @return boolean
     */
    private function setLocalPart( $value )
    {
        // Initialize
        $this->_sPartLocal = NULL;

        // Verify the type
        $value   = ( is_string( $value ) ) ? trim( $value ) : '';
        $iLength = ( '' == $value ) ? 0 : mb_strlen( $value, 'UTF-8' );

        // Maximum length of the local part is 64 characters. Dots may also be present in the local part, but can not
        // be the first nor last character, nor adjacent to another dot (.) (x2E).
        if( ($iLength > 0) &&
                ($iLength < 65) &&
                ( FALSE === strpos( $value, '..' ) ) &&
                // Non Quoted || Quoted
                ( ( preg_match( self::getPatternEmailAddressLocalPartNoQuoted(), $value ) === 1 ) ||
                ( preg_match( self::getPatternEmailAddressLocalPartQuoted(), $value ) === 1 ) ) )
        {
            $this->_sPartLocal = $value;
        }

        return isset( $this->_sPartLocal );
    }

    /** Domain part section
     * ******************** */

    /**
     * Domain part of the email address.
     * @var string
     */
    private $_sPartDomain = NULL;

    /**
     * Returns the domain part of the email address.
     *
     * @return string|NULL
     */
    public function getDomainPart()
    {
        return $this->_sPartDomain;
    }

    /** Punycode section
     * ***************** */

    /**
     * Domain punycode.
     * @var string
     */
    private $_sPunycode = NULL;

    /**
     * Returns the punycode encoded email.
     *
     * @return string|NULL
     */
    public function getPunycode()
    {
        return ( isset( $this->_sPartLocal ) && isset( $this->_sPunycode ) ) ? $this->_sPartLocal . '@' . $this->_sPunycode : NULL;
    }

    /** DNS section
     * ************ */

    /**
     * Determines if the domain is fully qualified (FQDN) and resolvable to an A or MX domain name system record.
     *
     * @param boolean $useDeepMxCheck [OPTIONAL] Set to TRUE to perform a deep validation process for MX records.
     * @return boolean
     */
    public function checkDNS( $useDeepMxCheck = FALSE )
    {

        if( isset( $this->_sPunycode ) )
        {
            $Domain  = $this->_sPunycode . '.';
            $bReturn = checkdnsrr( $Domain, 'MX' ) ||
                    ( $useDeepMxCheck &&
                    ( checkdnsrr( $Domain, 'A' ) || checkdnsrr( $Domain, 'AAAA' ) || checkdnsrr( $Domain, 'A6' ) ) );
        }
        else
        {
            $bReturn = FALSE;
        }
        return $bReturn;
    }

}