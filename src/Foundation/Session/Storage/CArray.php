<?php
namespace Foundation\Session\Storage;
/**
 * Foundation Framework
 *
 * @package   Session
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Session storage in an array. The array is not saved at the end of the script.
 *
 * @category   Foundation
 * @package    Session
 * @subpackage Storage
 * @version    1.0.0
 * @since      1.0.0
 */
final class CArray implements \Foundation\Session\Storage\StorageInterface
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
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->_sDebugID = uniqid( 'carray', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__, [ ] );
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
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

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        return ( (strlen( $this->_sId ) > 0 ) ) ? serialize( $this->_Session ) : '';
    }

    /** Session section
     * **************** */

    /**
     * Session storage
     * @var array
     */
    private $_Session = [ ];

    /**
     * Session id
     * @var string
     */
    private $_sId = '';

    /**
     * Session name
     * @var string
     */
    private $_sName = 'PHPSESSID';

    /**
     * Writable state
     * @var boolean
     */
    private $_bClosed = TRUE;

    /**
     * Returns the current session status.
     *
     * @return int PHP_SESSION_DISABLED if sessions are disabled.
     *             PHP_SESSION_NONE if sessions are enabled, but none exists.
     *             PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
     */
    public function status()
    {
        return ( ( strlen( $this->_sId ) > 0 ) && !$this->_bClosed ) ? PHP_SESSION_ACTIVE : PHP_SESSION_NONE;
    }

    /**
     * Set the current session name.
     *
     * @param string $name The session name can't consist of digits only, at least one letter must be present. Otherwise
     * a new session id is generated every time.
     * @return string The old session name.
     * @throws \Foundation\Exception\BadMethodCallException   If the session is already started.
     * @throws \Foundation\Exception\InvalidArgumentException If the session name is not valid.
     */
    public function setName( $name )
    {
        // Cannot change the session name if the session is already started.
        if( strlen( $this->_sId ) > 0 )
            throw new \Foundation\Exception\BadMethodCallException( 'Cannot change the session name if the session is already started.' );

        // Check the type and the value of the new session name.
        $pValidator = new \Foundation\Type\Simple\CString( $name, array( '/^[a-z][a-z0-9]+$/i' ) );
        if( !$pValidator->isValid() )
            throw new \Foundation\Exception\InvalidArgumentException( 'The session name is not valid.' );

        // Set the session name.
        $sReturn      = $this->_sName;
        $this->_sName = $pValidator->getValue();
        unset( $pValidator );

        return $sReturn;
    }

    /**
     * Get the current session name.
     *
     * @return string The name of the current session.
     */
    public function getName()
    {
        return $this->_sName;
    }

    /**
     * Start new or resume existing session.
     *
     * @return boolean This function returns TRUE if a session was successfully started, otherwise FALSE.
     */
    public function start()
    {
        $this->_bClosed = FALSE;
        if( strlen( $this->_sId ) == 0 )
        {
            $this->_sId = uniqid();
        }
        return TRUE;
    }

    /**
     * Get the current session id.
     *
     * @return string Returns the session id for the current session or the empty string ("") if there is no current
     * session (no current session id exists).
     */
    public function id()
    {
        return $this->_sId;
    }

    /**
     * Update the current session id with a newly generated one. The current session id is replaced with a new one and
     * the current session information are kept.
     *
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function regenerateId()
    {
        $bReturn = FALSE;
        if( !headers_sent() && !$this->_bClosed )
        {
            $this->_sId = uniqid( 'new', TRUE );
            $bReturn    = TRUE;
        }
        return $bReturn;
    }

    /**
     * Free all session variables.
     *
     * @return void.
     */
    public function unsetSession()
    {
        if( !$this->_bClosed )
        {
            $this->_Session = [ ];
        }
    }

    /**
     * Write session data and end session.
     *
     * @return void.
     */
    public function writeAndClose()
    {
        $this->_bClosed = TRUE;
    }

    /**
     * Destroys all data registered to the session.
     *
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function destroy()
    {
        if( PHP_SESSION_ACTIVE == $this->status() )
        {
            $this->_bClosed = TRUE;
            $this->_sId     = '';
            $this->_Session = [ ];
            $bReturn        = TRUE;
        }
        else
        {
            $bReturn = FALSE;
        }
        return $bReturn;
    }

    /** Access section
     * *************** */

    /**
     * Checks if the offset is a valid type.
     * Checks if a container exists within the Storage object already. If not, one is created.
     *
     * @param string $offset    The offset.
     * @param string $container The name of the container.
     * @return bool Returns FALSE if one of the arguments, at least, is not valid.
     */
    private function verify( $offset, $container )
    {
        // Initialise
        static $sPattern = '/^[a-z][a-z0-9_\\\]+$/i';
        $bReturn  = FALSE;

        // Check offset
        if( is_string( $offset ) || is_int( $offset ) )
        {
            // Check container's name
            if( preg_match( $sPattern, $container ) === 1 )
            {
                if( !isset( $this->_Session[$container] ) )
                {
                    $this->_Session[$container] = [ ];
                }
                $bReturn = TRUE;
            }
        }

        return $bReturn;
    }

    /**
     * Assigns a value to the specified container and offset.
     *
     * @param string $offset    The offset to assign the value to.
     * @param mixed  $value     The value to set.
     * @param string $container The name of the container to assign the offset to.
     * @throws \Foundation\Exception\OutOfBoundsException If the name of the container is not valid.
     * @return void
     */
    public function setOffset( $offset, $value, $container = 'default' )
    {
        // Write only if session is active
        if( PHP_SESSION_ACTIVE == $this->status() )
        {
            if( $this->verify( $offset, $container ) )
            {
                $this->_Session[$container][$offset] = $value;
            }
            else
            {
                throw new \Foundation\Exception\OutOfBoundsException( 'The name of the container is not valid.' );
            }
        }
    }

    /**
     * Whether or not an offset exists.
     *
     * @param string $offset    The offset to check for.
     * @param string $container The name of the container which contains the offset to check for.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function existsOffset( $offset, $container = 'default' )
    {
        return ( (strlen( $this->_sId ) > 0) && $this->verify( $offset, $container ) ) ? isset( $this->_Session[$container][$offset] ) : FALSE;
    }

    /**
     * Unsets an offset.
     *
     * @param string $offset    The offset to unset.
     * @param string $container The name of the container which contains the offset to unset.
     * @return void
     */
    public function unsetOffset( $offset, $container = 'default' )
    {
        if( (PHP_SESSION_ACTIVE == $this->status()) && $this->verify( $offset, $container ) )
        {
            unset( $this->_Session[$container][$offset] );
        }//if(...
    }

    /**
     * Returns the value at specified offset.
     *
     * @param string $offset    The offset to retrieve.
     * @param string $container The name of the container which contains the offset to retrieve.
     * @return mixed Can return all value types.
     */
    public function getOffset( $offset, $container = 'default' )
    {
        if( (strlen( $this->_sId ) > 0) && $this->verify( $offset, $container ) )
        {
            $return = isset( $this->_Session[$container][$offset] ) ? $this->_Session[$container][$offset] : NULL;
        }
        else
        {
            $return = NULL;
        }
        return $return;
    }

}