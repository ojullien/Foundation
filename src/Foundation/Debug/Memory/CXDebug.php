<?php
namespace Foundation\Debug\Memory;
/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements methods for measuring memory usage using XDebug functions.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Memory
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CXDebug implements \Foundation\Debug\Memory\MemoryInterface
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @throws \RuntimeException if XDebug is not loaded.
     */
    public function __construct()
    {
        if( !function_exists( 'xdebug_memory_usage' ) || !function_exists( 'xdebug_peak_memory_usage' ) )
        {
            throw new \RuntimeException( 'XDebug is not loaded.' );
        }
    }

    /**
     * Clone is not allowed.
     *
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __clone()
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Cloning is not allowed.' );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __set( $name, $value )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @codeCoverageIgnore
     */
    public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /** Memory section
     * *************** */

    /**
     * Returns the maximum amount of memory, in bytes, the script used until now.
     *
     * @return integer
     */
    public function getMemoryPeakUsage()
    {
        return xdebug_peak_memory_usage();
    }

    /**
     * Returns the current amount of memory, in bytes, the script uses.
     *
     * @return integer
     */
    public function getMemoryUsage()
    {
        return xdebug_memory_usage();
    }

}