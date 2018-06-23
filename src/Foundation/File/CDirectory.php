<?php
namespace Foundation\File;
/**
 * Foundation Framework
 *
 * @package   File
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class offers a high-level object oriented interface to information and manipulation for an individual directory.
 *
 * @category   Foundation
 * @package    File
 * @version    1.0.0
 * @since      1.0.0
 */
final class CDirectory extends \SplFileInfo
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
     * @param \Foundation\Type\Complex\CPath $dirname Name of the directory. May contains path.
     * @throws \Foundation\Exception\InvalidArgumentException If the path is not valid.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct( \Foundation\Type\Complex\CPath $dirname )
    {
        //@codeCoverageIgnoreStart
        $this->_sDebugID = uniqid( 'cdirectory', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 [ $dirname ] );
        //@codeCoverageIgnoreEnd
        if( $dirname->isValid() )
        {
            parent::__construct( $dirname->getValue() );
        }
        else
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'The path is not valid.' );
        }
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
     * @param mixed $value
     * @codeCoverageIgnore
     */
    public function __set( $name, $value )
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
    public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /**
     * Reads data from variable. If the directory exists, this method expands all symbolic links, resolves relative
     * references and returns the real path to the directory.
     *
     * @return string
     * @codeCoverageIgnore
     */
    public function __toString()
    {
        $sReturn = $this->getRealPath();
        if( FALSE === $sReturn )
        {
            $sReturn = (string)$this->getPathname();
        }
        return $sReturn;
    }

    /** Directory section
     * ****************** */

    /**
     * Makes directory if not exists. Returns FALSE if the directory can not be created or if the directory exists
     * but is not writable. Returns TRUE on success.
     *
     * @return boolean
     */
    public function createDirectory()
    {
        $bReturn = FALSE;
        if( $this->isDir() )
        {
            $bReturn = $this->isWritable();
        }
        else
        {
            if( !$this->isFile() && !$this->isLink() )
            {
                $bReturn = mkdir( (string)$this, 0770, TRUE );
            }
        }
        return $bReturn;
    }

}