<?php
return [
    [ 'label' => 'TEST: dir is file "notadir"', 'test'  => APPLICATION_PATH . DIRECTORY_SEPARATOR . 'tests'
        . DIRECTORY_SEPARATOR . 'framework'
        . DIRECTORY_SEPARATOR . 'provider'
        . DIRECTORY_SEPARATOR . 'resource'
        . DIRECTORY_SEPARATOR . 'notadir' ],
    [ 'label' => 'TEST: dir already exists', 'test'  => APPLICATION_PATH_UPLOADS ],
    [ 'label' => 'TEST: dir does not exist', 'test'  => APPLICATION_PATH_UPLOADS . DIRECTORY_SEPARATOR . 'todelete' ],
];