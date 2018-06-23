<?php namespace Foundation\Debug;
/**
 * Foundation Framework
 *
 * @package   Debug
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined('APPLICATION_NAME') )
    die('-1');

/**
 * This class implements usefull methods for profiling memory allocation and script execution.
 *
 * @category Foundation
 * @package  Debug
 * @version  1.0.0
 * @since    1.0.0
 * @codeCoverageIgnore
 */
final class CDebugger
{
    /** Constants */
    const DEFAULT_VALUE = NULL;
    const QUERY = 1;
    const COOKIE = 2;
    const SESSION = 4;
    const MEMORY = 8;
    const HEADERS = 16;

    /** Singleton pattern
     ********************/

    /**
     * Singleton
     * @var \Foundation\Debug\CDebug
     */
    private static $_pInstance = self::DEFAULT_VALUE;

    /**
     * Constructor.
     */
    private function __construct(){}

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset( $this->_pCookie, $this->_pSession, $this->_pPost, $this->_pGet );
    }

    /**
     * Clone is not allowed.
     *
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __clone()
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Cloning is not allowed.' );
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed $value
     * @throws \Foundation\Exception\BadMethodCallException
     */
    public function __set($name, $value)
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @codeCoverageIgnore
     */
    public function __get( $name )
    {
        throw new \Foundation\Exception\BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /**
     * Retrieves the default class instance.
     *
     * @return \Foundation\Debug\CDebug
     */
    public static function getInstance()
    {
        if( !isset(self::$_pInstance) )
        {
            self::$_pInstance = new \Foundation\Debug\CDebugger();
        }
        return self::$_pInstance;
    }

    /**
     * Deletes instance
     */
    public static function deleteInstance()
    {
        if( isset(self::$_pInstance) )
        {
            $tmp=self::$_pInstance;
            self::$_pInstance=self::DEFAULT_VALUE;
            unset($tmp);
        }//if( isset(...
        if( !defined('FOUNDATION_DEBUG_OFF') )
        {
            define('FOUNDATION_DEBUG_OFF',1);
        }//if( !defined(...
    }

    /** Superglobal variables
     ************************/

    /**
     * Get state
     * @var \Foundation\Debug\Variable\CContainer
     */
    private $_pGet = self::DEFAULT_VALUE;

    /**
     * Set GET.
     *
     * @param \Foundation\Debug\Variable\CContainer $pVariable
     */
    public function setVariableGet( \Foundation\Debug\Variable\CContainer $pVariable )
    {
        $this->_pGet = $pVariable;
    }

    /**
     * Post state
     * @var \Foundation\Debug\Variable\CContainer
     */
    private $_pPost = self::DEFAULT_VALUE;

    /**
     * Set POST.
     *
     * @param \Foundation\Debug\Variable\CContainer $pVariable
     */
    public function setVariablePost( \Foundation\Debug\Variable\CContainer $pVariable )
    {
        $this->_pPost = $pVariable;
    }

    /**
     * Cookie state
     * @var \Foundation\Debug\Variable\CContainer
     */
    private $_pCookie = self::DEFAULT_VALUE;

    /**
     * Set COOKIE.
     *
     * @param \Foundation\Debug\Variable\CContainer $pVariable
     */
    public function setVariableCookie( \Foundation\Debug\Variable\CContainer $pVariable )
    {
        $this->_pCookie = $pVariable;
    }

    /**
     * Session state
     * @var \Foundation\Debug\Variable\CContainer
     */
    private $_pSession = self::DEFAULT_VALUE;

    /**
     * Set SESSION.
     *
     * @param \Foundation\Debug\Variable\CContainer $pVariable
     */
    public function setVariableSession( \Foundation\Debug\Variable\CContainer $pVariable )
    {
        $this->_pSession = $pVariable;
    }

    /** Memorizer
     ************/

    /**
     * Memorizer
     * @var \Foundation\Debug\Memory\CMemorizer
     */
    private $_pMemorizer = self::DEFAULT_VALUE;

    /**
     * Set the memorizer.
     *
     * @param \Foundation\Debug\Memory\CMemorizer $pTimeManager
     */
    public function setMemorizer( \Foundation\Debug\Memory\CMemorizer $pMemorizer )
    {
        $this->_pMemorizer = $pMemorizer;
    }

    /**
     * Get the memorizer.
     *
     * @return \Foundation\Debug\Memory\CMemorizer
     */
    public function getMemorizer()
    {
        return $this->_pMemorizer;
    }

    /** Time manager
     ***************/

    /**
     * Time manager
     * @var \Foundation\Debug\Timer\TimerInterface
     */
    private $_pTimeManager = self::DEFAULT_VALUE;

    /**
     * Set time manager.
     *
     * @param \Foundation\Debug\Timer\TimerInterface $pTimeManager
     */
    public function setTimeManager( \Foundation\Debug\Timer\TimerInterface $pTimeManager )
    {
        $this->_pTimeManager = $pTimeManager;
    }

    /**
     * Stop the timer. Returns the script duration in seconds, with microsecond's precision.
     *
     * @return float
     */
    public function stopTimer()
    {
        $fReturn = 0.0;
        if( isset($this->_pTimeManager) )
        {
            $fReturn = $this->_pTimeManager->stopTime();
        }
        return $fReturn;
    }

    /** Rendering section
     ********************/

    /**
     * Returns debug information in human readable format.
     *
     * @param \Foundation\Debug\RenderInterface $pRender
     * @param type $iDisplay [OPTIONAL] Display more informations. Combinaison of QUERY, COOKIE, SESSION, HEADERS and MEMORY
     * @return string
     */
    public function render( \Foundation\Debug\Render\RenderInterface $pRender, $iDisplay = 0 )
    {
        $sReturn = $pRender->renderPrecondition();
        $sReturn .= $pRender->renderUsage( $this->_pTimeManager->getScriptDuration(),
                                           $this->_pMemorizer->getMemoryPeakUsage(),
                                           $this->_pMemorizer->getMemoryUsage() );
       if( $iDisplay & self::HEADERS )
        {
           $sReturn .= $pRender->renderHeader( headers_list() );
        }
        if( $iDisplay & self::QUERY )
        {
            $sReturn .= $pRender->renderVariable( 'get', $this->_pGet->compare( isset($_GET)?$_GET:array() ));
            $sReturn .= $pRender->renderVariable( 'post', $this->_pPost->compare( isset($_POST)?$_POST:array() ));
        }
        if( $iDisplay & self::COOKIE )
        {
            $sReturn .= $pRender->renderVariable( 'cookie', $this->_pCookie->compare(isset($_COOKIE)?$_COOKIE:array()));
        }
        if( $iDisplay & self::SESSION )
        {
            $sReturn .= $pRender->renderSessionConfiguration();
            $sReturn .= $pRender->renderVariable( 'session',
                                                  $this->_pSession->compare(isset($_SESSION)?$_SESSION:array()));
        }
        if( $iDisplay & self::MEMORY )
        {
            $sReturn .= $pRender->renderMemory( $this->_pTimeManager->getScriptDuration(), $this->_pMemorizer->getData() );
        }
        $sReturn .= $pRender->renderPostcondition();
        return $sReturn;
    }

}
define( 'FOUNDATION_DEBUG', 1 );

// Create time manager
if( function_exists( 'xdebug_time_index' ) )
{
    $DebugTimeManager = new \Foundation\Debug\Timer\CXDebug();
}
else
{
    $DebugTimeManager = new \Foundation\Debug\Timer\CCore();
}

// Create memory manager
if( function_exists( 'xdebug_memory_usage' ) && function_exists( 'xdebug_peak_memory_usage' ) )
{
    $DebugMemoryManager = new \Foundation\Debug\Memory\CXDebug();
}
else
{
    $DebugMemoryManager = new \Foundation\Debug\Memory\CCore();
}

// Create memorizer
$DebugMemorizer =  new \Foundation\Debug\Memory\CMemorizer( $DebugTimeManager, $DebugMemoryManager );

// Create debugger
\Foundation\Debug\CDebugger::getInstance()->setTimeManager( $DebugTimeManager );
\Foundation\Debug\CDebugger::getInstance()->setMemorizer( $DebugMemorizer );

// Create container for superglobal variables
\Foundation\Debug\CDebugger::getInstance()->setVariableCookie(
        new \Foundation\Debug\Variable\CContainer( (isset($_COOKIE)) ? $_COOKIE : array() ) );
\Foundation\Debug\CDebugger::getInstance()->setVariableSession(
        new \Foundation\Debug\Variable\CContainer( (isset($_SESSION)) ? $_SESSION : array() ) );
\Foundation\Debug\CDebugger::getInstance()->setVariableGet(
        new \Foundation\Debug\Variable\CContainer( (isset($_GET)) ? $_GET : array() ) );
\Foundation\Debug\CDebugger::getInstance()->setVariablePost(
        new \Foundation\Debug\Variable\CContainer( (isset($_POST)) ? $_POST : array() ) );