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
 * Cache storage using APC.
 *
 * @category   Foundation
 * @package    Cache
 * @subpackage Storage
 * @version    1.0.0
 * @since      1.0.0
 */
final class CApc extends \Foundation\Cache\Storage\CStorageAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @param string  $sNamespace [OPTIONAL]. Namespace will be used to prefix the key.
     * @throws \Exception If apc is not loaded
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $sNamespace = '' )
    {
        parent::__construct( $sNamespace );

        $bEnabled = ini_get( 'apc.enabled' );

        if( PHP_SAPI == 'cli' )
            $bEnabled = $bEnabled && (bool)ini_get( 'apc.enable_cli' );

        if( !$bEnabled )
            throw new \Exception( "ext/apc is disabled - see 'apc.enabled' and 'apc.enable_cli'" );
    }

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
    public function store( $key, $value, $ttl = 0 )
    {
        // Initialize
        $bReturn = FALSE;
        $key     = ( is_string( $key ) ) ? trim( $key ) : '';
        $ttl     = ( is_int( $ttl ) ) ? $ttl + 0 : 0;

        // Normalize the key and store the value into the cache.
        if( '' != $key )
        {
            $key = $this->_sNamespace . static::NAMESPACE_SEPARATOR . $key;

            $bReturn = apc_store( $key, $value, $ttl );
        }

        return $bReturn;
    }

    /** Reading section
     * **************** */

    /**
     * Checks if the key exists.
     *
     * @param string $key The key.
     * @return bool Returns TRUE if the key exists, otherwise FALSE.
     */
    public function exists( $key )
    {
        // Initialize
        $bReturn = FALSE;
        $key     = ( is_string( $key ) ) ? trim( $key ) : '';

        // Normalize the key then check if the key exists and is not expired.
        if( '' != $key )
        {
            $key = $this->_sNamespace . static::NAMESPACE_SEPARATOR . $key;

            $bReturn = apc_exists( $key );
        }

        return $bReturn;
    }

    /**
     * Fetchs a stored variable from the cache.
     *
     * @param string $key The key used to store the value ( with store() ).
     * @param bool   $success [OUT]. Set to TRUE in success and FALSE in failure.
     * @return mixed The stored variable on success; FALSE on failure.
     */
    public function fetch( $key, &$success )
    {
        // Initialize
        $bReturn = FALSE;
        $key     = ( is_string( $key ) ) ? trim( $key ) : '';
        $success = FALSE;

        // Normalize the key and get the data
        if( '' != $key )
        {
            $key = $this->_sNamespace . static::NAMESPACE_SEPARATOR . $key;

            $bReturn = apc_fetch( $key, $success );
        }

        return $bReturn;
    }

    /** Deleting section
     * ***************** */

    /**
     * Removes a stored variable from the cache.
     *
     * @param string $key The key used to store the value ( with store() ).
     * @return bool Returns TRUE on success or FALSE on failure.
     */
    public function delete( $key )
    {
        // Initialize
        $bReturn = FALSE;
        $key     = ( is_string( $key ) ) ? trim( $key ) : '';

        // Normalize the key and delete the data.
        if( '' != $key )
        {
            $key = $this->_sNamespace . static::NAMESPACE_SEPARATOR . $key;

            $bReturn = apc_delete( $key );
        }

        return $bReturn;
    }

}