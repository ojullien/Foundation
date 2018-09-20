<?php
if (! defined('FOUNDATION_EXCEPTION_PATH')) {
    define('FOUNDATION_EXCEPTION_PATH', APPLICATION_PATH . '/src/Foundation/Exception');
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/BadFunctionCallException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/DomainException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/LengthException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/OutOfBoundsException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/OutOfRangeException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/OverflowException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/RangeException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/RuntimeException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/UnderflowException.php'));
    require_once(realpath(FOUNDATION_EXCEPTION_PATH . '/UnexpectedValueException.php'));
}
if (! defined('FOUNDATION_TYPE_PATH')) {
    define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');
    require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CFloat.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CInt.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CByte.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CEmailAddress.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CPath.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CIp.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CHostname.php'));
    require(realpath(FOUNDATION_TYPE_PATH . '/Enum/CSeverity.php'));
}

if (! defined('FOUNDATION_PROTOCOL_PATH')) {
    define('FOUNDATION_PROTOCOL_PATH', APPLICATION_PATH . '/src/Foundation/Protocol');
//    require( realpath( FOUNDATION_PROTOCOL_PATH . '/Download/CDownloadAbstract.php' ) );
//    require( realpath( FOUNDATION_PROTOCOL_PATH . '/Download/CDownloadAudio.php' ) );
//    require( realpath( FOUNDATION_PROTOCOL_PATH . '/Download/CDownloadImage.php' ) );
//    require( realpath( FOUNDATION_PROTOCOL_PATH . '/Download/ManagerInterface.php' ) );
//    require( realpath( FOUNDATION_PROTOCOL_PATH . '/Download/CManager.php' ) );
    require(realpath(FOUNDATION_PROTOCOL_PATH . '/Connector/ConnectorInterface.php'));
    require(realpath(FOUNDATION_PROTOCOL_PATH . '/Connector/CConnectorAbstract.php'));
    require(realpath(FOUNDATION_PROTOCOL_PATH . '/Connector/CFile.php'));
    require(realpath(FOUNDATION_PROTOCOL_PATH . '/Connector/CCurl.php'));
//    require( realpath( FOUNDATION_PROTOCOL_PATH . '/CRemoteAddress.php' ) );
}

if (! defined('FOUNDATION_WEATHER_PATH')) {
    define('FOUNDATION_WEATHER_PATH', APPLICATION_PATH . '/src/Foundation/Weather');
    require(realpath(FOUNDATION_WEATHER_PATH . '/Decoder/DecoderInterface.php'));
    require(realpath(FOUNDATION_WEATHER_PATH . '/Decoder/CDecoderAbstract.php'));
    require(realpath(FOUNDATION_WEATHER_PATH . '/Decoder/CDecoder.php'));
    require(realpath(FOUNDATION_WEATHER_PATH . '/Decoder/CDecoratorAbstract.php'));
    require(realpath(FOUNDATION_WEATHER_PATH . '/Decoder/CDecoderWu.php'));
}

class CDecoderWuTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeJSONEmpty()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);
        $return     = $pDecoderWu->decode([ ], '');
        $this->assertNull($return, 'TEST: decode');
        $this->assertSame(
            \Foundation\Weather\Decoder\CDecoder::FWD_ERROR_SYNTAX,
            $pDecoderWu->getErrorNumber(),
            'TEST: getErrorNumber'
        );
        $this->assertSame('Invalid or malformed data', $pDecoderWu->getErrorText(), 'TEST: getErrorText');
        unset($pDecoderWu, $pDecoder);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeJSONBad()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);
        $return     = $pDecoderWu->decode([ ], '{"response":{"version": "0.1"}');
        $this->assertNull($return, 'TEST: decode');
        $this->assertSame(JSON_ERROR_SYNTAX, $pDecoderWu->getErrorNumber(), 'TEST: getErrorNumber');
        $this->assertSame('Syntax error', $pDecoderWu->getErrorText(), 'TEST: getErrorText');
        unset($pDecoderWu, $pDecoder);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDTDEmpty()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);
        $return     = $pDecoderWu->decode([ ], '{"response":{"version": "0.1"}}');
        $this->assertNull($return, 'TEST: decode');
        $this->assertSame(
            \Foundation\Weather\Decoder\CDecoder::FWD_ERROR_SYNTAX,
            $pDecoderWu->getErrorNumber(),
            'TEST: getErrorNumber'
        );
        $this->assertSame('Invalid or malformed data', $pDecoderWu->getErrorText(), 'TEST: getErrorText');
        unset($pDecoderWu, $pDecoder);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testCompactKeyMissing01()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);

        $pMethod = new ReflectionMethod('\Foundation\Weather\Decoder\CDecoderWu', 'compact');
        $pMethod->setAccessible(true);

        $data = [
            'forecast' => [
                'txt_forecast'   => [
                    'date'        => '',
                    'forecastday' => [
                        0 => [
                            'period'         => 0,
                            'icon'           => '',
                            'title'          => '',
                            'fcttext_metric' => '',
                            'pop'            => 0 ] ] ],
                'simpleforecast' => [
                    'forecastday' => [
                        0 => [
                            'date'        => [
                                'day'           => 0,
                                'month'         => 0,
                                'year'          => 0,
                                'monthname'     => '',
                                'weekday_short' => '',
                                'weekday'       => '' ],
                            'period'      => 0,
                            'high'        => '',
                            'low'         => '',
                            'conditions'  => '',
                            'icon'        => '',
                            'pop'         => 0,
                            'qpf_allday'  => 0,
                            'snow_allday' => 0,
                            'maxwind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avewind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avehumidity' => 0 ]
                    ] ] ] ];

        $pMethod->invokeArgs($pDecoderWu, [ &$data ]);
        $this->assertSame(
            \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING,
            $pDecoderWu->getErrorNumber(),
            'TEST: getErrorNumber'
        );
        $this->assertEquals(
            'Key "forecast/simpleforecast/forecastday/period" is missing',
            $pDecoderWu->getErrorText(),
            'TEST: getErrorText'
        );
        unset($pDecoderWu, $pDecoder, $pMethod);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testCompactKeyMissing02()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);

        $pMethod = new ReflectionMethod('\Foundation\Weather\Decoder\CDecoderWu', 'compact');
        $pMethod->setAccessible(true);

        $data = [
            'forecast' => [
                'txt_forecast'   => [
                    'date'        => '',
                    'forecastday' => [
                        0 => [
                            'period'         => 0,
                            'icon'           => '',
                            'title'          => '',
                            'fcttext_metric' => '',
                            'pop'            => 0 ] ] ],
                'simpleforecast' => [
                    'notforecastday' => [
                        0 => [
                            'date'        => [
                                'day'           => 0,
                                'month'         => 0,
                                'year'          => 0,
                                'monthname'     => '',
                                'weekday_short' => '',
                                'weekday'       => '' ],
                            'period'      => 1,
                            'high'        => '',
                            'low'         => '',
                            'conditions'  => '',
                            'icon'        => '',
                            'pop'         => 0,
                            'qpf_allday'  => 0,
                            'snow_allday' => 0,
                            'maxwind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avewind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avehumidity' => 0 ]
                    ] ] ] ];

        $pMethod->invokeArgs($pDecoderWu, [ &$data ]);
        $this->assertSame(
            \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING,
            $pDecoderWu->getErrorNumber(),
            'TEST: getErrorNumber'
        );
        $this->assertEquals(
            'Key "forecast/simpleforecast/forecastday" is missing',
            $pDecoderWu->getErrorText(),
            'TEST: getErrorText'
        );
        unset($pDecoderWu, $pDecoder, $pMethod);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testCompactKeyMissing03()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);

        $pMethod = new ReflectionMethod('\Foundation\Weather\Decoder\CDecoderWu', 'compact');
        $pMethod->setAccessible(true);

        $data = [
            'forecast' => [
                'txt_forecast'   => [
                    'date'        => '',
                    'forecastday' => [
                        0 => [
                            'notperiod'      => 0,
                            'icon'           => '',
                            'title'          => '',
                            'fcttext_metric' => '',
                            'pop'            => 0 ] ] ],
                'simpleforecast' => [
                    'forecastday' => [
                        0 => [
                            'date'        => [
                                'day'           => 0,
                                'month'         => 0,
                                'year'          => 0,
                                'monthname'     => '',
                                'weekday_short' => '',
                                'weekday'       => '' ],
                            'period'      => 1,
                            'high'        => '',
                            'low'         => '',
                            'conditions'  => '',
                            'icon'        => '',
                            'pop'         => 0,
                            'qpf_allday'  => 0,
                            'snow_allday' => 0,
                            'maxwind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avewind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avehumidity' => 0 ]
                    ] ] ] ];

        $pMethod->invokeArgs($pDecoderWu, [ &$data ]);

        $this->assertSame(
            \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING,
            $pDecoderWu->getErrorNumber(),
            'TEST: getErrorNumber'
        );
        $this->assertEquals(
            'Key "forecast/txt_forecast/forecastday/period" is missing',
            $pDecoderWu->getErrorText(),
            'TEST: getErrorText'
        );
        unset($pDecoderWu, $pDecoder, $pMethod);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testCompactKeyMissing04()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);

        $pMethod = new ReflectionMethod('\Foundation\Weather\Decoder\CDecoderWu', 'compact');
        $pMethod->setAccessible(true);

        $data = [
            'forecast' => [
                'txt_forecast'   => [
                    'date'           => '',
                    'notforecastday' => [
                        0 => [
                            'period'         => 0,
                            'icon'           => '',
                            'title'          => '',
                            'fcttext_metric' => '',
                            'pop'            => 0 ] ] ],
                'simpleforecast' => [
                    'forecastday' => [
                        0 => [
                            'date'        => [
                                'day'           => 0,
                                'month'         => 0,
                                'year'          => 0,
                                'monthname'     => '',
                                'weekday_short' => '',
                                'weekday'       => '' ],
                            'period'      => 1,
                            'high'        => '',
                            'low'         => '',
                            'conditions'  => '',
                            'icon'        => '',
                            'pop'         => 0,
                            'qpf_allday'  => 0,
                            'snow_allday' => 0,
                            'maxwind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avewind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avehumidity' => 0 ]
                    ] ] ] ];

        $pMethod->invokeArgs($pDecoderWu, [ &$data ]);
        $this->assertSame(
            \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING,
            $pDecoderWu->getErrorNumber(),
            'TEST: getErrorNumber'
        );
        $this->assertEquals(
            'Key "forecast/txt_forecast/forecastday" is missing',
            $pDecoderWu->getErrorText(),
            'TEST: getErrorText'
        );
        unset($pDecoderWu, $pDecoder, $pMethod);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testCompactKeyMissing05()
    {
        $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
        $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);

        $pMethod = new ReflectionMethod('\Foundation\Weather\Decoder\CDecoderWu', 'compact');
        $pMethod->setAccessible(true);

        $data = [
            'forecast' => [
                'txt_forecast'   => [
                    'notdate'     => '',
                    'forecastday' => [
                        0 => [
                            'period'         => 0,
                            'icon'           => '',
                            'title'          => '',
                            'fcttext_metric' => '',
                            'pop'            => 0 ] ] ],
                'simpleforecast' => [
                    'forecastday' => [
                        0 => [
                            'date'        => [
                                'day'           => 0,
                                'month'         => 0,
                                'year'          => 0,
                                'monthname'     => '',
                                'weekday_short' => '',
                                'weekday'       => '' ],
                            'period'      => 1,
                            'high'        => '',
                            'low'         => '',
                            'conditions'  => '',
                            'icon'        => '',
                            'pop'         => 0,
                            'qpf_allday'  => 0,
                            'snow_allday' => 0,
                            'maxwind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avewind'     => [
                                'kph'     => 0,
                                'dir'     => '',
                                'degrees' => 0 ],
                            'avehumidity' => 0 ]
                    ] ] ] ];

        $pMethod->invokeArgs($pDecoderWu, [ &$data ]);
        $this->assertSame(
            \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING,
            $pDecoderWu->getErrorNumber(),
            'TEST: getErrorNumber'
        );
        $this->assertEquals(
            'Key "forecast/txt_forecast/date" is missing',
            $pDecoderWu->getErrorText(),
            'TEST: getErrorText'
        );
        unset($pDecoderWu, $pDecoder, $pMethod);
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoderWu
     * @covers \Foundation\Weather\Decoder\CDecoratorAbstract
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecode()
    {
        // Connector
        $aConnectorOptionsConnect = [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 2,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_AUTOREFERER    => true,
        ];
        $aConnectorOptionsWrite   = [
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER   => [
                'Accept: text/html, application/xml;q=0.9, */*;q=0.1',
                'Accept-Charset: iso-8859-1, utf-8, utf-16, *;q=0.1' ] ];

        $sWUFile = realpath(APPLICATION_PATH . '/data/uploads/Pomponne_pws-1_bestfct-1.json');
        $aWUdtd  = require(realpath(FOUNDATION_WEATHER_PATH . '/Decoder/Dtd/wu_dtd.php'));
        $aPBRdtd = require(realpath(FOUNDATION_WEATHER_PATH . '/Decoder/Dtd/pbr_dtd.php'));

        $pConnector = new \Foundation\Protocol\Connector\CFile();
        $pConnector->connect($sWUFile, $aConnectorOptionsConnect);
        $this->assertTrue($pConnector->write($sWUFile, $aConnectorOptionsWrite), 'Connector write');

        $sSOURCE = $pConnector->read();
        $pConnector->close();
        unset($pConnector);

        if (true !== $sSOURCE) {
            // Convert json into an array
            $aJSON = json_decode($sSOURCE, true, 512, JSON_BIGINT_AS_STRING);
            $this->assertTrue(is_array($aJSON), 'json_decode');

            // Create decoder
            $pDecoder   = new \Foundation\Weather\Decoder\CDecoder();
            $pDecoderWu = new \Foundation\Weather\Decoder\CDecoderWu($pDecoder);
            $aPBR       = $pDecoderWu->decode($aWUdtd, $sSOURCE);
            $this->assertTrue(is_array($aPBR), 'decode');
            $this->assertSame(0, $pDecoderWu->getErrorNumber(), 'CDecoderWu decode');
            $this->assertSame(0, $pDecoder->getErrorNumber(), 'CDecoder decode');
            unset($pDecoderWu, $pDecoder);

            // Compare dtd
            $this->parseArrayType($aPBRdtd, $aPBR);

            // Compare values
            if ($aPBR['response']['version'] !== $aJSON['response']['version']) {
                throw new \Foundation\Exception\RuntimeException('Value mismatch for "response/version"');
            }
            if ($aPBR['current_observation']['display_location'] !== $aJSON['current_observation']['display_location']['full']) {
                throw new \Foundation\Exception\RuntimeException('Value mismatch for "current_observation/display_location"');
            }
            if ($aPBR['current_observation']['observation_location'] !== $aJSON['current_observation']['observation_location']['full']) {
                throw new \Foundation\Exception\RuntimeException('Value mismatch for "current_observation/observation_location"');
            }
            $this->parseArrayValue($aPBR['current_observation'], $aJSON['current_observation']);
            if ($aPBR['forecast_date'] !== $aJSON['forecast']['txt_forecast']['date']) {
                throw new \Foundation\Exception\RuntimeException('Value mismatch for "forecast_date"');
            }
            $this->parseArrayValue($aPBR['forecastday_short'], $aJSON['forecast']['txt_forecast']['forecastday']);
            $this->parseArrayValue($aPBR['forecastday'], $aJSON['forecast']['simpleforecast']['forecastday']);
            $pTemp = &$aJSON['forecast']['simpleforecast']['forecastday'];
            foreach ($aPBR['forecastday'] as $key => $value) {
                if ($value['high'] !== $pTemp[$key]['high']['celsius']) {
                    throw new \Foundation\Exception\RuntimeException('Value mismatch for "forecastday/' . $key . '/high"');
                }
                if ($value['low'] !== $pTemp[$key]['low']['celsius']) {
                    throw new \Foundation\Exception\RuntimeException('Value mismatch for "forecastday/' . $key . '/low"');
                }
                if ($value['qpf_allday'] !== $pTemp[$key]['qpf_allday']['mm']) {
                    throw new \Foundation\Exception\RuntimeException('Value mismatch for "forecastday/' . $key . '/qpf_allday"');
                }
                if ($value['snow_allday'] !== $pTemp[$key]['snow_allday']['cm']) {
                    throw new \Foundation\Exception\RuntimeException('Value mismatch for "forecastday/' . $key . '/snow_allday"');
                }
            }
            $this->parseArrayValue($aPBR['moon_phase'], $aJSON['moon_phase']);
        }
    }

    final protected function parseArrayType(array& $one, array& $two)
    {
        foreach ($one as $key => $void) {
            if (isset($two[$key])) {
                $one_value = &$one[$key];
                $two_value = &$two[$key];

                if (is_array($one_value) && is_array($two_value)) {
                    $this->parseArrayType($one_value, $two_value);
                } elseif (is_scalar($one_value) && is_scalar($two_value)) {
                    // good
                } else {
                    throw new \RuntimeException(sprintf('Type mismatch for "%s"', $key));
                }
            } else {
                throw new \RuntimeException(sprintf('Key "%s" is missing', $key));
            }
        }
    }

    final protected function parseArrayValue(array& $one, array& $two)
    {
        foreach ($one as $key => $void) {
            if (isset($two[$key])) {
                $one_value = &$one[$key];
                $two_value = &$two[$key];

                if (is_array($one_value) && is_array($two_value)) {
                    $this->parseArrayValue($one_value, $two_value);
                } elseif (is_scalar($one_value) && is_scalar($two_value)) {
                    if ($one_value !== $two_value) {
                        throw new \RuntimeException(sprintf('Value mismatch for "%s"', $key));
                    }
                } elseif (is_array($one_value) && is_scalar($two_value)) {
                    throw new \RuntimeException(sprintf('Type mismatch for "%s"', $key));
                }
            }
        }
    }
}
