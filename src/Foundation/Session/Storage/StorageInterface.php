<?php
namespace Foundation\Session\Storage;

/**
 * Foundation Framework
 *
 * @package   Session
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

// Define Predefined Constants
//defined( 'PHP_SESSION_DISABLED' ) || define( 'PHP_SESSION_DISABLED', 0 );
//defined( 'PHP_SESSION_NONE' ) || define( 'PHP_SESSION_NONE', 1 );
//defined( 'PHP_SESSION_ACTIVE' ) || define( 'PHP_SESSION_ACTIVE', 2 );

/**
 * Interface class for session storage implementation.
 *
 * @category   Foundation
 * @package    Session
 * @subpackage Storage
 * @version    1.0.0
 * @since      1.0.0
 */
interface StorageInterface
{

    /**
     * Returns the current session status.
     *
     * @return int PHP_SESSION_DISABLED if sessions are disabled.
     *             PHP_SESSION_NONE if sessions are enabled, but none exists.
     *             PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
     */
    public function status();

    /**
     * Set the current session name.
     *
     * @param string $name The session name can't consist of digits only, at least one letter must be present. Otherwise
     * a new session id is generated every time.
     * @return string Returns the old session name.
     * @throws \Foundation\Exception\BadMethodCallException   If the session is already started.
     * @throws \Foundation\Exception\InvalidArgumentException If the session name is not valid.
     */
    public function setName($name);

    /**
     * Get the current session name.
     *
     * @return string The name of the current session.
     */
    public function getName();

    /**
     * Start new or resume existing session.
     *
     * @return boolean This function returns TRUE if a session was successfully started, otherwise FALSE.
     */
    public function start();

    /**
     * Get the current session id.
     *
     * @return string Returns the session id for the current session or the empty string ("") if there is no current
     * session (no current session id exists).
     */
    public function id();

    /**
     * Update the current session id with a newly generated one. The current session id is replaced with a new one and
     * the current session information are kept.
     *
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function regenerateId();

    /**
     * Free all session variables.
     *
     * @return void.
     */
    public function unsetSession();

    /**
     * Write session data and end session.
     *
     * @return void.
     */
    public function writeAndClose();

    /**
     * Destroys all data registered to the session.
     *
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function destroy();

    /**
     * Assigns a value to the specified container and offset.
     *
     * @param string $offset    The offset to assign the value to.
     * @param mixed  $value     The value to set.
     * @param string $container The name of the container to assign the offset to.
     * @throws \Foundation\Exception\OutOfBoundsException If the name of the container is not valid.
     * @return void
     */
    public function setOffset($offset, $value, $container = 'default');

    /**
     * Whether or not an offset exists.
     *
     * @param string $offset    The offset to check for.
     * @param string $container The name of the container which contains the offset to check for.
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function existsOffset($offset, $container = 'default');

    /**
     * Unsets an offset.
     *
     * @param string $offset    The offset to unset.
     * @param string $container The name of the container which contains the offset to unset.
     * @return void
     */
    public function unsetOffset($offset, $container = 'default');

    /**
     * Returns the value at specified offset.
     *
     * @param string $offset    The offset to retrieve.
     * @param string $container The name of the container which contains the offset to retrieve.
     * @return mixed Can return all value types.
     */
    public function getOffset($offset, $container = 'default');
}
