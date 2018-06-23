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
 * This class implements usefull methods for debug rendering in html format.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Render
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
final class CHtml extends \Foundation\Debug\Render\CRenderAbstract implements \Foundation\Debug\Render\RenderInterface
{

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
        $sReturn = '<table class="table table-striped table-bordered"><caption>SCRIPT</caption>'
                . '<thead><tr><th>DURATION</th><th>MEMORY PEAK</th><th>MEMORY</th></tr></thead>'
                . '<tbody><tr><td>' . $this->convertToMSecond( $fScriptDuration, 2, self::UNIT ) . '</td>'
                . '<td>' . $this->convertToMByte( $iMemoryPeakUsage, 2, self::UNIT ) . '</td>'
                . '<td>' . $this->convertToMByte( $iMemoryUsage, 2, self::UNIT ) . '</td></tr></tbody>'
                . '</table>';
        return $sReturn . PHP_EOL;
    }

    /**
     * Formates value.
     *
     * @param mixed $mixed
     * @return string
     */
    private function format( $mixed )
    {
        if( is_object( $mixed ) )
        {
            if( method_exists( $mixed, 'getArrayCopy' ) )
            {
                $mixed = $mixed->getArrayCopy();
            }
            else
            {
                $mixed = serialize( $mixed );
            }
        }

        if( is_array( $mixed ) )
        {
            $sReturn = htmlentities( print_r( $mixed, true ), ENT_QUOTES, 'UTF-8' );
        }
        else
        {
            $mixed   = (is_null( $mixed )) ? 'NULL' : trim( $mixed );
            $sReturn = htmlentities( $mixed, ENT_QUOTES, 'UTF-8' );
        }
        return $sReturn;
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
        $sReturn = '<table class="table table-striped table-bordered"><caption>MEMORY</caption>'
                . '<thead><tr><th>&nbsp;</th>'
                . '<th colspan="3">DURATION</th>'
                . '<th colspan="3">MEMORY PEAK</th>'
                . '<th colspan="3">MEMORY</th></tr>'
                . '<tr><th>CLASS</th>'
                . '<th>START</th><th>END</th><th>DURATION</th>'
                . '<th>START</th><th>END</th><th>DIFF</th>'
                . '<th>START</th><th>END</th><th>DIFF</th></tr></thead><tbody>';
        foreach( $data as $value )
        {
            $sReturn .= '<tr ' . (($value['time']['end'] > 0.0) ? '' : ' class="text-error"') . '>';
            // Class
            $sReturn .= '<td>' . htmlentities( $value['class'], ENT_QUOTES, 'UTF-8' ) . '</td>';
            // Duration
            $sReturn .= '<td>' . $this->convertToMSecond( $value['time']['start'], 2, self::UNIT ) . '</td><td>';
            if( $value['time']['end'] > 0.0 )
            {
                $sReturn .= $this->convertToMSecond( $value['time']['end'], 2, self::UNIT ) . '</td><td>~'
                        . $this->convertToMSecond( $value['time']['end'] - $value['time']['start'], 2, self::UNIT ) . '</td>';
            }
            else
            {
                $sReturn .= 'never deleted</td><td>'
                        . $this->convertToMSecond( $fScriptDuration, 2, self::UNIT ) . '</td>';
            }
            // Memory peak
            $sReturn .= '<td>' . $this->convertToMByte( $value['memoryPeak']['start'], 2, self::UNIT ) . '</td>'
                    . '<td>' . $this->convertToMByte( $value['memoryPeak']['end'], 2, self::UNIT ) . '</td>'
                    . '<td>' . $this->convertToMByte( $value['memoryPeak']['end'] - $value['memoryPeak']['start']
                            , 2, self::UNIT )
                    . '</td>'
                    // Memory
                    . '<td>' . $this->convertToMByte( $value['memory']['start'], 2, self::UNIT ) . '</td>'
                    . '<td>' . $this->convertToMByte( $value['memory']['end'], 2, self::UNIT ) . '</td>'
                    . '<td>' . $this->convertToMByte( $value['memory']['end'] - $value['memory']['start']
                            , 2, self::UNIT )
                    . '</td></tr>';
        }
        $sReturn .='</tbody></table>';
        return $sReturn . PHP_EOL;
    }

    /**
     * Parses and renders an array content, in human readable format.
     *
     * @param array $data Contains data differencies. Format:
     *                    [$key] = array( 'status' => KEY_IDENTICAL | KEY_UPDATED | KEY_DELETED | KEY_ADDED
     *                                    'values' => array ( 'type' => VALUE_ARRAYS | VALUE_OTHERS,
     *                                                        'start' => ...,
     *                                                        'end' => ... ) );
     * @return string
     */
    private function parse( array $data )
    {
        // Constants
        $aStatus                                                       = array( );
        $aStatus[\Foundation\Debug\Variable\CContainer::KEY_IDENTICAL] = array( 'status' => 'identical', 'class'  => 'info' );
        $aStatus[\Foundation\Debug\Variable\CContainer::KEY_UPDATED]   = array( 'status' => 'updated', 'class'  => 'warning' );
        $aStatus[\Foundation\Debug\Variable\CContainer::KEY_DELETED]   = array( 'status' => 'deleted', 'class'  => 'error' );
        $aStatus[\Foundation\Debug\Variable\CContainer::KEY_ADDED]     = array( 'status' => 'added', 'class'  => 'success' );
        $sReturn                                                       = '<thead><tr><th>KEY</th><th>STATUS</th><th>START</th><th>END</th></tr></thead>'
                . '<tbody>';
        foreach( $data as $key => $value )
        {
            if( $key === 0 )
                continue;
            $sReturn .= '<tr class ="' . $aStatus[$value['status']]['class'] . '" >'
                    //$sReturn .= '<tr>'
                    . '<td>' . htmlentities( $key, ENT_QUOTES, 'UTF-8' ) . '</td>'
                    . '<td class ="' . $aStatus[$value['status']]['class'] . '" >' . $aStatus[$value['status']]['status'] . '</td>';
            if( $value['status'] == \Foundation\Debug\Variable\CContainer::KEY_IDENTICAL )
            {
                // Identical
                $sReturn .= '<td colspan="2">' . $this->format( $value['values']['start'] ) . '</td>';
            }
            else
            {
                // Updated or deleted or added
                if( $value['values']['type'] == \Foundation\Debug\Variable\CContainer::VALUE_OTHERS )
                {
                    // Scalar
                    $sReturn .= '<td>' . $this->format( $value['values']['start'] ) . '</td>'
                            . '<td>' . $this->format( $value['values']['end'] ) . '</td>';
                }
                else
                {
                    // Arrays
                    $sReturn .= '<td colspan="2"><table class="table table-striped table-bordered">'
                            . $this->parse( $value['values']['end'] ) . '</table></td>';
                }
            }
            $sReturn .= '</tr>';
        }//foreach(...
        $sReturn .= '</tbody>';
        return $sReturn . PHP_EOL;
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
        $name    = ( is_string( $name ) ) ? strtoupper( trim( $name ) ) : 'NA';
        $sReturn = '<table class="table table-striped table-bordered"><caption>' . htmlentities( $name, ENT_QUOTES,
                                                                                                 'UTF-8' ) . '</caption>'
                . $this->parse( $data )
                . '</table>';
        return $sReturn . PHP_EOL;
    }

    /**
     * Rendering preconditions.
     *
     * @param  array $options [OPTIONAL] List of options. Not used.
     * @return string
     */
    public function renderPrecondition( array $options = array( ) )
    {
        return '<div class="clearfix"></div><div class="container"><h2>Debug</h2>' . PHP_EOL;
    }

    /**
     * Rendering postcondition.
     *
     * @return string
     */
    public function renderPostcondition()
    {
        return '</div>' . PHP_EOL;
    }

    /**
     * Rendering sent headers.
     *
     * @param array $aHeaders Sent headers
     * @return string
     */
    public function renderHeader( array $aHeaders )
    {
        $sReturn = '<table class="table table-striped table-bordered"><caption>HEADERS</caption>'
                . '<thead><tr><th>HEADER</th><th>VALUE</th></thead><tbody>';
        foreach( $aHeaders as $header )
        {
            $header = trim( $header );
            if( strlen( $header ) > 0 )
            {
                if( strpos( $header, ':' ) === FALSE )
                {
                    $header .= ':';
                }
                list( $sHeader, $sValue ) = explode( ':', $header, 2 );
                $sReturn .= '<tr><td>' . htmlentities( trim( $sHeader ), ENT_QUOTES, 'UTF-8' ) . '</td>'
                        . '<td>' . htmlentities( trim( $sValue ), ENT_QUOTES, 'UTF-8' ) . '</td></tr>';
            }
        }
        $sReturn .= '</tbody></table>';
        return $sReturn . PHP_EOL;
    }

    /**
     * Rendering session configuration.
     *
     * @return string
     */
    public function renderSessionConfiguration()
    {
        $sReturn = '<table class="table table-striped table-bordered"><caption>SESSION CONFIGURATION</caption>'
                . '<thead><tr><th>OPTION</th><th>VALUE</th></thead><tbody>';

        // Current session name
        $sReturn .= '<tr><td>name</td><td>' . htmlentities( session_name(), ENT_QUOTES, 'UTF-8' ) . '</td></tr>';

        // Current session save path
        $sReturn .= '<tr><td>save path</td><td>' . htmlentities( session_save_path(), ENT_QUOTES, 'UTF-8' ) . '</td></tr>';

        // Current session id
        $sReturn .= '<tr><td>id</td><td>' . htmlentities( session_id(), ENT_QUOTES, 'UTF-8' ) . '</td></tr>';
        if( function_exists( 'session_status' ) )
            $sReturn .= '<tr><td>status</td><td>' . htmlentities( session_status(), ENT_QUOTES, 'UTF-8' ) . '</td></tr>';

        // Current cookie parameters
        $aOptions = session_get_cookie_params();
        foreach( $aOptions as $Option => $value )
        {
            if( is_bool( $value ) )
                $value = (TRUE===$value) ? 'TRUE' : 'FALSE';
            $sReturn .= '<tr><td>' . htmlentities( $Option, ENT_QUOTES, 'UTF-8' ) . '</td>';
            $sReturn .= '<td>' . htmlentities( $value, ENT_QUOTES, 'UTF-8' ) . '</td></tr>';
        }
        $sReturn .= '</tbody></table>';
        return $sReturn . PHP_EOL;
    }

}