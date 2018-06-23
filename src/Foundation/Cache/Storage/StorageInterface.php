<?php
namespace Foundation\Cache\Storage;
/**
 * Foundation Framework
 *
 * @package   Cache
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Interface class for cache storage implementation.
 *
 * @category   Foundation
 * @package    Cache
 * @subpackage Storage
 * @version    1.0.0
 * @since      1.0.0
 */
interface StorageInterface
{
    /** Writing section
     * **************** */

    /**
     * Cache a variable in the data store.
     *
     * @param string  $key   Store the variable using this name. keys are cache-unique, so storing a second value with
     *                       the same key will overwrite the original value.
     * @param mixed   $value The variable to store.
     * @param integer $ttl   [OPTIONAL]. Time To Live; store var in the cache for ttl seconds. After the ttl has passed,
     *                       the stored variable will be expunged from the cache (on the next request). If no ttl is
     *                       supplied (or if the ttl is 0), the value will persist until it is removed from the cache
     *                       manually, or otherwise fails to exist in the cache (clear, restart, etc.).
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function store( $key, $value, $ttl = 0 );

    /** Reading section
     * **************** */

    /**
     * Checks if the key exists.
     *
     * @param string $key The key.
     * @return bool Returns TRUE if the key exists, otherwise FALSE.
     */
    public function exists( $key );

    /**
     * Fetchs a stored variable from the cache.
     *
     * @param string $key The key used to store the value ( with store() ).
     * @param bool   $success [OUT]. Set to TRUE in success and FALSE in failure.
     * @return mixed The stored variable on success; FALSE on failure.
     */
    public function fetch( $key, &$success );

    /** Deleting section
     * ***************** */

    /**
     * Removes a stored variable from the cache.
     *
     * @param string $key The key used to store the value ( with store() ).
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function delete( $key );
}
