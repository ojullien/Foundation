<?php
namespace Foundation\Test\Protocol\Connector;

trait_exists('\Foundation\Test\Protocol\Connector\Provider\TConnectorProvider') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Protocol/Connector/provider/TConnectorProvider.php'));

class_exists('\Foundation\Protocol\Connector\CCurl') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/Connector/CCurl.php'));

class CCurlTest extends \PHPUnit_Framework_TestCase
{

    use \Foundation\Test\Protocol\Connector\Provider\TConnectorProvider;

    /** Class section
     * ************** */
    protected function setUp()
    {
        $this->loadData();
        $this->_pConnector = new \Foundation\Protocol\Connector\CCurl();
    }

    /** Test section
     * ************* */

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     * @expectedException Foundation\Exception\RuntimeException
     */
    public function testCheckConnection()
    {
        $this->_pConnector->write('http://framework.zend.com/api/zf-version?v=2');
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     */
    public function testCheckURL01()
    {
        $this->proceedEmptyHost();
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     */
    public function testCheckURL02()
    {
        static $sHost        = 'http://doesnotexist.fr';
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);
        $this->assertFalse($this->_pConnector->write($sHost, $this->the_OptionsWrite), 'write');
        $iErrorNumber = $this->_pConnector->getErrorNumber();
        $this->assertTrue(
            (CURLE_COULDNT_RESOLVE_HOST == $iErrorNumber) || (CURLE_OPERATION_TIMEOUTED == $iErrorNumber),
            'getErrorNumber'
        );
        $this->assertTrue((strlen($this->_pConnector->getErrorText()) > 0 ), 'getErrorText');
        $this->assertFalse($this->_pConnector->read(), 'read');
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testCheckUPLOAD01()
    {
        static $sHost = 'http://framework.zend.com/api/zf-version?v=2';

        $this->the_OptionsWrite[CURLOPT_UPLOAD] = true;
        $this->the_OptionsWrite[CURLOPT_INFILE] = '@file';
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);
        $this->_pConnector->write($sHost, $this->the_OptionsWrite);
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testCheckUPLOAD02()
    {
        static $sHost = 'http://framework.zend.com/api/zf-version?v=2';

        $this->the_OptionsWrite[CURLOPT_UPLOAD]     = true;
        $this->the_OptionsWrite[CURLOPT_INFILESIZE] = 1;
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);
        $this->_pConnector->write($sHost, $this->the_OptionsWrite);
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testCheckPUT01()
    {
        static $sHost = 'http://framework.zend.com/api/zf-version?v=2';

        $this->the_OptionsWrite[CURLOPT_PUT]    = true;
        $this->the_OptionsWrite[CURLOPT_INFILE] = '@file';
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);
        $this->_pConnector->write($sHost, $this->the_OptionsWrite);
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testCheckPUT02()
    {
        static $sHost = 'http://framework.zend.com/api/zf-version?v=2';

        $this->the_OptionsWrite[CURLOPT_PUT]        = true;
        $this->the_OptionsWrite[CURLOPT_INFILESIZE] = 1;
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);
        $this->_pConnector->write($sHost, $this->the_OptionsWrite);
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testCheckResource()
    {
        static $sHost = 'http://framework.zend.com/api/zf-version?v=2';

        $this->the_OptionsWrite[CURLOPT_UPLOAD]     = true;
        $this->the_OptionsWrite[CURLOPT_INFILE]     = false;
        $this->the_OptionsWrite[CURLOPT_INFILESIZE] = 10;
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);
        $this->_pConnector->write($sHost, $this->the_OptionsWrite);
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testCheckOUTPUT()
    {
        static $sHost = 'http://framework.zend.com/api/zf-version?v=2';

        $this->the_OptionsWrite[CURLOPT_FILE] = true;
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);
        $this->_pConnector->write($sHost, $this->the_OptionsWrite);
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     */
    public function testWriteFile()
    {
        $sSource      = realpath(APPLICATION_PATH . '/LICENSE');
        $sDestination = realpath(APPLICATION_PATH . '/data/logs') . '/ccurltest.log';
        $sHost        = 'file://localhost/' . strtr($sSource, '\\', '/');
        $pFile        = fopen($sDestination, 'wb');
        $this->assertTrue(is_resource($pFile), 'is_resource');

        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);

        $this->the_OptionsWrite[CURLOPT_FILE] = $pFile;

        $this->assertTrue($this->_pConnector->write($sHost, $this->the_OptionsWrite), 'write');
        $this->assertSame(CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber');
        $this->assertTrue((strlen($this->_pConnector->getErrorText()) == 0 ), 'getErrorText');

        $this->assertTrue($this->_pConnector->read(), 'read');
        fflush($pFile);
        fclose($pFile);
        $this->assertTrue((filesize($sSource) == filesize($sDestination) ), 'filesize');
        unlink($sDestination);
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @group specification
     */
    public function testWriteFileNobody()
    {
        static $sHost = 'http://framework.zend.com/api/zf-version?v=2';

        $sDestination = realpath(APPLICATION_PATH . '/data/logs') . '/ccurltest.log';

        $pFile = fopen($sDestination, 'wb');
        $this->assertTrue(is_resource($pFile), 'is_resource');

        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);

        $this->the_OptionsWrite[CURLOPT_FILE]   = $pFile;
        $this->the_OptionsWrite[CURLOPT_NOBODY] = true;

        $this->assertTrue($this->_pConnector->write($sHost, $this->the_OptionsWrite), 'write');
        $this->assertSame(CURLE_OK, $this->_pConnector->getErrorNumber(), 'getErrorNumber');
        $this->assertTrue((strlen($this->_pConnector->getErrorText()) == 0 ), 'getErrorText');

        $info = $this->_pConnector->getInformation();
        $this->assertTrue(in_array($info['http_code'], [ 200, 301, 302 ]), 'http_code');
        $this->assertTrue($this->_pConnector->read(), 'read');
        fflush($pFile);
        fclose($pFile);
        $this->assertTrue((0 == filesize($sDestination) ), 'filesize');
        unlink($sDestination);
    }

    /**
     * Provider for testWriteHttps and testWriteHttpsNobody
     */
    public function provideForWriteHttps()
    {
        return [
            [
                'label'    => 'TEST: SSL_VERIFYPEER',
                'test'     => true,
                'expected' => [
                    'win'   => [
                        'write'          => false,
                        'getErrorNumber' => CURLE_SSL_CACERT,
                        'http_code'      => [ 0 ],
                        'read'           => false
                    ],
                    'linux' => [
                        'write'          => true,
                        'getErrorNumber' => CURLE_OK,
                        'http_code'      => [ 200, 301, 302 ],
                        'read'           => true
                    ] ] ],
            [
                'label'    => 'TEST: !SSL_VERIFYPEER',
                'test'     => false,
                'expected' => [
                    'win'   => [
                        'write'          => true,
                        'getErrorNumber' => CURLE_OK,
                        'http_code'      => [ 200, 301, 302 ],
                        'read'           => true
                    ],
                    'linux' => [
                        'write'          => true,
                        'getErrorNumber' => CURLE_OK,
                        'http_code'      => [ 200, 301, 302 ],
                        'read'           => true
                    ] ] ],
        ];
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @covers \Foundation\Protocol\Connector\CCurl::close
     * @group specification
     * @dataProvider provideForWriteHttps
     */
    public function testWriteHttps($label, $test, array $expected)
    {
        // Initialize
        static $sHost = 'https://lists.wikimedia.org/mailman/listinfo';

        if (DIRECTORY_SEPARATOR == '\\') {
            $expected = &$expected['win'];
        } else {
            $expected = &$expected['linux'];
        }

        // Connect
        $this->the_OptionsConnect[CURLOPT_SSL_VERIFYPEER] = $test;
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);

        // Write
        $this->assertSame(
            $expected['write'],
            $this->_pConnector->write($sHost, $this->the_OptionsWrite),
            $label . ' write'
        );
        $this->assertSame($expected['getErrorNumber'], $this->_pConnector->getErrorNumber(), $label . ' getErrorNumber');

        // Get informations
        $aInfo = $this->_pConnector->getInformation();
        $this->assertTrue(in_array($aInfo['http_code'], $expected['http_code']), $label . ' http_code');

        // Read
        $sReturn = $this->_pConnector->read();

        if ($expected['read']) {
            $this->assertTrue(is_string($sReturn), $label . ' read');
            $iLength = strlen($sReturn);
            $this->assertEquals($aInfo['size_download'], $iLength, $label . ' size_download');
        } else {
            $this->assertFalse($sReturn, $label . ' read');
        }

        // Close
        $this->_pConnector->close();
    }

    /**
     * @covers \Foundation\Protocol\Connector\CCurl::connect
     * @covers \Foundation\Protocol\Connector\CCurl::write
     * @covers \Foundation\Protocol\Connector\CCurl::close
     * @group specification
     * @dataProvider provideForWriteHttps
     */
    public function testWriteHttpsNobody($label, $test, array $expected)
    {
        // Initialize
        static $sHost = 'https://lists.wikimedia.org/mailman/listinfo';

        if (DIRECTORY_SEPARATOR == '\\') {
            $expected = &$expected['win'];
        } else {
            $expected = &$expected['linux'];
        }

        // Connect
        $this->the_OptionsConnect[CURLOPT_SSL_VERIFYPEER] = $test;
        $this->the_OptionsWrite[CURLOPT_NOBODY]           = true;
        $this->_pConnector->connect($sHost, $this->the_OptionsConnect);

        // Write
        $this->assertSame(
            $expected['write'],
            $this->_pConnector->write($sHost, $this->the_OptionsWrite),
            $label . ' write'
        );
        $this->assertSame($expected['getErrorNumber'], $this->_pConnector->getErrorNumber(), $label . ' getErrorNumber');

        // Get informations
        $aInfo = $this->_pConnector->getInformation();
        $this->assertTrue(in_array($aInfo['http_code'], $expected['http_code']), $label . ' http_code');

        // Read
        $sReturn = $this->_pConnector->read();

        if ($expected['read']) {
            $this->assertTrue(is_string($sReturn), $label . ' read');
            $iLength = strlen($sReturn);
            $this->assertEquals($aInfo['size_download'], $iLength, $label . ' size_download');
        } else {
            $this->assertFalse($sReturn, $label . ' read');
        }

        // Close
        $this->_pConnector->close();
    }
}
