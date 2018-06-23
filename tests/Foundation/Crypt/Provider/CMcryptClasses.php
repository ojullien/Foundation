<?php
namespace Test\Foundation\Crypt\Provider;
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Exception/ExceptionInterface.php' ) );

class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Exception/InvalidArgumentException.php' ) );

class_exists( '\Foundation\Exception\RuntimeException' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Exception/RuntimeException.php' ) );

interface_exists( '\Foundation\Crypt\CypherInterface' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Crypt/CypherInterface.php' ) );

class_exists( '\Foundation\Crypt\CMcryptAbstract' ) || require( realpath( APPLICATION_PATH . '/src/Foundation/Crypt/CMcryptAbstract.php' ) );

/**
 * Foundation Framework
 *
 * @package   Cryptography
 * @copyright (©) 2010-2013, Olivier Jullien <olivier.jullien@outlook.com>
 * @license   Private
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

final class CMcryptAlgoEmpty extends \Foundation\Crypt\CMcryptAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct()
    {
        parent::__construct( '', MCRYPT_MODE_OFB );
    }

    /** Cypher section
     * *************** */

    /**
     * Encrypt. Do nothing.
     */
    public function encrypt( $sData )
    {
        return $sData;
    }

    /**
     * Decrypt. Do nothing.
     */
    public function decrypt( $sData )
    {
        return $sData;
    }

}

final class CMcryptAlgoNotValid extends \Foundation\Crypt\CMcryptAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct()
    {
        parent::__construct( 'doesnotexists', MCRYPT_MODE_OFB );
    }

    /** Cypher section
     * *************** */

    /**
     * Encrypt. Do nothing.
     */
    public function encrypt( $sData )
    {
        return $sData;
    }

    /**
     * Decrypt. Do nothing.
     */
    public function decrypt( $sData )
    {
        return $sData;
    }

}

final class CMcryptModeEmpty extends \Foundation\Crypt\CMcryptAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct()
    {
        parent::__construct( MCRYPT_RIJNDAEL_256, '' );
    }

    /** Cypher section
     * *************** */

    /**
     * Encrypt. Do nothing.
     */
    public function encrypt( $sData )
    {
        return $sData;
    }

    /**
     * Decrypt. Do nothing.
     */
    public function decrypt( $sData )
    {
        return $sData;
    }

}

final class CMcryptModeNotValid extends \Foundation\Crypt\CMcryptAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct()
    {
        parent::__construct( MCRYPT_RIJNDAEL_256, 'doesnotexist' );
    }

    /** Cypher section
     * *************** */

    /**
     * Encrypt. Do nothing.
     */
    public function encrypt( $sData )
    {
        return $sData;
    }

    /**
     * Decrypt. Do nothing.
     */
    public function decrypt( $sData )
    {
        return $sData;
    }

}

final class CMcrypt extends \Foundation\Crypt\CMcryptAbstract
{
    /** Class section
     * ************** */

    /**
     * Constructor.
     *
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct()
    {
        parent::__construct( MCRYPT_3DES, MCRYPT_MODE_ECB );
    }

    /** Cypher section
     * *************** */

    /**
     * Encrypt. Do nothing.
     */
    public function encrypt( $sData )
    {
        return $sData;
    }

    /**
     * Decrypt. Do nothing.
     */
    public function decrypt( $sData )
    {
        return $sData;
    }

    /**
     * Returns the key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->_sKey;
    }

}