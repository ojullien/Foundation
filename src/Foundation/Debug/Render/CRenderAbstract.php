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
 * This class implements usefull methods for debug rendering.
 *
 * @category   Foundation
 * @package    Debug
 * @subpackage Render
 * @version    1.0.0
 * @since      1.0.0
 * @codeCoverageIgnore
 */
abstract class CRenderAbstract
{
    /** Constants */

    const SIGN = 1;
    const UNIT = 2;

    /** Memory section
     * *************** */

    /**
     * Convert bytes to MBytes
     *
     * @param float   $iValue     Value to convert
     * @param integer $iPrecision [OPTIONAL] Precision
     * @param boolean $iOption    [OPTIONAL] Add sign and/or unit. Combinaison of SIGN | UNIT
     * @return string
     */
    protected function convertToMByte( $value, $iPrecision = 2, $iOption = 0 )
    {
        $value      = ( is_numeric( $value ) ) ? $value + 0 : 0;
        $iPrecision = ( is_numeric( $iPrecision ) ) ? $iPrecision + 0 : 2;
        $iOption    = ( is_numeric( $iOption ) ) ? $iOption + 0 : 0;
        $sReturn    = round( $value / 1024 / 1024, $iPrecision );
        if( $iOption & self::SIGN )
        {
            $sReturn = (($sReturn >= 0) ? '+' : '-') . (string)$sReturn;
        }
        if( $iOption & self::UNIT )
        {
            $sReturn .= ' MByte(s)';
        }
        return $sReturn;
    }

    /**
     * Convert bytes to KBytes
     *
     * @param float   $iValue     Value to convert
     * @param integer $iPrecision [OPTIONAL] Precision
     * @param boolean $iOption    [OPTIONAL] Add sign and/or unit. Combinaison of SIGN | UNIT
     * @return string
     */
    protected function convertToKByte( $value, $iPrecision = 2, $iOption = 0 )
    {
        $value      = ( is_numeric( $value ) ) ? $value + 0 : 0;
        $iPrecision = ( is_numeric( $iPrecision ) ) ? $iPrecision + 0 : 2;
        $iOption    = ( is_numeric( $iOption ) ) ? $iOption + 0 : 0;
        $sReturn    = round( $value / 1024, $iPrecision );
        if( $iOption & self::SIGN )
        {
            $sReturn = (($sReturn >= 0) ? '+' : '-') . (string)$sReturn;
        }
        if( $iOption & self::UNIT )
        {
            $sReturn .= ' KByte(s)';
        }
        return $sReturn;
    }

    /** Time section
     * ************* */

    /**
     * Convert second with microsecond's precision to millisecond
     *
     * @param float   $iValue     Value to convert
     * @param integer $iPrecision [OPTIONAL] Precision
     * @param boolean $iOption    [OPTIONAL] Add unit.
     * @return string
     */
    protected function convertToMSecond( $value, $iPrecision = 2, $iOption = 0 )
    {
        $value      = ( is_numeric( $value ) ) ? $value + 0.0 : 0.0;
        $iPrecision = ( is_numeric( $iPrecision ) ) ? $iPrecision + 0 : 2;
        $iOption    = ( is_numeric( $iOption ) ) ? $iOption + 0 : 0;
        $sReturn    = round( $value * 1000, $iPrecision );
        if( $iOption & self::UNIT )
        {
            $sReturn .= ' ms';
        }
        return $sReturn;
    }

}