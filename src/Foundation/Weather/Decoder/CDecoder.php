<?php
namespace Foundation\Weather\Decoder;
/**
 * Foundation Framework
 *
 * @package   Weather
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements a concrete decoder strategy: decodes according to a dtd.
 *
 * @category   Foundation
 * @package    Weather
 * @subpackage Decoder
 * @version    1.0.0
 * @since      1.0.0
 */
final class CDecoder extends \Foundation\Weather\Decoder\CDecoderAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->_sDebugID = uniqid( 'cdecoder', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__, array( ) );
    }

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    private $_sDebugID = '';

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /** Decoder section
     * **************** */

    /**
     * Parses recursively and replaces $dtd values with values from $data array.
     * This method computes as a "looks like" intersection method; the $dtd keys are preserved, the $dtd values are
     * replaced with the values from $data.
     *
     * Use getErrorNumber and getErrorText methods to check if an error as "key is missing" or "type mismatch" was
     * occured.
     *
     * @param  array $dtd  The DTD and the destination.
     * @param  array $data The source.
     * @return void
     */
    private function parse( array& $dtd, array& $data )
    {
        // For each key from the dtd
        foreach( $dtd as $key => $void )
        {
            // DTD specific.
            // The key exists in the source but should contains the value of the key defined by $void['__MOVE'].
            if( is_array( $void ) && isset( $void['__MOVE'] ) )
            {

                // The key defined by $void['__MOVE'] should exists in the source
                if( isset( $data[$key] ) && isset( $data[$key][$void['__MOVE']] ) )
                {
                    $dtd[$key] = $data[$key][$void['__MOVE']];
                }
                // Case error: the expected key is missing in the source.
                else
                {
                    $dtd[$key]     = $void['__DEFAULT'];
                    $this->_iError = self::FWD_KEY_MISSING;
                    $this->_sError = sprintf( 'Key "%s/%s" is missing', $key, $void['__MOVE'] );
                }
                continue;
            }

            // DTD specific.
            // This key does not exist in the source but has to be created into the destination.
            if( is_array( $void ) && isset( $void['__DEFAULT'] ) )
            {
                $dtd[$key] = $void['__DEFAULT'];
                continue;
            }

            // Look for the same key in the source:
            // - if does not exist: keep the default value defined in the DTD.
            // - if exists: the action depends on the type.
            if( isset( $data[$key] ) )
            {
                // Work with pointers
                $data_value = &$data[$key];
                $dtd_value  = &$dtd[$key];

                // Case array: parse deeper
                if( is_array( $dtd_value ) && is_array( $data_value ) )
                {
                    $this->parse( $dtd_value, $data_value );
                }
                // Case scalar: copy value
                elseif( is_scalar( $dtd_value ) && is_scalar( $data_value ) )
                {
                    $dtd_value = $data_value;
                }
                // Case error: not the same type
                else
                {
                    $this->_iError = self::FWD_BAD_TYPE;
                    $this->_sError = sprintf( 'Type mismatch for "%s"', $key );
                }
            }
            // Case error: the expected key is missing in the source.
            else
            {
                $this->_iError = self::FWD_KEY_MISSING;
                $this->_sError = sprintf( 'Key "%s" is missing', $key );
            }//if( isset( ...
        }// foreach( ...
    }

    /**
     * Decodes data into an associative array according to the DTD.
     * The returned array has the same structure as the DTD.
     * In case of failure, use getErrorNumber and getErrorText methods to determine the exact nature of error.
     * @see \Foundation\Weather\Decoder\Dtd\wu_dtd for a DTD explanation.
     *
     * @param  array $dtd  Defines the legal structure of the returned array. Should not be empty.
     * @param  array $data The data being decoded. Should not be empty.
     * @return array Returns the decoded data on success, NULL on failure.
     */
    public function decode( array $dtd, $data )
    {
        // Initialize
        $this->_iError = 0;
        $this->_sError = '';

        // This strategy apply only on array
        if( !empty( $dtd ) && is_array( $data ) && !empty( $data ) )
        {
            // Parse the source according to the DTD
            $this->parse( $dtd, $data );
        }
        else
        {
            $dtd           = NULL;
            $this->_iError = self::FWD_ERROR_SYNTAX;
            $this->_sError = 'Invalid or malformed data';
        }
        return $dtd;
    }

}