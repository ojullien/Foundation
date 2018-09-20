<?php
namespace Foundation\Debug\Timer;

/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

/**
 * Interface class for debug timer implementation.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Timer
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
interface TimerInterface
{

    /**
     * Returns the current time index since the starting of the script in seconds.
     *
     * @return float
     */
    public function getCurrentDuration();

    /**
     * Timestamp of the end of the script.
     * Returns the script duration in seconds, with microsecond's precision.
     *
     * @return float
     */
    public function stopTime();

    /**
     * Returns the script duration in seconds, with microsecond's precision.
     *
     * @return float
     */
    public function getScriptDuration();
}
