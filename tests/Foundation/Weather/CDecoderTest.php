<?php
if( !defined( 'FOUNDATION_WEATHER_PATH' ) )
{
    define( 'FOUNDATION_WEATHER_PATH', APPLICATION_PATH . '/src/Foundation/Weather' );
    require( realpath( FOUNDATION_WEATHER_PATH . '/Decoder/DecoderInterface.php' ) );
    require( realpath( FOUNDATION_WEATHER_PATH . '/Decoder/CDecoderAbstract.php' ) );
    require( realpath( FOUNDATION_WEATHER_PATH . '/Decoder/CDecoder.php' ) );
    require( realpath( FOUNDATION_WEATHER_PATH . '/Decoder/CDecoratorAbstract.php' ) );
    require( realpath( FOUNDATION_WEATHER_PATH . '/Decoder/CDecoderWu.php' ) );
}

class CDecoderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDTDEmpty()
    {
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( array( ), array( 'notempty' ) );
        $this->assertNull( $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_ERROR_SYNTAX, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Invalid or malformed data', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDataEmpty()
    {
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( array( 'notempty' ), array( ) );
        $this->assertNull( $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_ERROR_SYNTAX, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Invalid or malformed data', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDataNotArray()
    {
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( array( 'notempty' ), '' );
        $this->assertNull( $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_ERROR_SYNTAX, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Invalid or malformed data', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeKeyMissing01()
    {
        $dtd      = array( 'one_key' => 'one_value' );
        $data     = array( 'two_key' => 'two_value' );
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $dtd, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Key "one_key" is missing', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeKeyMissing02()
    {
        $dtd      = array(
            'one_key' => 'one_value',
            'two_key' => array(
                'three_key' => 'three_value' ) );
        $data     = array(
            'a_key'   => 'a_value',
            'one_key' => 'one_value',
            'two_key' => array(
                'b_key' => 'b_value' ) );
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $dtd, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Key "three_key" is missing', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeKeyMissing03()
    {
        $dtd      = array(
            'one_key' => 'one_value',
            'two_key' => array(
                'three_key' => array(
                    'four_key' => 'four_value' ) ) );
        $data     = array(
            'one_key' => 'one_value',
            'a_key'   => 'a_value',
            'two_key' => array(
                'b_key'     => 'b_value',
                'three_key' => array(
                    'c_key' => 'c_value' ) ) );
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $dtd, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Key "four_key" is missing', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeKeyTypeMismatch01()
    {
        $dtd      = array( 'one_key' => 'one_value' );
        $data     = array( 'one_key' => array( ) );
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $dtd, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_BAD_TYPE, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Type mismatch for "one_key"', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeKeyTypeMismatch02()
    {
        $dtd      = array(
            'one_key' => 'one_value',
            'two_key' => array(
                'three_key' => 'three_value' ) );
        $data     = array(
            'a_key'   => 'a_value',
            'one_key' => 'one_value',
            'two_key' => array(
                'b_key'     => 'b_value',
                'three_key' => array( ) ) );
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $dtd, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_BAD_TYPE, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Type mismatch for "three_key"', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDTDSpecificDefault()
    {
        $dtd      = array(
            'one_key' => array( '__DEFAULT' => '1' ),
            'two_key' => array(
                'five_key'  => array( '__DEFAULT' => '5' ),
                'three_key' => array(
                    'four_key' => array( '__DEFAULT' => '4' ) ) ) );
        $data     = array(
            'a_key'   => 'a_value',
            'two_key' => array(
                'b_key'     => 'b_value',
                'three_key' => array(
                    'c_key' => 'c_value' ) ) );
        $result   = array(
            'one_key' => '1',
            'two_key' => array(
                'five_key'  => '5',
                'three_key' => array(
                    'four_key' => '4' ) ) );
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $result, $return, 'TEST: decode' );
        $this->assertSame( 0, $pDecoder->getErrorNumber(), 'TEST: getErrorNumber' );
        $this->assertSame( '', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDTDSpecificMoveKeyMissing01()
    {
        $dtd = array(
            '1_key' => '1_value',
            '2_key' => array(
                '__MOVE'    => 'extra',
                '__DEFAULT' => '' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array(
                    '__MOVE'    => 'extra',
                    '__DEFAULT' => '' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array(
                        '__MOVE'    => 'extra',
                        '__DEFAULT' => '' ) ) ) );

        $data = array(
            '1_key' => '1_value',
            '2_key' => array(
                'notextra' => 'a_value' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array( 'extra' => 'b_value' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array( 'extra' => 'c_value' ) ) ) );

        $result = array(
            '1_key' => '1_value',
            '2_key' => '',
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => 'b_value',
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => 'c_value' ) ) );

        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $result, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Key "2_key/extra" is missing', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDTDSpecificMoveKeyMissing02()
    {
        $dtd = array(
            '1_key' => '1_value',
            '2_key' => array(
                '__MOVE'    => 'extra',
                '__DEFAULT' => '' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array(
                    '__MOVE'    => 'extra',
                    '__DEFAULT' => '' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array(
                        '__MOVE'    => 'extra',
                        '__DEFAULT' => '' ) ) ) );

        $data = array(
            '1_key' => '1_value',
            '2_key' => array(
                'extra' => 'a_value' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array( 'notextra' => 'b_value' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array( 'extra' => 'c_value' ) ) ) );

        $result = array(
            '1_key' => '1_value',
            '2_key' => 'a_value',
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => '',
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => 'c_value' ) ) );

        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $result, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Key "5_key/extra" is missing', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDTDSpecificMoveKeyMissing03()
    {
        $dtd = array(
            '1_key' => '1_value',
            '2_key' => array(
                '__MOVE'    => 'extra',
                '__DEFAULT' => '' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array(
                    '__MOVE'    => 'extra',
                    '__DEFAULT' => '' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array(
                        '__MOVE'    => 'extra',
                        '__DEFAULT' => '' ) ) ) );

        $data = array(
            '1_key' => '1_value',
            '2_key' => array(
                'extra' => 'a_value' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array( 'extra' => 'b_value' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array( 'notextra' => 'c_value' ) ) ) );

        $result = array(
            '1_key' => '1_value',
            '2_key' => 'a_value',
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => 'b_value',
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => '' ) ) );

        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $result, $return, 'TEST: decode' );
        $this->assertSame( \Foundation\Weather\Decoder\CDecoder::FWD_KEY_MISSING, $pDecoder->getErrorNumber(),
                           'TEST: getErrorNumber' );
        $this->assertSame( 'Key "8_key/extra" is missing', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecodeDTDSpecificMove()
    {
        $dtd = array(
            '1_key' => '1_value',
            '2_key' => array(
                '__MOVE'    => 'extra',
                '__DEFAULT' => '' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array(
                    '__MOVE'    => 'extra',
                    '__DEFAULT' => '' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array(
                        '__MOVE'    => 'extra',
                        '__DEFAULT' => '' ) ) ) );

        $data = array(
            '1_key' => '1_value',
            '2_key' => array(
                'extra' => 'a_value' ),
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => array( 'extra' => 'b_value' ),
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => array( 'extra' => 'c_value' ) ) ) );

        $result = array(
            '1_key' => '1_value',
            '2_key' => 'a_value',
            '3_key' => array(
                '4_key' => '4_value',
                '5_key' => 'b_value',
                '6_key' => array(
                    '7_key' => '7_value',
                    '8_key' => 'c_value' ) ) );

        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $result, $return, 'TEST: decode' );
        $this->assertSame( 0, $pDecoder->getErrorNumber(), 'TEST: getErrorNumber' );
        $this->assertSame( '', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

    /**
     * @covers \Foundation\Weather\Decoder\CDecoder
     * @covers \Foundation\Weather\Decoder\CDecoderAbstract
     * @group specification
     */
    public function testDecode()
    {
        $dtd      = array(
            'one_key' => '!',
            'two_key' => array(
                'five_key'  => '!',
                'three_key' => array(
                    'four_key' => '!' ) ) );
        $data     = array(
            'a_key'   => 'a_value',
            'one_key' => '1',
            'two_key' => array(
                'five_key'  => '5',
                'b_key'     => 'b_value',
                'three_key' => array(
                    'c_key'    => 'c_value',
                    'four_key' => '4' ) ) );
        $result   = array(
            'one_key' => '1',
            'two_key' => array(
                'five_key'  => '5',
                'three_key' => array(
                    'four_key' => '4' ) ) );
        $pDecoder = new \Foundation\Weather\Decoder\CDecoder();
        $return   = $pDecoder->decode( $dtd, $data );
        $this->assertTrue( is_array( $return ), 'TEST: decode is_array' );
        $this->assertTrue( !empty( $return ), 'TEST: decode empty' );
        $this->assertEquals( $result, $return, 'TEST: decode' );
        $this->assertSame( 0, $pDecoder->getErrorNumber(), 'TEST: getErrorNumber' );
        $this->assertSame( '', $pDecoder->getErrorText(), 'TEST: getErrorText' );
        unset( $pDecoder );
    }

}