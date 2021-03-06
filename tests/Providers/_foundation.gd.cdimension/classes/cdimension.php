<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = [
// array( 'label'=>'TEST: fit[300*200] size[800*400]', 'test'=>array( 'fit'=>array(300,200), 'size'=>array(800,400) ) ),
[ 'expected' => [ 'fit' => [300,150] ,'close' => [400,200] ]],
// array( 'label'=>'TEST: fit[300*200] size[400*800]', 'test'=>array( 'fit'=>array(300,200), 'size'=>array(400,800) ) ),
[ 'expected' => [ 'fit' => [100,200] ,'close' => [300,600] ]],
// array( 'label'=>'TEST: fit[300*200] size[600*600]', 'test'=>array( 'fit'=>array(300,200), 'size'=>array(600,600) ) ),
[ 'expected' => [ 'fit' => [200,200] ,'close' => [300,300] ]],
// array( 'label'=>'TEST: fit[200*300] size[800*400]', 'test'=>array( 'fit'=>array(200,300), 'size'=>array(800,400) ) ),
[ 'expected' => [ 'fit' => [200,100] ,'close' => [600,300] ]],
// array( 'label'=>'TEST: fit[200*300] size[400*800]', 'test'=>array( 'fit'=>array(200,300), 'size'=>array(400,800) ) ),
[ 'expected' => [ 'fit' => [150,300] ,'close' => [200,400] ]],
// array( 'label'=>'TEST: fit[200*300] size[600*600]', 'test'=>array( 'fit'=>array(200,300), 'size'=>array(600,600) ) ),
[ 'expected' => [ 'fit' => [200,200] ,'close' => [300,300] ]],
// array( 'label'=>'TEST: fit[300*300] size[800*400]', 'test'=>array( 'fit'=>array(300,300), 'size'=>array(800,400) ) ),
[ 'expected' => [ 'fit' => [300,150] ,'close' => [600,300] ]],
// array( 'label'=>'TEST: fit[300*300] size[400*800]', 'test'=>array( 'fit'=>array(300,300), 'size'=>array(400,800) ) ),
[ 'expected' => [ 'fit' => [150,300] ,'close' => [300,600] ]],
// array( 'label'=>'TEST: fit[300*300] size[600*600]', 'test'=>array( 'fit'=>array(300,300), 'size'=>array(600,600) ) ),
[ 'expected' => [ 'fit' => [300,300] ,'close' => [300,300] ]],
// array( 'label'=>'TEST: fit[800*400] size[300*200]', 'test'=>array( 'fit'=>array(800,400), 'size'=>array(300,200) ) ),
[ 'expected' => [ 'fit' => [600,400] ,'close' => [800,534] ]],
// array( 'label'=>'TEST: fit[800*400] size[200*300]', 'test'=>array( 'fit'=>array(800,400), 'size'=>array(200,300) ) ),
[ 'expected' => [ 'fit' => [267,400] ,'close' => [800,1200] ]],
// array( 'label'=>'TEST: fit[800*400] size[300*300]', 'test'=>array( 'fit'=>array(800,400), 'size'=>array(300,300) ) ),
[ 'expected' => [ 'fit' => [400,400] ,'close' => [800,800] ]],
// array( 'label'=>'TEST: fit[400*800] size[300*200]', 'test'=>array( 'fit'=>array(400,800), 'size'=>array(300,200) ) ),
[ 'expected' => [ 'fit' => [400,267] ,'close' => [1200,800] ]],
// array( 'label'=>'TEST: fit[400*800] size[200*300]', 'test'=>array( 'fit'=>array(400,800), 'size'=>array(200,300) ) ),
[ 'expected' => [ 'fit' => [400,600] ,'close' => [534,800] ]],
// array( 'label'=>'TEST: fit[400*800] size[300*300]', 'test'=>array( 'fit'=>array(400,800), 'size'=>array(300,300) ) ),
[ 'expected' => [ 'fit' => [400,400] ,'close' => [800,800] ]],
// array( 'label'=>'TEST: fit[600*600] size[300*200]', 'test'=>array( 'fit'=>array(600,600), 'size'=>array(300,200) ) ),
[ 'expected' => [ 'fit' => [600,400] ,'close' => [900,600] ]],
// array( 'label'=>'TEST: fit[600*600] size[200*300]', 'test'=>array( 'fit'=>array(600,600), 'size'=>array(200,300) ) ),
[ 'expected' => [ 'fit' => [400,600] ,'close' => [600,900] ]],
// array( 'label'=>'TEST: fit[600*600] size[300*300]', 'test'=>array( 'fit'=>array(600,600), 'size'=>array(300,300) ) ),
[ 'expected' => [ 'fit' => [600,600] ,'close' => [600,600] ]],
// array( 'label'=>'TEST: fit[300*500] size[800*400]', 'test'=>array( 'fit'=>array(300,500), 'size'=>array(800,400) ) ),
[ 'expected' => [ 'fit' => [300,150] ,'close' => [1000,500] ]],
// array( 'label'=>'TEST: fit[300*500] size[400*800]', 'test'=>array( 'fit'=>array(300,500), 'size'=>array(400,800) ) ),
[ 'expected' => [ 'fit' => [250,500] ,'close' => [300,600] ]],
// array( 'label'=>'TEST: fit[500*300] size[800*400]', 'test'=>array( 'fit'=>array(500,300), 'size'=>array(800,400) ) ),
[ 'expected' => [ 'fit' => [500,250] ,'close' => [600,300] ]],
// array( 'label'=>'TEST: fit[500*300] size[400*800]', 'test'=>array( 'fit'=>array(500,300), 'size'=>array(400,800) ) ),
[ 'expected' => [ 'fit' => [150,300] ,'close' => [500,1000] ]],
// array( 'label'=>'TEST: fit[800*100] size[300*200]', 'test'=>array( 'fit'=>array(800,100), 'size'=>array(300,200) ) ),
[ 'expected' => [ 'fit' => [150,100] ,'close' => [800,534] ]],
// array( 'label'=>'TEST: fit[800*100] size[200*300]', 'test'=>array( 'fit'=>array(800,100), 'size'=>array(200,300) ) ),
[ 'expected' => [ 'fit' => [67,100] ,'close' => [800,1200] ]],
// array( 'label'=>'TEST: fit[100*800] size[300*200]', 'test'=>array( 'fit'=>array(100,800), 'size'=>array(300,200) ) ),
[ 'expected' => [ 'fit' => [100,67] ,'close' => [1200,800] ]],
// array( 'label'=>'TEST: fit[100*800] size[200*300]', 'test'=>array( 'fit'=>array(100,800), 'size'=>array(200,300) ) ),
[ 'expected' => [ 'fit' => [100,150] ,'close' => [534,800] ]],
];
