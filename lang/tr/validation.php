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
    'accepted' => ':attribute kabul edilmelidir.',
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
            'rule-name' => 'kişiselleştirilmiş mesaj',
        ],
    ],
    'active_url' => ':attribute geçerli bir URL değil.',
    'after' => ':attribute :date\'den sonraki bir tarih olmalıdır.',
    'alpha' => ':attribute yalnızca harflerden oluşmalıdır.',
    'alpha_dash' => ':attribute yalnızca harf, rakam, tire ve alt çizgi içermelidir.',
    'alpha_num' => ':attribute yalnızca harf ve rakamlardan oluşmalıdır.',
    'array' => ':attribute bir dizi olmalıdır.',
    'before_or_equal' => ':attribute :date\'den önce veya ona eşit bir tarih olmalıdır.',
    'between' => [
        'array' => ':attribute :min ve :max arasında öğeler içermelidir.',
        'numeric' => ':attribute :min ve :max arasında olmalıdır.',
        'string' => ':attribute :min ve :max karakterleri arasında olmalıdır.',
        'file' => ':attribute :min ve :max kilobayt arasında olmalıdır.',
    ],
    'boolean' => ':attribute alanı doğru veya yanlış olmalıdır.',
    'confirmed' => ':attribute onayı eşleşmiyor.',
    'current_password' => 'Şifre yanlış.',
    'date_equals' => ':attribute, :date\'e eşit bir tarih olmalıdır.',
    'declined' => ':attribute reddedilmelidir.',
    'declined_if' => ':other :value olduğunda :attribute reddedilmelidir.',
    'digits' => ':attribute :digits rakamlar olmalıdır.',
    'digits_between' => ':attribute :min ve :max rakamları arasında olmalıdır.',
    'dimensions' => ':attribute geçersiz resim boyutlarına sahip.',
    'distinct' => ':attribute alanı yinelenen bir değere sahip.',
    'doesnt_start_with' => ':attribute aşağıdakilerden biriyle başlamayabilir: :values.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'ends_with' => ':attribute aşağıdakilerden biriyle bitmelidir: :values.',
    'enum' => 'Seçilen :attribute geçersiz.',
    'file' => ':attribute bir dosya olmalıdır.',
    'filled' => ':attribute alanının bir değeri olmalıdır.',
    'gt' => [
        'array' => ':attribute :value öğelerinden daha fazlasına sahip olmalıdır.',
        'numeric' => ':attribute :value değerinden büyük olmalıdır.',
        'string' => ':attribute :value karakterlerinden büyük olmalıdır.',
        'file' => ':attribute :value kilobayttan büyük olmalıdır.',
    ],
    'gte' => [
        'array' => ':attribute :value öğelerine veya daha fazlasına sahip olmalıdır.',
        'numeric' => ':attribute :value\'dan büyük veya ona eşit olmalıdır.',
        'string' => ':attribute :value karakterlerinden büyük veya onlara eşit olmalıdır.',
        'file' => ':attribute :value kilobayttan büyük veya ona eşit olmalıdır.',
    ],
    'image' => ':attribute bir resim olmalıdır.',
    'in' => 'Seçilen :attribute geçersiz.',
    'integer' => ':attribute bir tamsayı olmalıdır.',
    'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'lt' => [
        'array' => ':attribute :value öğesinden daha az öğeye sahip olmalıdır.',
        'file' => ':attribute :value kilobayttan az olmalıdır.',
        'string' => ':attribute :value karakterlerinden küçük olmalıdır.',
        'numeric' => ':attribute :value değerinden küçük olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute :value öğesinden fazla öğeye sahip olmamalıdır.',
        'file' => ':attribute :value kilobayttan küçük veya ona eşit olmalıdır.',
        'string' => ':attribute :value karakterlerinden küçük veya ona eşit olmalıdır.',
        'numeric' => ':attribute :value\'dan küçük veya ona eşit olmalıdır.',
    ],
    'mac_address' => ':attribute geçerli bir MAC adresi olmalıdır.',
    'max' => [
        'array' => ':attribute :max öğesinden fazlasına sahip olmamalıdır.',
        'file' => ':attribute :max kilobayttan büyük olmamalıdır.',
        'numeric' => ':attribute :max değerinden büyük olmamalıdır.',
        'string' => ':attribute :max karakterden büyük olmamalıdır.',
    ],
    'prohibited' => ':attribute alanı yasaktır.',
    'prohibited_if' => ':other :value olduğunda :attribute alanı yasaktır.',
    'prohibits' => ':attribute alanı :other öğesinin mevcut olmasını yasaklar.',
    'regex' => ':attribute biçimi geçersiz.',
    'required' => ':attribute alanı zorunludur.',
    'required_array_keys' => ':attribute alanı şu girdileri içermelidir: :values.',
    'required_if' => ':attribute alanı :other :value olduğunda gereklidir.',
    'required_with' => ':attribute alanı :values mevcut olduğunda gereklidir.',
    'required_with_all' => ':attribute alanı :values mevcut olduğunda gereklidir.',
    'required_without' => ':attribute alanı :values mevcut olmadığında gereklidir.',
    'same' => ':attribute ve :other eşleşmelidir.',
    'size' => [
        'array' => ':attribute :size öğeleri içermelidir.',
        'file' => ':attribute :size kilobayt olmalıdır.',
        'numeric' => ':attribute :size olmalıdır.',
        'string' => ':attribute :size karakterleri olmalıdır.',
    ],
    'string' => ':attribute bir dize olmalıdır.',
    'timezone' => ':attribute geçerli bir saat dilimi olmalıdır.',
    'unique' => ':attribute zaten alınmış.',
    'mimes' => ':attribute şu türden bir dosya olmalıdır: :values.',
    'mimetypes' => ':attribute şu türden bir dosya olmalıdır: :values.',
    'min' => [
        'array' => ':attribute en az :min öğesi içermelidir.',
        'file' => ':attribute en az :min kilobayt olmalıdır.',
        'string' => ':attribute en az :min karakterden oluşmalıdır.',
        'numeric' => ':attribute en az :min olmalıdır.',
    ],
    'multiple_of' => ':attribute :value değerinin katı olmalıdır.',
    'not_in' => 'Seçilen :attribute geçersiz.',
    'not_regex' => ':attribute biçimi geçersiz.',
    'numeric' => ':attribute bir sayı olmalıdır.',
    'password' => [
        'mixed' => ':attribute en az bir büyük harf ve bir küçük harf içermelidir.',
        'numbers' => ':attribute en az bir sayı içermelidir.',
        'symbols' => ':attribute en az bir sembol içermelidir.',
        'letters' => ':attribute en az bir harf içermelidir.',
        'uncompromised' => 'Belirtilen :attribute bir veri sızıntısında ortaya çıktı. Lütfen farklı bir :attribute seçin.',
    ],
    'uuid' => ':attribute geçerli bir UUID olmalıdır.',
    'accepted_if' => ':attribute :other :value olduğunda kabul edilmelidir.',
    'after_or_equal' => ':attribute :date\'ten sonraki veya ona eşit bir tarih olmalıdır.',
    'before' => ':attribute :date tarihinden önceki bir tarih olmalıdır.',
    'date' => ':attribute geçerli bir tarih değil.',
    'date_format' => ':attribute formatı :format ile eşleşmiyor.',
    'different' => ':attribute ve :other farklı olmalıdır.',
    'doesnt_end_with' => ':attribute aşağıdakilerden biriyle bitmeyebilir: :values.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'prohibited_unless' => ':attribute alanı :other :values içinde olmadığı sürece yasaktır.',
    'uploaded' => ':attribute yüklenemedi.',
    'required_without_all' => ':attribute alanı :values\'ın hiçbiri mevcut olmadığında gereklidir.',
    'url' => ':attribute geçerli bir URL olmalıdır.',
    'present' => ':attribute alanı mevcut olmalıdır.',
    'required_unless' => ':attribute alanı :other :values içinde olmadığı sürece gereklidir.',
    'starts_with' => ':attribute aşağıdakilerden biriyle başlamalıdır: :values.',
    'in_array' => ':attribute alanı :other\'da mevcut değil.',
    'json' => ':attribute geçerli bir JSON dizesi olmalıdır.',
];
