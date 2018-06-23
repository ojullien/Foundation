<?php
namespace Foundation\Weather\Decoder;
/**
 * Foundation Framework
 *
 * @package   Weather
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * This class is a decorator class used to extend the fonctionnalities of a decoder class.
 * This class implements a concrete decoder strategy: decodes a Weather Underground json data to an associative array
 * that has a PBR structure.
 *
 * @category   Foundation
 * @package    Weather
 * @subpackage Decoder
 * @version    1.0.0
 * @since      1.0.0
 */
final class CDecoderWu extends \Foundation\Weather\Decoder\CDecoratorAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @param \Foundation\Weather\Decoder\DecoderInterface $pDecoder The decoder being decorated.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     * @codeCoverageIgnore
     */
    public function __construct( \Foundation\Weather\Decoder\DecoderInterface $pDecoder )
    {
        $this->_sDebugID = uniqid( 'cdecoderwu', TRUE );
        defined( 'FOUNDATION_DEBUG' ) &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add( $this->_sDebugID, __CLASS__,
                                                                                 array( $pDecoder ) );
        parent::__construct( $pDecoder );
    }

    /** Error section
     * ************** */

    /**
     * JSON messages.
     *
     * @var array
     */
    private static $_JsonMessages = array(
        JSON_ERROR_NONE           => 'No error has occurred',
        JSON_ERROR_DEPTH          => 'The maximum stack depth has been exceeded',
        JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed DATA',
        JSON_ERROR_CTRL_CHAR      => 'Control character error, possibly incorrectly encoded',
        JSON_ERROR_SYNTAX         => 'Syntax error',
        JSON_ERROR_UTF8           => 'Malformed UTF-8 characters, possibly incorrectly encoded' );

    /** Decoder section
     * **************** */

    /**
     * Compacts WU JSON decoded data according to the PBR dtd.
     * The input array shall be valid according to WU dtd and the output array will be valid according to PBR dtd.
     * In case of failure, use getErrorNumber and getErrorText methods to determine the exact nature of error.
     * @see \Foundation\Weather\Decoder\Dtd\pbr_dtd for a DTD explanation.
     *
     * @param array $data Decoded WU JSON data according to WU dtd. Then, PBR compacted data according to PBR dtd.
     * @return void
     */
    private function compact( array& $data )
    {
        // Declare static arrays
        static $aForecastdayShort = array(
    'icon'           => '',
    'title'          => '',
    'fcttext_metric' => '',
    'pop'            => '' );

        static $aforecastday = array(
    'date'        => array(
        'day'           => 0,
        'month'         => 0,
        'year'          => 0,
        'monthname'     => '',
        'weekday_short' => '',
        'weekday'       => '' ),
    'high'        => '',
    'low'         => '',
    'conditions'  => '',
    'icon'        => '',
    'pop'         => 0,
    'qpf_allday'  => 0,
    'snow_allday' => 0,
    'maxwind'     => array(
        'kph'     => 0,
        'dir'     => '',
        'degrees' => 0 ),
    'avewind'     => array(
        'kph'     => 0,
        'dir'     => '',
        'degrees' => 0 ),
    'avehumidity' => 0 );

        // Add default forecast_date
        $data['forecast_date'] = '';

        // Add default forecastday_short
        $data['forecastday_short'] = array( );
        for( $iIndex = 0; $iIndex < 20; $iIndex++ )
        {
            $data['forecastday_short'][$iIndex] = $aForecastdayShort;
        }

        // Add default forecastday
        $data['forecastday'] = array( );
        for( $iIndex = 0; $iIndex < 10; $iIndex++ )
        {
            $data['forecastday'][$iIndex] = $aforecastday;
        }

        // Initialize pointers
        $pCurrentObservation = NULL;
        $pForecast           = NULL;
        $pTxtForecast        = NULL;
        $pSimpleforecast     = NULL;

        if( isset( $data['current_observation'] ) )
            $pCurrentObservation = &$data['current_observation'];

        if( isset( $data['forecast'] ) )
            $pForecast = &$data['forecast'];

        if( (NULL !== $pForecast) && isset( $pForecast['txt_forecast'] ) )
            $pTxtForecast = &$pForecast['txt_forecast'];

        if( (NULL !== $pForecast) && isset( $pForecast['simpleforecast'] ) )
            $pSimpleforecast = &$pForecast['simpleforecast'];

        // Compact txt_forecast/date
        if( (NULL !== $pCurrentObservation) && isset( $pCurrentObservation['ob_url'] ) )
        {
            $data['response']['url'] = $pCurrentObservation['ob_url'];
        }
        else
        {
            $this->_iError = self::FWD_KEY_MISSING;
            $this->_sError = 'Key "current_observation/ob_url" is missing';
        }

        // Compact txt_forecast/date
        if( (NULL !== $pTxtForecast) && isset( $pTxtForecast['date'] ) )
        {
            $data['forecast_date'] = $pTxtForecast['date'];
        }
        else
        {
            $this->_iError = self::FWD_KEY_MISSING;
            $this->_sError = 'Key "forecast/txt_forecast/date" is missing';
        }

        // Compact txt_forecast/forecastday
        if( (NULL !== $pTxtForecast) && isset( $pTxtForecast['forecastday'] ) && is_array( $pTxtForecast['forecastday'] ) )
        {
            foreach( $pTxtForecast['forecastday'] as $value )
            {
                if( isset( $value['period'] ) && isset( $data['forecastday_short'][$value['period']] ) )
                {
                    $data['forecastday_short'][$value['period']] = $this->_pDecoratedDecoder->decode( $aForecastdayShort,
                                                                                                      $value );
                    // Save error
                    // @codeCoverageIgnoreStart
                    if( 0 != $this->_pDecoratedDecoder->getErrorNumber() )
                    {
                        $this->_iError = $this->_pDecoratedDecoder->getErrorNumber();
                        $this->_sError = $this->_pDecoratedDecoder->getErrorText();
                    }
                    // @codeCoverageIgnoreEnd
                }
                else
                {
                    $this->_iError = self::FWD_KEY_MISSING;
                    $this->_sError = 'Key "forecast/txt_forecast/forecastday/period" is missing';
                }
            }
        }
        else
        {
            $this->_iError = self::FWD_KEY_MISSING;
            $this->_sError = 'Key "forecast/txt_forecast/forecastday" is missing';
        }

        // Compact txt_forecast/ simpleforecast / forecastday
        if( (NULL !== $pSimpleforecast) && isset( $pSimpleforecast['forecastday'] ) && is_array( $pSimpleforecast['forecastday'] ) )
        {
            foreach( $pSimpleforecast['forecastday'] as $value )
            {
                if( isset( $value['period'] ) && isset( $data['forecastday'][$value['period'] - 1] ) )
                {
                    $data['forecastday'][$value['period'] - 1] = $this->_pDecoratedDecoder->decode( $aforecastday,
                                                                                                    $value );
                    // Save error
                    // @codeCoverageIgnoreStart
                    if( 0 != $this->_pDecoratedDecoder->getErrorNumber() )
                    {
                        $this->_iError = $this->_pDecoratedDecoder->getErrorNumber();
                        $this->_sError = $this->_pDecoratedDecoder->getErrorText();
                    }
                    // @codeCoverageIgnoreEnd
                }
                else
                {
                    $this->_iError = self::FWD_KEY_MISSING;
                    $this->_sError = 'Key "forecast/simpleforecast/forecastday/period" is missing';
                }
            }
        }
        else
        {
            $this->_iError = self::FWD_KEY_MISSING;
            $this->_sError = 'Key "forecast/simpleforecast/forecastday" is missing';
        }

        // Unset
        unset( $data['forecast'] );
    }

    /**
     * Decodes WU JSON data into an associative array according to the DTD.
     * The returned array has the same structure as the DTD.
     * In case of failure, use getErrorNumber and getErrorText methods to determine the exact nature of error.
     * @see \Foundation\Weather\Decoder\Dtd\wu_dtd for a DTD explanation.
     *
     * @param  array  $dtd  Defines the legal structure of the returned array. Should not be empty.
     * @param  string $data The json data being decoded. Should not be empty.
     * @return array Returns the decoded data on success, NULL on failure.
     */
    public function decode( array $dtd, $data )
    {
        // Initialize
        $return        = NULL;
        $this->_iError = 0;
        $this->_sError = '';

        // This strategy apply only on a string
        $data = ( is_string( $data ) ) ? trim( $data ) : '';
        if( strlen( $data ) > 0 )
        {
            // Decode WU json string into array
            $data = json_decode( $data, TRUE, 512, JSON_BIGINT_AS_STRING );
            if( is_array( $data ) )
            {
                // Parse the source according to the DTD
                $return = $this->_pDecoratedDecoder->decode( $dtd, $data );

                // Save error
                $this->_iError = $this->_pDecoratedDecoder->getErrorNumber();
                $this->_sError = $this->_pDecoratedDecoder->getErrorText();

                // Compact data
                if( is_array( $return ) )
                    $this->compact( $return );
            }
            // Case error: the data is not a valid json data
            else
            {
                // An error was occured while json decoding
                $this->_iError = json_last_error();
                $this->_sError = ( isset( static::$_JsonMessages[$this->_iError] ) ) ? static::$_JsonMessages[$this->_iError] : 'Unexpected json error';
            }
        }
        // Case error: the data is not a string
        else
        {
            $this->_iError = self::FWD_ERROR_SYNTAX;
            $this->_sError = 'Invalid or malformed data';
        }

        return $return;
    }

}