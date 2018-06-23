<?php
namespace Foundation\Test\Stdlib;
defined( 'FOUNDATION_STDLIB_PATH' ) || define( 'FOUNDATION_STDLIB_PATH', APPLICATION_PATH . '/src/Foundation/Stdlib' );
class_exists( '\Foundation\Stdlib\CServerUtils' ) || require( realpath( FOUNDATION_STDLIB_PATH . '/CServerUtils.php' ) );

class CServerUtilsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Foundation\Stdlib\CServerUtils
     * @group specification
     */
    public function testAcceptFromHttp()
    {
        $aAllowed = array( 'fr_FR', 'en_US' );
        $aTests   = array(
            array( 'test'    => 'TEST: 01', 'header'  => NULL, 'allowed' => NULL, 'return'  => NULL ),
            array( 'test'    => 'TEST: 02', 'header'  => FALSE, 'allowed' => NULL, 'return'  => NULL ),
            array( 'test'    => 'TEST: 03', 'header'  => TRUE, 'allowed' => NULL, 'return'  => NULL ),
            array( 'test'    => 'TEST: 04', 'header'  => array( ), 'allowed' => NULL, 'return'  => NULL ),
            array( 'test'    => 'TEST: 05', 'header'  => new \stdClass(), 'allowed' => NULL, 'return'  => NULL ),
            array( 'test'    => 'TEST: 06', 'header'  => '', 'allowed' => NULL, 'return'  => NULL ),
            array( 'test'    => 'TEST: 07', 'header'  => '', 'allowed' => array( ), 'return'  => NULL ),
            array( 'test'    => 'TEST: 08', 'header'  => '', 'allowed' => array( 'fr_FR' ), 'return'  => 'fr_FR' ),
            array( 'test'    => 'TEST: 09', 'header'  => 'fr', 'allowed' => NULL, 'return'  => 'fr' ),
            array( 'test'    => 'TEST: 10', 'header'  => 'en_us', 'allowed' => NULL, 'return'  => 'en_US' ),
            array( 'test'    => 'TEST: 11', 'header'  => 'fr_FR', 'allowed' => $aAllowed, 'return'  => 'fr_FR' ),
            array( 'test'    => 'TEST: 12', 'header'  => 'en_us', 'allowed' => $aAllowed, 'return'  => 'en_US' ),
            array( 'test'    => 'TEST: 13', 'header'  => 'es', 'allowed' => $aAllowed, 'return'  => 'fr_FR' ),
            array( 'test'    => 'TEST: 14', 'header'  => 'en', 'allowed' => $aAllowed, 'return'  => 'en_US' ),
            array( 'test'    => 'TEST: 15', 'header'  => 'en_GB', 'allowed' => $aAllowed, 'return'  => 'en_US' ),
        );

        foreach( $aTests as $aTest )
        {
            $return = \Foundation\Stdlib\CServerUtils::acceptFromHttp( $aTest['header'], $aTest['allowed'] );
            $this->assertSame( $aTest['return'], $return, $aTest['test'] );
        }
    }

    /**
     * @covers \Foundation\Stdlib\CServerUtils
     * @group specification
     */
    public function testIsMSIE()
    {
        $aTests = array(
            array( 'test'   => 'TEST: 01', 'header' => NULL, 'return' => FALSE ),
            array( 'test'   => 'TEST: 02', 'header' => FALSE, 'return' => FALSE ),
            array( 'test'   => 'TEST: 03', 'header' => TRUE, 'return' => FALSE ),
            array( 'test'   => 'TEST: 04', 'header' => array( ), 'return' => FALSE ),
            array( 'test'   => 'TEST: 05', 'header' => new \stdClass(), 'return' => FALSE ),
            array( 'test'   => 'TEST: 06', 'header' => '', 'return' => FALSE ),
            array( 'test'   => 'MSIE 8.0', 'header' => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; Win64; x64; Trident/4.0; .NET CLR 2.0.50727; SLCC2; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; Tablet PC 2.0)',
                'return' => 8 ),
            array( 'test'   => 'Firefox', 'header' => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13',
                'return' => FALSE ),
            array( 'test'   => 'Chrome', 'header' => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.10 (KHTML, like Gecko) Chrome/8.0.552.237 Safari/534.10',
                'return' => FALSE ),
            array( 'test'   => 'Opera', 'header' => 'Opera/9.80 (Windows NT 6.1; U; zh-tw) Presto/2.7.62 Version/11.01',
                'return' => FALSE ),
            array( 'test'   => 'Safari', 'header' => 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; en-us) AppleWebKit/534.16+ (KHTML, like Gecko) Version/5.0.3 Safari/533.19.4',
                'return' => FALSE ),
            array( 'test'   => 'iPhone (Safari)', 'header' => 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_2_1 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5',
                'return' => FALSE ),
            array( 'test'   => 'iPad (Safari)', 'header' => 'Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; ja-jp) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5',
                'return' => FALSE ),
            array( 'test'   => 'Google Android', 'header' => 'Mozilla/5.0 (Linux; U; Android 2.2; he-il; GT-I9000 Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'return' => FALSE ),
            array( 'test'   => 'Blackberry', 'header' => 'BlackBerry9700/5.0.0.862 Profile/MIDP-2.1 Configuration/CLDC-1.1 VendorID/331',
                'return' => FALSE ),
            array( 'test'   => 'Opera Mini', 'header' => 'Opera/9.80 (Series 60; Opera Mini/5.1.22784/22.394; U; en) Presto/2.5.25 Version/10.54',
                'return' => FALSE ),
            array( 'test'   => 'Opera Mobile', 'header' => 'Opera/9.80 (Android; Linux; Opera Mobi/ADR-1012221546; U; pl) Presto/2.7.60 Version/10.5',
                'return' => FALSE ),
            array( 'test'   => 'Microsoft IE 7 for mobile', 'header' => 'Mozilla/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.0; Trident/3.1; IEMobile/7.0) Asus;Galaxy6',
                'return' => 7 ),
        );

        foreach( $aTests as $aTest )
        {
            $return = \Foundation\Stdlib\CServerUtils::isMSIE( $aTest['header'] );
            $this->assertSame( $aTest['return'], $return, $aTest['test'] );
        }
    }

}