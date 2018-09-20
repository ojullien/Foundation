<?php
namespace Foundation\Crypt;

/**
 * Foundation Framework
 *
 * @package   Cryptography
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if (! defined('APPLICATION_VERSION')) {
    die('-1');
}

if (! extension_loaded('mcrypt')) {
    die('The Mcrypt extension is not loaded.');
}

/**
 * Parent class for cypher using Mcrypt extension.
 *
 * @category   Foundation
 * @package    Cryptography
 * @subpackage Cypher
 * @version    1.0.0
 * @since      1.0.0
 */
abstract class CMcryptAbstract implements \Foundation\Crypt\CypherInterface
{
    /** Class section
     * ************** */

    /**
     * Class unique ID
     * @var string
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    protected $_sDebugID = '';

    /**
     * Constructor.
     *
     * @param string $sAlgo The encryption algorithm (cipher).
     * @param string $sMode The cipher mode.
     * @throws \Foundation\Exception\InvalidArgumentException Raises an InvalidArgumentException exception if one
     *                                                        argument, at least, is not valid.
     * @throws \Foundation\Exception\RuntimeException Raises a RuntimeException exception if the specified algorithm or
     *                                                mode is not supported by Mcrypt.
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __construct($sAlgo, $sMode)
    {
        // @codeCoverageIgnoreStart
        $this->_sDebugID = uniqid('cmcryptabstract', true);
        defined('FOUNDATION_DEBUG') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->add(
                    $this->_sDebugID,
                    __CLASS__,
                    [ $sAlgo, $sMode ]
                );
        // @codeCoverageIgnoreEnd

        $this->_sAlgo = ( is_string($sAlgo) ) ? trim($sAlgo) : '';
        if ('' == $this->_sAlgo) {
            throw new \Foundation\Exception\InvalidArgumentException('No valid encryption algorithm specified.');
        }

        $this->_sMode = ( is_string($sMode) ) ? trim($sMode) : '';
        if ('' == $this->_sMode) {
            throw new \Foundation\Exception\InvalidArgumentException('No valid encryption mode specified.');
        }

        // Opens the module of the algorithm and the mode to be used
        $this->_pResource = mcrypt_module_open($this->_sAlgo, '', $this->_sMode, '');
        if (! is_resource($this->_pResource)) {
            throw new \Foundation\Exception\RuntimeException('The algorithm and/or mode is not supported.');
        }

        // Get the maximum supported keysize of the opened mode
        $this->_iKeySize = mcrypt_enc_get_key_size($this->_pResource);

        // Get the size of the IV of the opened algorithm
        $this->_iIVSize = mcrypt_enc_get_iv_size($this->_pResource);
    }

    /**
     * Destructor.
     *
     * @codeCoverageIgnore
     * @todo DEBUG MEMORY DUMP. SHALL BE DELETED
     */
    public function __destruct()
    {
        // Closes the encryption module
        if (is_resource($this->_pResource)) {
            mcrypt_module_close($this->_pResource);
        }

        $this->_pResource = null;

        // @codeCoverageIgnoreStart
        defined('FOUNDATION_DEBUG') && ! defined('FOUNDATION_DEBUG_OFF') &&
                \Foundation\Debug\CDebugger::getInstance()->getMemorizer()->delete($this->_sDebugID);
        // @codeCoverageIgnoreEnd
    }

    /**
     * Writing data to inaccessible properties is not allowed.
     *
     * @param string $name
     * @param mixed  $value
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __set($name, $value)
    {
        throw new \Foundation\Exception\BadMethodCallException('Writing data to inaccessible properties is not allowed.');
    }

    /**
     * Reading data from inaccessible properties is not allowed.
     *
     * @param string $name
     * @throws \Foundation\Exception\BadMethodCallException
     * @codeCoverageIgnore
     */
    final public function __get($name)
    {
        throw new \Foundation\Exception\BadMethodCallException('Reading data from inaccessible properties is not allowed.');
    }

    /** Mcrypt section
     * *************** */

    /**
     * Encryption algorithm
     *
     * @var string
     */
    protected $_sAlgo = '';

    /**
     * Encryption mode
     *
     * @var string
     */
    protected $_sMode = '';

    /**
     * Resource of the module of the algorithm to be used.
     *
     * @var Resource
     */
    protected $_pResource = null;

    /**
     * Initialization vector size.
     *
     * @var integer
     */
    protected $_iIVSize = 0;

    /**
     * Encryption key size.
     *
     * @var integer
     */
    protected $_iKeySize = 0;

    /** Cypher section
     * *************** */

    /**
     * Encryption key.
     *
     * @var string
     */
    protected $_sKey = '';

    /**
     * Set the encryption key.
     *
     * @param string $sKey The encryption key.
     * @return \Foundation\Crypt\Cypher\CypherInterface
     * @throws \Foundation\Exception\InvalidArgumentException Raises an InvalidArgumentException exception if the
     *                                                        argument is not valid.
     */
    final public function setKey($sKey)
    {
        // Check parameter
        $this->_sKey = ( is_string($sKey) ) ? trim($sKey) : '';

        if ('' == $this->_sKey) {
            throw new \Foundation\Exception\InvalidArgumentException('No valid encryption key specified.');
        }

        // Creates the key with the good size.
        $this->_sKey = substr(md5($sKey), 0, $this->_iKeySize);

        return $this;
    }
}
