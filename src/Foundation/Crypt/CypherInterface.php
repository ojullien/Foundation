<?php
namespace Foundation\Crypt;
/**
 * Foundation Framework
 *
 * @package   Cryptography
 * @copyright (©) 2010-2013, Olivier Jullien <https://github.com/ojullien>
 * @license   MIT <https://github.com/ojullien/Foundation/blob/master/LICENSE>
 */
if( !defined( 'APPLICATION_VERSION' ) )
    die( '-1' );

/**
 * Interface class for cypher implementation.
 *
 * @category   Foundation
 * @package    Cryptography
 * @subpackage Cypher
 * @version    1.0.0
 * @since      1.0.0
 */
interface CypherInterface
{

    /**
     * Set the encryption key.
     *
     * @param string $sKey The encryption key.
     * @return \Foundation\Crypt\Cypher\CypherInterface
     * @throws \Foundation\Exception\InvalidArgumentException Raises an InvalidArgumentException exception if the
     *                                                        argument is not valid.
     */
    public function setKey( $sKey );

    /**
     * Encrypt.
     *
     * @param string $sData Data to encrypt.
     * @return string Returns encrypted data.
     * @throws \Foundation\Exception\InvalidArgumentException Raises an Invalid Argument Exception if the argument is
     *                                                        not valid.
     * @throws \Foundation\Exception\RuntimeException Raises a Runtime Exception if the cypher cannot be initialized.
     */
    public function encrypt( $sData );

    /**
     * Decrypt.
     *
     * @param string $sData Data to decrypt.
     * @return string Returns decrypted data.
     * @throws \Foundation\Exception\InvalidArgumentException Raises an Invalid Argument Exception if the argument is
     *                                                        not valid.
     * @throws \Foundation\Exception\RuntimeException Raises a Runtime Exception if the cypher cannot be initialized.
     */
    public function decrypt( $sData );
}
