<?php
namespace Foundation\Test\Type\Simple;

class CFloatMock extends \Foundation\Type\Simple\CFloat
{

    /** Numeric section
     * **************** */
    final public function getOptions()
    {
        return $this->_aOptions;
    }
}
