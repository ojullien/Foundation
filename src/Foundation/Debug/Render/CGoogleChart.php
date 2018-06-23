<?php
namespace Foundation\Debug\Render;
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
 * This class implements usefull methods for debug rendering in google chart format.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Render
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CGoogleChart extends \Foundation\Debug\Render\CRenderAbstract
        implements \Foundation\Debug\Render\RenderInterface
{
    /** Rendering section
     * ****************** */

    /**
     * Returns the script execution time and the memory usage in human readable format.
     *
     * @param float   $fScriptDuration  Script duration in seconds, with microsecond's precision
     * @param integer $iMemoryPeakUsage Peak memory usage
     * @param integer $iMemoryUsage     Current memory usage
     * @return string
     */
    public function renderUsage( $fScriptDuration, $iMemoryPeakUsage, $iMemoryUsage )
    {
        // Build javascript
        $sReturn = 'var dataUsage=google.visualization.arrayToDataTable(['
                . '[\'Label\', \'Value\'],'
                . '[\'Duration\', ' . $this->convertToMSecond( $fScriptDuration ) . '],'
                . '[\'Peak\', ' . $this->convertToMByte( $iMemoryPeakUsage ) . '],'
                . '[\'Memory\', ' . $this->convertToMByte( $iMemoryUsage ) . '],'
                . ']);'
                . 'var optionsUsage={'
                . 'width:400,height:120,'
                . 'redFrom:90,redTo:100,'
                . 'yellowFrom:75,yellowTo:90,'
                . 'minorTicks:5};'
                . 'new google.visualization.Gauge(document.getElementById(\'chartUsage_div\'))'
                . '.draw(dataUsage,optionsUsage);' . PHP_EOL;
        return $sReturn . PHP_EOL;
    }

    /**
     * Rendering memory data.
     *
     * @param float  $fScriptDuration  Script duration in seconds, with microsecond's precision
     * @param array  $data             Contains memory data. Format:
     *                                                [$key] = array( 'class' => ...,
     *                                                                 'time' => array( 'start' => ..., 'end' => ...),
     *                                                           'memoryPeak' => array( 'start' => ..., 'end' => ...),
     *                                                               'memory' => array( 'start' => ..., 'end' => ...) );
     * @return string
     */
    public function renderMemory( $fScriptDuration, array $data )
    {
        // Build javascript
        $sReturn = 'var dataMemory=google.visualization.arrayToDataTable(['
                . '[\'Script\',0,0,' . $fScriptDuration . ',' . $fScriptDuration . ']';
        foreach( $data as $value )
        {
            $sReturn .= ',[\'' . htmlentities( $value['class'], ENT_QUOTES, 'UTF-8' ) . '\',';
            if( $value['time']['end'] > 0.0 )
            {
                $sReturn .= '0,' . $value['time']['start'] . ',' . $value['time']['end'] . ',' . $fScriptDuration . ']';
            }
            else
            {
                $sReturn .= $fScriptDuration . ',' . $fScriptDuration . ',' . $value['time']['start'] . ',0]';
            }
        }//Foreach(...
        $sReturn .= '], true);new google.visualization.CandlestickChart(document.getElementById(\'chartMemory_div\'))'
                . '.draw(dataMemory,{title: \'Memory\'});';
        return $sReturn;
    }

    /**
     * Returns superglobal variable data in human readable format.
     *
     * @param string $name Name of the superglobal variable
     * @param array  $data Contains data differencies. Format:
     *                     [$key] = array( 'status' => KEY_IDENTICAL | KEY_UPDATED | KEY_DELETED | KEY_ADDED
     *                                     'values' => array ( 'type' => VALUE_ARRAYS | VALUE_OTHERS,
     *                                                         'start' => ...,
     *                                                         'end' => ... ) );
     * @return string
     */
    public function renderVariable( $name, array $data )
    {
        return '';
    }

    /**
     * Rendering preconditions.
     *
     * @param  array $options [OPTIONAL] List of options. Not used.
     * @return string
     */
    public function renderPrecondition( array $options = array( ) )
    {
        $sReturn = '<div id="chartUsage_div"></div>' . PHP_EOL
                . '<div id="chartMemory_div"></div>' . PHP_EOL
                . '<script type="text/javascript" src="https://www.google.com/jsapi"></script>' . PHP_EOL
                . '<script type="text/javascript">' . PHP_EOL
                // Load the Visualization API and the packages.
                . 'google.load(\'visualization\', \'1.0\', {\'packages\':[\'corechart\',\'gauge\']});' . PHP_EOL
                // Set a callback to run when the Google Visualization API is loaded.
                . 'google.setOnLoadCallback(drawVisualization);' . PHP_EOL
                // Callback that creates and populates a data table,
                // instantiates the pie chart, passes in the data and
                // draws it.
                . 'function drawVisualization() {' . PHP_EOL;
        return $sReturn;
    }

    /**
     * Rendering postcondition.
     *
     * @return string
     */
    public function renderPostcondition()
    {
        return '}</script>' . PHP_EOL;
    }

    /**
     * Rendering sent headers.
     *
     * @param array $aHeaders Sent headers
     * @return string
     */
    public function renderHeader( array $aHeaders )
    {
        return '';
    }

    /**
     * Rendering session configuration.
     *
     * @return string
     */
    public function renderSessionConfiguration( )
    {
        return '';
    }
}