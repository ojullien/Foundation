<?php
namespace Foundation\Debug\Memory;
/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <olivier.jullien@netcourrier.com>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class implements methods for measuring memory usage using PHP core functions.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Memory
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CCore implements \Foundation\Debug\Memory\MemoryInterface
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @throws \RuntimeException if the memory functions are not accessible.
     */
    public function __construct()
    {
        if( !function_exists( 'memory_get_peak_usage' ) || !function_exists( 'memory_get_usage' ) )
        {
            throw new \RuntimeException( 'Memory functions are not accessible.' );
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
     * Returns the peak of memory, in bytes, that's been allocated to your PHP script.
     *
     * @return integer
     */
    public function getMemoryPeakUsage()
    {
        return @memory_get_peak_usage();
    }

    /**
     * Returns the amount of memory, in bytes, that's currently being allocated to your PHP script.
     *
     * @return integer
     */
    public function getMemoryUsage()
    {
        return @memory_get_usage();
    }

}