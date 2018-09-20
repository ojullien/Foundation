<?php
$basePath = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'src'
        . DIRECTORY_SEPARATOR . 'Foundation'
        . DIRECTORY_SEPARATOR . 'Exception';
return [
    'Foundation\Exception\UnderflowException' => $basePath . DIRECTORY_SEPARATOR . 'UnderflowException.php',
    'Foundation\Exception\OverflowException'  => $basePath . DIRECTORY_SEPARATOR . 'OverflowException.php',
];
