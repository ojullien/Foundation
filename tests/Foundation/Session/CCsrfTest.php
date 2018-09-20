<?php
namespace Foundation\Test\Session\Storage;

defined('FOUNDATION_EXCEPTION_PATH') || define(
    'FOUNDATION_EXCEPTION_PATH',
    APPLICATION_PATH . '/src/Foundation/Exception'
);
interface_exists('\Foundation\Exception\ExceptionInterface') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php'));
class_exists('\Foundation\Exception\InvalidArgumentException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php'));
class_exists('\Foundation\Exception\BadMethodCallException') || require(realpath(FOUNDATION_EXCEPTION_PATH . '/BadMethodCallException.php'));

defined('FOUNDATION_TYPE_PATH') || define('FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type');
interface_exists('\Foundation\Type\TypeInterface') || require(realpath(FOUNDATION_TYPE_PATH . '/TypeInterface.php'));
class_exists('\Foundation\Type\CTypeAbstract') || require(realpath(FOUNDATION_TYPE_PATH . '/CTypeAbstract.php'));
class_exists('\Foundation\Type\Simple\CString') || require(realpath(FOUNDATION_TYPE_PATH . '/Simple/CString.php'));

defined('FOUNDATION_SESSION_PATH') || define(
    'FOUNDATION_SESSION_PATH',
    APPLICATION_PATH . '/src/Foundation/Session'
);
interface_exists('\Foundation\Session\Storage\StorageInterface') || require(realpath(FOUNDATION_SESSION_PATH . '/Storage/StorageInterface.php'));
class_exists('\Foundation\Session\Storage\CArray') || require(realpath(FOUNDATION_SESSION_PATH . '/Storage/CArray.php'));
class_exists('\Foundation\Session\CCsrf') || require(realpath(FOUNDATION_SESSION_PATH . '/CCsrf.php'));

class CCsrfTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Foundation\Session\Storage\CArray
     */
    protected $storage;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->storage = new \Foundation\Session\Storage\CArray();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->storage = null;
    }

    /**
     * @covers \Foundation\Session\CCsrf
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testSaveException()
    {
        $container = new \Foundation\Session\CCsrf($this->storage);
        $container->save();
        unset($container);
    }

    /**
     * @covers \Foundation\Session\CCsrf
     * @group specification
     * @expectedException Foundation\Exception\BadMethodCallException
     */
    public function testIsValidException()
    {
        $container = new \Foundation\Session\CCsrf($this->storage);
        $container->isValid((string)$container);
        unset($container);
    }

    /**
     * @covers \Foundation\Session\CCsrf
     * @group specification
     */
    public function testSave()
    {
        $token          = md5(uniqid(rand(), true));
        $this->storage->start();
        $container      = new \Foundation\Session\CCsrf($this->storage);
        $generatedtoken = (string)$container->getToken();

        $this->assertFalse($container->isValid($generatedtoken), 'isValid');

        $container->save();
        $this->assertSame(
            $this->storage->getOffset(\Foundation\Session\CCsrf::UID, APPLICATION_NAME),
            $container->getToken(),
            'getToken'
        );
        $this->assertTrue($container->isValid($generatedtoken), 'isValid after save');

        $this->assertFalse($container->isValid($token), 'isValid after update');

        $this->assertTrue($container->isValid($generatedtoken), 'isValid after reset');

        $this->assertFalse($container->isValid('notvalid'), 'isValid after notvalid');

        unset($container);
    }
}
