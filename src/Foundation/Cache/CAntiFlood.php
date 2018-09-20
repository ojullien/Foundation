<?php
namespace Foundation\Cache;

/**
 * Foundation Framework
 *
 * @package   Cache
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * The class implements a strategy to prevent flooding using a cache.
 *
 * @category   Foundation
 * @package    Cache
 * @version    1.0.0
 * @since      1.0.0
 */
final class CAntiFlood
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
     * @param \Foundation\Cache\Storage\StorageInterface $pCache. Instance of cache storage adapter.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct(\Foundation\Cache\Storage\StorageInterface $pCache)
    {
        $this->_sDebugID = uniqid('cantiflood', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $pCache ]
                );

        $this->_pCache = $pCache;
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        $this->_pCache = null;
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

    /** Cache section
     * ************** */

    /**
     * Instance of a cache storage adapter.
     *
     * @var \Foundation\Cache\Storage\StorageInterface
     */
    private $_pCache = null;

    /** Lock section
     * ************* */

    /**
     * Lock entry label in the cache storage.
     *
     * @var string
     */
    private $_sLockEntryLabel = 'lock';

    /**
     * The number of seconds to sleep between two attempts to acquire the lock.
     *
     * @var integer
     */
    private $_iLockSleep = 1;

    /**
     * Number of attempts to acquire the lock.
     *
     * @var integer
     */
    private $_iLockRetry = 1;

    /**
     * Get the label for the lock entry in the cache storage.
     *
     * @return string
     */
    public function getLockEntryLabel()
    {
        return $this->_sLockEntryLabel;
    }

    /**
     * Set the label for the lock entry in the cache storage.
     *
     * @param string $sValue Label.
     * @return \Foundation\Cache\CAntiFlood
     * @throws \Foundation\Exception\InvalidArgumentException Returns an Invalid Argument Exception if the argument is
     *                                                        not valid.
     */
    public function setLockEntryLabel($sValue)
    {
        $sValue = ( is_string($sValue) ) ? trim($sValue) : '';

        if ('' == $sValue) {
            throw new \Foundation\Exception\InvalidArgumentException('The argument is not valid.');
        }

        $this->_sLockEntryLabel = $sValue;

        return $this;
    }

    /**
     * Set the number of seconds to sleep between two attempts to acquire the lock
     *
     * @param integer $iValue Number of seconds to sleep.
     * @return \Foundation\Cache\CAntiFlood
     * @throws \Foundation\Exception\InvalidArgumentException Returns an Invalid Argument Exception if the argument is
     *                                                        not valid.
     */
    public function setLockSleep($iValue)
    {
        if (! is_integer($iValue) || ( $iValue < 0 )) {
            throw new \Foundation\Exception\InvalidArgumentException('The argument is not valid.');
        }
        $this->_iLockSleep = $iValue;
        return $this;
    }

    /**
     * Set the number of attempts to acquire the lock.
     *
     * @param integer $iValue Number of attempts.
     * @return \Foundation\Cache\CAntiFlood
     * @throws \Foundation\Exception\InvalidArgumentException Returns an Invalid Argument Exception if the argument is
     *                                                        not valid.
     */
    public function setLockRetry($iValue)
    {
        if (! is_integer($iValue) || ( $iValue < 0 )) {
            throw new \Foundation\Exception\InvalidArgumentException('The argument is not valid.');
        }
        $this->_iLockRetry = $iValue;
        return $this;
    }

    /** Anti flood section
     * ******************* */

    /**
     * Event entry label in the cache storage.
     *
     * @var string
     */
    private $_sEventEntryLabel = 'lastevent';

    /**
     * Allowed flood lifetime in seconds.
     *
     * @var integer
     */
    private $_iEventLifeTime = 60;

    /**
     * The number of events allowed during the defined lifetime.
     *
     * @var integer
     */
    private $_iEventThreshold = 5;

    /**
     * Get the label of the event in the cache storage.
     *
     * @return string
     */
    public function getEventEntryLabel()
    {
        return $this->_sEventEntryLabel;
    }

    /**
     * Set the label of the event in the cache storage.
     *
     * @param string $sValue Label.
     * @return \Foundation\Cache\CAntiFlood
     * @throws \Foundation\Exception\InvalidArgumentException Returns an Invalid Argument Exception if the argument is
     *                                                        not valid.
     */
    public function setEventEntryLabel($sValue)
    {
        $sValue = ( is_string($sValue) ) ? trim($sValue) : '';

        if ('' == $sValue) {
            throw new \Foundation\Exception\InvalidArgumentException('The argument is not valid.');
        }

        $this->_sEventEntryLabel = $sValue;

        return $this;
    }

    /**
     * Set the flood lifetime in seconds.
     *
     * @param integer $iValue Lifetime in seconds (>=1).
     * @return \Foundation\Cache\CAntiFlood
     * @throws \Foundation\Exception\InvalidArgumentException Returns an Invalid Argument Exception if the argument is
     *                                                        not valid.
     */
    public function setEventLifeTime($iValue)
    {
        if (! is_integer($iValue) || ( $iValue < 1 )) {
            throw new \Foundation\Exception\InvalidArgumentException('The argument is not valid.');
        }
        $this->_iEventLifeTime = $iValue;
        return $this;
    }

    /**
     * Set the number of events allowed during the defined lifetime.
     *
     * @param integer $iValue Number of events (>=1).
     * @return \Foundation\Cache\CAntiFlood
     * @throws \Foundation\Exception\InvalidArgumentException Returns an Invalid Argument Exception if the argument is
     *                                                        not valid.
     */
    public function setEventThreshold($iValue)
    {
        if (! is_integer($iValue) || ( $iValue < 1 )) {
            throw new \Foundation\Exception\InvalidArgumentException('The argument is not valid.');
        }
        $this->_iEventThreshold = $iValue;
        return $this;
    }

    /**
     * Get the number of events allowed during the defined lifetime.
     *
     * @return integer
     */
    public function getEventThreshold()
    {
        return $this->_iEventThreshold;
    }

    /**
     * Prevent flooding.
     *
     * @return boolean Returns FALSE if no flooding has been detected, returns TRUE otherwise.
     */
    public function prevent()
    {
        // If the data are already locked, wait for the release.
        // Return TRUE if the data are never been released.
        $iBuffer = 0;
        while ($this->_pCache->exists($this->_sLockEntryLabel)) {
            if (++$iBuffer > $this->_iLockRetry) {
                return true;
            }
            sleep($this->_iLockSleep);
        }

        // Lock the data.
        $this->_pCache->store($this->_sLockEntryLabel, 'on');

        // Gets the data and analyses it to prevent flooding.
        // If no data are in the cache then stores new data and returns FALSE.
        // If data exists in the cache then analyses the lifetime.
        //    If last update is older than "EventLifeTime" seconds then replaces the data and returns FALSE.
        //    If last update is recent ( < "EventLifeTime" seconds ) then analyses the threshold .
        //       If the count is not greater than "EventThreshold" then updates the data and returns FALSE.
        //       If the count is greater than "EventThreshold" then returns TRUE.
        $bSuccess = false;
        $bReturn  = false;

        $aData = $this->_pCache->fetch($this->_sEventEntryLabel, $bSuccess);

        if (! $bSuccess || ( ( time() - $aData['time'] ) > $this->_iEventLifeTime )) {
            $this->_pCache->store(
                $this->_sEventEntryLabel,
                [
                'time'  => time(),
                'count' => 1 ]
            );
        } elseif ($aData['count'] < $this->_iEventThreshold) {
            $this->_pCache->store(
                $this->_sEventEntryLabel,
                [
                'time'  => $aData['time'],
                'count' => $aData['count'] + 1 ]
            );
        } else {
            $bReturn = true;
        }

        // Release the data
        $this->_pCache->delete($this->_sLockEntryLabel);

        return $bReturn;
    }
}
