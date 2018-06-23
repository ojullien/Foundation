<?php
// 'Exception'=> 0:none, 1:PHPUnit_Framework_Error_Warning, 2:PHPUnit_Framework_Error_Notice, 3:\Exception
$this->_aTests[self::KEY_RESULT] = array(
//// Non quoted valid
//array( 'label'=>'TEST: Abc' , 'test'=>'Abc' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => 'Abc' ),
                         '__toString' => array( 'exception'=>0, 'return' => 'Abc' ),
                          'getLength' => array( 'exception'=>0, 'return' => 3 ),
                             'getRaw' => array( 'exception'=>0, 'return' => 'Abc' ) )),
//array( 'label'=>'TEST: Abc.123' , 'test'=>'Abc.123' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => 'Abc.123' ),
                         '__toString' => array( 'exception'=>0, 'return' => 'Abc.123' ),
                          'getLength' => array( 'exception'=>0, 'return' => 7 ),
                             'getRaw' => array( 'exception'=>0, 'return' => 'Abc.123' ) )),
//array( 'label'=>'TEST: 123' , 'test'=>'123' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '123' ),
                         '__toString' => array( 'exception'=>0, 'return' => '123' ),
                          'getLength' => array( 'exception'=>0, 'return' => 3 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '123' ) )),
//array( 'label'=>'TEST: 123-Abc' , 'test'=>'123-Abc' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '123-Abc' ),
                         '__toString' => array( 'exception'=>0, 'return' => '123-Abc' ),
                          'getLength' => array( 'exception'=>0, 'return' => 7 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '123-Abc' ) )),
//array( 'label'=>'TEST: 12.-.Abc' , 'test'=>'12.-.Abc' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '12.-.Abc' ),
                         '__toString' => array( 'exception'=>0, 'return' => '12.-.Abc' ),
                          'getLength' => array( 'exception'=>0, 'return' => 8 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '12.-.Abc' ) )),
//array( 'label'=>'TEST: user+mailbox' , 'test'=>'user+mailbox' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => 'user+mailbox' ),
                         '__toString' => array( 'exception'=>0, 'return' => 'user+mailbox' ),
                          'getLength' => array( 'exception'=>0, 'return' => 12 ),
                             'getRaw' => array( 'exception'=>0, 'return' => 'user+mailbox' ) )),
//array( 'label'=>'TEST: customer/department=shipping' , 'test'=>'customer/department=shipping' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => 'customer/department=shipping' ),
                         '__toString' => array( 'exception'=>0, 'return' => 'customer/department=shipping' ),
                          'getLength' => array( 'exception'=>0, 'return' => 28 ),
                             'getRaw' => array( 'exception'=>0, 'return' => 'customer/department=shipping' ) )),
//array( 'label'=>'TEST: user+mailbox/department=shipping' , 'test'=>'user+mailbox/department=shipping' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => 'user+mailbox/department=shipping' ),
                         '__toString' => array( 'exception'=>0, 'return' => 'user+mailbox/department=shipping' ),
                          'getLength' => array( 'exception'=>0, 'return' => 32 ),
                             'getRaw' => array( 'exception'=>0, 'return' => 'user+mailbox/department=shipping' ) )),
//array( 'label'=>'TEST: !#$%&\'*+-/=?^_`.{|}~' , 'test'=>'!#$%&\'*+-/=?^_`.{|}~' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '!#$%&\'*+-/=?^_`.{|}~' ),
                         '__toString' => array( 'exception'=>0, 'return' => '!#$%&\'*+-/=?^_`.{|}~' ),
                          'getLength' => array( 'exception'=>0, 'return' => 20 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '!#$%&\'*+-/=?^_`.{|}~' ) )),
//array( 'label'=>'TEST: !def!xyz%abc' , 'test'=>'!def!xyz%abc' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '!def!xyz%abc' ),
                         '__toString' => array( 'exception'=>0, 'return' => '!def!xyz%abc' ),
                          'getLength' => array( 'exception'=>0, 'return' => 12 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '!def!xyz%abc' ) )),
//array( 'label'=>'TEST: _somename' , 'test'=>'_somename' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '_somename' ),
                         '__toString' => array( 'exception'=>0, 'return' => '_somename' ),
                          'getLength' => array( 'exception'=>0, 'return' => 9 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '_somename' ) )),
//array( 'label'=>'TEST: Abc.example.com' , 'test'=>'Abc.example.com' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => 'Abc.example.com' ),
                         '__toString' => array( 'exception'=>0, 'return' => 'Abc.example.com' ),
                          'getLength' => array( 'exception'=>0, 'return' => 15 ),
                             'getRaw' => array( 'exception'=>0, 'return' => 'Abc.example.com' ) )),
//// Non quoted invalid
//array( 'label'=>'TEST: Abc..123' , 'test'=>'Abc..123' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => 'Abc..123' ) )),
//array( 'label'=>'TEST: Abc@def' , 'test'=>'Abc@def' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => 'Abc@def' ) )),
//array( 'label'=>'TEST: Abc\@def' , 'test'=>'Abc\@def' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => 'Abc\@def' ) )),
//array( 'label'=>'TEST: Fred Bloggs' , 'test'=>'Fred Bloggs' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => 'Fred Bloggs' ) )),
//array( 'label'=>'TEST: Fred\ Bloggs' , 'test'=>'Fred\ Bloggs' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => 'Fred\ Bloggs' ) )),
//array( 'label'=>'TEST: Joe.\\Blow' , 'test'=>'Joe.\\Blow' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => 'Joe.\\Blow' ) )),
//array( 'label'=>'TEST: Abc.' , 'test'=>'Abc.' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => 'Abc.' ) )),
//array( 'label'=>'TEST: .Abc' , 'test'=>'.Abc' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => '.Abc' ) )),
//// Quoted valid
//array( 'label'=>'TEST: quoted Abc' , 'test'=>'"Abc"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Abc"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Abc"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 5 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"Abc"' ) )),
//array( 'label'=>'TEST: quoted Abc.123' , 'test'=>'"Abc.123"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Abc.123"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Abc.123"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 9 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"Abc.123"' ) )),
//array( 'label'=>'TEST: quoted 123' , 'test'=>'"123"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"123"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"123"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 5 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"123"' ) )),
//array( 'label'=>'TEST: quoted 123-Abc' , 'test'=>'"123-Abc"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"123-Abc"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"123-Abc"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 9 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"123-Abc"' ) )),
//array( 'label'=>'TEST: quoted 12.-.Abc' , 'test'=>'"12.-.Abc"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"12.-.Abc"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"12.-.Abc"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 10 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"12.-.Abc"' ) )),
//array( 'label'=>'TEST: quoted user+mailbox' , 'test'=>'"user+mailbox"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"user+mailbox"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"user+mailbox"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 14 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"user+mailbox"' ) )),
//array( 'label'=>'TEST: quoted customer/department=shipping' , 'test'=>'"customer/department=shipping"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"customer/department=shipping"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"customer/department=shipping"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 30 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"customer/department=shipping"' ) )),
//array( 'label'=>'TEST: quoted user+mailbox/department=shipping' , 'test'=>'"user+mailbox/department=shipping"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"user+mailbox/department=shipping"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"user+mailbox/department=shipping"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 34 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"user+mailbox/department=shipping"' ) )),
//array( 'label'=>'TEST: quoted !#$%&\'*+-/=?^_`.{|}~' , 'test'=>'"!#$%&\'*+-/=?^_`.{|}~"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"!#$%&\'*+-/=?^_`.{|}~"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"!#$%&\'*+-/=?^_`.{|}~"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 22 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"!#$%&\'*+-/=?^_`.{|}~"' ) )),
//array( 'label'=>'TEST: quoted !def!xyz%abc' , 'test'=>'"!def!xyz%abc"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"!def!xyz%abc"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"!def!xyz%abc"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 14 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"!def!xyz%abc"' ) )),
//array( 'label'=>'TEST: quoted _somename' , 'test'=>'"_somename"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"_somename"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"_somename"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 11 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"_somename"' ) )),
//array( 'label'=>'TEST: quoted Abc@def' , 'test'=>'"Abc@def"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Abc@def"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Abc@def"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 9 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"Abc@def"' ) )),
//array( 'label'=>'TEST: quoted Abc\@def' , 'test'=>'"Abc\@def"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Abc\@def"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Abc\@def"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 10 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"Abc\@def"' ) )),
//array( 'label'=>'TEST: quoted Fred Bloggs' , 'test'=>'"Fred Bloggs"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Fred Bloggs"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Fred Bloggs"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 13 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"Fred Bloggs"' ) )),
//array( 'label'=>'TEST: quoted Fred\ Bloggs' , 'test'=>'"Fred\ Bloggs"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Fred\ Bloggs"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Fred\ Bloggs"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 14 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"Fred\ Bloggs"' ) )),
//array( 'label'=>'TEST: quoted Joe.\\Blow' , 'test'=>'"Joe.\\Blow"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Joe.\\Blow"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Joe.\\Blow"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 11 ),
                             'getRaw' => array( 'exception'=>0, 'return' => '"Joe.\\Blow"' ) )),
//array( 'label'=>'TEST: quoted Abc.example.com' , 'test'=>'"Abc.example.com"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => TRUE ),
                           'getValue' => array( 'exception'=>0, 'return' => '"Abc.example.com"' ),
                         '__toString' => array( 'exception'=>0, 'return' => '"Abc.example.com"' ),
                          'getLength' => array( 'exception'=>0, 'return' => 17 ),
                            'getRaw' => array( 'exception'=>0, 'return' => '"Abc.example.com"' ) )),
//// Quoted invalid
//array( 'label'=>'TEST: quoted Abc..123' , 'test'=>'"Abc..123"' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => '"Abc..123"' ) )),
//array( 'label'=>'TEST: quoted Abc.' , 'test'=>'"Abc."' ),
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => '"Abc."' ) )),
//array( 'label'=>'TEST: quoted .Abc' , 'test'=>'".Abc"' )
array( 'expected'=>array( 'exception' => 0,
                            'isvalid' => array( 'exception'=>0, 'return' => FALSE ),
                           'getValue' => array( 'exception'=>0, 'return' => NULL ),
                         '__toString' => array( 'exception'=>0, 'return' => '' ),
                          'getLength' => array( 'exception'=>0, 'return' => 0 ),
                            'getRaw' => array( 'exception'=>0, 'return' => '".Abc"' ) )),
);