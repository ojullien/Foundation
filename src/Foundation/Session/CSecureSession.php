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
 * This class implements usefull methods to determine if the current environment matches that which was expected.
 *
 * @category   Foundation
 * @package    Session
 * @version    1.0.0
 * @since      1.0.0
 */
final class CSecureSession
{
    /** Constants */

    const UID = 'remote_uid';

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
     * @param \Foundation\Session\Storage\StorageInterface $storage       An instance of a session storage.
     * @param \Foundation\Protocol\CRemoteAddress          $remoteAddress The client ip address.
     * @param string                                       $userAgent     The client's user agent
     * @throws \Foundation\Exception\InvalidArgumentException If the remote address $remoteAddress is not valid.
     *
     */
    public function __construct(
        \Foundation\Session\Storage\StorageInterface $storage,
        \Foundation\Protocol\CRemoteAddress $remoteAddress,
        $userAgent
    ) {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid('csecuresession', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $storage, $remoteAddress, $userAgent ]
                );
        //@codeCoverageIgnoreEnd
        // Check remote IP address
        if (! $remoteAddress->isValid()) {
            throw new \Foundation\Exception\InvalidArgumentException('The remote address is not valid.');
        }

        $remoteAddress = (string)$remoteAddress;

        // Check user agent
        if (is_string($userAgent)) {
            $userAgent = trim($userAgent);
        }
        if (! is_string($userAgent) || (0 == strlen($userAgent))) {
            $userAgent = 'UNKNOWN';
        }

        // Calculates a client hash based on few server and execution environment informations.
        // We use the hash for easy and fast comparaison.
        $this->_iCRC = crc32($remoteAddress . $userAgent);

        // Save parameters
        $this->_pStorage = $storage;
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

    /** Storage methods
     * **************** */

    /**
     * Instance of Storage object.
     * @var \Foundation\Session\Storage\StorageInterface
     */
    private $_pStorage = null;

    /** CRC methods
     * ************ */

    /**
     * CRC calculated from the current PHP environment.
     * @var array
     */
    private $_iCRC = null;

    /** container section
     * ****************** */

    /**
     * Saves a hash of the current server and execution environment informations into the session storage.
     *
     * @return void
     * @throws \Foundation\Exception\BadMethodCallException If the session is not started.
     */
    public function save()
    {
        // Session should be started
        if ($this->_pStorage->status() === PHP_SESSION_ACTIVE) {
            //  Get and save current UID
            $this->_pStorage->setOffset(self::UID, $this->_iCRC, APPLICATION_NAME);
        } else {
            throw new \Foundation\Exception\BadMethodCallException('The session was not successfully started.');
        }
    }

    /**
     * Returns TRUE if the current environment matches that which was store in the storage.
     *
     * @return boolean
     * @throws \Foundation\Exception\BadMethodCallException If the session is not started.
     */
    public function isValid()
    {
        // Initialize
        $bReturn = false;

        // Session should be started
        if (($this->_pStorage->status() == PHP_SESSION_ACTIVE )) {
            // Get stored UID
            $uidSaved = $this->_pStorage->getOffset(self::UID, APPLICATION_NAME);

            // Compare with the client uid
            $bReturn = ( $this->_iCRC == $uidSaved );
        } else {
            throw new \Foundation\Exception\BadMethodCallException('The session was not successfully started.');
        }//if(...

        return $bReturn;
    }

    /**
     * Whether or not the data exists in the storage.
     *
     * @return boolean
     * @throws \Foundation\Exception\BadMethodCallException If the session is not started.
     */
    public function exists()
    {
        // Initialize
        $bReturn = false;

        // Session should be started
        if (($this->_pStorage->status() == PHP_SESSION_ACTIVE )) {
            // Get stored UID
            $bReturn = $this->_pStorage->existsOffset(self::UID, APPLICATION_NAME);
        } else {
            throw new \Foundation\Exception\BadMethodCallException('The session was not successfully started.');
        }//if(...

        return $bReturn;
    }
}
