<?php
defined('FOUNDATION_TEST_RESOURCE_PATH') || define(
    'FOUNDATION_TEST_RESOURCE_PATH',
    realpath(__DIR__ . '/../resource')
);
return [
    [ 'label' => 'TEST: NULL', 'test'  => [
            'value' => null, 'mime'  => null ] ],
    [ 'label' => 'TEST: EMPTY', 'test'  => [
            'value' => '', 'mime'  => null ] ],
    [ 'label' => 'TEST: DIRECTORY', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR, 'mime'  => 'directory' ] ],
    [ 'label' => 'TEST: notadir', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'notadir',
            'mime'  => 'inode/x-empty' ] ],
    [ 'label' => 'TEST: source.php', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'source.php',
            'mime'  => 'text/x-php' ] ],
    [ 'label' => 'TEST: image.bmp', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.bmp',
            'mime'  => 'image/x-ms-bmp' ] ],
    [ 'label' => 'TEST: image.gif', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.gif',
            'mime'  => 'image/gif' ] ],
    [ 'label' => 'TEST: image.jpg', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.jpg',
            'mime'  => 'image/jpeg' ] ],
    [ 'label' => 'TEST: image.png', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image.png',
            'mime'  => 'image/png' ] ],
    [ 'label' => 'TEST: image', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'image', 'mime'  => 'image/png' ] ],
    [ 'label' => 'TEST: audio.mp3', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'audio.mp3',
            'mime'  => 'audio/mpeg' ] ],
    [ 'label' => 'TEST: audio', 'test'  => [
            'value' => FOUNDATION_TEST_RESOURCE_PATH . DIRECTORY_SEPARATOR . 'audio', 'mime'  => 'audio/mpeg' ] ],
];
