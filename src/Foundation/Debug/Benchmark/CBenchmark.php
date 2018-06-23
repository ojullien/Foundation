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
 * This class implements usefull methods for benchmarking.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Benchmark
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CBenchmark
{
    /** Constants */

    const MAXTEST = 1000;

    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @param string  $name Name of the bench.
     * @param array  $options [OPTIONAL] An array defining the options. $options[0] specifies the pattern the value
     *                        should match.
     * @throws \Foundation\Exception\InvalidArgumentException
     */
    public function __construct( $name, array $options = NULL )
    {
        // Name
        if( !is_scalar( $name ) )
        {
            throw new \Foundation\Exception\InvalidArgumentException( 'Bad name.' );
        }//if( !is_scalar...
        if( is_null( $name ) )
        {
            $name = 'NULL';
        }
        elseif( strlen( $name ) == 0 )
        {
            $name = 'EMPTY';
        }
        else
        {
            $this->_sName = trim( $name );
        }

        // Options
        if( is_array( $options ) )
        {
            // Display round ajust
            if( isset( $options[0] ) )
            {
                if( is_int( $options[0] ) && ($options[0] > 0) )
                {
                    $this->_aOptions[0] = $options[0];
                }
                else
                {
                    throw new \Foundation\Exception\InvalidArgumentException( 'Bad option.' );
                }//if( is_int(...
            }//if( isset(...
            // Display round precision
            if( isset( $options[1] ) )
            {
                if( is_int( $options[1] ) )
                {
                    $this->_aOptions[1] = $options[1];
                }
                else
                {
                    throw new \Foundation\Exception\InvalidArgumentException( 'Bad option.' );
                }//if( is_int(...
            }//if( isset(...
        }//if( is_array(...
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

    /** Bench section
     * ************** */

    /**
     * Options.
     * @var array
     */
    private $_aOptions = array( 1000, 8 );

    /**
     * Name of the bench.
     * @var string
     */
    private $_sName = '';

    /**
     * Measures.
     * @var array Of \Foundation\Debug\Benchmark\CMeasure
     */
    private $_aMeasures = array( );

    /**
     * Minimum average.
     * @var float
     */
    private $_fMin = NULL;

    /**
     * Maximum average.
     * @var float
     */
    private $_fMax = NULL;

    /**
     * Add a measure.
     *
     * @param \Foundation\Debug\Benchmark\CMeasure $pMeasure Measure to bench.
     */
    public function addMeasure( \Foundation\Debug\Benchmark\CMeasure $pMeasure )
    {
        $fAverage = $pMeasure->getAverage();
        if( NULL === $this->_fMax )
        {
            $this->_fMax = $this->_fMin = $fAverage;
        }
        else
        {
            if( $fAverage > $this->_fMax )
                $this->_fMax        = $fAverage;
            if( $fAverage < $this->_fMin )
                $this->_fMin        = $fAverage;
        }
        $this->_aMeasures[] = $pMeasure;
    }

    /**
     * Benchmark.
     *
     * @return string
     */
    public function render()
    {
        // Initialize
        $fRoundedMin = round( $this->_fMin * $this->_aOptions[0], $this->_aOptions[1] );

        // Header
        $sHeader = '<table class="table table-bordered">'
                . '<caption>"' . htmlentities( $this->_sName, ENT_QUOTES, 'UTF-8' ) . '"</caption>'
                . '<thead class="label label-inverse"><tr><th></th>';

        // Body
        $sAverage = '<tr><td>AVERAGE</td>';
        $sMin     = '</tr><tr><td>MIN</td>';
        $sMax     = '</tr><tr><td>MAX</td>';

        foreach( $this->_aMeasures as $pMeasure )
        {
            // Initialize
            $fAverage = $pMeasure->getAverage();

            // Header
            $sHeader .= '<th>' . $pMeasure->getName() . '</th>';

            // Average
            if( $fAverage == $this->_fMin )
            {
                $sClass = ' class="label label-success"';
            }
            elseif( $fAverage == $this->_fMax )
            {
                $sClass = ' class="label label-important"';
            }
            else
            {
                $sClass = '';
            }

            $fRoundedAverage = round( $fAverage * $this->_aOptions[0], $this->_aOptions[1] );
            $fGap            = $fRoundedAverage - $fRoundedMin;
            $sAverage .= '<td' . $sClass . '>' . $fRoundedAverage . ' (+' . $fGap . ')</td>';

            // Min
            $sMin .= '<td>' . round( $pMeasure->getMin() * $this->_aOptions[0], $this->_aOptions[1] ) . '</td>';

            // Max
            $sMax .= '<td>' . round( $pMeasure->getMax() * $this->_aOptions[0], $this->_aOptions[1] ) . '</td>';
        }//foreach(...

        return $sHeader . '</tr></thead><tbody>' . $sAverage . $sMin . $sMax . '</tr></tbody></table>';
    }

}