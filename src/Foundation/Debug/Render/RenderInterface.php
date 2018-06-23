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
 * Interface class for debug render implementation.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Render
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
interface RenderInterface
{

    /**
     * Rendering script execution time and the memory usage.
     *
     * @param float   $fScriptDuration  Script duration in seconds, with microsecond's precision
     * @param integer $iMemoryPeakUsage Peak memory usage
     * @param integer $iMemoryUsage     Current memory usage
     */
    public function renderUsage( $fScriptDuration, $iMemoryPeakUsage, $iMemoryUsage );

    /**
     * Rendering superglobal variable data.
     *
     * @param string $name Name of the superglobal variable
     * @param array  $data Contains data differencies. Format:
     *                     [$key] = array( 'status' => KEY_IDENTICAL | KEY_UPDATED | KEY_DELETED | KEY_ADDED
     *                                     'values' => array ( 'type' => VALUE_ARRAYS | VALUE_OTHERS,
     *                                                         'start' => ...,
     *                                                         'end' => ... ) );
     * @return mixed
     */
    public function renderVariable( $name, array $data );

    /**
     * Rendering memory data.
     *
     * @param float  $fScriptDuration  Script duration in seconds, with microsecond's precision
     * @param array  $data             Contains memory data. Format:
     *                                                [$key] = array( 'class' => ...,
     *                                                                 'time' => array( 'start' => ..., 'end' => ...),
     *                                                           'memoryPeak' => array( 'start' => ..., 'end' => ...),
     *                                                               'memory' => array( 'start' => ..., 'end' => ...) );
     * @return mixed
     */
    public function renderMemory( $fScriptDuration, array $data );

    /**
     * Rendering preconditions.
     *
     * @param  array $options [OPTIONAL] List of options.
     * @return mixed
     */
    public function renderPrecondition( array $options = array( ) );

    /**
     * Rendering postcondition.
     * @return string
     */
    public function renderPostcondition();

    /**
     * Rendering sent headers.
     *
     * @param array $aHeaders Sent headers
     * @return string
     */
    public function renderHeader( array $aHeaders );

    /**
     * Rendering session configuration.
     *
     * @return string
     */
    public function renderSessionConfiguration();
}