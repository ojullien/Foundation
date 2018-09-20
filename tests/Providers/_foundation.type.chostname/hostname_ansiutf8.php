<?php
/**
 * Foundation Framework
 *
 * @package   IDN
 * @copyright (©) 2010-2013, Olivier Jullien <olivier.jullien@outlook.com>
 * @license   Private
 */
$this->_aTests[self::KEY_TEST] = [
[ 'label' => 'TEST: 上海世博会.中国', 'test' => [ 'utf8' => '上海世博会.中国', 'idn' => 'xn--fhqya62el8j7s3b.xn--fiqs8s' ] ],
[ 'label' => 'TEST: Arabic مثال.إختبار', 'test' => [ 'utf8' => 'مثال.إختبار', 'idn' => 'xn--mgbh0fb.xn--kgbechtv' ] ],
[ 'label' => 'TEST: Simplified Chinese 例子.测试', 'test' => [ 'utf8' => '例子.测试', 'idn' => 'xn--fsqu00a.xn--0zwm56d' ] ],
[ 'label' => 'TEST: Traditional Chinese 例子.測試', 'test' => [ 'utf8' => '例子.測試', 'idn' => 'xn--fsqu00a.xn--g6w251d' ] ],
[ 'label' => 'TEST: Greek παράδειγμα.δοκιμή', 'test' => [ 'utf8' => 'παράδειγμα.δοκιμή', 'idn' => 'xn--hxajbheg2az3al.xn--jxalpdlp' ] ],
[ 'label' => 'TEST: Devanagari Hindi उदाहरण.परीक्षा', 'test' => [ 'utf8' => 'उदाहरण.परीक्षा', 'idn' => 'xn--p1b6ci4b4b3a.xn--11b5bs3a9aj6g' ] ],
[ 'label' => 'TEST: Kanji, Hiragana, Katakana Japanese 例え.テスト', 'test' => [ 'utf8' => '例え.テスト', 'idn' => 'xn--r8jz45g.xn--zckzah' ] ],
[ 'label' => 'TEST: Hangul Korean 실례.테스트', 'test' => [ 'utf8' => '실례.테스트', 'idn' => 'xn--9n2bp8q.xn--9t4b11yi5a' ] ],
[ 'label' => 'TEST: Perso-Arabic مثال.آزمایشی', 'test' => [ 'utf8' => 'مثال.آزمایشی', 'idn' => 'xn--mgbh0fb.xn--hgbk6aj7f53bba' ] ],
[ 'label' => 'TEST: Cyrillic Russian пример.испытание', 'test' => [ 'utf8' => 'пример.испытание', 'idn' => 'xn--e1afmkfd.xn--80akhbyknj4f' ] ],
[ 'label' => 'TEST: Tamil உதாரணம்.பரிட்சை', 'test' => [ 'utf8' => 'உதாரணம்.பரிட்சை', 'idn' => 'xn--zkc6cc5bi7f6e.xn--hlcj6aya9esc7a' ] ],
[ 'label' => 'TEST: Hebrew Yiddish בײַשפּיל.טעסט', 'test' => [ 'utf8' => 'בײַשפּיל.טעסט', 'idn' => 'xn--fdbk5d8ap9b8a8d.xn--deba0ad' ] ],
[ 'label' => 'TEST: Ge\'ez Amharic አማርኛ.idn.icann.org', 'test' => [ 'utf8' => 'አማርኛ.idn.icann.org', 'idn' => 'xn--1xd0bwwra.idn.icann.org' ] ],
[ 'label' => 'TEST: Bengali বাংলা.idn.icann.org', 'test' => [ 'utf8' => 'বাংলা.idn.icann.org', 'idn' => 'xn--54b7fta0cc.idn.icann.org' ] ],
[ 'label' => 'TEST: Hebrew עברית.idn.icann.org', 'test' => [ 'utf8' => 'עברית.idn.icann.org', 'idn' => 'xn--5dbqzzl.idn.icann.org' ] ],
[ 'label' => 'TEST: Khmer ភាសាខ្មែរ.idn.icann.org', 'test' => [ 'utf8' => 'ភាសាខ្មែរ.idn.icann.org', 'idn' => 'xn--j2e7beiw1lb2hqg.idn.icann.org' ] ],
[ 'label' => 'TEST: Thai ไทย.idn.icann.org', 'test' => [ 'utf8' => 'ไทย.idn.icann.org', 'idn' => 'xn--o3cw4h.idn.icann.org' ] ],
[ 'label' => 'TEST: Persian Urdu اردو.idn.icann.org', 'test' => [ 'utf8' => 'اردو.idn.icann.org', 'idn' => 'xn--mgbqf7g.idn.icann.org' ] ],
];
