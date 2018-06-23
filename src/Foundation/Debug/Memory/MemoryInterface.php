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
 * Interface class for debug memory measure implementation.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Memory
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
interface MemoryInterface
{

    /**
     * Returns the peak memory usage.
     *
     * @return integer
     */
    public function getMemoryPeakUsage();

    /**
     * Returns the current memory usage.
     *
     * @return integer
     */
    public function getMemoryUsage();
}