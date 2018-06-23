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
 * Parent class for all storage adapters.
 *
 * @category   Foundation
 * @package    Cache
 * @subpackage Storage
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CStorageAbstract implements \Foundation\Cache\Storage\StorageInterface
{

    const NAMESPACE_SEPARATOR = '_';

    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    protected $_sDebugID = '';

    /**
     * Constructor.
     *
     * @param string  $sNamespace [OPTIONAL]. Namespace will be used to prefix the key.
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( $sNamespace = '' )
    {
        $this->_sDebugID = uniqid( 'cstorageabstract', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $sNamespace ] );

        $this->_sNamespace = ( is_string( $sNamespace ) ) ? trim( $sNamespace ) : '';
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        defined( 'FOUNDATION_DEBUG' ) && !defined( 'FOUNDATION_DEBUG_OFF' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete( $this->_sDebugID );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __set( $name, $value )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /** Adapter section
     * **************** */

    /**
     * Namespace.
     *
     * @var string
     */
    protected $_sNamespace = '';

}
