<?php
namespace Test\Foundation\Crypt\Provider;

trait TCryptDataProvider
{

    /**
     * Provides data test.
     *
     * @return array List of tests
     */
    public function getCryptData()
    {
        return [
            [ 'label' => 'TEST: café-glacé.com', 'test'  => 'café-glacé.com' ],
            [ 'label' => 'TEST: café.glacé.com', 'test'  => 'café.glacé.com' ],
            [ 'label' => 'TEST: 1café.glacé2.com', 'test'  => '1café.glacé2.com' ],
            [ 'label' => 'TEST: 上海世博会.中国', 'test'  => '上海世博会.中国' ],
            [ 'label' => 'TEST: Latin supernovæ.fr', 'test'  => 'supernovæ.fr' ],
            [ 'label' => 'TEST: Arabic مثال.إختبار', 'test'  => 'مثال.إختبار' ],
            [ 'label' => 'TEST: Simplified Chinese 例子.测试', 'test'  => '例子.测试' ],
            [ 'label' => 'TEST: Traditional Chinese 例子.測試', 'test'  => '例子.測試' ],
            [ 'label' => 'TEST: Greek παράδειγμα.δοκιμή', 'test'  => 'παράδειγμα.δοκιμή' ],
            [ 'label' => 'TEST: Devanagari Hindi उदाहरण.परीक्षा', 'test'  => 'उदाहरण.परीक्षा' ], // No encoding
            [ 'label' => 'TEST: Kanji, Hiragana, Katakana Japanese 例え.テスト', 'test'  => '例え.テスト' ],
            [ 'label' => 'TEST: Hangul Korean 실례.테스트', 'test'  => '실례.테스트' ],
            [ 'label' => 'TEST: Perso-Arabic مثال.آزمایشی', 'test'  => 'مثال.آزمایشی' ],
            [ 'label' => 'TEST: Cyrillic Russian пример.испытание', 'test'  => 'пример.испытание' ],
            [ 'label' => 'TEST: Tamil உதாரணம்.பரிட்சை', 'test'  => 'உதாரணம்.பரிட்சை' ], // No encoding
            [ 'label' => 'TEST: Hebrew Yiddish בײַשפּיל.טעסט', 'test'  => 'בײַשפּיל.טעסט' ], // No encoding
            [ 'label' => 'TEST: Ge\'ez Amharic አማርኛ.idn.icann.org', 'test'  => 'አማርኛ.idn.icann.org' ],
            [ 'label' => 'TEST: Bengali বাংলা.idn.icann.org', 'test'  => 'বাংলা.idn.icann.org' ], // No encoding
            [ 'label' => 'TEST: Hebrew עברית.idn.icann.org', 'test'  => 'עברית.idn.icann.org' ],
            [ 'label' => 'TEST: Khmer ភាសាខ្មែរ.idn.icann.org', 'test'  => 'ភាសាខ្មែរ.idn.icann.org' ], // No encoding
            [ 'label' => 'TEST: Thai ไทย.idn.icann.org', 'test'  => 'ไทย.idn.icann.org' ],
            [ 'label' => 'TEST: Persian Urdu اردو.idn.icann.org', 'test'  => 'اردو.idn.icann.org' ],
        ];
    }

    /**
     * Provides key.
     *
     * @return string
     */
    public function getCryptKey()
    {
        return 'Foundation 1.0.0-20130728 by Olivier Jullien ( olivierjullien@outlook.com )';
    }
}
