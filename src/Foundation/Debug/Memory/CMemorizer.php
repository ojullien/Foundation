<?php
namespace Foundation\Debug\Memory;
/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_NAME' ) )
    die( '-1' );

/**
 * This class implements methods for measuring memory allocation and deallocation.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Memory
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CMemorizer
{
    /** Constants */

    const DEFAULT_VALUE = NULL;

    /** Class management
     * ***************** */

    /**
     * Constructor.
     *
     * @param \Foundation\Debug\Timer\TimerInterface   $pTimeManager
     * @param \Foundation\Debug\Memory\MemoryInterface $pMemoryManager
     */
    public function __construct( \Foundation\Debug\Timer\TimerInterface $pTimeManager
    , \Foundation\Debug\Memory\MemoryInterface $pMemoryManager )
    {
        $this->_pTimeManager   = $pTimeManager;
        $this->_pMemoryManager = $pMemoryManager;
    }

    /**
     * Clone is not allowed
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
     * @param mixed $value
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

    /** Time manager
     * ************* */

    /**
     * Time manager
     * @var \Foundation\Debug\Timer\TimerInterface
     */
    private $_pTimeManager = self::DEFAULT_VALUE;

    /** Memory manager
     * *************** */

    /**
     * Memory manager
     * @var \Foundation\Debug\Memory\MemoryInterface
     */
    private $_pMemoryManager = self::DEFAULT_VALUE;

    /**
     * Returns the peak memory usage.
     *
     * @return integer
     */
    public function getMemoryPeakUsage()
    {
        $iReturn = 0;
        if( isset( $this->_pMemoryManager ) )
        {
            $iReturn = $this->_pMemoryManager->getMemoryPeakUsage();
        }
        return $iReturn;
    }

    /**
     * Returns the current memory usage.
     *
     * @return integer
     */
    public function getMemoryUsage()
    {
        $iReturn = 0;
        if( isset( $this->_pMemoryManager ) )
        {
            $iReturn = $this->_pMemoryManager->getMemoryUsage();
        }
        return $iReturn;
    }

    /** Stack management
     * ***************** */

    /**
     * Memory allocation stack
     * @var array
     */
    private $_aStack = array( );

    /**
     * Returns memory data
     *
     * @return array
     */
    public function getData()
    {
        return $this->_aStack;
    }

    /**
     * Add a memory allocation to the stack
     *
     * @param string $sId     Unique identifier
     * @param string $sClass  Class type
     * @param array  $aParams List of parameters
     * @throws \Foundation\Exception\InvalidArgumentException
     */
    public function add( $sId, $sClass, array $aParams )
    {
        // Get the current time since the starting of the script.
        $fTime = $this->_pTimeManager->getCurrentDuration();

        // Get the current memory
        $iMemoryPeak = $this->_pMemoryManager->getMemoryPeakUsage();
        $iMemory     = $this->_pMemoryManager->getMemoryUsage();

        // Check identifier
        $sId = (is_string( $sId )) ? trim( $sId ) : NULL;
        if( !isset( $sId ) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Unique identifier is not valid.' );
        }//if( !isset(...
        if( array_key_exists( $sId, $this->_aStack ) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Unique identifier already exists.' );
        }//if( array_key_exists(...
        // Check class name
        $sClass = (is_string( $sClass )) ? basename( trim( $sClass ) ) : NULL;
        if( !isset( $sClass ) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Class name is not valid.' );
        }//if( !isset(...
        // Check Parameters
        $sParameter = FALSE;
        foreach( $aParams as $param )
        {
            // Set separator
            if( FALSE === $sParameter )
            {
                $sParameter = '( ';
            }
            else
            {
                $sParameter .= ', ';
            }
            // Set value
            if( $param instanceof \Foundation\Type\CTypeAbstract )
            {
                $sParameter .= (string)$param;
            }
            elseif( is_scalar( $param ) )
            {
                $sParameter .= (string)$param;
            }
            elseif( 'object' == gettype( $param ) )
            {
                $sParameter .= basename( get_class( $param ) );
            }
            else
            {
                $sParameter .= gettype( $param );
            }//if(...
        }//foreach(...
        if( FALSE != $sParameter )
        {
            $sParameter .= ' )';
        }

        // Add to the stack
        $this->_aStack[$sId] = array( 'class'      => $sClass . $sParameter,
            'time'       => array( 'start' => $fTime, 'end'   => 0.0 ),
            'memoryPeak' => array( 'start' => $iMemoryPeak, 'end'   => 0 ),
            'memory'     => array( 'start' => $iMemory, 'end'   => 0 ) );
    }

    /**
     * Add a memory disalloction
     *
     * @param string $sId Unique identifier
     * @throws \Foundation\Exception\InvalidArgumentException
     */
    public function delete( $sId )
    {
        // Get the current time since the starting of the script.
        $fTime = $this->_pTimeManager->getCurrentDuration();

        // Get the current memory
        $iMemoryPeak = $this->_pMemoryManager->getMemoryPeakUsage();
        $iMemory     = $this->_pMemoryManager->getMemoryUsage();

        // Check identifier
        $sId = (is_string( $sId )) ? trim( $sId ) : NULL;
        if( !isset( $sId ) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Unique identifier is not valid.' );
        }//if( !isset(...

        if( array_key_exists( $sId, $this->_aStack ) )
        {
            // Update the stack
            $pId                      = &$this->_aStack[$sId];
            $pId['time']['end']       = $fTime;
            $pId['memory']['end']     = $iMemory;
            $pId['memoryPeak']['end'] = $iMemoryPeak;
        }
        else
        {
            // Add to the stack
            $this->_aStack[$sId] = array( 'class'      => 'UNKNOWN',
                'time'       => array( 'start' => NULL, 'end'   => $fTime ),
                'memoryPeak' => array( 'start' => 0, 'end'   => $iMemoryPeak ),
                'memory'     => array( 'start' => 0, 'end'   => $iMemory ) );
        }
    }

}