<?php
namespace Test\Foundation\Crypt;

trait_exists('\Test\Foundation\Crypt\Provider\TCryptDataProvider') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Crypt/Provider/TCryptDataProvider.php'));

interface_exists('\Foundation\Crypt\CypherInterface') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CypherInterface.php'));
class_exists('\Foundation\Crypt\CMcryptAbstract') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CMcryptAbstract.php'));
class_exists('\Foundation\Crypt\CTripleDES') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CTripleDES.php'));

class CTripleDESTest extends \PHPUnit_Framework_TestCase
{

    use \Test\Foundation\Crypt\Provider\TCryptDataProvider;

    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Crypt\CTripleDES::encrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testEncryptDataException()
    {
        $pCypher = new \Foundation\Crypt\CTripleDES();
        $pCypher->encrypt('  ');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CTripleDES::encrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testEncryptKeyException()
    {
        $pCypher = new \Foundation\Crypt\CTripleDES();
        $pCypher->encrypt('not empty');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CTripleDES::decrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testDecryptDataException()
    {
        $pCypher = new \Foundation\Crypt\CTripleDES();
        $pCypher->decrypt('  ');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CTripleDES::decrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testDecryptKeyException()
    {
        $pCypher = new \Foundation\Crypt\CTripleDES();
        $pCypher->decrypt('not empty');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CTripleDES
     * @group specification
     * @dataProvider getCryptData
     */
    public function testEncryptDecrypt($sLabel, $sData)
    {
        $pCypherIn  = new \Foundation\Crypt\CTripleDES();
        $sEncrypted = $pCypherIn->setkey($this->getCryptKey())->encrypt($sData);
        unset($pCypherIn);

        $pCypherOut = new \Foundation\Crypt\CTripleDES();
        $sDecrypted = $pCypherOut->setkey($this->getCryptKey())->decrypt($sEncrypted);
        unset($pCypherOut);

        $this->assertSame($sData, $sDecrypted, $sLabel);
    }

    /**
     * @group specification
     */
    public function testEncryptDecryptNotTheSameKey()
    {
        static $sData      = 'cryptmeplease';
        $pCypherIn  = new \Foundation\Crypt\CTripleDES();
        $sEncrypted = $pCypherIn->setkey('thegoodkey')->encrypt($sData);
        unset($pCypherIn);

        $pCypherOut = new \Foundation\Crypt\CTripleDES();
        $sDecrypted = $pCypherOut->setkey('thefalsekey')->decrypt($sEncrypted);
        unset($pCypherOut);

        $this->assertNotSame($sData, $sDecrypted);
    }
}
