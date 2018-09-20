<?php
namespace Foundation\Test\Log\Writer;

defined('FOUNDATION_EXCEPTION_PATH') || define(
    'FOUNDATION_EXCEPTION_PATH',
    APPLICATION_PATH . '/src/Foundation/Exception'
);
interface_exists('\Foundation\Exception\ExceptionInterface') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
class_exists('\Foundation\Exception\InvalidArgumentException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');
interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));
class_exists('\Foundation\Type\Complex\CPath') || require(realpath(FOUNDATION_TYPE_PATH . '/Complex/CPath.php'));
class_exists('\Foundation\Type\Enum\CSeverity') || require(realpath(FOUNDATION_TYPE_PATH . '/Enum/CSeverity.php'));

defined('FOUNDATION_PROTOCOL_PATH') || define(
    'FOUNDATION_PROTOCOL_PATH',
    APPLICATION_PATH . '/src/Foundation/Protocol'
);
class_exists('\Foundation\Protocol\CRemoteAddress') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/CRemoteAddress.php'));

defined('FOUNDATION_LOG_PATH') || define('FOUNDATION_LOG_PATH', APPLICATION_PATH . '/src/Foundation/Log');
interface_exists('\Foundation\Log\Writer\WriterInterface') || require(realpath(FOUNDATION_LOG_PATH . '/Writer/WriterInterface.php'));
class_exists('\Foundation\Log\Writer\CWriterAbstract') || require(realpath(FOUNDATION_LOG_PATH . '/Writer/CWriterAbstract.php'));
class_exists('\Foundation\Log\Writer\CFile') || require(realpath(FOUNDATION_LOG_PATH . '/Writer/CFile.php'));
class_exists('\Foundation\Log\Writer\CNull') || require(realpath(FOUNDATION_LOG_PATH . '/Writer/CNull.php'));
class_exists('\Foundation\Log\CMessage') || require(realpath(FOUNDATION_LOG_PATH . '/CMessage.php'));

class_exists('\Foundation\Test\Framework\Provider\CDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php'));

class CFileTest extends \PHPUnit_Framework_TestCase
{
    /** Class section
     * *************** */

    /**
     * Loads data.
     */
    public static function setUpBeforeClass()
    {
        $aTests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_PATH,
            require(realpath(__DIR__ . '/../../Type/Complex/provider/result/cpath.php'))
        );

        foreach ($aTests as $test) {
            if (false === $test['expected']['isvalid']['return']) {
                static::$_aTests[] = $test;
            }
        }
    }

    /** Test section
     * ************* */

    /**
     * Data for test
     * @var array
     */
    public static $_aTests = null;

    /**
     * @covers \Foundation\Log\Writer\CFile::__construct
     * @group specification
     */
    public function testPathException()
    {
        foreach (static::$_aTests as $data) {
            $label = &$data['label'];
            $value = &$data['test'];
            try {
                $pObject = new \Foundation\Log\Writer\CFile(new \Foundation\Type\Complex\CPath($value));
                unset($pObject);
                $this->fail($label . ' No exception raised.');
            } catch (\Foundation\Exception\InvalidArgumentException $exc) {
                $this->assertTrue(true);
            } catch (\Exception $exc) {
                $this->fail($label . ' No the expected exception.');
            }
        }
    }

    /**
     * @covers \Foundation\Log\Writer\CFile
     * @covers \Foundation\Log\Writer\CWriterAbstract
     * @group specification
     */
    public function testCFile()
    {
        $sFileName = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'todelete.log';
        $pMessage  = new \Foundation\Log\CMessage(new \Foundation\Type\Enum\CSeverity());
        $pFileName = new \Foundation\Type\Complex\CPath($sFileName);
        $pFile     = new \Foundation\Log\Writer\CFile($pFileName);
        $pNull     = new \Foundation\Log\Writer\CNull();
        $pFile->setSuccessor($pNull);
        $pFile->write($pMessage);
        $pFile->shutdown();
        unset($pFile, $pFileName, $pMessage);
        $this->assertTrue(unlink($sFileName), 'unlink');
    }
}
