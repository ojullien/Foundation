<?php
namespace Foundation\Test\Gd;
defined( 'FOUNDATION_EXCEPTION_PATH' ) || define( 'FOUNDATION_EXCEPTION_PATH',
                                                  APPLICATION_PATH . '/src/Foundation/Exception' );
interface_exists( '\Foundation\Exception\ExceptionInterface' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/ExceptionInterface.php' ) );
class_exists( '\Foundation\Exception\InvalidArgumentException' ) || require( realpath( FOUNDATION_EXCEPTION_PATH . '/InvalidArgumentException.php' ) );

defined( 'FOUNDATION_GD_PATH' ) || define( 'FOUNDATION_GD_PATH', APPLICATION_PATH . '/src/Foundation/Gd' );
class_exists( '\Foundation\Gd\CDimensions' ) || require( realpath( FOUNDATION_GD_PATH . '/CDimensions.php' ) );

class_exists( '\Foundation\Test\Framework\Provider\CDataTestProvider' ) || require( realpath( APPLICATION_PATH . '/tests/framework/provider/CDataTestProvider.php' ) );

class CDimensionsTest extends \PHPUnit_Framework_TestCase
{
    /** Class section
     * *************** */

    /**
     * Loads data.
     */
    public static function setUpBeforeClass()
    {
        static::$_aTests = \Foundation\Test\Framework\Provider\CDataTestProvider::GetInstance()->getTests(
                \Foundation\Test\Framework\Provider\CDataTestProvider::DATA_DIMENSION,
                require( realpath( __DIR__ . '/provider/result/cdimension.php' ) ) );
    }

    /** Test section
     * ************* */

    /**
     * Data for test
     * @var array
     */
    public static $_aTests = NULL;

    /**
     * @covers \Foundation\Gd\CDimensions::__construct
     * @group specification
     */
    public function testConstructException()
    {
        $aTests = [
            [ 'label' => 'Test: FALSE,3', 'test'  => [FALSE, 3 ] ],
            [ 'label' => 'Test: 3,FALSE', 'test'  => [3, FALSE ] ],
            [ 'label' => 'Test: 3,0', 'test'  => [3, 0 ] ],
            [ 'label' => 'Test: 0,3', 'test'  => [0, 3 ] ],
        ];

        foreach( $aTests as $data )
        {
            $label = &$data['label'];
            $value = &$data['test'];
            try
            {
                $pObject = new \Foundation\Gd\CDimensions( $value[0], $value[1] );
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
     * @covers \Foundation\Gd\CDimensions
     * @group specification
     */
    public function testConstruct()
    {
        $pObject = new \Foundation\Gd\CDimensions( 111, 222 );
        $this->assertSame( 111, $pObject->getWidth(), 'getWidth' );
        $this->assertSame( 222, $pObject->getHeight(), 'getHeight' );
        $this->assertSame( serialize( [ 'width'  => '111', 'height' => '222' ] ), (string)$pObject, 'string' );
        unset( $pObject );
    }

    /**
     * @covers \Foundation\Gd\CDimensions::resizeByAbsolute
     * @covers \Foundation\Gd\CDimensions::scale
     * @group specification
     */
    public function testResizeByAbsolute()
    {
        foreach( static::$_aTests as $data )
        {
            $label    = &$data['label'];
            $value    = &$data['test'];
            $expected = &$data['expected'];

            $fit  = new \Foundation\Gd\CDimensions( $value['fit'][0], $value['fit'][1] );
            $size = new \Foundation\Gd\CDimensions( $value['size'][0], $value['size'][1] );

            // width
            $this->assertSame( $value['size'][0], $size->getWidth(), $label . ' size getWidth' );
            $this->assertSame( $value['fit'][0], $fit->getWidth(), $label . ' size getWidth' );

            // height
            $this->assertSame( $value['size'][1], $size->getHeight(), $label . ' fit getHeight' );
            $this->assertSame( $value['fit'][1], $fit->getHeight(), $label . ' fit getHeight' );

            // resizeByAbsolute
            $return = $size->resizeByAbsolute( $fit );
            $this->assertSame( $expected['fit']
                    , array( $return->getWidth(), $return->getHeight() )
                    , $label . ' resizeByAbsolute' );

            unset( $size, $fit );
        }
    }

    /**
     * @covers \Foundation\Gd\CDimensions::resizeByPercentage
     * @group specification
     */
    public function testResizeByPercentageException()
    {
        $aTests = [
            [ 'label' => 'TEST: NULL', 'test'  => NULL ],
            [ 'label' => 'TEST: TRUE', 'test'  => TRUE ],
            [ 'label' => 'TEST: FALSE', 'test'  => FALSE ],
            [ 'label' => 'TEST: empty', 'test'  => '' ],
            [ 'label' => 'TEST: string', 'test'  => 'string' ],
            [ 'label' => 'TEST: object', 'test'  => (object)[ ] ],
            [ 'label' => 'TEST: resource', 'test'  => new \SplFileObject( __FILE__ ) ],
            [ 'label' => 'TEST: NULL', 'test'  => 0 ],
        ];

        foreach( $aTests as $data )
        {
            try
            {
                $pObject = new \Foundation\Gd\CDimensions( 100, 100 );
                $pObject->resizeByPercentage( $data['test'] );
                unset( $pObject );
                $this->fail( $data['label'] . ' No exception raised.' );
            }
            catch( \Foundation\Exception\InvalidArgumentException $exc )
            {
                $this->assertTrue( TRUE );
            }
            catch( \Exception $exc )
            {
                $this->fail( $data['label'] . ' No the expected exception.' );
            }
        }
    }

    /**
     * @covers \Foundation\Gd\CDimensions::resizeByPercentage
     * @group specification
     */
    public function testResizeByPercentage()
    {
        $size    = new \Foundation\Gd\CDimensions( 100, 200 );
        $newsize = $size->resizeByPercentage( 50 );
        $this->assertSame( 100, $newsize->getHeight(), 'resizeByPercentage W' );
        $this->assertSame( 50, $newsize->getWidth(), 'resizeByPercentage H' );
        unset( $newsize, $size );
    }

    /**
     * @covers \Foundation\Gd\CDimensions::resizeClose
     * @group specification
     */
    public function testResizeClose()
    {
        foreach( static::$_aTests as $data )
        {
            $label    = &$data['label'];
            $value    = &$data['test'];
            $expected = &$data['expected'];
            $fit      = new \Foundation\Gd\CDimensions( $value['fit'][0], $value['fit'][1] );
            $size     = new \Foundation\Gd\CDimensions( $value['size'][0], $value['size'][1] );

            // width
            $this->assertSame( $value['size'][0], $size->getWidth(), $label . ' size getWidth' );
            $this->assertSame( $value['fit'][0], $fit->getWidth(), $label . ' fit getWidth' );

            // height
            $this->assertSame( $value['size'][1], $size->getHeight(), $label . ' size getHeight' );
            $this->assertSame( $value['fit'][1], $fit->getHeight(), $label . ' fit getHeight' );

            // resizeByAbsolute
            $return = $size->resizeClose( $fit );
            $this->assertSame( $expected['close']
                    , array( $return->getWidth(), $return->getHeight() )
                    , $label . ' resizeClose' );

            unset( $size, $fit );
        }
    }

}