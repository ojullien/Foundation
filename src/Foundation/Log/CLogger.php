<?php
namespace Foundation\Log;
/**
 * Foundation Framework
 *
 * @package   Log
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements usefull methods for general purpose logging.
 *
 * @category   Foundation
 * @package    Log
 * @version    1.0.0
 * @since      1.0.0
 */
final class CLogger
{
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
     * @param \Foundation\Log\Writer\WriterInterface $writer Log writer.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( \Foundation\Log\Writer\WriterInterface $writer )
    {
        $this->_sDebugID = uniqid( 'clogger', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__, array( ) );
        $this->_pWriter  = $writer;
    }

    /**
     * Destructor
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        if( isset( $this->_pWriter ) )
        {
            try
            {
                $this->_pWriter->shutdown();
            }
            catch( \Exception $e )
            {/* Do nothing */
            }
        }
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
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

    /** Writer section
     * *************** */

    /**
     * Writer
     * @var \Foundation\Log\Writer\WriterInterface
     */
    private $_pWriter = NULL;

    /** Log section
     * ************ */

    /**
     * Add a message as a log entry
     *
     * @param \Foundation\Type\Enum\CSeverity $severity Severity level of the message.
     * @param string                          $user     Name of the logged user that experienced the condition.
     * @param string                          $module   Module producing the message.
     * @param string                          $title    Short message.
     * @param string                          $message  Detailed message.
     */
    public function log( \Foundation\Type\Enum\CSeverity $severity, $user, $module, $title, $message )
    {
        if( isset( $this->_pWriter ) )
        {
            $server  = ( isset( $_SERVER ) && is_array( $_SERVER ) ) ? $_SERVER : array( );
            $session = ( isset( $_SESSION ) && is_array( $_SESSION ) ) ? $_SESSION : array( );
            $pLog    = new \Foundation\Log\CMessage( $severity, $server, $session );
            $pLog->setMessage( $message );
            $pLog->setModule( $module );
            $pLog->setTitle( $title );
            $pLog->setUser( $user );
            $this->_pWriter->write( $pLog );
            unset( $pLog );
        }
    }

    /**
     * Add an emergency message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function emerg( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::EMERG ), $user, $module,
                                                         $title, $message );
    }

    /**
     * Add an alert message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function alert( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::ALERT ), $user, $module,
                                                         $title, $message );
    }

    /**
     * Add a critical message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function crit( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::CRIT ), $user, $module,
                                                         $title, $message );
    }

    /**
     * Add an error message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function err( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::ERR ), $user, $module, $title,
                                                         $message );
    }

    /**
     * Add a warning message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function warn( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::WARN ), $user, $module,
                                                         $title, $message );
    }

    /**
     * Add a notice message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function notice( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::NOTICE ), $user, $module,
                                                         $title, $message );
    }

    /**
     * Add an information message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function info( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::INFO ), $user, $module,
                                                         $title, $message );
    }

    /**
     * Add a debug message as a log entry.
     *
     * @param string $user    Name of the logged user that experienced the condition.
     * @param string $module  Module producing the message.
     * @param string $title   Short message.
     * @param string $message Detailed message.
     */
    public function debug( $user, $module, $title, $message )
    {
        $this->log( new \Foundation\Type\Enum\CSeverity( \Foundation\Type\Enum\CSeverity::DEBUG ), $user, $module,
                                                         $title, $message );
    }

}