<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted' => ':attribute-ը պետք է ընդունվի։',
    'accepted_if' => ':attribute-ը պետք է ընդունվի, եթե :other-ը :value է.',
    'active_url' => ':attribute-ը վավեր URL չէ։',
    'after' => ':attribute-ը-ը պետք է ամսաթիվ լինի :date-ից հետո։',
    'after_or_equal' => ':attribute-ը պետք է ամսաթիվ լինի կամ համարժեք լինի :date-ին։',
    'alpha' => ':attribute-ը պետք է միայն տառեր պարունակի։',
    'alpha_dash' => ':attribute-ը պետք է միայն տառեր, թվեր, գծիկներ և ենթամնաներ պարունակի։',
    'alpha_num' => ':attribute-ը պետք է միայն տառեր ու թվեր պարունակի։',
    'array' => ':attribute-ը պետք է զանգված լինի։',
    'before' => ':attribute-ը պետք է ամսաթիվ լինի կամ համարժեք լինի :date-ին։պետք է ամսաթիվ լինի :date-ից առաջ։',
    'before_or_equal' => ':attribute-ը պետք է ամսաթիվ լինի կամ համարժեք լինի :date-ին։',
    'between' => [
        'array' => ':attribute-ը պետք է :min և :max առարկաների միջև լինի։',
        'file' => ':attribute-ը պետք է :min և :max կիլոբայտերի միջև լինի։',
        'numeric' => ':attribute-ը պետք է :min և :max միջև լինի։',
        'string' => ':attribute-ը պետք է :min և :max նիշերի միջև լինի։',
    ],
    'boolean' => ':attribute-ի դաշտը պետք է true կամ false լինի։',
    'confirmed' => ':attribute-ի հաստատումը չի համապատասխանում նրան։',
    'current_password' => 'Գաղտնաբառը սխալ է։',
    'date' => ':attribute-ը վավեր ամսաթիվ չէ։',
    'date_equals' => ':attribute-ը պետք է ամսաթիվ լինի :date:',
    'date_format' => ':attribute-ը չի համապատասխանում ձևաչափին :format։',
    'declined' => ':attribute-ը պետք է մերժվի։',
    'declined_if' => ':attribute-ը պետք է մերժվի, եթե :other-ը :value է։',
    'different' => ':attribute-ը և :other-ը պետք է տարբեր լինեն։',
    'digits' => ':attribute-ը պետք է լինի :digits թվանշանով։',
    'digits_between' => ':attribute-ը պետք է ընկած լինի :min և :max թվերի միջև։',
    'dimensions' => ':attribute-ն պատկերային չափումները վավեր չեն։',
    'distinct' => ':attribute-ը կրկնօրինակված արժեք ունի։',
    'doesnt_end_with' => ':attribute-ը կարող է չավարտվել սրանցից մեկով :values։',
    'doesnt_start_with' => ':attribute-ը կարող է չսկսվել սրանցից մեկով :values:',
    'email' => ':attribute-ը պետք է վավեր էլ․ փոստ լինի։',
    'ends_with' => ':attribute-ը պետք է ավարտվի սրանցից մեկով :values:',
    'enum' => 'Նշված :attribute-ը վավեր չէ։',
    'exists' => 'Նշված :attribute-ը վավեր չէ։',
    'file' => ':attribute-ը պետք է ֆայլի տեսքով լինի։',
    'filled' => ':attribute-ի դաշտը պետք է արժեք ունենա։',
    'gt' => [
        'array' => ':attribute-ը չպետք է պարունակի ավելի առարկա, քան :value-ում է։',
        'file' => ':attribute-ը պետք է մեծ լինի :value կիլոբայտից։',
        'numeric' => ':attribute-ը պետք է գերազանցի :value-ն։',
        'string' => ':attribute-ը պետք է գերազանցի :value-ի նիշերին։',
    ],
    'gte' => [
        'array' => ':attribute-ը պետք է պարունակի :value կամ ավելի առարկաներ։',
        'file' => ':attribute-ը պետք է գերազանցի կամ հավասար լինի :value-ին։',
        'numeric' => ':attribute-ը պետք է գերազանցի կամ հավասար լինի :value-ին։',
        'string' => ':attribute-ը պետք է գերազանցի կամ հավասար լինի :value-ին։',
    ],
    'image' => ':attribute-ը պետք է պատկեր լինի։',
    'in' => 'Նշված :attribute-ը վավեր չէ։',
    'in_array' => ':attribute-ի դաշտը :other-ում գոյություն չունի։',
    'integer' => ':attribute-ը պետք է ամբողջ թիվ լինի։',
    'ip' => ':attribute-ը պետք է ունենա նույնականացման վավեր հասցե։',
    'ipv4' => ':attribute-ը պետք է ունենա վավեր IPv4 հասցե:',
    'ipv6' => ':attribute-ը պետք է ունենա վավեր IPv6 հասցե:',
    'json' => ':attribute-ը պետք է ունենա վավեր JSON սիմվոլ։',
    'lt' => [
        'array' => ':attribute-ում պետք է ավելի քիչ առարկա լինի :value:',
        'file' => ':attribute-ում պետք է ավելի քիչ կիլոբայտ լինի :value:',
        'numeric' => ':attribute-ում :value-ից ավելի փոքր լինի:',
        'string' => ':attribute-ը պետք է ավելի փոքր լինի, քան :value նիշերի քանակն է։',
    ],
    'lte' => [
        'array' => ':attribute-ը չի կարող ունենալ :value-օց ավելի նիշ։',
        'file' => ':attribute-ը պետք է ավելի քիչ լինի :value կիլոբայտերից կամ հավասար լինի դրանց։',
        'numeric' => ':attribute-ը պետք է ավելի քիչ լինի :value առարկաներից կամ հավասար լինի դրանց։',
        'string' => ':attribute-ը պետք է ավելի քիչ լինի :value նիշերի քանակից կամ հավասար լինի դրանց։',
    ],
    'mac_address' => ':attribute-ը պետք է վավեր MAC հասցե ունենա։',
    'max' => [
        'array' => ':attribute-ը չպետք է լինի ավելին, քան առարկաների :max քանակն է։',
        'file' => ':attribute-ը չպետք է :max կիլոբայտերից ավելի լինի։',
        'numeric' => ':attribute-ը չպետք է լինի ավելին, քան :max։',
        'string' => ':attribute-ը չպետք է լինի ավելին, քան :max նիշերի քանակը։',
    ],
    'mimes' => ':attribute-ը պետք է լինի հետևյալ տեսակի ֆայլ՝: :values:',
    'mimetypes' => ':attribute-ը պետք է այս տեսակի ֆայլ լինի։ :values:',
    'min' => [
        'array' => ':attribute-ը պետք է ունենա նվազագույնը :min առարկաներ։',
        'file' => ':attribute-ը պետք է կշռի նվազագույնը :min կիլոբայտ։',
        'numeric' => ':attribute-ը պետք է լինի նվազագույնը :min։',
        'string' => ':attribute-ը պետք է լինի նվազագույնը :min նիշ։',
    ],
    'multiple_of' => ':attribute-ը պետք է լինի :value-ի բազմապատիկը։',
    'not_in' => 'Ընտրված :attribute-ը վավեր չէ։',
    'not_regex' => ':attribute-ի ձևաչափը վավեր չէ։',
    'numeric' => ':attribute-ը պետք է թվանշան լինի։',
    'password' => [
        'letters' => ':attribute-ը պետք է գոնե մի տառ պարունակի։',
        'mixed' => ':attribute-ը պետք է գոնե մի գլխատառ ու մի սովորական տառ պարունակի։',
        'numbers' => ':attribute-ը պետք է գոնի մի թվանշան պարունակի։',
        'symbols' => ':attribute-ը պետք է գոնի մի սիմվոլ պարունակի։',
        'uncompromised' => 'Տրված :attribute-ը հայտաբերվել է տվյալների արտահոսքում։ Խնդրում ենք ընտրել մեկ այլ :attribute։',
    ],
    'present' => ':attribute-ը պետք է առկա լինի։',
    'prohibited' => ':attribute-ի դաշտն արգելված է։',
    'prohibited_if' => ':attribute-ի դաշտն արգելված է, եթե :other-ը :value է։',
    'prohibited_unless' => ':attribute-ի դաշտն արգելված է, եթե :other-ը :values չէ։',
    'prohibits' => ':attribute-ը արգելում է :other-ին ներկա գտնվել։',
    'regex' => ':attribute-ի ձևաչափը վավեր չէ։',
    'required' => ':attribute-ի դաշտը պարտադիր է։',
    'required_array_keys' => ':attribute-ը պետք է մուտքեր պարունակի :values-ի համար։',
    'required_if' => ':attribute-ի դաշտը պարտադիր է, երբ :other-ը :value է։',
    'required_unless' => ':attribute-ի դաշտը պարտադիր է, այն դեպքում եթե :other-ը :values է։',
    'required_with' => ':attribute-ի դաշտը պարտադիր է, երբ :values առկա է։',
    'required_with_all' => ':attribute-ի դաշտը պարտադիր է, երբ :values առկա են։',
    'required_without' => ':attribute-ի դաշտը պարտադիր է, երբ :values առկա չէ։',
    'required_without_all' => ':attribute-ի դաշտը պարտադիր է, երբ :values ոչ մեկը առկա չեն։',
    'same' => ':attribute-ը և :other-ը պետք է համընկնեն։',
    'size' => [
        'array' => ':attribute-ը պետք է պարունակի :size առարկաներ։',
        'file' => ':attribute-ը պետք է լինի :size կիլոբայտ։',
        'numeric' => ':attribute-ը պետք է լինի :size-ի։',
        'string' => ':attribute-ը պետք է լինի :size նիշ։',
    ],
    'starts_with' => ':attribute-ը պետք է սկսի :values դրանցից մեկով։',
    'string' => ':attribute-ը պետք է սիմվոլ լինի։',
    'timezone' => ':attribute-ը պետք է ժամանակային վավեր գոտի լինի։',
    'unique' => ':attribute-ն արդեն վերցված է։',
    'uploaded' => ':attribute-ը վերբեռնել չստացվեց։',
    'url' => ':attribute-ը-պետք վավեր հղում լինի։',
    'uuid' => ':attribute-ը պետք է վավեր UUID լինի:',
    'custom' => [
        'attribute-name' => [
            /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
            'rule-name' => 'մաքսային հաղորդագրություն',
        ],
    ],
];
