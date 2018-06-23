<?php

final class CProviderFactory
{
    /** Constantes */

    const KEY_TEST   = 0;
    const KEY_RESULT = 1;

    /** Providers */
    const PROVIDER_TYPE_BOOLEAN                         = 'type.boolean';
    const PROVIDER_TYPE_NOTSCALAR                       = 'type.notscalar';
    const PROVIDER_TYPE_NUMERIC                         = 'type.numeric';
    const PROVIDER_TYPE_STRING                          = 'type.string';
    const PROVIDER_STRING_UTF8                          = 'string.utf8';
    const PROVIDER_STRING_XSS                           = 'string.xss';
    const PROVIDER_NUMERIC_MINMAX                       = 'numeric.minmax';
    const PROVIDER_FOUNDATION_TYPE_CBYTE                = 'foundation.type.cbyte';
    const PROVIDER_FOUNDATION_TYPE_CEMAILADDRESS_LOCAL  = 'foundation.type.cemailaddress.local';
    const PROVIDER_FOUNDATION_TYPE_CHOSTNAME            = 'foundation.type.chostname';
    const PROVIDER_FOUNDATION_TYPE_CIP                  = 'foundation.type.cip';
    const PROVIDER_FOUNDATION_FILE_DIRECTORY            = 'foundation.file.directory';
    const PROVIDER_FOUNDATION_FILE_PATH                 = 'foundation.file.path';
    const PROVIDER_FOUNDATION_GD_CDIMENSION             = 'foundation.gd.cdimension';
    const PROVIDER_RESOURCE                             = 'resource';

    /** Classes */
    const CLASS_TYPE_CIP                       = 'cip';
    const CLASS_TYPE_CBYTE                     = 'cbyte';
    const CLASS_TYPE_CEMAILADDRESS             = 'cemailaddress';
    const CLASS_TYPE_CEMAILADDRESS_LOCAL       = 'cemailaddress.localpart';
    const CLASS_TYPE_CHOSTNAME                 = 'chostname';
    const CLASS_TYPE_CSEVERITY                 = 'cseverity';
    const CLASS_TYPE_CFLOAT                    = 'cfloat';
    const CLASS_TYPE_CINT                      = 'cint';
    const CLASS_TYPE_CPATH                     = 'cpath';
    const CLASS_TYPE_CSTRING                   = 'cstring';
    const CLASS_GD_CDIMENSION                  = 'cdimension';
    const CLASS_GD_CRESOURCE                   = 'cresource';
    const CLASS_HTTP_DOWNLOAD_CDOWNLOADMANAGER = 'cdownloadmanager';
    const CLASS_HTTP_DOWNLOAD_CDOWNLOADIMAGE   = 'cdownloadimage';
    const CLASS_HTTP_DOWNLOAD_CDOWNLOADAUDIO   = 'cdownloadaudio';
    const CLASS_FILE_CDIRECTORY                = 'cdirectory';
    const CLASS_SESSION_CMANAGER               = 'csessionmanager';

    /** Class methods
     * ************** */

    /**
     * Constructor
     *
     * @param string $provider
     * @param string $class
     * @throws \InvalidArgumentException
     */
    public function __construct( $provider, $class )
    {
        // Create array
        $this->_aTests = new \SplFixedArray( 2 );

        // Include provider
        $provider = ( is_string( $provider ) ) ? trim( $provider ) : '';
        if( strlen( $provider ) > 0 )
        {
            include( __DIR__ . DIRECTORY_SEPARATOR . $provider . DIRECTORY_SEPARATOR . 'tests.php' );
        }
        else
        {
            throw new \InvalidArgumentException( 'Invalid provider.' );
        }

        // Include class
        $class = ( is_string( $class ) ) ? trim( $class ) : '';
        if( strlen( $class ) > 0 )
        {
            include( __DIR__ . DIRECTORY_SEPARATOR . $provider
                    . DIRECTORY_SEPARATOR . 'classes'
                    . DIRECTORY_SEPARATOR . $class . '.php' );
        }
        else
        {
            throw new \InvalidArgumentException( 'Invalid class.' );
        }
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        unset( $this->_aTests );
    }

    /**
     * Convert to string
     *
     * @return string
     */
    public function __toString()
    {
        return print_r( $this->_aTests, TRUE );
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

    /** Provider factory methods
     * ************************* */

    /**
     * Test values
     * @var \SplFixedArray
     */
    private $_aTests = NULL;

    /**
     * Returns all the data needed for the $class tests
     * @throws \InvalidArgumentException
     * @return array
     */
    public function get()
    {
        // Initialize
        $return = array( );
        $iCountTest   = -1;
        $iCountResult = -1;
        // Build tests and results
        if( isset( $this->_aTests[self::KEY_TEST] ) && isset( $this->_aTests[self::KEY_RESULT] ) )
        {
            $iCountTest   = count( $this->_aTests[self::KEY_TEST] );
            $iCountResult = count( $this->_aTests[self::KEY_RESULT] );
            for( $index = 0; $index < $iCountTest; $index++ )
            {
                $return[] = array_merge( $this->_aTests[self::KEY_TEST][$index]
                        , $this->_aTests[self::KEY_RESULT][$index] );
            }//for(...
        }//if( isset(...
        // Check
        if( ($iCountTest !== $iCountResult) || ($iCountTest !== count( $return ) ) )
        {
            throw new \RuntimeException( 'Something bad happened.' );
        }//if(...

        return $return;
    }

}