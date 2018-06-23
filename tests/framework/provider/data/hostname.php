<?php
return [
// DNS VALID
[ 'label'=>'TEST: example.com'     , 'test'=>[ 'idn'=>'example.com'   , 'punycode'=>'example.com' ] ],
[ 'label'=>'TEST: example.museum'  , 'test'=>[ 'idn'=>'example.museum', 'punycode'=>'example.museum' ] ],
[ 'label'=>'TEST: d.hatena.ne.jp'  , 'test'=>[ 'idn'=>'d.hatena.ne.jp', 'punycode'=>'d.hatena.ne.jp' ] ],
[ 'label'=>'TEST: 123example.com'  , 'test'=>[ 'idn'=>'123example.com', 'punycode'=>'123example.com' ] ],
[ 'label'=>'TEST: 1and1.fr'        , 'test'=>[ 'idn'=>'1and1.fr'      , 'punycode'=>'1and1.fr' ] ],
[ 'label'=>'TEST: doma-in.com'     , 'test'=>[ 'idn'=>'doma-in.com'   , 'punycode'=>'doma-in.com' ] ],
[ 'label'=>'TEST: domain.co.uk'    , 'test'=>[ 'idn'=>'domain.co.uk'  , 'punycode'=>'domain.co.uk' ] ],
// DNS NOT VALID
[ 'label'=>'TEST: example..'                     , 'test'=>[ 'idn'=>'example..'                     , 'punycode'=>'example..' ] ],
[ 'label'=>'TEST: example..com'                  , 'test'=>[ 'idn'=>'example..com'                  , 'punycode'=>'example..com' ] ],
[ 'label'=>'TEST: example,com'                   , 'test'=>[ 'idn'=>'example,com'                   , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: exam_ple.com'                  , 'test'=>[ 'idn'=>'exam_ple.com'                  , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: .example.com'                  , 'test'=>[ 'idn'=>'.example.com'                  , 'punycode'=>'.example.com' ] ],
[ 'label'=>'TEST: -domain.com'                   , 'test'=>[ 'idn'=>'-domain.com'                   , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: domain-.com'                   , 'test'=>[ 'idn'=>'domain-.com'                   , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: do--main.com'                  , 'test'=>[ 'idn'=>'do--main.com'                  , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: yah&oo.com'                    , 'test'=>[ 'idn'=>'yah&oo.com'                    , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: y*ahoo.com'                    , 'test'=>[ 'idn'=>'y*ahoo.com'                    , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: ya#hoo'                        , 'test'=>[ 'idn'=>'ya#hoo'                        , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: test.com / http://www.test.com', 'test'=>[ 'idn'=>'test.com / http://www.test.com', 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: ~ex%20ample'                   , 'test'=>[ 'idn'=>'~ex%20ample'                   , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: §bad'                          , 'test'=>[ 'idn'=>'§bad'                          , 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: don?t.know'                    , 'test'=>[ 'idn'=>'don?t.know'                    , 'punycode'=>FALSE ] ],
// TLD
[ 'label'=>'TEST: www.danger1com', 'test'=>[ 'idn'=>'www.danger1com', 'punycode'=>'www.danger1com' ] ],
[ 'label'=>'TEST: dangercom'     , 'test'=>[ 'idn'=>'dangercom'     , 'punycode'=>'dangercom' ] ],
[ 'label'=>'TEST: www.dangercom' , 'test'=>[ 'idn'=>'www.dangercom' , 'punycode'=>'www.dangercom' ] ],
[ 'label'=>'TEST: example.f1'    , 'test'=>[ 'idn'=>'example.f1' , 'punycode'=>'example.f1' ] ],
[ 'label'=>'TEST: example.f-r'   , 'test'=>[ 'idn'=>'example.f-r', 'punycode'=>'example.f-r' ] ],
// TLD NOT VALID
[ 'label'=>'TEST: example.c'  , 'test'=>[ 'idn'=>'example.c'  , 'punycode'=>'example.c' ] ],
[ 'label'=>'TEST: example.123', 'test'=>[ 'idn'=>'example.123', 'punycode'=>'example.123' ] ],
[ 'label'=>'TEST: example.-fr'  , 'test'=>[ 'idn'=>'example.-fr'  , 'punycode'=>'example.-fr' ] ],
[ 'label'=>'TEST: example.fr-'  , 'test'=>[ 'idn'=>'example.fr-'  , 'punycode'=>'example.fr-' ] ],
// LOCAL VALID
[ 'label'=>'TEST: localhost'            , 'test'=>[ 'idn'=>'localhost'            , 'punycode'=>'localhost' ] ],
[ 'label'=>'TEST: localhost.localdomain', 'test'=>[ 'idn'=>'localhost.localdomain', 'punycode'=>'localhost.localdomain' ] ],
// LOCAL NOT VALID
[ 'label'=>'TEST: local host', 'test'=>[ 'idn'=>'local host', 'punycode'=>FALSE ] ],
[ 'label'=>'TEST: .localhost', 'test'=>[ 'idn'=>'.localhost', 'punycode'=>'.localhost' ] ],
// PUNYCODE NOT VALID
[ 'label'=>'TEST: xn--brger-x45d2va.com', 'test'=>[ 'idn'=>FALSE, 'punycode'=>'xn--brger-x45d2va.com' ] ],
[ 'label'=>'TEST: xn--bürger.com'       , 'test'=>[ 'idn'=>FALSE, 'punycode'=>'xn--bürger.com' ] ],
[ 'label'=>'TEST: xn--'                 , 'test'=>[ 'idn'=>FALSE, 'punycode'=>'xn--' ] ],
// PARTIAL
[ 'label'=>'TEST: example.'        , 'test'=>[ 'idn'=>'example.'    , 'punycode'=>'example.' ] ],
[ 'label'=>'TEST: example.com.'    , 'test'=>[ 'idn'=>'example.com.', 'punycode'=>'example.com.' ] ],
[ 'label'=>'TEST: ~ex%20ample.'    , 'test'=>[ 'idn'=>'~ex%20ample.', 'punycode'=>FALSE ] ],
// IDN VALID
[ 'label'=>'TEST: café-glacé.com'  , 'test'=>[ 'idn'=>'café-glacé.com'  , 'punycode'=>'xn--caf-glac-d1af.com' ] ],
[ 'label'=>'TEST: café.glacé.com'  , 'test'=>[ 'idn'=>'café.glacé.com'  , 'punycode'=>'xn--caf-dma.xn--glac-epa.com' ] ],
[ 'label'=>'TEST: 1café.glacé2.com', 'test'=>[ 'idn'=>'1café.glacé2.com', 'punycode'=>'xn--1caf-epa.xn--glac2-esa.com' ] ],
[ 'label'=>'TEST: 上海世博会.中国'   , 'test'=>[ 'idn'=>'上海世博会.中国'    , 'punycode'=>'xn--fhqya62el8j7s3b.xn--fiqs8s' ] ],
[ 'label'=>'TEST: Latin supernovæ.fr', 'test'=>[ 'idn'=>'supernovæ.fr', 'punycode'=>'xn--supernov-q0a.fr' ] ],
[ 'label'=>'TEST: Arabic مثال.إختبار', 'test'=>[ 'idn'=>'مثال.إختبار', 'punycode'=>'xn--mgbh0fb.xn--kgbechtv' ] ],
[ 'label'=>'TEST: Simplified Chinese 例子.测试', 'test'=>[ 'idn'=>'例子.测试', 'punycode'=>'xn--fsqu00a.xn--0zwm56d' ] ],
[ 'label'=>'TEST: Traditional Chinese 例子.測試', 'test'=>[ 'idn'=>'例子.測試', 'punycode'=>'xn--fsqu00a.xn--g6w251d' ] ],
[ 'label'=>'TEST: Greek παράδειγμα.δοκιμή', 'test'=>[ 'idn'=>'παράδειγμα.δοκιμή', 'punycode'=>'xn--hxajbheg2az3al.xn--jxalpdlp' ] ],
[ 'label'=>'TEST: Devanagari Hindi उदाहरण.परीक्षा', 'test'=>[ 'idn'=>'उदाहरण.परीक्षा', 'punycode'=>'xn--p1b6ci4b4b3a.xn--11b5bs3a9aj6g' ] ], // No encoding
[ 'label'=>'TEST: Kanji, Hiragana, Katakana Japanese 例え.テスト', 'test'=>[ 'idn'=>'例え.テスト', 'punycode'=>'xn--r8jz45g.xn--zckzah' ] ],
[ 'label'=>'TEST: Hangul Korean 실례.테스트', 'test'=>[ 'idn'=>'실례.테스트', 'punycode'=>'xn--9n2bp8q.xn--9t4b11yi5a' ] ],
[ 'label'=>'TEST: Perso-Arabic مثال.آزمایشی', 'test'=>[ 'idn'=>'مثال.آزمایشی', 'punycode'=>'xn--mgbh0fb.xn--hgbk6aj7f53bba' ] ],
[ 'label'=>'TEST: Cyrillic Russian пример.испытание', 'test'=>[ 'idn'=>'пример.испытание', 'punycode'=>'xn--e1afmkfd.xn--80akhbyknj4f' ] ],
[ 'label'=>'TEST: Tamil உதாரணம்.பரிட்சை', 'test'=>[ 'idn'=>'உதாரணம்.பரிட்சை', 'punycode'=>'xn--zkc6cc5bi7f6e.xn--hlcj6aya9esc7a' ] ], // No encoding
[ 'label'=>'TEST: Hebrew Yiddish בײַשפּיל.טעסט', 'test'=>[ 'idn'=>'בײַשפּיל.טעסט', 'punycode'=>'xn--fdbk5d8ap9b8a8d.xn--deba0ad' ] ], // No encoding
[ 'label'=>'TEST: Ge\'ez Amharic አማርኛ.idn.icann.org', 'test'=>[ 'idn'=>'አማርኛ.idn.icann.org', 'punycode'=>'xn--1xd0bwwra.idn.icann.org' ] ],
[ 'label'=>'TEST: Bengali বাংলা.idn.icann.org', 'test'=>[ 'idn'=>'বাংলা.idn.icann.org', 'punycode'=>'xn--54b7fta0cc.idn.icann.org' ] ], // No encoding
[ 'label'=>'TEST: Hebrew עברית.idn.icann.org', 'test'=>[ 'idn'=>'עברית.idn.icann.org', 'punycode'=>'xn--5dbqzzl.idn.icann.org' ] ],
[ 'label'=>'TEST: Khmer ភាសាខ្មែរ.idn.icann.org', 'test'=>[ 'idn'=>'ភាសាខ្មែរ.idn.icann.org', 'punycode'=>'xn--j2e7beiw1lb2hqg.idn.icann.org' ] ], // No encoding
[ 'label'=>'TEST: Thai ไทย.idn.icann.org', 'test'=>[ 'idn'=>'ไทย.idn.icann.org', 'punycode'=>'xn--o3cw4h.idn.icann.org' ] ],
[ 'label'=>'TEST: Persian Urdu اردو.idn.icann.org', 'test'=>[ 'idn'=>'اردو.idn.icann.org', 'punycode'=>'xn--mgbqf7g.idn.icann.org' ] ],
];