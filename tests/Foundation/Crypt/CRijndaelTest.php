<?php
namespace Test\Foundation\Crypt;

trait_exists('\Test\Foundation\Crypt\Provider\TCryptDataProvider') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Crypt/Provider/TCryptDataProvider.php'));

interface_exists('\Foundation\Crypt\CypherInterface') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CypherInterface.php'));
class_exists('\Foundation\Crypt\CMcryptAbstract') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CMcryptAbstract.php'));
class_exists('\Foundation\Crypt\CRijndael') || require(realpath(APPLICATION_PATH . '/src/Foundation/Crypt/CRijndael.php'));

class CRijndaelTest extends \PHPUnit_Framework_TestCase
{

    use \Test\Foundation\Crypt\Provider\TCryptDataProvider;

    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Crypt\CRijndael::encrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testEncryptDataException()
    {
        $pCypher = new \Foundation\Crypt\CRijndael();
        $pCypher->encrypt('  ');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CRijndael::encrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testEncryptKeyException()
    {
        $pCypher = new \Foundation\Crypt\CRijndael();
        $pCypher->encrypt('not empty');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CRijndael::decrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testDecryptDataException()
    {
        $pCypher = new \Foundation\Crypt\CRijndael();
        $pCypher->decrypt('  ');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CRijndael::decrypt
     * @group specification
     * @expectedException \InvalidArgumentException
     */
    public function testDecryptKeyException()
    {
        $pCypher = new \Foundation\Crypt\CRijndael();
        $pCypher->decrypt('not empty');
        unset($pCypher);
    }

    /**
     * @covers \Foundation\Crypt\CRijndael
     * @group specification
     * @dataProvider getCryptData
     */
    public function testEncryptDecrypt($sLabel, $sData)
    {
        $pCypherIn  = new \Foundation\Crypt\CRijndael();
        $sEncrypted = $pCypherIn->setkey($this->getCryptKey())->encrypt($sData);
        unset($pCypherIn);

        $pCypherOut = new \Foundation\Crypt\CRijndael();
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
        $pCypherIn  = new \Foundation\Crypt\CRijndael();
        $sEncrypted = $pCypherIn->setkey('thegoodkey')->encrypt($sData);
        unset($pCypherIn);

        $pCypherOut = new \Foundation\Crypt\CRijndael();
        $sDecrypted = $pCypherOut->setkey('thefalsekey')->decrypt($sEncrypted);
        unset($pCypherOut);

        $this->assertNotSame($sData, $sDecrypted);
    }
}
