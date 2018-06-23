<?php
namespace Foundation\Test\Framework\Provider;

final class CDataTestProvider
{

    const DATA_DIMENSION                   = 'data\dimension';
    const DATA_DIRECTORY                   = 'data\directory';
    const DATA_TYPE_BYTE                   = 'data\byte';
    const DATA_TYPE_BOOLEAN                = 'data\boolean';
    const DATA_TYPE_EMAILADDRESS_LOCALPART = 'data\emailaddress_localpart';
    const DATA_TYPE_FLOAT                  = 'data\float';
    const DATA_TYPE_HOSTNAME               = 'data\hostname';
    const DATA_TYPE_INT                    = 'data\integer';
    const DATA_TYPE_IP                     = 'data\ip';
    const DATA_TYPE_NOTSCALAR              = 'data\notscalar';
    const DATA_TYPE_NUMERIC                = 'data\numeric';
    const DATA_TYPE_PATH                   = 'data\path';
    const DATA_TYPE_RESOURCE               = 'data\resource';
    const DATA_TYPE_STRING                 = 'data\string';
    const DATA_TYPE_UTF8                   = 'data\utf8';
    const DATA_TYPE_XSS                    = 'data\xss';

    /** Class section
     * ************** */

    /**
     * Constructor.
     */
    private function __construct()
    {
        // Do nothing
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        $this->_aData = NULL;
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __set( $name, $value )
    {
        throw new \BadMethodCallException( 'Writing data to inaccessible properties is not allowed.' );
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __get( $name )
    {
        throw new \BadMethodCallException( 'Reading data from inaccessible properties is not allowed.' );
    }

    /**
     * Cloning is not allowed.
     *
     * @throws \BadMethodCallException
     * @codeCoverageIgnore
     */
    public function __clone()
    {
        throw new \BadMethodCallException( 'Cloning is not allowed.' );
    }

    /** Singleton section
     * ****************** */

    /**
     * Singleton
     *
     * @var \Foundation\Test\Framework\Provider\CTestData
     */
    private static $_pInstance = NULL;

    /**
     * Returns an instance of \Foundation\Test\Framework\Provider\CDataTestProvider.
     *
     * @return \Foundation\Test\Framework\Provider\CDataTestProvider
     */
    public static function GetInstance()
    {
        if( NULL === self::$_pInstance )
            self::$_pInstance = new \Foundation\Test\Framework\Provider\CDataTestProvider();

        return self::$_pInstance;
    }

    /**
     * Delete the current instance.
     *
     * @return void
     */
    public static function DeleteInstance()
    {
        if( NULL !== self::$_pInstance )
        {
            $tmp = self::$_pInstance;
            self::$_pInstance = NULL;
            unset( $tmp );
        }
    }

    /** DataTestProvider section
     * ************************* */

    /**
     * Data to test.
     *
     * @var array
     */
    private $_aData = [ ];

    /**
     *
     * @param string $sNamespace Namespace of the data to test.
     * @param array  $aResult    Expected results.
     * @return array
     */
    public function getTests( $sNamespace, array $aResult )
    {
        // Check results
        $iResultCount = count( $aResult );
        if( 0 === $iResultCount )
            throw new \InvalidArgumentException( 'The result argument is empty.' );

        // Check and load data
        $sNamespace = ( is_string( $sNamespace ) ) ? trim( $sNamespace ) : '';
        if( '' == $sNamespace )
            throw new \InvalidArgumentException( 'The data namespace argument is empty.' );

        if( !isset( $this->_aData[$sNamespace] ) )
            $this->_aData[$sNamespace] = require( realpath( __DIR__ . DIRECTORY_SEPARATOR . $sNamespace . '.php' ) );

        $aData = &$this->_aData[$sNamespace];

        $iDataCount = count( $aData );
        if( 0 === $iDataCount )
            throw new \InvalidArgumentException( 'No data to test.' );

        // Check data and result count
        if( $iDataCount !== $iResultCount )
            throw new \RuntimeException( 'Found ' . $iResultCount . ' results for ' . $iDataCount . ' tests.' );

        // Build the tests
        $aReturn = [ ];
        for( $iIndex = 0; $iIndex < $iDataCount; $iIndex++ )
        {
            $aReturn[] = array_merge( $aData[$iIndex], $aResult[$iIndex] );
        }

        // Check data and result count
        if( $iDataCount !== count( $aReturn ) )
            throw new \RuntimeException( 'Something bad happened.' );

        return $aReturn;
    }

}