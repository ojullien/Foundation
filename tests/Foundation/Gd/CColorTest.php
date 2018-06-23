<?php
namespace Foundation\Test\Gd;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );

defined( 'FOUNDATION_GD_PATH' ) || define( 'FOUNDATION_GD_PATH', APPLICATION_PATH . '/src/Foundation/Gd' );
class_exists( '\Foundation\Gd\CColor' ) || require( realpath( FOUNDATION_GD_PATH . '/CColor.php' ) );

class CColorTest extends \PHPUnit_Framework_TestCase
{
    /** Test section
     * ************* */

    /**
     * @covers \Foundation\Gd\CColor::__construct
     * @group specification
     */
    public function testConstructException()
    {
        $aTests = [
            [ 'label' => 'Test: FALSE, 0, 0, 0', 'test'  => [ FALSE, 0, 0, 0 ] ],
            [ 'label' => 'Test: 0, FALSE, 0, 0', 'test'  => [ 0, FALSE, 0, 0 ] ],
            [ 'label' => 'Test: 0, 0, FALSE, 0', 'test'  => [ 0, 0, FALSE, 0 ] ],
            [ 'label' => 'Test: 0, 0, 0, FALSE', 'test'  => [ 0, 0, 0, FALSE ] ],
            [ 'label' => 'Test: -1, 0, 0, 0', 'test'  => [ -1, 0, 0, 0 ] ],
            [ 'label' => 'Test: 256, 0, 0, 0', 'test'  => [ 256, 0, 0, 0 ] ],
            [ 'label' => 'Test: 0, -1, 0, 0', 'test'  => [ 0, -1, 0, 0 ] ],
            [ 'label' => 'Test: 0, 256, 0, 0', 'test'  => [ 0, 256, 0, 0 ] ],
            [ 'label' => 'Test: 0, 0, -1, 0', 'test'  => [ 0, 0, -1, 0 ] ],
            [ 'label' => 'Test: 0, 0, 256, 0', 'test'  => [ 0, 0, 256, 0 ] ],
            [ 'label' => 'Test: 0, 0, 0, -1', 'test'  => [ 0, 0, 0, -1 ] ],
            [ 'label' => 'Test: 0, 0, 0, 256', 'test'  => [ 0, 0, 0, 128 ] ],
        ];

        foreach( $aTests as $data )
        {
            $label = &$data['label'];
            $value = &$data['test'];
            try
            {
                $pObject = new \Foundation\Gd\CColor( $value[0], $value[1], $value[2], $value[3] );
                unset( $pObject );
                $this->fail( $label . ' No exception raised.' );
            }
            catch( \Foundation\Exception\InvalidArgumentException $exc )
            {
                $this->assertTrue( TRUE );
            }
            catch( \Exception $exc )
            {
                $this->fail( $label . ' No the expected exception.' );
            }
        }
    }

    /**
     * @covers \Foundation\Gd\CColor
     * @group specification
     */
    public function testClass()
    {
        $pObject = new \Foundation\Gd\CColor( 1, 2, 3, 4 );
        $this->assertSame( 1, $pObject->getRed(), 'getRed' );
        $this->assertSame( 2, $pObject->getGreen(), 'getGreen' );
        $this->assertSame( 3, $pObject->getBlue(), 'getBlue' );
        $this->assertSame( 4, $pObject->getTransparency(), 'getTransparency' );
        $this->assertSame( serialize( [
            'red'          => '1',
            'green'        => '2',
            'blue'         => '3',
            'transparency' => '4' ] ), (string)$pObject, 'string' );
        unset( $pObject );
    }

}