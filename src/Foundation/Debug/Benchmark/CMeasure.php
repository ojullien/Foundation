<?php
namespace Foundation\Debug\Benchmark;
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
 * This class is a measure container for benchmark.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Benchmark
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CMeasure
{
    /** Constants */

    const DEFAULT_VALUE = NULL;
    const MAXTEST       = 1000;

    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @param string  $name Name of the container.
     * @param integer $size The size of the fixed array. This expects a number between 1 and PHP_INT_MAX.
     * @throws \Foundation\Exception\InvalidArgumentException
     */
    public function __construct( $name, $size = self::MAXTEST )
    {
        // Name
        $name = trim( $name );
        if( empty( $name ) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Bad name.' );
        }
        $this->_sName = $name;
        // Size
        if( !is_integer( $size ) || ($size < 1) || ($size > PHP_INT_MAX) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Bad size.' );
        }
        $this->_aTests = new \SplFixedArray( $size );
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset( $this->_aTests );
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

    /** Name section
     * ************* */

    /**
     * Name of the container.
     * @var string
     */
    private $_sName = '';

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->_sName;
    }

    /** Measure time section
     * ********************* */

    /**
     * Measure start time.
     * @var float
     */
    private $_fStart = self::DEFAULT_VALUE;

    /**
     * Set start time.
     *
     * @param float $fStart
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function setStart( $fStart )
    {
        if( !is_float( $fStart ) || ($fStart <= 0) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Bad start time.' );
        }
        $this->_fStart = $fStart;
    }

    /**
     * Measure end time.
     * @var float
     */
    private $_fEnd = self::DEFAULT_VALUE;

    /**
     * Set end time.
     *
     * @param float $fStart
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function setEnd( $fEnd )
    {
        if( !is_float( $fEnd ) || ($fEnd <= 0) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Bad end time.' );
        }
        $this->_fEnd = $fEnd;
    }

    /**
     * Get Measure duration.
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->_fEnd - $this->_fStart;
    }

    /** Measure section
     * **************** */

    /**
     * Maximum elapse time.
     * @var \SplFixedArray
     */
    private $_aTests = self::DEFAULT_VALUE;

    /**
     * Current index.
     * @var integer
     */
    private $_iIndex = 0;

    /**
     * Maximum elapse time.
     * @var float
     */
    private $_fMax = self::DEFAULT_VALUE;

    /**
     * Get max test value.
     *
     * @return float
     */
    public function getMax()
    {
        return $this->_fMax;
    }

    /**
     * Minimum elapse time.
     * @var float
     */
    private $_fMin = self::DEFAULT_VALUE;

    /**
     * Get min test value.
     *
     * @return float
     */
    public function getMin()
    {
        return $this->_fMin;
    }

    /**
     * Sum of each elapse times.
     * @var float
     */
    private $_fSum = 0.0;

    /**
     * Get average.
     *
     * @return float
     */
    public function getAverage()
    {
        return $this->_fSum / $this->_aTests->count();
    }

    /**
     * add measure test values.
     *
     * @param float $fTimeStart Test time start
     * @param float $fTimeStop  Test time end
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function add( $fTimeStart, $fTimeStop )
    {
        if( !is_float( $fTimeStart ) || !is_float( $fTimeStop ) || ($fTimeStart <= 0) || ($fTimeStop <= 0) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Bad time values.' );
        }

        // Difference of $fTimeStop and $fTimeStart
        $fDiff = $fTimeStop - $fTimeStart;

        // Save the difference
        $this->_aTests[$this->_iIndex++] = $fDiff;

        // Add
        $this->_fSum += $fDiff;

        if( is_null( $this->_fMin ) )
        {
            // First values
            $this->_fMin = $this->_fMax = $fDiff;
        }
        else
        {
            // Save the maximum
            if( $fDiff > $this->_fMax )
                $this->_fMax = $fDiff;
            // Save the minimum
            if( $fDiff < $this->_fMin )
                $this->_fMin = $fDiff;
        }//if( is_float(...
    }

}