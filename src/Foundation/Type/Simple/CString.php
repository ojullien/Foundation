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
 * This class provides a string filter.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Simple
 * @version    1.0.0
 * @since      1.0.0
 */
class CString extends \Foundation\Type\CTypeAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor
     *
     * @param string $value   The value to write.
     * @param array  $options [OPTIONAL] An array defining the options. $options[0] specifies the pattern the value
     *                        should match.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $value, array $options = [ ] )
    {
        $this->_sDebugID = uniqid( 'cstring', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $value, $options ] );
        // Options
        $this->_aOptions = $options;
        // Value
        $this->setValue( $value );
    }

    /** String section
     * *************** */

    /**
     * Options
     * @var array
     */
    private $_aOptions = NULL;

    /**
     * Searches variable for a match to the regular expression given in pattern.
     *
     * Returns true if the variable matches the pattern.
     * If $aMatches is provided,then it is filled with the results of search. $aMatches[0] will contain the text that
     * matched the full pattern, $aMatches[1] will have the text that matched the first captured parenthesized
     * subpattern, and so on.
     *
     * @param string $pattern  The pattern to search for.
     * @param array  $aMatches [OPTIONAL] Results of the search.
     * @return boolean
     */
    final public function matches( $pattern, &$aMatches = NULL )
    {
        // Initialize
        $bReturn = FALSE;

        // Check pattern type
        $pattern = ( is_string( $pattern ) ) ? trim( $pattern ) : $pattern = '';

        // Search
        if( isset( $this->_Value ) && ( strlen( $pattern ) > 0 ) && ( is_null( $aMatches ) || is_array( $aMatches ) ) )
        {
            if( preg_match( $pattern, $this->_Value, $aMatches ) > 0 )
            {
                $bReturn = TRUE;
            }//if( preg_match(...
        }//if( isset(...

        return $bReturn;
    }

    /**
     * Removes characters from the end of the variable.
     *
     * @param string $sCharlist Characters to remove
     */
    final public function trimFromEnd( $sCharlist )
    {
        if( (strlen( $this->_Value ) > 0) && is_string( $sCharlist ) )
        {
            $this->_Value = rtrim( $this->_Value, $sCharlist );
        }//if( (strlen(...
    }

    /**
     * Returns TRUE if the $sNeedle was found. FALSE otherwise.
     *
     * @param string  $needle           The string, of one or more characters, to search in.
     * @param boolean $bCaseInsensitive [OPTIONAL] If TRUE, $needle is case insensitive.
     * @return boolean
     */
    final public function contains( $needle, $bCaseInsensitive = FALSE )
    {
        $bReturn = FALSE;
        if( strlen( $this->_Value ) > 0 )
        {
            // Check $bCaseInsensitive type
            $bCaseInsensitive = ( is_bool( $bCaseInsensitive ) ) ? $bCaseInsensitive : FALSE;

            // TypeInterface case
            if( $needle instanceof \Foundation\Type\TypeInterface )
                $needle = $needle->getValue();

            if( is_scalar( $needle ) )
            {
                // Cast to string
                $needle = trim( $needle );

                // Find the substring
                if( strlen( $needle ) > 0 )
                {
                    if( $bCaseInsensitive )
                    {
                        $bReturn = stripos( $this->_Value, $needle );
                    }
                    else
                    {
                        $bReturn = strpos( $this->_Value, $needle );
                    }//if(...

                    $bReturn = ( $bReturn === FALSE ) ? FALSE : TRUE;
                }//if( is_string( ...
            }//if( is_scalar( ...
        }//if( strlen(...
        return $bReturn;
    }

    /** Type section
     * ************* */

    /**
     * Writes data to variable.
     *
     * @param string $value   The value to write.
     * @return \Foundation\Type\Simple\CString
     */
    public function setValue( $value )
    {
        // Initialize
        $this->_Value = NULL;

        // Check value
        if( $value instanceof \Foundation\Type\TypeInterface )
            $value = $value->getValue();

        if( is_scalar( $value ) )
        {
            // Cast to string
            $this->_Value = trim( $value );

            // Check filter
            if( isset( $this->_aOptions[0] ) && !$this->matches( $this->_aOptions[0] ) )
            {
                $this->_Value = NULL;
            }
        }

        return $this;
    }

}