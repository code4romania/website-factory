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
            'nativeName' => 'аҧсуа бызшәа, аҧсшәа',
            'direction' => 'ltr',
        ],
        'ae' => [
            'name' => 'Avestan',
            'nativeName' => 'avesta',
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
            'nativeName' => 'aragonés',
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
            'nativeName' => 'авар мацӀ, магӀарул мацӀ',
            'direction' => 'ltr',
        ],
        'ay' => [
            'name' => 'Aymara',
            'nativeName' => 'aymar aru',
            'direction' => 'ltr',
        ],
        'az' => [
            'name' => 'Azerbaijani',
            'nativeName' => 'azərbaycan dili',
            'direction' => 'ltr',
        ],
        'ba' => [
            'name' => 'Bashkir',
            'nativeName' => 'башҡорт теле',
            'direction' => 'ltr',
        ],
        'be' => [
            'name' => 'Belarusian',
            'nativeName' => 'беларуская мова',
            'direction' => 'ltr',
        ],
        'bg' => [
            'name' => 'Bulgarian',
            'nativeName' => 'български език',
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
            'nativeName' => 'bamanankan',
            'direction' => 'ltr',
        ],
        'bn' => [
            'name' => 'Bengali, Bangla',
            'nativeName' => 'বাংলা',
            'direction' => 'ltr',
        ],
        'bo' => [
            'name' => 'Tibetan Standard, Tibetan, Central',
            'nativeName' => 'བོད་ཡིག',
            'direction' => 'ltr',
        ],
        'br' => [
            'name' => 'Breton',
            'nativeName' => 'brezhoneg',
            'direction' => 'ltr',
        ],
        'bs' => [
            'name' => 'Bosnian',
            'nativeName' => 'bosanski jezik',
            'direction' => 'ltr',
        ],
        'ca' => [
            'name' => 'Catalan',
            'nativeName' => 'català',
            'direction' => 'ltr',
        ],
        'ce' => [
            'name' => 'Chechen',
            'nativeName' => 'нохчийн мотт',
            'direction' => 'ltr',
        ],
        'ch' => [
            'name' => 'Chamorro',
            'nativeName' => 'Chamoru',
            'direction' => 'ltr',
        ],
        'co' => [
            'name' => 'Corsican',
            'nativeName' => 'corsu',
            'direction' => 'ltr',
        ],
        'cr' => [
            'name' => 'Cree',
            'nativeName' => 'ᓀᐦᐃᔭᐍᐏᐣ',
            'direction' => 'ltr',
        ],
        'cs' => [
            'name' => 'Czech',
            'nativeName' => 'čeština',
            'direction' => 'ltr',
        ],
        'cu' => [
            'name' => 'Old Church Slavonic, Church Slavonic, Old Bulgarian',
            'nativeName' => 'ѩзыкъ словѣньскъ',
            'direction' => 'ltr',
        ],
        'cv' => [
            'name' => 'Chuvash',
            'nativeName' => 'чӑваш чӗлхи',
            'direction' => 'ltr',
        ],
        'cy' => [
            'name' => 'Welsh',
            'nativeName' => 'Cymraeg',
            'direction' => 'ltr',
        ],
        'da' => [
            'name' => 'Danish',
            'nativeName' => 'dansk',
            'direction' => 'ltr',
        ],
        'de' => [
            'name' => 'German',
            'nativeName' => 'Deutsch',
            'direction' => 'ltr',
        ],
        'dv' => [
            'name' => 'Divehi, Dhivehi, Maldivian',
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
            'nativeName' => 'ελληνικά',
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
            'nativeName' => 'eesti, eesti keel',
            'direction' => 'ltr',
        ],
        'eu' => [
            'name' => 'Basque',
            'nativeName' => 'euskara, euskera',
            'direction' => 'ltr',
        ],
        'fa' => [
            'name' => 'Farsi',
            'nativeName' => 'فارسی',
            'direction' => 'rtl',
        ],
        'ff' => [
            'name' => 'Fula, Fulah, Pulaar, Pular',
            'nativeName' => 'Fulfulde, Pulaar, Pular',
            'direction' => 'ltr',
        ],
        'fi' => [
            'name' => 'Finnish',
            'nativeName' => 'suomi',
            'direction' => 'ltr',
        ],
        'fj' => [
            'name' => 'Fijian',
            'nativeName' => 'vosa Vakaviti',
            'direction' => 'ltr',
        ],
        'fo' => [
            'name' => 'Faroese',
            'nativeName' => 'føroyskt',
            'direction' => 'ltr',
        ],
        'fr' => [
            'name' => 'French',
            'nativeName' => 'français',
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
            'nativeName' => 'galego',
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
            'nativeName' => 'Gaelg, Gailck',
            'direction' => 'ltr',
        ],
        'ha' => [
            'name' => 'Hausa',
            'nativeName' => 'هَوُسَ',
            'direction' => 'rtl',
        ],
        'he' => [
            'name' => 'Hebrew',
            'nativeName' => 'עברית',
            'direction' => 'rtl',
        ],
        'hi' => [
            'name' => 'Hindi',
            'nativeName' => 'हिन्दी, हिंदी',
            'direction' => 'ltr',
        ],
        'ho' => [
            'name' => 'Hiri Motu',
            'nativeName' => 'Hiri Motu',
            'direction' => 'ltr',
        ],
        'hr' => [
            'name' => 'Croatian',
            'nativeName' => 'hrvatski',
            'direction' => 'ltr',
        ],
        'ht' => [
            'name' => 'Haitian',
            'nativeName' => 'Kreyòl ayisyen',
            'direction' => 'ltr',
        ],
        'hu' => [
            'name' => 'Hungarian',
            'nativeName' => 'magyar',
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
            'nativeName' => 'Interlingua',
            'direction' => 'ltr',
        ],
        'id' => [
            'name' => 'Indonesian',
            'nativeName' => 'Bahasa Indonesia',
            'direction' => 'ltr',
        ],
        'ig' => [
            'name' => 'Igbo',
            'nativeName' => 'Asụsụ Igbo',
            'direction' => 'ltr',
        ],
        'ii' => [
            'name' => 'Nuosu',
            'nativeName' => 'ꆈꌠ꒿ Nuosuhxop',
            'direction' => 'ltr',
        ],
        'ik' => [
            'name' => 'Inupiaq',
            'nativeName' => 'Iñupiaq, Iñupiatun',
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
            'nativeName' => '日本語 (にほんご)',
            'direction' => 'ltr',
        ],
        'jv' => [
            'name' => 'Javanese',
            'nativeName' => 'ꦧꦱꦗꦮ, Basa Jawa',
            'direction' => 'ltr',
        ],
        'ka' => [
            'name' => 'Georgian',
            'nativeName' => 'ქართული',
            'direction' => 'ltr',
        ],
        'kg' => [
            'name' => 'Kongo',
            'nativeName' => 'Kikongo',
            'direction' => 'ltr',
        ],
        'ki' => [
            'name' => 'Kikuyu',
            'nativeName' => 'Gĩkũyũ',
            'direction' => 'ltr',
        ],
        'kj' => [
            'name' => 'Kwanyama',
            'nativeName' => 'Kuanyama',
            'direction' => 'ltr',
        ],
        'kk' => [
            'name' => 'Kazakh',
            'nativeName' => 'қазақ тілі',
            'direction' => 'ltr',
        ],
        'kl' => [
            'name' => 'Greenlandic',
            'nativeName' => 'kalaallisut',
            'direction' => 'ltr',
        ],
        'km' => [
            'name' => 'Khmer',
            'nativeName' => 'ខ្មែរ, ខេមរភាសា, ភាសាខ្មែរ',
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
            'nativeName' => 'Kanuri',
            'direction' => 'ltr',
        ],
        'ks' => [
            'name' => 'Kashmiri',
            'nativeName' => 'कश्मीरी, كشميري‎',
            'direction' => 'rtl',
        ],
        'ku' => [
            'name' => 'Kurdish',
            'nativeName' => 'Kurdî, كوردی‎',
            'direction' => 'rtl',
        ],
        'kv' => [
            'name' => 'Komi',
            'nativeName' => 'коми кыв',
            'direction' => 'ltr',
        ],
        'kw' => [
            'name' => 'Cornish',
            'nativeName' => 'Kernewek',
            'direction' => 'ltr',
        ],
        'ky' => [
            'name' => 'Kyrgyz',
            'nativeName' => 'Кыргызча, Кыргыз тили',
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
            'nativeName' => 'ພາສາລາວ',
            'direction' => 'ltr',
        ],
        'lt' => [
            'name' => 'Lithuanian',
            'nativeName' => 'lietuvių kalba',
            'direction' => 'ltr',
        ],
        'lu' => [
            'name' => 'Luba-Katanga',
            'nativeName' => 'Tshiluba',
            'direction' => 'ltr',
        ],
        'lv' => [
            'name' => 'Latvian',
            'nativeName' => 'latviešu valoda',
            'direction' => 'ltr',
        ],
        'mg' => [
            'name' => 'Malagasy',
            'nativeName' => 'fiteny malagasy',
            'direction' => 'ltr',
        ],
        'mh' => [
            'name' => 'Marshallese',
            'nativeName' => 'Kajin M̧ajeļ',
            'direction' => 'ltr',
        ],
        'mi' => [
            'name' => 'Māori',
            'nativeName' => 'te reo Māori',
            'direction' => 'ltr',
        ],
        'mk' => [
            'name' => 'Macedonian',
            'nativeName' => 'македонски јазик',
            'direction' => 'ltr',
        ],
        'ml' => [
            'name' => 'Malayalam',
            'nativeName' => 'മലയാളം',
            'direction' => 'ltr',
        ],
        'mn' => [
            'name' => 'Mongolian',
            'nativeName' => 'Монгол хэл',
            'direction' => 'ltr',
        ],
        'mr' => [
            'name' => 'Marathi',
            'nativeName' => 'मराठी',
            'direction' => 'ltr',
        ],
        'ms' => [
            'name' => 'Malay',
            'nativeName' => 'bahasa Melayu, بهاس ملايو‎',
            'direction' => 'ltr',
        ],
        'mt' => [
            'name' => 'Maltese',
            'nativeName' => 'Malti',
            'direction' => 'ltr',
        ],
        'my' => [
            'name' => 'Burmese',
            'nativeName' => 'ဗမာစာ',
            'direction' => 'ltr',
        ],
        'na' => [
            'name' => 'Nauruan',
            'nativeName' => 'Dorerin Naoero',
            'direction' => 'ltr',
        ],
        'nb' => [
            'name' => 'Norwegian Bokmål',
            'nativeName' => 'Norsk bokmål',
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
        'nn' => [
            'name' => 'Norwegian Nynorsk',
            'nativeName' => 'Norsk nynorsk',
            'direction' => 'ltr',
        ],
        'no' => [
            'name' => 'Norwegian',
            'nativeName' => 'Norsk',
            'direction' => 'ltr',
        ],
        'nr' => [
            'name' => 'Southern Ndebele',
            'nativeName' => 'isiNdebele',
            'direction' => 'ltr',
        ],
        'nv' => [
            'name' => 'Navajo, Navaho',
            'nativeName' => 'Diné bizaad',
            'direction' => 'ltr',
        ],
        'ny' => [
            'name' => 'Chichewa, Chewa, Nyanja',
            'nativeName' => 'chiCheŵa, chinyanja',
            'direction' => 'ltr',
        ],
        'oc' => [
            'name' => 'Occitan',
            'nativeName' => 'occitan',
            'direction' => 'ltr',
        ],
        'oj' => [
            'name' => 'Ojibwe, Ojibwa',
            'nativeName' => 'ᐊᓂᔑᓈᐯᒧᐎᓐ',
            'direction' => 'ltr',
        ],
        'om' => [
            'name' => 'Oromo',
            'nativeName' => 'Afaan Oromoo',
            'direction' => 'ltr',
        ],
        'or' => [
            'name' => 'Oriya',
            'nativeName' => 'ଓଡ଼ିଆ',
            'direction' => 'ltr',
        ],
        'os' => [
            'name' => 'Ossetian, Ossetic',
            'nativeName' => 'ирон æвзаг',
            'direction' => 'ltr',
        ],
        'pa' => [
            'name' => '(Eastern) Punjabi',
            'nativeName' => 'ਪੰਜਾਬੀ',
            'direction' => 'ltr',
        ],
        'pi' => [
            'name' => 'Pāli',
            'nativeName' => 'पाऴि',
            'direction' => 'ltr',
        ],
        'pl' => [
            'name' => 'Polish',
            'nativeName' => 'polski',
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
            'nativeName' => 'Runa Simi, Kichwa',
            'direction' => 'ltr',
        ],
        'rm' => [
            'name' => 'Romansh',
            'nativeName' => 'rumantsch grischun',
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
            'name' => 'Sanskrit (Saṁskṛta)',
            'nativeName' => 'संस्कृतम्',
            'direction' => 'ltr',
        ],
        'sc' => [
            'name' => 'Sardinian',
            'nativeName' => 'sardu',
            'direction' => 'ltr',
        ],
        'sd' => [
            'name' => 'Sindhi',
            'nativeName' => 'सिन्धी, سنڌي، سندھی‎',
            'direction' => 'ltr',
        ],
        'se' => [
            'name' => 'Northern Sami',
            'nativeName' => 'Davvisámegiella',
            'direction' => 'ltr',
        ],
        'sg' => [
            'name' => 'Sango',
            'nativeName' => 'yângâ tî sängö',
            'direction' => 'ltr',
        ],
        'si' => [
            'name' => 'Sinhalese, Sinhala',
            'nativeName' => 'සිංහල',
            'direction' => 'ltr',
        ],
        'sk' => [
            'name' => 'Slovak',
            'nativeName' => 'slovenčina, slovenský jazyk',
            'direction' => 'ltr',
        ],
        'sl' => [
            'name' => 'Slovene',
            'nativeName' => 'slovenski jezik, slovenščina',
            'direction' => 'ltr',
        ],
        'sm' => [
            'name' => 'Samoan',
            'nativeName' => "gagana fa'a Samoa",
            'direction' => 'ltr',
        ],
        'sn' => [
            'name' => 'Shona',
            'nativeName' => 'chiShona',
            'direction' => 'ltr',
        ],
        'so' => [
            'name' => 'Somali',
            'nativeName' => 'Soomaaliga, af Soomaali',
            'direction' => 'ltr',
        ],
        'sq' => [
            'name' => 'Albanian',
            'nativeName' => 'Shqip',
            'direction' => 'ltr',
        ],
        'sr' => [
            'name' => 'Serbian',
            'nativeName' => 'српски језик',
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
            'nativeName' => 'Basa Sunda',
            'direction' => 'ltr',
        ],
        'sv' => [
            'name' => 'Swedish',
            'nativeName' => 'svenska',
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
            'nativeName' => 'тоҷикӣ, toçikī, تاجیکی‎',
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
            'nativeName' => 'Türkmen, Түркмен',
            'direction' => 'ltr',
        ],
        'tl' => [
            'name' => 'Tagalog',
            'nativeName' => 'Wikang Tagalog',
            'direction' => 'ltr',
        ],
        'tn' => [
            'name' => 'Tswana',
            'nativeName' => 'Setswana',
            'direction' => 'ltr',
        ],
        'to' => [
            'name' => 'Tonga (Tonga Islands)',
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
            'nativeName' => 'татар теле, tatar tele',
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
            'nativeName' => 'ئۇيغۇرچە‎, Uyghurche',
            'direction' => 'ltr',
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
            'nativeName' => 'Oʻzbek, Ўзбек, أۇزبېك‎',
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
            'nativeName' => 'walon',
            'direction' => 'ltr',
        ],
        'wo' => [
            'name' => 'Wolof',
            'nativeName' => 'Wollof',
            'direction' => 'ltr',
        ],
        'xh' => [
            'name' => 'Xhosa',
            'nativeName' => 'isiXhosa',
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
            'name' => 'Zhuang, Chuang',
            'nativeName' => 'Saɯ cueŋƅ, Saw cuengh',
            'direction' => 'ltr',
        ],
        'zh' => [
            'name' => 'Chinese',
            'nativeName' => '中文 (Zhōngwén), 汉语, 漢語',
            'direction' => 'ltr',
        ],
        'zu' => [
            'name' => 'Zulu',
            'nativeName' => 'isiZulu',
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
