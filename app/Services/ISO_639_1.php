<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\LanguageNotInISO639;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ISO_639_1
{
    private const LANGUAGES = [
        'aa' => [
            'name' => 'Afar',
            'nativeName' => 'Afaraf',
            'direction' => 'ltr',
        ],
        'ab' => [
            'name' => 'Abkhaz',
            'nativeName' => 'Аԥсшәа',
            'direction' => 'ltr',
        ],
        'ae' => [
            'name' => 'Avestan',
            'nativeName' => 'Avesta',
            'direction' => 'ltr',
        ],
        'af' => [
            'name' => 'Afrikaans',
            'nativeName' => 'Afrikaans',
            'direction' => 'ltr',
        ],
        'ak' => [
            'name' => 'Akan',
            'nativeName' => 'Akan',
            'direction' => 'ltr',
        ],
        'am' => [
            'name' => 'Amharic',
            'nativeName' => 'አማርኛ',
            'direction' => 'ltr',
        ],
        'an' => [
            'name' => 'Aragonese',
            'nativeName' => 'Aragonés',
            'direction' => 'ltr',
        ],
        'ar' => [
            'name' => 'Arabic',
            'nativeName' => 'العربية',
            'direction' => 'rtl',
        ],
        'as' => [
            'name' => 'Assamese',
            'nativeName' => 'অসমীয়া',
            'direction' => 'ltr',
        ],
        'av' => [
            'name' => 'Avaric',
            'nativeName' => 'Авар',
            'direction' => 'ltr',
        ],
        'ay' => [
            'name' => 'Aymara',
            'nativeName' => 'Aymar aru',
            'direction' => 'ltr',
        ],
        'az' => [
            'name' => 'Azerbaijani',
            'nativeName' => 'Azərbaycanca',
            'direction' => 'ltr',
        ],
        'ba' => [
            'name' => 'Bashkir',
            'nativeName' => 'Башҡортса',
            'direction' => 'ltr',
        ],
        'be' => [
            'name' => 'Belarusian',
            'nativeName' => 'Беларуская',
            'direction' => 'ltr',
        ],
        'bg' => [
            'name' => 'Bulgarian',
            'nativeName' => 'Български',
            'direction' => 'ltr',
        ],
        'bh' => [
            'name' => 'Bihari',
            'nativeName' => 'भोजपुरी',
            'direction' => 'ltr',
        ],
        'bi' => [
            'name' => 'Bislama',
            'nativeName' => 'Bislama',
            'direction' => 'ltr',
        ],
        'bm' => [
            'name' => 'Bambara',
            'nativeName' => 'Bamanankan',
            'direction' => 'ltr',
        ],
        'bn' => [
            'name' => 'Bengali',
            'nativeName' => 'বাংলা',
            'direction' => 'ltr',
        ],
        'bo' => [
            'name' => 'Tibetan',
            'nativeName' => 'བོད་ཡིག',
            'direction' => 'ltr',
        ],
        'br' => [
            'name' => 'Breton',
            'nativeName' => 'Brezhoneg',
            'direction' => 'ltr',
        ],
        'bs' => [
            'name' => 'Bosnian',
            'nativeName' => 'Bosanski',
            'direction' => 'ltr',
        ],
        'ca' => [
            'name' => 'Catalan',
            'nativeName' => 'Català',
            'direction' => 'ltr',
        ],
        'ce' => [
            'name' => 'Chechen',
            'nativeName' => 'Нохчийн',
            'direction' => 'ltr',
        ],
        'ch' => [
            'name' => 'Chamorro',
            'nativeName' => 'Chamoru',
            'direction' => 'ltr',
        ],
        'co' => [
            'name' => 'Corsican',
            'nativeName' => 'Corsu',
            'direction' => 'ltr',
        ],
        'cr' => [
            'name' => 'Cree',
            'nativeName' => 'ᓀᐦᐃᔭᐍᐏᐣ',
            'direction' => 'ltr',
        ],
        'cs' => [
            'name' => 'Czech',
            'nativeName' => 'Čeština',
            'direction' => 'ltr',
        ],
        'cu' => [
            'name' => 'Church Slavic',
            'nativeName' => 'Словѣньскъ',
            'direction' => 'ltr',
        ],
        'cv' => [
            'name' => 'Chuvash',
            'nativeName' => 'Чӑвашла',
            'direction' => 'ltr',
        ],
        'cy' => [
            'name' => 'Welsh',
            'nativeName' => 'Cymraeg',
            'direction' => 'ltr',
        ],
        'da' => [
            'name' => 'Danish',
            'nativeName' => 'Dansk',
            'direction' => 'ltr',
        ],
        'de' => [
            'name' => 'German',
            'nativeName' => 'Deutsch',
            'direction' => 'ltr',
        ],
        'dv' => [
            'name' => 'Divehi',
            'nativeName' => 'ދިވެހި',
            'direction' => 'rtl',
        ],
        'dz' => [
            'name' => 'Dzongkha',
            'nativeName' => 'རྫོང་ཁ',
            'direction' => 'ltr',
        ],
        'ee' => [
            'name' => 'Ewe',
            'nativeName' => 'Eʋegbe',
            'direction' => 'ltr',
        ],
        'el' => [
            'name' => 'Greek',
            'nativeName' => 'Ελληνικά',
            'direction' => 'ltr',
        ],
        'en' => [
            'name' => 'English',
            'nativeName' => 'English',
            'direction' => 'ltr',
        ],
        'eo' => [
            'name' => 'Esperanto',
            'nativeName' => 'Esperanto',
            'direction' => 'ltr',
        ],
        'es' => [
            'name' => 'Spanish',
            'nativeName' => 'Español',
            'direction' => 'ltr',
        ],
        'et' => [
            'name' => 'Estonian',
            'nativeName' => 'Eesti',
            'direction' => 'ltr',
        ],
        'eu' => [
            'name' => 'Basque',
            'nativeName' => 'Euskara',
            'direction' => 'ltr',
        ],
        'fa' => [
            'name' => 'Farsi',
            'nativeName' => 'فارسی',
            'direction' => 'rtl',
        ],
        'ff' => [
            'name' => 'Fula',
            'nativeName' => 'Fulfulde',
            'direction' => 'ltr',
        ],
        'fi' => [
            'name' => 'Finnish',
            'nativeName' => 'Suomi',
            'direction' => 'ltr',
        ],
        'fj' => [
            'name' => 'Fijian',
            'nativeName' => 'Na vosa vaka-Viti',
            'direction' => 'ltr',
        ],
        'fo' => [
            'name' => 'Faroese',
            'nativeName' => 'Føroyskt',
            'direction' => 'ltr',
        ],
        'fr' => [
            'name' => 'French',
            'nativeName' => 'Français',
            'direction' => 'ltr',
        ],
        'fy' => [
            'name' => 'Western Frisian',
            'nativeName' => 'Frysk',
            'direction' => 'ltr',
        ],
        'ga' => [
            'name' => 'Irish',
            'nativeName' => 'Gaeilge',
            'direction' => 'ltr',
        ],
        'gd' => [
            'name' => 'Gaelic',
            'nativeName' => 'Gàidhlig',
            'direction' => 'ltr',
        ],
        'gl' => [
            'name' => 'Galician',
            'nativeName' => 'Galego',
            'direction' => 'ltr',
        ],
        'gn' => [
            'name' => 'Guaraní',
            'nativeName' => "Avañe'ẽ",
            'direction' => 'ltr',
        ],
        'gu' => [
            'name' => 'Gujarati',
            'nativeName' => 'ગુજરાતી',
            'direction' => 'ltr',
        ],
        'gv' => [
            'name' => 'Manx',
            'nativeName' => 'Gaelg',
            'direction' => 'ltr',
        ],
        'ha' => [
            'name' => 'Hausa',
            'nativeName' => 'Hausa',
            'direction' => 'ltr',
        ],
        'he' => [
            'name' => 'Hebrew',
            'nativeName' => 'עברית',
            'direction' => 'rtl',
        ],
        'hi' => [
            'name' => 'Hindi',
            'nativeName' => 'हिन्दी',
            'direction' => 'ltr',
        ],
        'ho' => [
            'name' => 'Hiri Motu',
            'nativeName' => 'Hiri Motu',
            'direction' => 'ltr',
        ],
        'hr' => [
            'name' => 'Croatian',
            'nativeName' => 'Hrvatski',
            'direction' => 'ltr',
        ],
        'ht' => [
            'name' => 'Haitian',
            'nativeName' => 'Kreyòl ayisyen',
            'direction' => 'ltr',
        ],
        'hu' => [
            'name' => 'Hungarian',
            'nativeName' => 'Magyar',
            'direction' => 'ltr',
        ],
        'hy' => [
            'name' => 'Armenian',
            'nativeName' => 'Հայերեն',
            'direction' => 'ltr',
        ],
        'hz' => [
            'name' => 'Herero',
            'nativeName' => 'Otjiherero',
            'direction' => 'ltr',
        ],
        'ia' => [
            'name' => 'Interlingua',
            'nativeName' => 'Interlingue',
            'direction' => 'ltr',
        ],
        'id' => [
            'name' => 'Indonesian',
            'nativeName' => 'Bahasa Indonesia',
            'direction' => 'ltr',
        ],
        'ig' => [
            'name' => 'Igbo',
            'nativeName' => 'Ásụ̀sụ́ Ìgbò',
            'direction' => 'ltr',
        ],
        'ii' => [
            'name' => 'Nuosu',
            'nativeName' => 'ꆈꌠꉙ',
            'direction' => 'ltr',
        ],
        'ik' => [
            'name' => 'Inupiaq',
            'nativeName' => 'Iñupiaq',
            'direction' => 'ltr',
        ],
        'io' => [
            'name' => 'Ido',
            'nativeName' => 'Ido',
            'direction' => 'ltr',
        ],
        'is' => [
            'name' => 'Icelandic',
            'nativeName' => 'Íslenska',
            'direction' => 'ltr',
        ],
        'it' => [
            'name' => 'Italian',
            'nativeName' => 'Italiano',
            'direction' => 'ltr',
        ],
        'iu' => [
            'name' => 'Inuktitut',
            'nativeName' => 'ᐃᓄᒃᑎᑐᑦ',
            'direction' => 'ltr',
        ],
        'ja' => [
            'name' => 'Japanese',
            'nativeName' => '日本語',
            'direction' => 'ltr',
        ],
        'jv' => [
            'name' => 'Javanese',
            'nativeName' => 'Jawa',
            'direction' => 'ltr',
        ],
        'ka' => [
            'name' => 'Georgian',
            'nativeName' => 'ქართული',
            'direction' => 'ltr',
        ],
        'kg' => [
            'name' => 'Kongo',
            'nativeName' => 'Kongo',
            'direction' => 'ltr',
        ],
        'ki' => [
            'name' => 'Kikuyu',
            'nativeName' => 'Gĩkũyũ',
            'direction' => 'ltr',
        ],
        'kj' => [
            'name' => 'Kwanyama',
            'nativeName' => 'Oshikwanyama',
            'direction' => 'ltr',
        ],
        'kk' => [
            'name' => 'Kazakh',
            'nativeName' => 'Қазақша',
            'direction' => 'ltr',
        ],
        'kl' => [
            'name' => 'Greenlandic',
            'nativeName' => 'Kalaallisut',
            'direction' => 'ltr',
        ],
        'km' => [
            'name' => 'Khmer',
            'nativeName' => 'ភាសាខ្មែរ',
            'direction' => 'ltr',
        ],
        'kn' => [
            'name' => 'Kannada',
            'nativeName' => 'ಕನ್ನಡ',
            'direction' => 'ltr',
        ],
        'ko' => [
            'name' => 'Korean',
            'nativeName' => '한국어',
            'direction' => 'ltr',
        ],
        'kr' => [
            'name' => 'Kanuri',
            'nativeName' => 'Kànùrí',
            'direction' => 'ltr',
        ],
        'ks' => [
            'name' => 'Kashmiri',
            'nativeName' => 'कश्मीरी',
            'direction' => 'ltr',
        ],
        'ku' => [
            'name' => 'Kurdish',
            'nativeName' => 'Kurdî',
            'direction' => 'ltr',
        ],
        'kv' => [
            'name' => 'Komi',
            'nativeName' => 'Коми',
            'direction' => 'ltr',
        ],
        'kw' => [
            'name' => 'Cornish',
            'nativeName' => 'Kernowek',
            'direction' => 'ltr',
        ],
        'ky' => [
            'name' => 'Kyrgyz',
            'nativeName' => 'Кыргызча',
            'direction' => 'ltr',
        ],
        'lb' => [
            'name' => 'Luxembourgish',
            'nativeName' => 'Lëtzebuergesch',
            'direction' => 'ltr',
        ],
        'lg' => [
            'name' => 'Ganda',
            'nativeName' => 'Luganda',
            'direction' => 'ltr',
        ],
        'li' => [
            'name' => 'Limburgish',
            'nativeName' => 'Limburgs',
            'direction' => 'ltr',
        ],
        'ln' => [
            'name' => 'Lingala',
            'nativeName' => 'Lingála',
            'direction' => 'ltr',
        ],
        'lo' => [
            'name' => 'Lao',
            'nativeName' => 'ລາວ',
            'direction' => 'ltr',
        ],
        'lt' => [
            'name' => 'Lithuanian',
            'nativeName' => 'Lietuvių',
            'direction' => 'ltr',
        ],
        'lu' => [
            'name' => 'Luba-Katanga',
            'nativeName' => 'Kiluba',
            'direction' => 'ltr',
        ],
        'lv' => [
            'name' => 'Latvian',
            'nativeName' => 'Latviešu',
            'direction' => 'ltr',
        ],
        'mg' => [
            'name' => 'Malagasy',
            'nativeName' => 'Malagasy',
            'direction' => 'ltr',
        ],
        'mh' => [
            'name' => 'Marshallese',
            'nativeName' => 'Kajin M̧ajel‌̧',
            'direction' => 'ltr',
        ],
        'mi' => [
            'name' => 'Māori',
            'nativeName' => 'Māori',
            'direction' => 'ltr',
        ],
        'mk' => [
            'name' => 'Macedonian',
            'nativeName' => 'Македонски',
            'direction' => 'ltr',
        ],
        'ml' => [
            'name' => 'Malayalam',
            'nativeName' => 'മലയാളം',
            'direction' => 'ltr',
        ],
        'mn' => [
            'name' => 'Mongolian',
            'nativeName' => 'Монгол',
            'direction' => 'ltr',
        ],
        'mr' => [
            'name' => 'Marathi',
            'nativeName' => 'मराठी',
            'direction' => 'ltr',
        ],
        'ms' => [
            'name' => 'Malay',
            'nativeName' => 'Bahasa Melayu',
            'direction' => 'ltr',
        ],
        'mt' => [
            'name' => 'Maltese',
            'nativeName' => 'Malti',
            'direction' => 'ltr',
        ],
        'my' => [
            'name' => 'Burmese',
            'nativeName' => 'မြန်မာဘာသာ',
            'direction' => 'ltr',
        ],
        'na' => [
            'name' => 'Nauruan',
            'nativeName' => 'Naoero',
            'direction' => 'ltr',
        ],
        'nd' => [
            'name' => 'Northern Ndebele',
            'nativeName' => 'isiNdebele',
            'direction' => 'ltr',
        ],
        'ne' => [
            'name' => 'Nepali',
            'nativeName' => 'नेपाली',
            'direction' => 'ltr',
        ],
        'ng' => [
            'name' => 'Ndonga',
            'nativeName' => 'Owambo',
            'direction' => 'ltr',
        ],
        'nl' => [
            'name' => 'Dutch',
            'nativeName' => 'Nederlands',
            'direction' => 'ltr',
        ],
        'no' => [
            'name' => 'Norwegian',
            'nativeName' => 'Norsk',
            'direction' => 'ltr',
        ],
        'nr' => [
            'name' => 'Southern Ndebele',
            'nativeName' => 'isiNdebele seSewula',
            'direction' => 'ltr',
        ],
        'nv' => [
            'name' => 'Navajo',
            'nativeName' => 'Diné bizaad',
            'direction' => 'ltr',
        ],
        'ny' => [
            'name' => 'Chewa',
            'nativeName' => 'Chi-Chewa',
            'direction' => 'ltr',
        ],
        'oc' => [
            'name' => 'Occitan',
            'nativeName' => 'Occitan',
            'direction' => 'ltr',
        ],
        'oj' => [
            'name' => 'Ojibwe',
            'nativeName' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
            'direction' => 'ltr',
        ],
        'om' => [
            'name' => 'Oromo',
            'nativeName' => 'Oromoo',
            'direction' => 'ltr',
        ],
        'or' => [
            'name' => 'Oriya',
            'nativeName' => 'ଓଡ଼ିଆ',
            'direction' => 'ltr',
        ],
        'os' => [
            'name' => 'Ossetian',
            'nativeName' => 'Ирон',
            'direction' => 'ltr',
        ],
        'pa' => [
            'name' => 'Punjabi',
            'nativeName' => 'ਪੰਜਾਬੀ',
            'direction' => 'ltr',
        ],
        'pi' => [
            'name' => 'Pāli',
            'nativeName' => 'पालि',
            'direction' => 'ltr',
        ],
        'pl' => [
            'name' => 'Polish',
            'nativeName' => 'polPolskiski',
            'direction' => 'ltr',
        ],
        'ps' => [
            'name' => 'Pashto',
            'nativeName' => 'پښتو',
            'direction' => 'rtl',
        ],
        'pt' => [
            'name' => 'Portuguese',
            'nativeName' => 'Português',
            'direction' => 'ltr',
        ],
        'qu' => [
            'name' => 'Quechua',
            'nativeName' => 'Runa Simi',
            'direction' => 'ltr',
        ],
        'rm' => [
            'name' => 'Romansh',
            'nativeName' => 'Rumantsch',
            'direction' => 'ltr',
        ],
        'rn' => [
            'name' => 'Kirundi',
            'nativeName' => 'Ikirundi',
            'direction' => 'ltr',
        ],
        'ro' => [
            'name' => 'Romanian',
            'nativeName' => 'Română',
            'direction' => 'ltr',
        ],
        'ru' => [
            'name' => 'Russian',
            'nativeName' => 'Русский',
            'direction' => 'ltr',
        ],
        'rw' => [
            'name' => 'Kinyarwanda',
            'nativeName' => 'Ikinyarwanda',
            'direction' => 'ltr',
        ],
        'sa' => [
            'name' => 'Sanskrit',
            'nativeName' => 'संस्कृतम्',
            'direction' => 'ltr',
        ],
        'sc' => [
            'name' => 'Sardinian',
            'nativeName' => 'Sardu',
            'direction' => 'ltr',
        ],
        'sd' => [
            'name' => 'Sindhi',
            'nativeName' => 'سنڌي',
            'direction' => 'rtl',
        ],
        'se' => [
            'name' => 'Northern Sami',
            'nativeName' => 'Davvisámegiella',
            'direction' => 'ltr',
        ],
        'sg' => [
            'name' => 'Sango',
            'nativeName' => 'Sängö',
            'direction' => 'ltr',
        ],
        'si' => [
            'name' => 'Sinhalese',
            'nativeName' => 'සිංහල',
            'direction' => 'ltr',
        ],
        'sk' => [
            'name' => 'Slovak',
            'nativeName' => 'Slovenčina',
            'direction' => 'ltr',
        ],
        'sl' => [
            'name' => 'Slovene',
            'nativeName' => 'Slovenščina',
            'direction' => 'ltr',
        ],
        'sm' => [
            'name' => 'Samoan',
            'nativeName' => 'Gagana Samoa',
            'direction' => 'ltr',
        ],
        'sn' => [
            'name' => 'Shona',
            'nativeName' => 'ChiShona',
            'direction' => 'ltr',
        ],
        'so' => [
            'name' => 'Somali',
            'nativeName' => 'Soomaaliga',
            'direction' => 'ltr',
        ],
        'sq' => [
            'name' => 'Albanian',
            'nativeName' => 'Shqip',
            'direction' => 'ltr',
        ],
        'sr' => [
            'name' => 'Serbian',
            'nativeName' => 'Српски',
            'direction' => 'ltr',
        ],
        'ss' => [
            'name' => 'Swati',
            'nativeName' => 'SiSwati',
            'direction' => 'ltr',
        ],
        'st' => [
            'name' => 'Southern Sotho',
            'nativeName' => 'Sesotho',
            'direction' => 'ltr',
        ],
        'su' => [
            'name' => 'Sundanese',
            'nativeName' => 'Sunda',
            'direction' => 'ltr',
        ],
        'sv' => [
            'name' => 'Swedish',
            'nativeName' => 'Svenska',
            'direction' => 'ltr',
        ],
        'sw' => [
            'name' => 'Swahili',
            'nativeName' => 'Kiswahili',
            'direction' => 'ltr',
        ],
        'ta' => [
            'name' => 'Tamil',
            'nativeName' => 'தமிழ்',
            'direction' => 'ltr',
        ],
        'te' => [
            'name' => 'Telugu',
            'nativeName' => 'తెలుగు',
            'direction' => 'ltr',
        ],
        'tg' => [
            'name' => 'Tajik',
            'nativeName' => 'Тоҷикӣ',
            'direction' => 'ltr',
        ],
        'th' => [
            'name' => 'Thai',
            'nativeName' => 'ไทย',
            'direction' => 'ltr',
        ],
        'ti' => [
            'name' => 'Tigrinya',
            'nativeName' => 'ትግርኛ',
            'direction' => 'ltr',
        ],
        'tk' => [
            'name' => 'Turkmen',
            'nativeName' => 'Türkmençe',
            'direction' => 'ltr',
        ],
        'tl' => [
            'name' => 'Tagalog',
            'nativeName' => 'Tagalog',
            'direction' => 'ltr',
        ],
        'tn' => [
            'name' => 'Tswana',
            'nativeName' => 'Setswana',
            'direction' => 'ltr',
        ],
        'to' => [
            'name' => 'Tongan',
            'nativeName' => 'faka Tonga',
            'direction' => 'ltr',
        ],
        'tr' => [
            'name' => 'Turkish',
            'nativeName' => 'Türkçe',
            'direction' => 'ltr',
        ],
        'ts' => [
            'name' => 'Tsonga',
            'nativeName' => 'Xitsonga',
            'direction' => 'ltr',
        ],
        'tt' => [
            'name' => 'Tatar',
            'nativeName' => 'Татарча',
            'direction' => 'ltr',
        ],
        'tw' => [
            'name' => 'Twi',
            'nativeName' => 'Twi',
            'direction' => 'ltr',
        ],
        'ty' => [
            'name' => 'Tahitian',
            'nativeName' => 'Reo Tahiti',
            'direction' => 'ltr',
        ],
        'ug' => [
            'name' => 'Uyghur',
            'nativeName' => 'ئۇيغۇرچە',
            'direction' => 'rtl',
        ],
        'uk' => [
            'name' => 'Ukrainian',
            'nativeName' => 'Українська',
            'direction' => 'ltr',
        ],
        'ur' => [
            'name' => 'Urdu',
            'nativeName' => 'اردو',
            'direction' => 'rtl',
        ],
        'uz' => [
            'name' => 'Uzbek',
            'nativeName' => 'Oʻzbek',
            'direction' => 'ltr',
        ],
        've' => [
            'name' => 'Venda',
            'nativeName' => 'Tshivenḓa',
            'direction' => 'ltr',
        ],
        'vi' => [
            'name' => 'Vietnamese',
            'nativeName' => 'Tiếng Việt',
            'direction' => 'ltr',
        ],
        'vo' => [
            'name' => 'Volapük',
            'nativeName' => 'Volapük',
            'direction' => 'ltr',
        ],
        'wa' => [
            'name' => 'Walloon',
            'nativeName' => 'Walon',
            'direction' => 'ltr',
        ],
        'wo' => [
            'name' => 'Wolof',
            'nativeName' => 'Wolof',
            'direction' => 'ltr',
        ],
        'xh' => [
            'name' => 'Xhosa',
            'nativeName' => 'IsiXhosa',
            'direction' => 'ltr',
        ],
        'yi' => [
            'name' => 'Yiddish',
            'nativeName' => 'ייִדיש',
            'direction' => 'rtl',
        ],
        'yo' => [
            'name' => 'Yoruba',
            'nativeName' => 'Yorùbá',
            'direction' => 'ltr',
        ],
        'za' => [
            'name' => 'Zhuang',
            'nativeName' => 'Vahcuengh',
            'direction' => 'ltr',
        ],
        'zh' => [
            'name' => 'Chinese',
            'nativeName' => '中文',
            'direction' => 'ltr',
        ],
        'zu' => [
            'name' => 'Zulu',
            'nativeName' => 'IsiZulu',
            'direction' => 'ltr',
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

    public static function getLanguageOptions(): Collection
    {
        return collect(self::LANGUAGES)
            ->map(fn ($language, $code) => [
                'code' => $code,
                'name' => $language['name'],
            ])
            ->values();
    }

    public static function getNativeLanguageOptions(): Collection
    {
        return collect(self::LANGUAGES)
            ->map(fn ($language, $code) => [
                'code' => $code,
                'name' => $language['nativeName'],
                'direction' => $language['direction'],
            ])
            ->values();
    }

    public static function getCombinedLanguageOptions(): Collection
    {
        return collect(self::LANGUAGES)
            ->map(fn ($language, $code) => [
                'code' => $code,
                'name' => $language['name'] . ' (' . $language['nativeName'] . ')',
                'direction' => $language['direction'],
            ])
            ->values();
    }

    public static function getLanguageDirection(string $code): string
    {
        return self::getLanguage($code)['direction'];
    }
}
