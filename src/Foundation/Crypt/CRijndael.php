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

/**
 * Simple RIJNDAEL-256 encryption cypher.
 *
 * @category   Foundation
 * @package    Cryptography
 * @subpackage Cypher
 * @version    1.0.0
 * @since      1.0.0
 */
final class CRijndael extends \Foundation\Crypt\CMcryptAbstract
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
        parent::__construct(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_OFB);
    }

    /** Cypher section
     * *************** */

    /**
     * Encrypt.
     *
     * @param string $sData Data to encrypt.
     * @return string Returns encrypted data.
     * @throws \Foundation\Exception\InvalidArgumentException Raises an Invalid Argument Exception if the argument is
     *                                                        not valid or if the encryption key was not specified.
     * @throws \Foundation\Exception\RuntimeException Raises a Runtime Exception if the cypher cannot be initialized.
     */
    public function encrypt($sData)
    {
        // Check parameter
        $sData = ( is_string($sData) ) ? trim($sData) : '';
        if ('' == $sData) {
            throw new \Foundation\Exception\InvalidArgumentException('The data to encrypt cannot be empty.');
        }

        // The key should be provided
        if ('' == $this->_sKey) {
            throw new \Foundation\Exception\InvalidArgumentException('No valid encryption key specified.');
        }

        // Creates the initialization vector (IV) from a random source
        $sInitializationVector = mcrypt_create_iv($this->_iIVSize, MCRYPT_DEV_RANDOM);

        // Initializes all buffers needed for encryption
        $iReturn = mcrypt_generic_init($this->_pResource, $this->_sKey, $sInitializationVector);
        if ($iReturn === false || $iReturn < 0) {
            throw new \Foundation\Exception\RuntimeException('Initializing all buffers needed for encryption failed with error code: ' . $iReturn);
        }

        // Encrypts data
        $sReturn = mcrypt_generic($this->_pResource, $sData);

        // Deinitializes the encryption module
        mcrypt_generic_deinit($this->_pResource);

        return $sInitializationVector . $sReturn;
    }

    /**
     * Decrypt.
     *
     * @param string $sData Data to decrypt.
     * @return string Returns decrypted data.
     * @throws \Foundation\Exception\InvalidArgumentException Raises an Invalid Argument Exception if the argument is
     *                                                        not valid or if the encryption key was not specified.
     * @throws \Foundation\Exception\RuntimeException Raises a Runtime Exception if the cypher cannot be initialized.
     */
    public function decrypt($sData)
    {
        // Initialize
        $sReturn = '';

        // Check parameter
        if (! is_string($sData) || ('' == $sData)) {
            throw new \Foundation\Exception\InvalidArgumentException('The data to encrypt cannot be empty.');
        }

        // The key should be provided
        if ('' == $this->_sKey) {
            throw new \Foundation\Exception\InvalidArgumentException('No valid encryption key specified.');
        }

        // Minimum length
        if (strlen($sData) > $this->_iIVSize) {
            // Retrieve the initialization vector (IV) from the data.
            $pInitializationVector = substr($sData, 0, $this->_iIVSize);

            // Initializes all buffers needed for encryption
            $iReturn = mcrypt_generic_init($this->_pResource, $this->_sKey, $pInitializationVector);
            if ($iReturn === false || $iReturn < 0) {
                throw new \Foundation\Exception\RuntimeException('Initializing all buffers needed for encryption failed with error code: ' . $iReturn);
            }

            // Decrypts data
            $sData   = substr($sData, $this->_iIVSize);
            $sReturn = rtrim(mdecrypt_generic($this->_pResource, $sData), "\0");

            // Deinitializes the encryption module
            mcrypt_generic_deinit($this->_pResource);
        }

        return $sReturn;
    }
}
