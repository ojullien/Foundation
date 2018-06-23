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
 * Representation of an error message.
 *
 * @category   Foundation
 * @package    Log
 * @version    1.0.0
 * @since      1.0.0
 */
final class CMessage
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
     * @param \Foundation\Type\Enum\CSeverity $severity Severity level.
     * @param array                           $aServer  Server data.
     * @param array                           $aSession Session data.
     * @throws \Foundation\Exception\InvalidArgumentException If an argument is not valid.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( \Foundation\Type\Enum\CSeverity $severity, array $aServer = [ ], array $aSession = [ ] )
    {
        $this->_sDebugID = uniqid( 'cmessage', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $severity, $aServer, $aSession ] );

        // Creates default.
        $this->_aServer        = $aServer;
        $this->_aSession       = $aSession;
        $this->_dateTime       = new \DateTime( 'now' );
        $this->_sModule        = APPLICATION_NAME . '-' . APPLICATION_VERSION;
        $this->_eSeverity      = $severity;
        $this->_sUser          = 'visitor';
        $this->_pRemoteAddress = new \Foundation\Protocol\CRemoteAddress( $aServer );
        $this->_sTitle         = 'Error';
        $this->_sMessage       = 'Unexpected error.';
    }

    /**
     * Destructor
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        unset( $this->_dateTime, $this->_eSeverity, $this->_pRemoteAddress );
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

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        $sReturn = 'Server time: ' . $this->_dateTime->format( 'D M d G:i:s Y' )
                . ', Module: ' . $this->_sModule
                . ', Severity: ' . (string)$this->_eSeverity
                . ', User: ' . $this->_sUser
                . ', Remote address: ' . (string)$this->_pRemoteAddress
                . ', Message: ' . $this->_sMessage
                . ', Request URI: ';
        if( isset( $this->_aServer['REQUEST_URI'] ) || array_key_exists( 'REQUEST_URI', $this->_aServer ) )
        {
            $sReturn .= $this->_aServer['REQUEST_URI'];
        }
        $sReturn .= ', Requested with: ';
        if( isset( $this->_aServer['HTTP_X_REQUESTED_WITH'] ) || array_key_exists( 'HTTP_X_REQUESTED_WITH', $this->_aServer ) )
        {
            $sReturn .= $this->_aServer['HTTP_X_REQUESTED_WITH'];
        }
        $sReturn .= ', User agent: ';
        if( isset( $this->_aServer['HTTP_USER_AGENT'] ) || array_key_exists( 'HTTP_USER_AGENT', $this->_aServer ) )
        {
            $sReturn .= $this->_aServer['HTTP_USER_AGENT'];
        }
        $sReturn .= ', Referer: ';
        if( isset( $this->_aServer['HTTP_REFERER'] ) || array_key_exists( 'HTTP_REFERER', $this->_aServer ) )
        {
            $sReturn .= $this->_aServer['HTTP_REFERER'];
        }
        $sReturn .= ', Session data: ';
        if( count( $this->_aSession ) > 0 )
        {
            $sReturn .= print_r( $this->_aSession, TRUE );
        }
        return $sReturn;
    }

    /** Message section
     * **************** */

    /**
     * Server
     * @var array
     */
    private $_aServer = NULL;

    /**
     * Session
     * @var array
     */
    private $_aSession = NULL;

    /**
     * Date and time of the message.
     * @var \DateTime
     */
    private $_dateTime = NULL;

    /**
     * Module producing the message.
     * @var string
     */
    private $_sModule = '';

    /**
     * Severity level of the message.
     * @var \Foundation\Type\Enum\CSeverity
     */
    private $_eSeverity = NULL;

    /**
     * Name of the logged user that experienced the condition.
     * @var string
     */
    private $_sUser = '';

    /**
     * Client address that made the request.
     * @var \Foundation\Protocol\CRemoteAddress
     */
    private $_pRemoteAddress = NULL;

    /**
     * Short message.
     * @var string
     */
    private $_sTitle = '';

    /**
     * Detailed message.
     * @var string
     */
    private $_sMessage = '';

    /**
     * Gets the Server data.
     *
     * @return array
     */
    public function getServer()
    {
        return $this->_aServer;
    }

    /**
     * Gets the sesssion data.
     *
     * @return array
     */
    public function getSession()
    {
        return $this->_aSession;
    }

    /**
     * Gets the date and time of the message.
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->_dateTime;
    }

    /**
     * Sets the date and time of the message.
     *
     * @param \DateTime $dateTime
     * @return \Foundation\Log\CMessage
     */
    public function setDateTime( \DateTime $dateTime )
    {
        $this->_dateTime = $dateTime;
        return $this;
    }

    /**
     * Gets the module producing the message.
     *
     * @return string
     */
    public function getModule()
    {
        return $this->_sModule;
    }

    /**
     * Sets the module producing the message.
     *
     * @param string $sModule
     * @return \Foundation\Log\CMessage
     */
    public function setModule( $sModule )
    {
        $this->_sModule = ( is_string( $sModule ) ) ? trim( $sModule ) : '';
        return $this;
    }

    /**
     * Gets the severity level of the message.
     *
     * @return string
     */
    public function getSeverity()
    {
        return (string)$this->_eSeverity;
    }

    /**
     * Sets the severity level of the message.
     *
     * @param \Foundation\Type\Enum\CSeverity $enumSeverity
     * @return \Foundation\Log\CMessage
     */
    public function setSeverity( \Foundation\Type\Enum\CSeverity $enumSeverity )
    {
        $this->_eSeverity = $enumSeverity;
        return $this;
    }

    /**
     * Gets the name of the logged user that experienced the condition.
     *
     * @return string
     */
    public function getUser()
    {
        return $this->_sUser;
    }

    /**
     * Sets the name of the logged user that experienced the condition.
     *
     * @param string $sUser
     * @return \Foundation\Log\CMessage
     */
    public function setUser( $sUser )
    {
        $this->_sUser = ( is_string( $sUser ) ) ? trim( $sUser ) : '';
        return $this;
    }

    /**
     * Gets the client address that made the request.
     *
     * @return string
     */
    public function getRemoteAddress()
    {
        return (string)$this->_pRemoteAddress;
    }

    /**
     * Sets the client address that made the request.
     *
     * @param \Foundation\Protocol\CRemoteAddress $pRemoteAddress
     * @return \Foundation\Log\CMessage
     */
    public function setRemoteAddress( \Foundation\Protocol\CRemoteAddress $pRemoteAddress )
    {
        if( $pRemoteAddress->isValid() )
            $this->_pRemoteAddress = $pRemoteAddress;

        return $this;
    }

    /**
     * Gets the short message.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_sTitle;
    }

    /**
     * Sets the short message.
     *
     * @param string $sTitle
     * @return \Foundation\Log\CMessage
     */
    public function setTitle( $sTitle )
    {
        $this->_sTitle = ( is_string( $sTitle ) ) ? trim( $sTitle ) : '';
        return $this;
    }

    /**
     * Gets the detailed error message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->_sMessage;
    }

    /**
     * Sets the detailed error message.
     *
     * @param string $sMessage
     * @return \Foundation\Log\CMessage
     */
    public function setMessage( $sMessage )
    {
        $this->_sMessage = ( is_string( $sMessage ) ) ? trim( $sMessage ) : '';
        return $this;
    }

}