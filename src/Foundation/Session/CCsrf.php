<?php
namespace Foundation\Session;

/**
 * Foundation Framework
 *
 * @package   Session
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_NAME')) {
    die('-1');
}

/**
 * This class implements usefull methods to protect against a cross-site request forgery attack.
 *
 * @category   Foundation
 * @package    Session
 * @version    1.0.0
 * @since      1.0.0
 */
final class CCsrf
{
    /** Constants */

    const UID = 'csrf_token';

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
     * @param \Foundation\Session\Storage\StorageInterface $storage An instance of a session storage.
     * @codeCoverageIgnore
     */
    public function __construct(\Foundation\Session\Storage\StorageInterface $storage)
    {
        $this->_sDebugID = uniqid('csrf', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $storage ]
                );

        // Save the storage
        $this->_pStorage = $storage;

        // Generate new token value
        $this->_sToken = md5(uniqid(rand(), true));
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     */
    public function __destruct()
    {
        $this->_pStorage = null;
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
        return $this->_sToken;
    }

    /** Storage section
     * **************** */

    /**
     * Instance of Storage object.
     * @var \Foundation\Session\Storage\StorageInterface
     */
    private $_pStorage = null;

    /** Token section
     * ************** */

    /**
     * Token value
     * @var string
     */
    private $_sToken = '';

    /**
     * Reads current token value.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->_sToken;
    }

    /** Container section
     * ****************** */

    /**
     * Saves current auto generated token value into the session storage.
     *
     * @return void
     * @throws \Foundation\Exception\BadMethodCallException If the session is not started.
     */
    public function save()
    {
        // Session should be started
        if ($this->_pStorage->status() === PHP_SESSION_ACTIVE) {
            //  Get and save current UID
            $this->_pStorage->setOffset(self::UID, $this->_sToken, APPLICATION_NAME);
        } else {
            throw new \Foundation\Exception\BadMethodCallException('The session was not successfully started.');
        }
    }

    /**
     * Returns TRUE if the vlaue of $token matches that which was store in the storage.
     * @param string $token
     * @return boolean
     * @throws \LogicException If the session is not started.
     */
    public function isValid($token)
    {
        // Initialize
        $bReturn  = false;
        static $sPattern = '/^[a-fA-F0-9]{32}+$/';

        // Session should be started
        if (($this->_pStorage->status() == PHP_SESSION_ACTIVE )) {
            // Filter the argument
            $pValidator = new \Foundation\Type\Simple\CString($token, [ $sPattern ]);
            if ($pValidator->isValid()) {
                // Get stored token
                $sStoredToken = $this->_pStorage->getOffset(self::UID, APPLICATION_NAME);

                // Compare
                $bReturn = ( $pValidator->getValue() == $sStoredToken );
            }
            unset($pValidator);
        } else {
            throw new \Foundation\Exception\BadMethodCallException('The session was not successfully started.');
        }//if(...

        return $bReturn;
    }
}
