<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\LanguageNotInISO639;
use Str;

class ISO_639_1
{
    private const LANGUAGES = [
        'aa' => [
            'name' => 'Afar',
            'nativeName' => 'Afaraf',
        ],
        'ab' => [
            'name' => 'Abkhaz',
            'nativeName' => 'аҧсуа бызшәа, аҧсшәа',
        ],
        'ae' => [
            'name' => 'Avestan',
            'nativeName' => 'avesta',
        ],
        'af' => [
            'name' => 'Afrikaans',
            'nativeName' => 'Afrikaans',
        ],
        'ak' => [
            'name' => 'Akan',
            'nativeName' => 'Akan',
        ],
        'am' => [
            'name' => 'Amharic',
            'nativeName' => 'አማርኛ',
        ],
        'an' => [
            'name' => 'Aragonese',
            'nativeName' => 'aragonés',
        ],
        'ar' => [
            'name' => 'Arabic',
            'nativeName' => 'العربية',
        ],
        'as' => [
            'name' => 'Assamese',
            'nativeName' => 'অসমীয়া',
        ],
        'av' => [
            'name' => 'Avaric',
            'nativeName' => 'авар мацӀ, магӀарул мацӀ',
        ],
        'ay' => [
            'name' => 'Aymara',
            'nativeName' => 'aymar aru',
        ],
        'az' => [
            'name' => 'Azerbaijani',
            'nativeName' => 'azərbaycan dili',
        ],
        'ba' => [
            'name' => 'Bashkir',
            'nativeName' => 'башҡорт теле',
        ],
        'be' => [
            'name' => 'Belarusian',
            'nativeName' => 'беларуская мова',
        ],
        'bg' => [
            'name' => 'Bulgarian',
            'nativeName' => 'български език',
        ],
        'bh' => [
            'name' => 'Bihari',
            'nativeName' => 'भोजपुरी',
        ],
        'bi' => [
            'name' => 'Bislama',
            'nativeName' => 'Bislama',
        ],
        'bm' => [
            'name' => 'Bambara',
            'nativeName' => 'bamanankan',
        ],
        'bn' => [
            'name' => 'Bengali, Bangla',
            'nativeName' => 'বাংলা',
        ],
        'bo' => [
            '639-2/B' => 'tib',
            'name' => 'Tibetan Standard, Tibetan, Central',
            'nativeName' => 'བོད་ཡིག',
        ],
        'br' => [
            'name' => 'Breton',
            'nativeName' => 'brezhoneg',
        ],
        'bs' => [
            'name' => 'Bosnian',
            'nativeName' => 'bosanski jezik',
        ],
        'ca' => [
            'name' => 'Catalan',
            'nativeName' => 'català',
        ],
        'ce' => [
            'name' => 'Chechen',
            'nativeName' => 'нохчийн мотт',
        ],
        'ch' => [
            'name' => 'Chamorro',
            'nativeName' => 'Chamoru',
        ],
        'co' => [
            'name' => 'Corsican',
            'nativeName' => 'corsu, lingua corsa',
        ],
        'cr' => [
            'name' => 'Cree',
            'nativeName' => 'ᓀᐦᐃᔭᐍᐏᐣ',
        ],
        'cs' => [
            '639-2/B' => 'cze',
            'name' => 'Czech',
            'nativeName' => 'čeština, český jazyk',
        ],
        'cu' => [
            'name' => 'Old Church Slavonic, Church Slavonic, Old Bulgarian',
            'nativeName' => 'ѩзыкъ словѣньскъ',
        ],
        'cv' => [
            'name' => 'Chuvash',
            'nativeName' => 'чӑваш чӗлхи',
        ],
        'cy' => [
            '639-2/B' => 'wel',
            'name' => 'Welsh',
            'nativeName' => 'Cymraeg',
        ],
        'da' => [
            'name' => 'Danish',
            'nativeName' => 'dansk',
        ],
        'de' => [
            '639-2/B' => 'ger',
            'name' => 'German',
            'nativeName' => 'Deutsch',
        ],
        'dv' => [
            'name' => 'Divehi, Dhivehi, Maldivian',
            'nativeName' => 'ދިވެހި',
        ],
        'dz' => [
            'name' => 'Dzongkha',
            'nativeName' => 'རྫོང་ཁ',
        ],
        'ee' => [
            'name' => 'Ewe',
            'nativeName' => 'Eʋegbe',
        ],
        'el' => [
            '639-2/B' => 'gre',
            'name' => 'Greek (modern)',
            'nativeName' => 'ελληνικά',
        ],
        'en' => [
            'name' => 'English',
            'nativeName' => 'English',
        ],
        'eo' => [
            'name' => 'Esperanto',
            'nativeName' => 'Esperanto',
        ],
        'es' => [
            'name' => 'Spanish',
            'nativeName' => 'Español',
        ],
        'et' => [
            'name' => 'Estonian',
            'nativeName' => 'eesti, eesti keel',
        ],
        'eu' => [
            '639-2/B' => 'baq',
            'name' => 'Basque',
            'nativeName' => 'euskara, euskera',
        ],
        'fa' => [
            '639-2/B' => 'per',
            'name' => 'Persian (Farsi)',
            'nativeName' => 'فارسی',
        ],
        'ff' => [
            'name' => 'Fula, Fulah, Pulaar, Pular',
            'nativeName' => 'Fulfulde, Pulaar, Pular',
        ],
        'fi' => [
            'name' => 'Finnish',
            'nativeName' => 'suomi, suomen kieli',
        ],
        'fj' => [
            'name' => 'Fijian',
            'nativeName' => 'vosa Vakaviti',
        ],
        'fo' => [
            'name' => 'Faroese',
            'nativeName' => 'føroyskt',
        ],
        'fr' => [
            '639-2/B' => 'fre',
            'name' => 'French',
            'nativeName' => 'français, langue française',
        ],
        'fy' => [
            'name' => 'Western Frisian',
            'nativeName' => 'Frysk',
        ],
        'ga' => [
            'name' => 'Irish',
            'nativeName' => 'Gaeilge',
        ],
        'gd' => [
            'name' => 'Scottish Gaelic, Gaelic',
            'nativeName' => 'Gàidhlig',
        ],
        'gl' => [
            'name' => 'Galician',
            'nativeName' => 'galego',
        ],
        'gn' => [
            'name' => 'Guaraní',
            'nativeName' => "Avañe'ẽ",
        ],
        'gu' => [
            'name' => 'Gujarati',
            'nativeName' => 'ગુજરાતી',
        ],
        'gv' => [
            'name' => 'Manx',
            'nativeName' => 'Gaelg, Gailck',
        ],
        'ha' => [
            'name' => 'Hausa',
            'nativeName' => '(Hausa) هَوُسَ',
        ],
        'he' => [
            'name' => 'Hebrew',
            'nativeName' => 'עברית',
        ],
        'hi' => [
            'name' => 'Hindi',
            'nativeName' => 'हिन्दी, हिंदी',
        ],
        'ho' => [
            'name' => 'Hiri Motu',
            'nativeName' => 'Hiri Motu',
        ],
        'hr' => [
            'name' => 'Croatian',
            'nativeName' => 'hrvatski jezik',
        ],
        'ht' => [
            'name' => 'Haitian, Haitian Creole',
            'nativeName' => 'Kreyòl ayisyen',
        ],
        'hu' => [
            'name' => 'Hungarian',
            'nativeName' => 'magyar',
        ],
        'hy' => [
            '639-2/B' => 'arm',
            'name' => 'Armenian',
            'nativeName' => 'Հայերեն',
        ],
        'hz' => [
            'name' => 'Herero',
            'nativeName' => 'Otjiherero',
        ],
        'ia' => [
            'name' => 'Interlingua',
            'nativeName' => 'Interlingua',
        ],
        'id' => [
            'name' => 'Indonesian',
            'nativeName' => 'Bahasa Indonesia',
        ],
        'ie' => [
            'name' => 'Interlingue',
            'nativeName' => 'Originally called Occidental; then Interlingue after WWII',
        ],
        'ig' => [
            'name' => 'Igbo',
            'nativeName' => 'Asụsụ Igbo',
        ],
        'ii' => [
            'name' => 'Nuosu',
            'nativeName' => 'ꆈꌠ꒿ Nuosuhxop',
        ],
        'ik' => [
            'name' => 'Inupiaq',
            'nativeName' => 'Iñupiaq, Iñupiatun',
        ],
        'io' => [
            'name' => 'Ido',
            'nativeName' => 'Ido',
        ],
        'is' => [
            '639-2/B' => 'ice',
            'name' => 'Icelandic',
            'nativeName' => 'Íslenska',
        ],
        'it' => [
            'name' => 'Italian',
            'nativeName' => 'Italiano',
        ],
        'iu' => [
            'name' => 'Inuktitut',
            'nativeName' => 'ᐃᓄᒃᑎᑐᑦ',
        ],
        'ja' => [
            'name' => 'Japanese',
            'nativeName' => '日本語 (にほんご)',
        ],
        'jv' => [
            'name' => 'Javanese',
            'nativeName' => 'ꦧꦱꦗꦮ, Basa Jawa',
        ],
        'ka' => [
            '639-2/B' => 'geo',
            'name' => 'Georgian',
            'nativeName' => 'ქართული',
        ],
        'kg' => [
            'name' => 'Kongo',
            'nativeName' => 'Kikongo',
        ],
        'ki' => [
            'name' => 'Kikuyu, Gikuyu',
            'nativeName' => 'Gĩkũyũ',
        ],
        'kj' => [
            'name' => 'Kwanyama, Kuanyama',
            'nativeName' => 'Kuanyama',
        ],
        'kk' => [
            'name' => 'Kazakh',
            'nativeName' => 'қазақ тілі',
        ],
        'kl' => [
            'name' => 'Kalaallisut, Greenlandic',
            'nativeName' => 'kalaallisut, kalaallit oqaasii',
        ],
        'km' => [
            'name' => 'Khmer',
            'nativeName' => 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ',
        ],
        'kn' => [
            'name' => 'Kannada',
            'nativeName' => 'ಕನ್ನಡ',
        ],
        'ko' => [
            'name' => 'Korean',
            'nativeName' => '한국어',
        ],
        'kr' => [
            'name' => 'Kanuri',
            'nativeName' => 'Kanuri',
        ],
        'ks' => [
            'name' => 'Kashmiri',
            'nativeName' => 'कश्मीरी, كشميري‎',
        ],
        'ku' => [
            'name' => 'Kurdish',
            'nativeName' => 'Kurdî, كوردی‎',
        ],
        'kv' => [
            'name' => 'Komi',
            'nativeName' => 'коми кыв',
        ],
        'kw' => [
            'name' => 'Cornish',
            'nativeName' => 'Kernewek',
        ],
        'ky' => [
            'name' => 'Kyrgyz',
            'nativeName' => 'Кыргызча, Кыргыз тили',
        ],
        'la' => [
            'name' => 'Latin',
            'nativeName' => 'latine, lingua latina',
        ],
        'lb' => [
            'name' => 'Luxembourgish, Letzeburgesch',
            'nativeName' => 'Lëtzebuergesch',
        ],
        'lg' => [
            'name' => 'Ganda',
            'nativeName' => 'Luganda',
        ],
        'li' => [
            'name' => 'Limburgish, Limburgan, Limburger',
            'nativeName' => 'Limburgs',
        ],
        'ln' => [
            'name' => 'Lingala',
            'nativeName' => 'Lingála',
        ],
        'lo' => [
            'name' => 'Lao',
            'nativeName' => 'ພາສາລາວ',
        ],
        'lt' => [
            'name' => 'Lithuanian',
            'nativeName' => 'lietuvių kalba',
        ],
        'lu' => [
            'name' => 'Luba-Katanga',
            'nativeName' => 'Tshiluba',
        ],
        'lv' => [
            'name' => 'Latvian',
            'nativeName' => 'latviešu valoda',
        ],
        'mg' => [
            'name' => 'Malagasy',
            'nativeName' => 'fiteny malagasy',
        ],
        'mh' => [
            'name' => 'Marshallese',
            'nativeName' => 'Kajin M̧ajeļ',
        ],
        'mi' => [
            '639-2/B' => 'mao',
            'name' => 'Māori',
            'nativeName' => 'te reo Māori',
        ],
        'mk' => [
            '639-2/B' => 'mac',
            'name' => 'Macedonian',
            'nativeName' => 'македонски јазик',
        ],
        'ml' => [
            'name' => 'Malayalam',
            'nativeName' => 'മലയാളം',
        ],
        'mn' => [
            'name' => 'Mongolian',
            'nativeName' => 'Монгол хэл',
        ],
        'mr' => [
            'name' => 'Marathi (Marāṭhī)',
            'nativeName' => 'मराठी',
        ],
        'ms' => [
            '639-2/B' => 'may',
            'name' => 'Malay',
            'nativeName' => 'bahasa Melayu, بهاس ملايو‎',
        ],
        'mt' => [
            'name' => 'Maltese',
            'nativeName' => 'Malti',
        ],
        'my' => [
            '639-2/B' => 'bur',
            'name' => 'Burmese',
            'nativeName' => 'ဗမာစာ',
        ],
        'na' => [
            'name' => 'Nauruan',
            'nativeName' => 'Dorerin Naoero',
        ],
        'nb' => [
            'name' => 'Norwegian Bokmål',
            'nativeName' => 'Norsk bokmål',
        ],
        'nd' => [
            'name' => 'Northern Ndebele',
            'nativeName' => 'isiNdebele',
        ],
        'ne' => [
            'name' => 'Nepali',
            'nativeName' => 'नेपाली',
        ],
        'ng' => [
            'name' => 'Ndonga',
            'nativeName' => 'Owambo',
        ],
        'nl' => [
            '639-2/B' => 'dut',
            'name' => 'Dutch',
            'nativeName' => 'Nederlands, Vlaams',
        ],
        'nn' => [
            'name' => 'Norwegian Nynorsk',
            'nativeName' => 'Norsk nynorsk',
        ],
        'no' => [
            'name' => 'Norwegian',
            'nativeName' => 'Norsk',
        ],
        'nr' => [
            'name' => 'Southern Ndebele',
            'nativeName' => 'isiNdebele',
        ],
        'nv' => [
            'name' => 'Navajo, Navaho',
            'nativeName' => 'Diné bizaad',
        ],
        'ny' => [
            'name' => 'Chichewa, Chewa, Nyanja',
            'nativeName' => 'chiCheŵa, chinyanja',
        ],
        'oc' => [
            'name' => 'Occitan',
            'nativeName' => "occitan, lenga d'òc",
        ],
        'oj' => [
            'name' => 'Ojibwe, Ojibwa',
            'nativeName' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
        ],
        'om' => [
            'name' => 'Oromo',
            'nativeName' => 'Afaan Oromoo',
        ],
        'or' => [
            'name' => 'Oriya',
            'nativeName' => 'ଓଡ଼ିଆ',
        ],
        'os' => [
            'name' => 'Ossetian, Ossetic',
            'nativeName' => 'ирон æвзаг',
        ],
        'pa' => [
            'name' => '(Eastern) Punjabi',
            'nativeName' => 'ਪੰਜਾਬੀ',
        ],
        'pi' => [
            'name' => 'Pāli',
            'nativeName' => 'पाऴि',
        ],
        'pl' => [
            'name' => 'Polish',
            'nativeName' => 'język polski, polszczyzna',
        ],
        'ps' => [
            'name' => 'Pashto',
            'nativeName' => 'پښتو',
        ],
        'pt' => [
            'name' => 'Portuguese',
            'nativeName' => 'Português',
        ],
        'qu' => [
            'name' => 'Quechua',
            'nativeName' => 'Runa Simi, Kichwa',
        ],
        'rm' => [
            'name' => 'Romansh',
            'nativeName' => 'rumantsch grischun',
        ],
        'rn' => [
            'name' => 'Kirundi',
            'nativeName' => 'Ikirundi',
        ],
        'ro' => [
            '639-2/B' => 'rum',
            'name' => 'Romanian',
            'nativeName' => 'Română',
        ],
        'ru' => [
            'name' => 'Russian',
            'nativeName' => 'Русский',
        ],
        'rw' => [
            'name' => 'Kinyarwanda',
            'nativeName' => 'Ikinyarwanda',
        ],
        'sa' => [
            'name' => 'Sanskrit (Saṁskṛta)',
            'nativeName' => 'संस्कृतम्',
        ],
        'sc' => [
            'name' => 'Sardinian',
            'nativeName' => 'sardu',
        ],
        'sd' => [
            'name' => 'Sindhi',
            'nativeName' => 'सिन्धी, سنڌي، سندھی‎',
        ],
        'se' => [
            'name' => 'Northern Sami',
            'nativeName' => 'Davvisámegiella',
        ],
        'sg' => [
            'name' => 'Sango',
            'nativeName' => 'yângâ tî sängö',
        ],
        'si' => [
            'name' => 'Sinhalese, Sinhala',
            'nativeName' => 'සිංහල',
        ],
        'sk' => [
            '639-2/B' => 'slo',
            'name' => 'Slovak',
            'nativeName' => 'slovenčina, slovenský jazyk',
        ],
        'sl' => [
            'name' => 'Slovene',
            'nativeName' => 'slovenski jezik, slovenščina',
        ],
        'sm' => [
            'name' => 'Samoan',
            'nativeName' => "gagana fa'a Samoa",
        ],
        'sn' => [
            'name' => 'Shona',
            'nativeName' => 'chiShona',
        ],
        'so' => [
            'name' => 'Somali',
            'nativeName' => 'Soomaaliga, af Soomaali',
        ],
        'sq' => [
            '639-2/B' => 'alb',
            'name' => 'Albanian',
            'nativeName' => 'Shqip',
        ],
        'sr' => [
            'name' => 'Serbian',
            'nativeName' => 'српски језик',
        ],
        'ss' => [
            'name' => 'Swati',
            'nativeName' => 'SiSwati',
        ],
        'st' => [
            'name' => 'Southern Sotho',
            'nativeName' => 'Sesotho',
        ],
        'su' => [
            'name' => 'Sundanese',
            'nativeName' => 'Basa Sunda',
        ],
        'sv' => [
            'name' => 'Swedish',
            'nativeName' => 'svenska',
        ],
        'sw' => [
            'name' => 'Swahili',
            'nativeName' => 'Kiswahili',
        ],
        'ta' => [
            'name' => 'Tamil',
            'nativeName' => 'தமிழ்',
        ],
        'te' => [
            'name' => 'Telugu',
            'nativeName' => 'తెలుగు',
        ],
        'tg' => [
            'name' => 'Tajik',
            'nativeName' => 'тоҷикӣ, toçikī, تاجیکی‎',
        ],
        'th' => [
            'name' => 'Thai',
            'nativeName' => 'ไทย',
        ],
        'ti' => [
            'name' => 'Tigrinya',
            'nativeName' => 'ትግርኛ',
        ],
        'tk' => [
            'name' => 'Turkmen',
            'nativeName' => 'Türkmen, Түркмен',
        ],
        'tl' => [
            'name' => 'Tagalog',
            'nativeName' => 'Wikang Tagalog',
        ],
        'tn' => [
            'name' => 'Tswana',
            'nativeName' => 'Setswana',
        ],
        'to' => [
            'name' => 'Tonga (Tonga Islands)',
            'nativeName' => 'faka Tonga',
        ],
        'tr' => [
            'name' => 'Turkish',
            'nativeName' => 'Türkçe',
        ],
        'ts' => [
            'name' => 'Tsonga',
            'nativeName' => 'Xitsonga',
        ],
        'tt' => [
            'name' => 'Tatar',
            'nativeName' => 'татар теле, tatar tele',
        ],
        'tw' => [
            'name' => 'Twi',
            'nativeName' => 'Twi',
        ],
        'ty' => [
            'name' => 'Tahitian',
            'nativeName' => 'Reo Tahiti',
        ],
        'ug' => [
            'name' => 'Uyghur',
            'nativeName' => 'ئۇيغۇرچە‎, Uyghurche',
        ],
        'uk' => [
            'name' => 'Ukrainian',
            'nativeName' => 'Українська',
        ],
        'ur' => [
            'name' => 'Urdu',
            'nativeName' => 'اردو',
        ],
        'uz' => [
            'name' => 'Uzbek',
            'nativeName' => 'Oʻzbek, Ўзбек, أۇزبېك‎',
        ],
        've' => [
            'name' => 'Venda',
            'nativeName' => 'Tshivenḓa',
        ],
        'vi' => [
            'name' => 'Vietnamese',
            'nativeName' => 'Tiếng Việt',
        ],
        'vo' => [
            'name' => 'Volapük',
            'nativeName' => 'Volapük',
        ],
        'wa' => [
            'name' => 'Walloon',
            'nativeName' => 'walon',
        ],
        'wo' => [
            'name' => 'Wolof',
            'nativeName' => 'Wollof',
        ],
        'xh' => [
            'name' => 'Xhosa',
            'nativeName' => 'isiXhosa',
        ],
        'yi' => [
            'name' => 'Yiddish',
            'nativeName' => 'ייִדיש',
        ],
        'yo' => [
            'name' => 'Yoruba',
            'nativeName' => 'Yorùbá',
        ],
        'za' => [
            'name' => 'Zhuang, Chuang',
            'nativeName' => 'Saɯ cueŋƅ, Saw cuengh',
        ],
        'zh' => [
            '639-2/B' => 'chi',
            'name' => 'Chinese',
            'nativeName' => '中文 (Zhōngwén), 汉语, 漢語',
        ],
        'zu' => [
            'name' => 'Zulu',
            'nativeName' => 'isiZulu',
        ],
    ];

    public static function getLanguages(): array
    {
        return self::LANGUAGES;
    }

    public static function getLanguage(string $code): array
    {
        $code = Str::of($code)
            ->lower()
            ->trim()
            ->value();

        if (! \array_key_exists($code, self::LANGUAGES)) {
            throw new LanguageNotInISO639($code);
        }

        return self::LANGUAGES[$code];
    }

    public static function getLanguageName(string $code): string
    {
        return self::getLanguage($code)['name'];
    }

    public static function getNativeLanguageName(string $code): string
    {
        return self::getLanguage($code)['nativeName'];
    }

    public static function getCombinedLanguageName(string $code): string
    {
        $language = self::getLanguage($code);

        return $language['name'] . ' (' . $language['nativeName'] . ')';
    }

    public static function getLanguageCodes(): array
    {
        return array_keys(self::LANGUAGES);
    }

    public static function getLanguageOptions(): array
    {
        return collect(self::LANGUAGES)
            ->map(fn ($language, $code) => [
                'code' => $code,
                'name' => $language['name'],
            ])
            ->values()
            ->toArray();
    }

    public static function getNativeLanguageOptions(): array
    {
        return collect(self::LANGUAGES)
            ->map(fn ($language, $code) => [
                'code' => $code,
                'name' => $language['nativeName'],
            ])
            ->values()
            ->toArray();
    }

    public static function getCombinedLanguageOptions(): array
    {
        return collect(self::LANGUAGES)
            ->map(fn ($language, $code) => [
                'code' => $code,
                'name' => $language['name'] . ' (' . $language['nativeName'] . ')',
            ])
            ->values()
            ->toArray();
    }
}
