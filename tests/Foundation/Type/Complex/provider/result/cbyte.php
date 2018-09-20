<?php
return [
//[ 'label'=>'TEST: 10g'         , 'test' => '10g' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '10g' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10g' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 3 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10737418240,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => '10485760K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 10G'         , 'test' => '10G' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '10G' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10G' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 3 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10737418240,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => '10485760K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 10m',         'test' => '10m' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '10m' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10m' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 3 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 10M',         'test' => '10M' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '10M' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10M' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 3 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 0.10m'       , 'test' => '0.10m' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '0.10m' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '0.10m' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 5 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.10,
                    'shorthanded' => '0M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 104857.6,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 102.4,
                    'shorthanded' => '102K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 9.765625e-05,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 0.10M'       , 'test' => '0.10M' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '0.10M' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '0.10M' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 5 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.10,
                    'shorthanded' => '0M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 104857.6,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 102.4,
                    'shorthanded' => '102K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 9.765625e-05,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 10240k'      , 'test' => '10240k' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '10240k' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10240k' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 6 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 10240K'      , 'test' => '10240K' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '10240K' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10240K' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 6 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 10485760'    , 'test' => 10485760 ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => 10485760 ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10485760' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 8 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: "10485760"'  , 'test' => '10485760' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => 10485760 ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10485760' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 8 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 256mm',        'test' => '256mm' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => false ],
            'getValue'       => [ 'exception' => 0, 'return'    => null ],
            '__toString'     => [ 'exception' => 0, 'return'    => '' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 0 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: m256m',        'test' => 'm256m' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => false ],
            'getValue'       => [ 'exception' => 0, 'return'    => null ],
            '__toString'     => [ 'exception' => 0, 'return'    => '' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 0 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: m256',         'test' => 'm256' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => false ],
            'getValue'       => [ 'exception' => 0, 'return'    => null ],
            '__toString'     => [ 'exception' => 0, 'return'    => '' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 0 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 2m56m',        'test' => '2m56m' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => false ],
            'getValue'       => [ 'exception' => 0, 'return'    => null ],
            '__toString'     => [ 'exception' => 0, 'return'    => '' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 0 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: _1g',          'test' => ' 1g' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '1g' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '1g' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 2 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1024,
                    'shorthanded' => '1024M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1073741824,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1048576,
                    'shorthanded' => '1048576K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1,
                    'shorthanded' => '1G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 1g_',          'test' => '1g ' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '1g' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '1g' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 2 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1024,
                    'shorthanded' => '1024M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1073741824,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1048576,
                    'shorthanded' => '1048576K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1,
                    'shorthanded' => '1G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 1_g',          'test' => '1 g' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => false ],
            'getValue'       => [ 'exception' => 0, 'return'    => null ],
            '__toString'     => [ 'exception' => 0, 'return'    => '' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 0 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: g',            'test' => 'g' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => false ],
            'getValue'       => [ 'exception' => 0, 'return'    => null ],
            '__toString'     => [ 'exception' => 0, 'return'    => '' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 0 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => null,
                    'shorthanded' => null ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 1',            'test' => '1' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => 1 ],
            '__toString'     => [ 'exception' => 0, 'return'    => '1' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 1 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.0000009536,
                    'shorthanded' => '0M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 1,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.0009765625,
                    'shorthanded' => '0K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 9.31322574615479e-10,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 0.009765625g', 'test' => '0.009765625g' ],
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '0.009765625g' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '0.009765625g' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 12 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10.0,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760.0,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240.0,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label'=>'TEST: 0.009765625G', 'test' => '0.009765625G' )
    [ 'expected' => [ 'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '0.009765625G' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '0.009765625G' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 12 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => true ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10.0,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10485760.0,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 10240.0,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [ 'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//['label' => 'TEST: CByte', 'test'  => new \Foundation\Type\Complex\CByte( '10M' ) ],
    [ 'expected' => [
            'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => '10M' ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10M' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 3 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
//[ 'label' => 'TEST: CInt', 'test'  => new \Foundation\Type\Simple\CInt( 10485760 ) ]
    [ 'expected' => [
            'isvalid'        => [ 'exception' => 0, 'return'    => true ],
            'getValue'       => [ 'exception' => 0, 'return'    => 10485760 ],
            '__toString'     => [ 'exception' => 0, 'return'    => '10485760' ],
            'getLength'      => [ 'exception' => 0, 'return'    => 8 ],
            'isShorthanded'  => [ 'exception' => 0, 'return'    => false ],
            'convertToMByte' => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 10,
                    'shorthanded' => '10M' ] ],
            'convertToByte'  => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 10485760,
                    'shorthanded' => null ] ],
            'convertToKByte' => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 10240,
                    'shorthanded' => '10240K' ] ],
            'convertToGByte' => [ 'exception' => 0, 'return'    => [
                    'numeric'     => 0.009765625,
                    'shorthanded' => '0G' ] ],
            'exception'      => 0 ] ],
];
