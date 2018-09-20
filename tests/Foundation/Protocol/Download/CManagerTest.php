<?php
namespace Foundation\Test\Protocol\Download;

defined('FOUNDATION_EXCEPTION_PATH') || define(
    'FOUNDATION_EXCEPTION_PATH',
    APPLICATION_PATH . '/src/Foundation/Exception'
);
interface_exists('\Foundation\Exception\ExceptionInterface') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
class_exists('\Foundation\Exception\InvalidArgumentException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));

defined('FOUNDATION_PROTOCOL_PATH') || define(
    'FOUNDATION_PROTOCOL_PATH',
    APPLICATION_PATH . '/src/Foundation/Protocol'
);
interface_exists('\Foundation\Protocol\Download\ManagerInterface') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/Download/ManagerInterface.php'));
class_exists('\Foundation\Protocol\Download\CManager') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/Download/CManager.php'));

class_exists('\Foundation\Test\Framework\Provider\CDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php'));

class CManagerTest extends \PHPUnit_Framework_TestCase
{
    /** Class section
     * *************** */

    /**
     * Contains not valid data
     * @var array
     */
    protected static $_aException = [ ];

    /**
     * Contains valid data
     * @var array
     */
    protected static $_aValid = [ ];

    /**
     * Loads test data.
     */
    public static function setUpBeforeClass()
    {
        $tests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_RESOURCE,
            require(realpath(__DIR__ . '/provider/result/cmanager.php'))
        );

        foreach ($tests as $test) {
            $expected = &$test['expected'];
            if ($expected['exception'] != 0) {
                static::$_aException[] = $test;
            }
            if ($expected['exception'] == 0) {
                static::$_aValid[] = $test;
            }
        }
    }

    /** Test section
     * ************* */

    /**
     * @covers \Foundation\Protocol\Download\CManager::send
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testSendAttachmentException()
    {
        foreach (static::$_aException as $data) {
            $label = &$data['label'];
            $test  = &$data['test'];

            $pFile = new \SplFileInfo($test['value']);
            $sMime = ( is_null($test['mime']) ) ? 'empty' : $test['mime'];

            $pDownload = new \Foundation\Protocol\Download\CManager();
            $pDownload->send($pFile, $sMime, [ 'test' => true ]);
            $this->assertSame(false, true, $label . ' not expected');
            unset($pDownload, $pFile);
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\CManager::send
     * @group specification
     * @expectedException Foundation\Exception\InvalidArgumentException
     */
    public function testSendMimeException()
    {
        static $aException = [
        [ 'label' => 'TEST: 01', 'test'  => null ],
        [ 'label' => 'TEST: 02', 'test'  => '' ],
        [ 'label' => 'TEST: 03', 'test'  => 'text/css$azer' ],
        ];

        foreach ($aException as $data) {
            $label = $data['label'];
            $sMime = $data['test'];

            $pFile     = new \SplFileInfo(__FILE__);
            $pDownload = new \Foundation\Protocol\Download\CManager();
            $pDownload->send($pFile, $sMime, [ 'test' => true ]);
            $this->assertSame(false, true, $label . ' not expected');
            unset($pDownload, $pFile);
        }
    }

    /**
     * @covers \Foundation\Protocol\Download\CManager::send
     * @group specification
     */
    public function testSend()
    {
        foreach (static::$_aValid as $data) {
            $label    = &$data['label'];
            $test     = &$data['test'];
            $expected = &$data['expected'];

            $pFile = new \SplFileInfo($test['value']);
            $sMime = $test['mime'];

            $pDownload = new \Foundation\Protocol\Download\CManager([\Foundation\Protocol\Download\CManager::DEFAULT_SIZE ]);
            $this->assertSame($expected['send'], $pDownload->send($pFile, $sMime, [ 'test' => true ]), $label);
            unset($pDownload, $pFile);
        }
    }
}
