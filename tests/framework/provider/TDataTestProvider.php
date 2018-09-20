<?php
namespace Foundation\Test\Framework\Provider;

class_exists('\Foundation\Test\Framework\Provider\CDataTestProvider') || require(realpath(APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php'));

trait TDataTestProvider
{
    /** Tests section
     * ************** */

    /**
     * Provides data for tests.
     *
     * @param string $sNamespace Namespace of the data to test.
     * @param array  $aResult    Expected results.
     * @return array
     */
    public function getDataForTest($sNamespace, array $aResult)
    {
        return \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests($sNamespace, $aResult);
    }

    /**
     * @group specification
     */
    public function testTypeNotScalar()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_NOTSCALAR,
            require(realpath($this->getResultPath(\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_NOTSCALAR) . '_notscalar.php'))
        );
        foreach ($tests as $test) {
            $this->proceed($test['label'], $test['test'], $test['expected']);
        }
    }

    /**
     * @group specification
     */
    public function testTypeBoolean()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_BOOLEAN,
            require(realpath($this->getResultPath(\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_BOOLEAN) . '_boolean.php'))
        );
        foreach ($tests as $test) {
            $this->proceed($test['label'], $test['test'], $test['expected']);
        }
    }

    /**
     * @group specification
     */
    public function testTypeNumeric()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_NUMERIC,
            require(realpath($this->getResultPath(\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_NUMERIC) . '_numeric.php'))
        );
        foreach ($tests as $test) {
            $this->proceed($test['label'], $test['test'], $test['expected']);
        }
    }

    /**
     * @group specification
     */
    public function testTypeString()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_STRING,
            require(realpath($this->getResultPath(\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_STRING) . '_string.php'))
        );
        foreach ($tests as $test) {
            $this->proceed($test['label'], $test['test'], $test['expected']);
            $this->proceed($test['label'], chr(0x20) . $test['test'], $test['expected']);
            $this->proceed($test['label'], $test['test'] . chr(0x20), $test['expected']);
            $this->proceed($test['label'], chr(0x20) . $test['test'] . chr(0x20), $test['expected']);
        }
    }

    /**
     * @group specification
     */
    public function testTypeUTF8()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_UTF8,
            require(realpath($this->getResultPath(\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_UTF8) . '_utf8.php'))
        );
        foreach ($tests as $test) {
            $this->proceed($test['label'], $test['test'], $test['expected']);
        }
    }

    /**
     * @group specification
     */
    public function testTypeXSS()
    {
        $tests = $this->getDataForTest(
            \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_XSS,
            require(realpath($this->getResultPath(\Foundation\Test\Framework\Provider\CDataTestProvider::DATA_TYPE_XSS) . '_xss.php'))
        );
        foreach ($tests as $test) {
            $this->proceed($test['label'], $test['test'], $test['expected']);
        }
    }
}
