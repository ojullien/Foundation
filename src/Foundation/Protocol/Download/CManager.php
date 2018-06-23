<?php
namespace Foundation\Protocol\Download;
/**
 * Foundation Framework
 *
 * @package   Protocol
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements default constant and methods for download.
 *
 * @category   Foundation
 * @package    Protocol
 * @subpackage Download
 * @version    1.0.0
 * @since      1.0.0
 */
final class CManager implements \Foundation\Protocol\Download\ManagerInterface
{
    /** Constants */

    const DEFAULT_SIZE = 65536;

    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    private $_sDebugID = '';

    /**
     * Constructor.
     *
     * @param array $options [OPTIONAL] An array defining the options.
     *                       $options[0] specifies the number of bytes to read and send per chunk.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct( array $options = [ ] )
    {
        $this->_sDebugID  = uniqid( 'cmanager', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $options ] );
        if( isset( $options[0] ) && is_integer( $options[0] ) && ( $options[0] > 0 ) )
            $this->_ChunkSize = $options[0];
    }

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

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __set( $name, $value )
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
    public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /** Download manager section
     * ************************* */

    /**
     * Number of bytes to read and send per chunk.
     * @var integer
     */
    private $_ChunkSize = self::DEFAULT_SIZE;

    /**
     * Sends a file. Returns FALSE on error.
     * Throws an exception if the attachment cannot be opened or if the mime type is not valid.
     *
     * @param \SplFileInfo $pAttachment Attachment to download.
     * @param string       $sMime       Mime type of the attachment
     * @param array        $options     [OPTIONAL] An array defining the options.
     *                                  $options['test'] specifies the test mode: if TRUE does not send headers nor
     *                                  attachment.
     * @return boolean Returns FALSE on error.
     * @throws \Foundation\Exception\InvalidArgumentException If the attachment cannot be opened or if the mime type is
     *                                                        not valid.
     */
    public function send( \SplFileInfo $pAttachment, $sMime, array $options = [ ] )
    {
        // Check attachment argument
        if( !$pAttachment->isFile() || !$pAttachment->isReadable() )
            throw new \Foundation\Exception\InvalidArgumentException( 'The attachment cannot be opened.' );

        // Check mime type argument
        static $sPattern = '/^[\w\.\-\+\/]+$/';

        $sMime = ( is_string( $sMime ) ) ? trim( $sMime ) : '';

        if( ( mb_strlen( $sMime ) < 3 ) || ( preg_match( $sPattern, $sMime ) !== 1 ) )
            throw new \Foundation\Exception\InvalidArgumentException( 'The mime type required is not valid.' );

        // Check options argument
        $bUnitTest = ( isset( $options['test'] ) && is_bool( $options['test'] ) ) ? $options['test'] : FALSE;

        // Send headers
        //@codeCoverageIgnoreStart
        if( !$bUnitTest )
        {
            // Send headers for attachment
            header( 'Content-Type: ' . $sMime );
            header( 'Content-disposition: attachment; filename="' . $pAttachment->getBasename() . '"' );
            header( "Content-Transfer-Encoding: binary" );
            header( "Content-Length: " . $pAttachment->getSize() );
            // Send header for cache
            header( "Pragma: public" );
            header( "Pragma: no-cache" );
            header( "Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0" );
            header( "Cache-Control: private", false );
            header( "Expires: 0" );
        }
        //@codeCoverageIgnoreEnd
        $bReturn = FALSE;

        // send attachment
        $pHandle = fopen( $pAttachment->getPathname(), 'rb' );
        if( $pHandle !== FALSE )
        {
            while( !feof( $pHandle ) )
            {
                $sBuffer = fread( $pHandle, $this->_ChunkSize );
                //@codeCoverageIgnoreStart
                if( !$bUnitTest && ($sBuffer !== FALSE) )
                {
                    echo $sBuffer;
                }
                //@codeCoverageIgnoreEnd
            }//while( !feof(...
            fclose( $pHandle );
            $bReturn = TRUE;
        }

        return $bReturn;
    }

}