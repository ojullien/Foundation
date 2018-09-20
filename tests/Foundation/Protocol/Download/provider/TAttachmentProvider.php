<?php
namespace Foundation\Test\Protocol\Download\Provider;

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
class_exists('\Foundation\Protocol\Download\Attachment\CAttachmentAbstract') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/Download/Attachment/CAttachmentAbstract.php'));

class_exists('\Foundation\Test\Framework\Provider\CDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php'));

trait TAttachmentProvider
{
    /** Class section
     * *************** */

    /**
     * Loads object.
     */
    public static function setUpBeforeClass()
    {
        static::$_pDownloadManager = new \Foundation\Protocol\Download\CManager();

        $tests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_RESOURCE,
            require(realpath(self::getResultPath() . '.php'))
        );

        foreach ($tests as $test) {
            $expected = &$test['expected'];

            if ($expected['fromextensionexception'] != 0) {
                static::$_aFromExtensionException[] = $test;
            } else {
                static::$_aFromExtensionValid[] = $test;
            }

            if ($expected['fromfileexception'] != 0) {
                static::$_aFromFileException[] = $test;
            } else {
                static::$_aFromFileValid[] = $test;
            }
        }
    }

    /**
     * Unloads test data.
     */
    public static function tearDownAfterClass()
    {
        static::$_pDownloadManager = null;
    }

    /** Test section
     * ************* */

    /**
     * Instance of Download manager
     * @var \Foundation\Protocol\Download\ManagerInterface
     */
    public static $_pDownloadManager = null;

    /**
     * Data for extension exception
     * @var array
     */
    public static $_aFromExtensionException = null;

    /**
     * Data for file
     * @var array
     */
    public static $_aFromFileException = null;

    /**
     * Valid data from extension
     * @var array
     */
    public static $_aFromExtensionValid = null;

    /**
     * Valid data from file
     * @var array
     */
    public static $_aFromFileValid = null;
}
