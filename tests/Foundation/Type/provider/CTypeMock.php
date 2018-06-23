<?php
namespace Foundation\Test\Type;
defined( 'FOUNDATION_TYPE_PATH' ) || define( 'FOUNDATION_TYPE_PATH', APPLICATION_PATH . '/src/Foundation/Type' );

interface_exists( '\Foundation\Type\TypeInterface' ) || require( realpath( FOUNDATION_TYPE_PATH . '/TypeInterface.php' ) );
class_exists( '\Foundation\Type\CTypeAbstract' ) || require( realpath( FOUNDATION_TYPE_PATH . '/CTypeAbstract.php' ) );

class CTypeMock extends \Foundation\Type\CTypeAbstract
{

    /**
     * Writes data to variable.
     *
     * @param mixed $value The value to write.
     * @return \Foundation\Type\TypeInterface
     */
    public function setValue( $value )
    {
        $this->_Value = $value;
        return $this;
    }

}