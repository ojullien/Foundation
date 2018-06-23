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
 * This class provides a path filter.
 *
 * @category   Foundation
 * @package    Type
 * @subpackage Complex
 * @version    1.0.0
 * @since      1.0.0
 */
final class CPath extends \Foundation\Type\CTypeAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor
     *
     * @param string $value The value to write.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $value )
    {
        $this->_sDebugID = uniqid( 'cpath', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__, [ $value ] );
        $this->setValue( $value );
    }

    /**
     * Convert to string. If the file or directory exists, this method expands all symbolic links, resolves relative
     * references and returns the real path.
     *
     * @return string
     */
    public function __toString()
    {
        if( isset( $this->_Value ) )
        {
            // The absolute path is checked everytime because it can be created during the lifetime of the class.
            $sReturn = realpath( $this->_Value );
            if( FALSE === $sReturn )
            {
                $sReturn = (string)$this->_Value;
            }
        }
        else
        {
            $sReturn = '';
        }
        return $sReturn;
    }

    /** Path section
     * ************* */

    /**
     * Returns the base name of the file, directory, or link without path info.
     *
     * @return mixed Returns string or NULL
     */
    public function getBasename()
    {
        if( isset( $this->_Value ) )
        {
            // The absolute path is checked everytime because it can be created during the lifetime of the class.
            $sReturn = realpath( $this->_Value );
            if( FALSE === $sReturn )
            {
                $sReturn = $this->_Value;
            }
            $sReturn = basename( $sReturn );
        }
        else
        {
            $sReturn = NULL;
        }
        return $sReturn;
    }

    /**
     * Gets absolute path to file. This method expands all symbolic links,
     * resolves relative references and returns the real path to the file.
     *
     * @return string Returns a string or FALSE if the path do not exists
     */
    public function getRealPath()
    {
        // The absolute path is checked everytime because it can be created during the lifetime of the class.
        return isset( $this->_Value ) ? realpath( $this->_Value ) : FALSE;
    }

    /** Type section
     * ************* */

    /**
     * Writes data to variable.
     *
     * @param string|\Foundation\Type\Complex\CPath|\Foundation\Type\Simple\CString $value The value to write.
     * @return \Foundation\Type\Complex\CPath
     */
    public function setValue( $value )
    {
        // Initialize
        $this->_Value = NULL;

        // Already a path: nothing to do
        if( $value instanceof \Foundation\Type\Complex\CPath )
        {
            $this->_Value = $value->getValue();
            return $this;
        }
        // Other types: cast to string
        elseif( $value instanceof \Foundation\Type\Simple\CString )
        {
            $value = (string)$value;
        }
        else
        {
            $value = is_string( $value ) ? trim( $value ) : '';
        }

        // Validate argument value
        if( strlen( $value ) > 0 )
        {
            // Split
            $value  = rtrim( $value, '/\\' );
            $aSplit = mb_split( '[:]', $value );
            if( strlen( $aSplit[0] ) > 0 )
            {
                $bIsValid = FALSE;

                // Only one ':' is allowed
                $iCount = count( $aSplit );
                if( $iCount == 1 )
                {
                    $bIsValid = TRUE;
                }
                elseif( $iCount == 2 )
                {
                    // Only one ':' should be located in the first part of the path
                    if( (strpos( $aSplit[0], '/' ) === FALSE) && (strpos( $aSplit[0], '\\' ) === FALSE) )
                    {
                        $bIsValid = TRUE;
                    }
                }

                // Check the path
                if( $bIsValid && (preg_match( "/^[\\p{Nd}\\p{L}\\\\\\/\\._\\-\\:]+$/u", $value ) > 0) )
                {
                    $this->_Value = $value;
                }
            }//if( strlen(...
        }//if( strlen(...

        return $this;
    }

    /**
     * Reads data from variable. If the file or directory exists, this method expands all symbolic links, resolves
     * relative references and returns the real path.
     *
     * @return mixed Returns a string or NULL
     */
    public function getValue()
    {
        if( isset( $this->_Value ) )
        {
            // The absolute path is checked everytime because it can be created during the lifetime of the class.
            $sReturn = realpath( $this->_Value );
            if( FALSE === $sReturn )
            {
                $sReturn = $this->_Value;
            }
        }
        else
        {
            $sReturn = NULL;
        }
        return $sReturn;
    }

    /**
     * Gets variable length. If the file or directory exists, this method expands all symbolic links, resolves relative
     * references and returns the lenght of the real path.
     *
     * @return int
     */
    public function getLength()
    {
        if( isset( $this->_Value ) )
        {
            // The absolute path is checked everytime because it can be created during the lifetime of the class.
            $sReturn = realpath( $this->_Value );
            if( FALSE === $sReturn )
            {
                $sReturn = $this->_Value;
            }
            $iReturn = mb_strlen( $sReturn, 'UTF-8' );
        }
        else
        {
            $iReturn = 0;
        }
        return $iReturn;
    }

}