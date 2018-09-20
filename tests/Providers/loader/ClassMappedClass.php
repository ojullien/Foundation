<?php
namespace FoundationTest\UnusualNamespace;

class ClassMappedClass
{

    public $options;

    public function __construct($options = null)
    {
        $this->options = $options;
    }
}
