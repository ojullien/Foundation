<?php
namespace Foundation\Test\Log;
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );
interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );
class_exists( '\Foundation\Type\Complex\CIp' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Complex/CIp.php' ) );
class_exists( '\Foundation\Type\Enum\CSeverity' ) || require( realpath( FOUNDATION_TYPE_PATH . '/Enum/CSeverity.php' ) );

defined( 'FOUNDATION_PROTOCOL_PATH' ) || define( 'FOUNDATION_PROTOCOL_PATH',
                                                 APPLICATION_PATH . '/src/Foundation/Protocol' );
class_exists( '\Foundation\Protocol\CRemoteAddress' ) || require( realpath( FOUNDATION_PROTOCOL_PATH . '/CRemoteAddress.php' ) );

defined( 'FOUNDATION_LOG_PATH' ) || define( 'FOUNDATION_LOG_PATH', APPLICATION_PATH . '/src/Foundation/Log' );
interface_exists( '\Foundation\Log\Writer\WriterInterface' ) || require( realpath( FOUNDATION_LOG_PATH . '/Writer/WriterInterface.php' ) );
class_exists( '\Foundation\Log\Writer\CWriterAbstract' ) || require( realpath( FOUNDATION_LOG_PATH . '/Writer/CWriterAbstract.php' ) );
class_exists( '\Foundation\Log\Writer\CNull' ) || require( realpath( FOUNDATION_LOG_PATH . '/Writer/CNull.php' ) );
class_exists( '\Foundation\Log\CMessage' ) || require( realpath( FOUNDATION_LOG_PATH . '/CMessage.php' ) );
class_exists( '\Foundation\Log\CLogger' ) || require( realpath( FOUNDATION_LOG_PATH . '/CLogger.php' ) );

class CLoggerTest extends \PHPUnit_Framework_TestCase
{

    protected static $_pLogger = null;

    public static function setUpBeforeClass()
    {
        self::$_pLogger = new \Foundation\Log\CLogger( new \Foundation\Log\Writer\CNull() );
    }

    public static function tearDownAfterClass()
    {
        self::$_pLogger = NULL;
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testLog()
    {
        self::$_pLogger->log( new \Foundation\Type\Enum\CSeverity(), 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testEmerg()
    {
        self::$_pLogger->emerg( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testAlert()
    {
        self::$_pLogger->alert( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testCrit()
    {
        self::$_pLogger->crit( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testErr()
    {
        self::$_pLogger->err( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testWarn()
    {
        self::$_pLogger->warn( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testNotice()
    {
        self::$_pLogger->notice( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testInfo()
    {
        self::$_pLogger->info( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

    /**
     * @covers \Foundation\Log\CLogger
     * @group specification
     */
    public function testDebug()
    {
        self::$_pLogger->debug( 'user', 'module', 'title', 'message' );
        $this->assertTrue( TRUE );
    }

}