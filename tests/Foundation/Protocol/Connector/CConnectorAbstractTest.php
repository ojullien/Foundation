<?php
namespace Foundation\Test\Protocol\Connector;

defined('FOUNDATION_PROTOCOL_PATH') || define(
    'FOUNDATION_PROTOCOL_PATH',
    APPLICATION_PATH . '/src/Foundation/Protocol'
);
interface_exists('\Foundation\Protocol\Connector\ConnectorInterface') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/Connector/ConnectorInterface.php'));
class_exists('\Foundation\Protocol\Connector\CConnectorAbstract') || require(realpath(FOUNDATION_PROTOCOL_PATH . '/Connector/CConnectorAbstract.php'));

class_exists('\Foundation\Test\Protocol\Connector\CConnectorAbstractMock') || require(realpath(APPLICATION_PATH . '/tests/Foundation/Protocol/Connector/provider/CConnectorAbstractMock.php'));

class CConnectorAbstractTest extends \PHPUnit_Framework_TestCase
{
    /** Tests section
     * ************** */

    /**
     * @covers \Foundation\Protocol\Connector\CConnectorAbstract
     * @group specification
     */
    public function testClass()
    {
        $pConnector = new \Foundation\Test\Protocol\Connector\CConnectorAbstractMock();

        $this->assertSame([
            'url'           => '',
            'size_download' => 0 ], $pConnector->getInformation(), 'getInformation');

        $this->assertSame(CURLE_OK, $pConnector->getErrorNumber(), 'getErrorNumber');

        $pConnector->setError('test error');
        $this->assertSame('test error', $pConnector->getErrorText(), 'getErrorText');

        $pConnector->setResponse('this is the response');
        $this->assertSame('this is the response', $pConnector->read(), 'read');

        unset($pConnector);
    }
}
