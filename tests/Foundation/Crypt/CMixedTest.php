<?php
namespace Test\Foundation\Crypt;

interface_exists('\Foundation\Crypt\CypherInterface') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CypherInterface.php'));
class_exists('\Foundation\Crypt\CMcryptAbstract') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CMcryptAbstract.php'));
class_exists('\Foundation\Crypt\CTripleDES') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CTripleDES.php'));
class_exists('\Foundation\Crypt\CRijndael') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CRijndael.php'));

class CMixedTest extends \PHPUnit_Framework_TestCase
{
    /** Tests section
     * ************** */

    /**
     * @group specification
     */
    public function testEncryptDecryptTripleDES2CRijndael()
    {
        static $sData      = 'cryptmeplease';
        static $skey       = 'thisisthekey';
        $pCypherIn  = new \Foundation\Crypt\CTripleDES();
        $sEncrypted = $pCypherIn->setkey($skey)->encrypt($sData);
        unset($pCypherIn);

        $pCypherOut = new \Foundation\Crypt\CRijndael();
        $sDecrypted = $pCypherOut->setkey($skey)->decrypt($sEncrypted);
        unset($pCypherOut);

        $this->assertNotSame($sData, $sDecrypted);
    }

    /**
     * @group specification
     */
    public function testEncryptDecryptCRijndael2TripleDES()
    {
        static $sData      = 'cryptmeplease';
        static $skey       = 'thisisthekey';
        $pCypherIn  = new \Foundation\Crypt\CRijndael();
        $sEncrypted = $pCypherIn->setkey($skey)->encrypt($sData);
        unset($pCypherIn);

        $pCypherOut = new \Foundation\Crypt\CTripleDES();
        $sDecrypted = $pCypherOut->setkey($skey)->decrypt($sEncrypted);
        unset($pCypherOut);

        $this->assertNotSame($sData, $sDecrypted);
    }
}
