<?php
namespace Foundation\Session\Config;

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

/**
 * Session cookie parameters and configuration.
 *
 * Default php option values to secure session:
 *  - Prevents javascript XSS attacks aimed to steal the session ID:
 *    session.cookie_httponly=on
 *  - Session ID cannot be passed through URLs:
 *    session.use_only_cookies=on
 *    session.use_trans_sid=off
 *  - Uses a secure connection (HTTPS) if possible
 *    session.cookie_secure=on
 *  - Adds entropy into the randomization of the session ID, as PHP's random number generator has some known flaws:
  session.entropy_file='/dev/urandom'
 *  - Uses a strong hash:
 *    session.hash_function='whirlpool'
 *
 * @category   Foundation
 * @package    Session
 * @subpackage Config
 * @version    1.0.0
 * @since      1.0.0
 */
final class CCookie
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
        $this->_sDebugID = uniqid('ccookie', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add($this->_sDebugID, __CLASS__, [ ]);
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     */
    public function __destruct()
    {
        defined('FOUNDATION_DEBUG') && ! defined('FOUNDATION_DEBUG_OFF') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete($this->_sDebugID);
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __set($name, $value)
    {
        throw new \Foundation\Exception\BadMethodCallException('Writing data to inaccessible properties is not allowed.');
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString()
    {
        return serialize(session_get_cookie_params());
    }

    /** session.use_cookies methods
     * **************************** */

    /**
     * Set a session cookie use parameter.
     *
     * @param string $option
     * @return boolean Returns TRUE on success, FALSE on failure.
     */
    private function setUse($option)
    {
        $option = ( is_string($option) ) ? trim($option) : '';
        if ('' != $option) {
            $option  = 'session.' . $option;
            $bReturn = (bool)ini_get($option);
            if (! $bReturn) {
                ini_set($option, true);
                $bReturn = (bool)ini_get($option);
            }
        } else {
            $bReturn = false;
        }
        return $bReturn;
    }

    /** session.cookie_lifetime methods
     * ******************************** */

    /**
     * Verify the session cookie lifetime parameter.
     *
     * @param integer $value Lifetime (relative to the server time) of the cookie in seconds. The value 0 means
     *                       "until the browser is closed."
     * @return mixed Returns the value on success, FALSE on failure.
     */
    private function verifyLifetime($value)
    {
        $value = ( is_numeric($value) ) ? $value + 0 : false;
        return ( is_integer($value) && ( $value >= 0 ) ? $value : false );
    }

    /** session.cookie_path methods
     * **************************** */

    /**
     * Verify the session cookie path parameter.
     *
     * @param string $value Path on the domain where the cookie will work.
     * @return mixed Returns the value on success, FALSE on failure.
     */
    private function verifyPath($value)
    {
        if (is_string($value)) {
            $value   = trim($value);
            $sReturn = parse_url($value, PHP_URL_PATH);
            if ($sReturn != $value) {
                $sReturn = false;
            }
        } else {
            $sReturn = false;
        }
        return $sReturn;
    }

    /** session.cookie_domain methods
     * ****************************** */

    /**
     * Verify the session cookie domain parameter.
     *
     * @param string $value Cookie domain, for example 'www.php.net'. To make cookies visible on all subdomains then the
     *                      domain must be prefixed with a dot like '.php.net'.
     * @return mixed Returns the value on success, FALSE on failure.
     */
    private function verifyDomain($value)
    {
        return ( is_string($value) ) ? trim($value) : false;
    }

    /** Cookie parameters methods
     * ************************** */

    /**
     * Get the session cookie parameters.
     *
     * Returns an array with the current session cookie information, the array contains the following items:
     * "lifetime" - The lifetime of the cookie in seconds.
     * "path" - The path where information is stored.
     * "domain" - The domain of the cookie.
     * "secure" - The cookie should only be sent over secure connections.
     * "httponly" - The cookie can only be accessed through the HTTP protocol.
     * @return array
     */
    public function getCookieParams()
    {
        return session_get_cookie_params();
    }

    /**
     * Set the session cookie parameters.
     *
     * @param array $parameters Session cookie parameters. The valid keys are:
     *               'lifetime' : INTEGER. Lifetime (relative to the server time) of the cookie in seconds which is sent
     *                            to the browser. The value 0 means "until the browser is closed."
     *                   'path' : STRING. Path on the domain where the cookie will work.
     *                 'domain' : STRING. Cookie domain, for example 'www.php.net'. To make cookies visible on all
     *                            subdomains then the domain must be prefixed with a dot like '.php.net'.
     *                 'secure' : BOOLEAN. If TRUE cookie will only be sent over secure connections.
     *               'httponly' : BOOLEAN. If set to TRUE then the cookie can only be accessed through the HTTP protocol.
     * @return void
     * @throws \Foundation\Exception\BadMethodCallException If the session is already started or if the session cookie cannot be initialized.
     * @throws \Foundation\Exception\DomainException If we could not use cookie and only cookie.
     * @throws \Foundation\Exception\InvalidArgumentException If an argument is not valid.
     */
    public function setCookieParams(array $parameters)
    {
        // Cannot change the cookie parameters if the session is already started.
        if (strlen(session_id()) > 0) {
            throw new \Foundation\Exception\BadMethodCallException('Cannot change the session cookie parameters if the session is already started.');
        }

        // For security issues we must use cookie and only cookie.
        if (! $this->setUse('use_cookies') || ! $this->setUse('use_only_cookies')) {
            throw new \Foundation\Exception\DomainException('Session cookie cannot be initialized.');
        }

        // Get the current session cookie parameters.
        $aCurrentParameters = session_get_cookie_params();

        // Cannot change the cookie lifetime parameter if the value is not valid.
        if (isset($parameters['lifetime'])) {
            $value = $this->verifyLifetime($parameters['lifetime']);
            if (! $value) {
                throw new \Foundation\Exception\InvalidArgumentException('session.cookie_lifetime is not valid.');
            }

            $aCurrentParameters['lifetime'] = $value;
        }

        // Cannot change the cookie path parameter if the value is not valid.
        if (isset($parameters['path'])) {
            $value = $this->verifyPath($parameters['path']);
            if (! $value) {
                throw new \Foundation\Exception\InvalidArgumentException('session.cookie_path is not valid.');
            }

            $aCurrentParameters['path'] = $value;
        }

        // Cannot change the cookie domain parameter if the value is not valid.
        if (isset($parameters['domain'])) {
            $value = $this->verifyDomain($parameters['domain']);
            if (! $value) {
                throw new \Foundation\Exception\InvalidArgumentException('session.cookie_domain is not valid.');
            }

            $aCurrentParameters['domain'] = $value;
        }

        // Cannot change the cookie secure parameter if the value is not valid.
        if (isset($parameters['secure'])) {
            $value = $parameters['secure'];
            if (! is_bool($value)) {
                throw new \Foundation\Exception\InvalidArgumentException('session.cookie_secure is not valid.');
            }

            $aCurrentParameters['secure'] = $value;
        }

        // Cannot change the cookie http only parameter if the value is not valid.
        if (isset($parameters['httponly'])) {
            $value = $parameters['httponly'];
            if (! is_bool($value)) {
                throw new \Foundation\Exception\InvalidArgumentException('session.cookie_httponly is not valid.');
            }

            $aCurrentParameters['httponly'] = $value;
        }

        // Set the session cookie parameters.
        session_set_cookie_params(
            $aCurrentParameters['lifetime'],
            $aCurrentParameters['path'],
            $aCurrentParameters['domain'],
            $aCurrentParameters['secure'],
            $aCurrentParameters['httponly']
        );
    }

    /**
     * Set the current session save path.
     *
     * @param string $path The path to which data is saved will be changed.
     * @return void
     * @throws \Foundation\Exception\BadMethodCallException If the session is already started.
     * @throws \Foundation\Exception\InvalidArgumentException If the session name is not valid.
     */
    public function setSavePath($path)
    {
        // Cannot change the session name if the session is already started.
        if (strlen(session_id()) > 0) {
            throw new \Foundation\Exception\BadMethodCallException('Cannot change the session data path if the session is already started.');
        }

        // Check the argument.
        $pValidator = new \Foundation\Type\Complex\CPath($path);
        $path       = $pValidator->getRealPath();
        unset($pValidator);
        if (! $path) {
            throw new \Foundation\Exception\InvalidArgumentException('The session data path is not valid.');
        }

        // Save the session data path.
        session_save_path($path);
    }

    /**
     * Get the current session save path.
     *
     * @return string Returns the path of the current directory used for data storage.
     */
    public function getSavePath()
    {
        return session_save_path();
    }
}
