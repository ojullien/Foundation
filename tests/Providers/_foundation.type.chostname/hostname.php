<?php
$this->_aTests[self::KEY_TEST] = array(
// DNS VALID
array( 'label'=>'TEST: example.com'     , 'test'=>array( 'idn'=>'example.com'   , 'punycode'=>'example.com' ) ),
array( 'label'=>'TEST: example.museum'  , 'test'=>array( 'idn'=>'example.museum', 'punycode'=>'example.museum' ) ),
array( 'label'=>'TEST: d.hatena.ne.jp'  , 'test'=>array( 'idn'=>'d.hatena.ne.jp', 'punycode'=>'d.hatena.ne.jp' ) ),
array( 'label'=>'TEST: 123example.com'  , 'test'=>array( 'idn'=>'123example.com', 'punycode'=>'123example.com' ) ),
array( 'label'=>'TEST: 1and1.fr'        , 'test'=>array( 'idn'=>'1and1.fr'      , 'punycode'=>'1and1.fr' ) ),
array( 'label'=>'TEST: doma-in.com'     , 'test'=>array( 'idn'=>'doma-in.com'   , 'punycode'=>'doma-in.com' ) ),
array( 'label'=>'TEST: domain.co.uk'    , 'test'=>array( 'idn'=>'domain.co.uk'  , 'punycode'=>'domain.co.uk' ) ),
// DNS NOT VALID
array( 'label'=>'TEST: example..'                     , 'test'=>array( 'idn'=>'example..'                     , 'punycode'=>'example..' ) ),
array( 'label'=>'TEST: example..com'                  , 'test'=>array( 'idn'=>'example..com'                  , 'punycode'=>'example..com' ) ),
array( 'label'=>'TEST: example,com'                   , 'test'=>array( 'idn'=>'example,com'                   , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: exam_ple.com'                  , 'test'=>array( 'idn'=>'exam_ple.com'                  , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: .example.com'                  , 'test'=>array( 'idn'=>'.example.com'                  , 'punycode'=>'.example.com' ) ),
array( 'label'=>'TEST: -domain.com'                   , 'test'=>array( 'idn'=>'-domain.com'                   , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: domain-.com'                   , 'test'=>array( 'idn'=>'domain-.com'                   , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: do--main.com'                  , 'test'=>array( 'idn'=>'do--main.com'                  , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: yah&oo.com'                    , 'test'=>array( 'idn'=>'yah&oo.com'                    , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: y*ahoo.com'                    , 'test'=>array( 'idn'=>'y*ahoo.com'                    , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: ya#hoo'                        , 'test'=>array( 'idn'=>'ya#hoo'                        , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: test.com / http://www.test.com', 'test'=>array( 'idn'=>'test.com / http://www.test.com', 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: ~ex%20ample'                   , 'test'=>array( 'idn'=>'~ex%20ample'                   , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: §bad'                          , 'test'=>array( 'idn'=>'§bad'                          , 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: don?t.know'                    , 'test'=>array( 'idn'=>'don?t.know'                    , 'punycode'=>FALSE ) ),
// TLD
array( 'label'=>'TEST: www.danger1com', 'test'=>array( 'idn'=>'www.danger1com', 'punycode'=>'www.danger1com' ) ),
array( 'label'=>'TEST: dangercom'     , 'test'=>array( 'idn'=>'dangercom'     , 'punycode'=>'dangercom' ) ),
array( 'label'=>'TEST: www.dangercom' , 'test'=>array( 'idn'=>'www.dangercom' , 'punycode'=>'www.dangercom' ) ),
array( 'label'=>'TEST: example.f1'    , 'test'=>array( 'idn'=>'example.f1' , 'punycode'=>'example.f1' ) ),
array( 'label'=>'TEST: example.f-r'   , 'test'=>array( 'idn'=>'example.f-r', 'punycode'=>'example.f-r' ) ),
// TLD NOT VALID
array( 'label'=>'TEST: example.c'  , 'test'=>array( 'idn'=>'example.c'  , 'punycode'=>'example.c' ) ),
array( 'label'=>'TEST: example.123', 'test'=>array( 'idn'=>'example.123', 'punycode'=>'example.123' ) ),
array( 'label'=>'TEST: example.-fr'  , 'test'=>array( 'idn'=>'example.-fr'  , 'punycode'=>'example.-fr' ) ),
array( 'label'=>'TEST: example.fr-'  , 'test'=>array( 'idn'=>'example.fr-'  , 'punycode'=>'example.fr-' ) ),
// LOCAL VALID
array( 'label'=>'TEST: localhost'            , 'test'=>array( 'idn'=>'localhost'            , 'punycode'=>'localhost' ) ),
array( 'label'=>'TEST: localhost.localdomain', 'test'=>array( 'idn'=>'localhost.localdomain', 'punycode'=>'localhost.localdomain' ) ),
// LOCAL NOT VALID
array( 'label'=>'TEST: local host', 'test'=>array( 'idn'=>'local host', 'punycode'=>FALSE ) ),
array( 'label'=>'TEST: .localhost', 'test'=>array( 'idn'=>'.localhost', 'punycode'=>'.localhost' ) ),
// PUNYCODE NOT VALID
array( 'label'=>'TEST: xn--brger-x45d2va.com', 'test'=>array( 'idn'=>FALSE, 'punycode'=>'xn--brger-x45d2va.com' ) ),
array( 'label'=>'TEST: xn--bürger.com'       , 'test'=>array( 'idn'=>FALSE, 'punycode'=>'xn--bürger.com' ) ),
array( 'label'=>'TEST: xn--'                 , 'test'=>array( 'idn'=>FALSE, 'punycode'=>'xn--' ) ),
// PARTIAL
array( 'label'=>'TEST: example.'        , 'test'=>array( 'idn'=>'example.'    , 'punycode'=>'example.' ) ),
array( 'label'=>'TEST: example.com.'    , 'test'=>array( 'idn'=>'example.com.', 'punycode'=>'example.com.' ) ),
array( 'label'=>'TEST: ~ex%20ample.'    , 'test'=>array( 'idn'=>'~ex%20ample.', 'punycode'=>FALSE ) ),
// IDN VALID
array( 'label'=>'TEST: café-glacé.com'  , 'test'=>array( 'idn'=>'café-glacé.com'  , 'punycode'=>'xn--caf-glac-d1af.com' ) ),
array( 'label'=>'TEST: café.glacé.com'  , 'test'=>array( 'idn'=>'café.glacé.com'  , 'punycode'=>'xn--caf-dma.xn--glac-epa.com' ) ),
array( 'label'=>'TEST: 1café.glacé2.com', 'test'=>array( 'idn'=>'1café.glacé2.com', 'punycode'=>'xn--1caf-epa.xn--glac2-esa.com' ) ),
array( 'label'=>'TEST: 上海世博会.中国'   , 'test'=>array( 'idn'=>'上海世博会.中国'    , 'punycode'=>'xn--fhqya62el8j7s3b.xn--fiqs8s' ) ),
array( 'label'=>'TEST: Latin supernovæ.fr', 'test'=>array( 'idn'=>'supernovæ.fr', 'punycode'=>'xn--supernov-q0a.fr' ) ),
array( 'label'=>'TEST: Arabic مثال.إختبار', 'test'=>array( 'idn'=>'مثال.إختبار', 'punycode'=>'xn--mgbh0fb.xn--kgbechtv' ) ),
array( 'label'=>'TEST: Simplified Chinese 例子.测试', 'test'=>array( 'idn'=>'例子.测试', 'punycode'=>'xn--fsqu00a.xn--0zwm56d' ) ),
array( 'label'=>'TEST: Traditional Chinese 例子.測試', 'test'=>array( 'idn'=>'例子.測試', 'punycode'=>'xn--fsqu00a.xn--g6w251d' ) ),
array( 'label'=>'TEST: Greek παράδειγμα.δοκιμή', 'test'=>array( 'idn'=>'παράδειγμα.δοκιμή', 'punycode'=>'xn--hxajbheg2az3al.xn--jxalpdlp' ) ),
array( 'label'=>'TEST: Devanagari Hindi उदाहरण.परीक्षा', 'test'=>array( 'idn'=>'उदाहरण.परीक्षा', 'punycode'=>'xn--p1b6ci4b4b3a.xn--11b5bs3a9aj6g' ) ), // No encoding
array( 'label'=>'TEST: Kanji, Hiragana, Katakana Japanese 例え.テスト', 'test'=>array( 'idn'=>'例え.テスト', 'punycode'=>'xn--r8jz45g.xn--zckzah' ) ),
array( 'label'=>'TEST: Hangul Korean 실례.테스트', 'test'=>array( 'idn'=>'실례.테스트', 'punycode'=>'xn--9n2bp8q.xn--9t4b11yi5a' ) ),
array( 'label'=>'TEST: Perso-Arabic مثال.آزمایشی', 'test'=>array( 'idn'=>'مثال.آزمایشی', 'punycode'=>'xn--mgbh0fb.xn--hgbk6aj7f53bba' ) ),
array( 'label'=>'TEST: Cyrillic Russian пример.испытание', 'test'=>array( 'idn'=>'пример.испытание', 'punycode'=>'xn--e1afmkfd.xn--80akhbyknj4f' ) ),
array( 'label'=>'TEST: Tamil உதாரணம்.பரிட்சை', 'test'=>array( 'idn'=>'உதாரணம்.பரிட்சை', 'punycode'=>'xn--zkc6cc5bi7f6e.xn--hlcj6aya9esc7a' ) ), // No encoding
array( 'label'=>'TEST: Hebrew Yiddish בײַשפּיל.טעסט', 'test'=>array( 'idn'=>'בײַשפּיל.טעסט', 'punycode'=>'xn--fdbk5d8ap9b8a8d.xn--deba0ad' ) ), // No encoding
array( 'label'=>'TEST: Ge\'ez Amharic አማርኛ.idn.icann.org', 'test'=>array( 'idn'=>'አማርኛ.idn.icann.org', 'punycode'=>'xn--1xd0bwwra.idn.icann.org' ) ),
array( 'label'=>'TEST: Bengali বাংলা.idn.icann.org', 'test'=>array( 'idn'=>'বাংলা.idn.icann.org', 'punycode'=>'xn--54b7fta0cc.idn.icann.org' ) ), // No encoding
array( 'label'=>'TEST: Hebrew עברית.idn.icann.org', 'test'=>array( 'idn'=>'עברית.idn.icann.org', 'punycode'=>'xn--5dbqzzl.idn.icann.org' ) ),
array( 'label'=>'TEST: Khmer ភាសាខ្មែរ.idn.icann.org', 'test'=>array( 'idn'=>'ភាសាខ្មែរ.idn.icann.org', 'punycode'=>'xn--j2e7beiw1lb2hqg.idn.icann.org' ) ), // No encoding
array( 'label'=>'TEST: Thai ไทย.idn.icann.org', 'test'=>array( 'idn'=>'ไทย.idn.icann.org', 'punycode'=>'xn--o3cw4h.idn.icann.org' ) ),
array( 'label'=>'TEST: Persian Urdu اردو.idn.icann.org', 'test'=>array( 'idn'=>'اردو.idn.icann.org', 'punycode'=>'xn--mgbqf7g.idn.icann.org' ) ),
);