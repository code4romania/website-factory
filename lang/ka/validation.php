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
    'accepted' => 'ეს :attribute უნდა იქნას მიღებული.',
    'accepted_if' => 'ეს :attribute უნდა იქნას მიღებული როცა :other არის :value.',
    'active_url' => 'ეს :attribute არ არის ვალიდური URL.',
    'after' => 'ეს :attribute უნდა იყოს დათარიღებული :date-ის მომდევნო თარიღებით.',
    'after_or_equal' => 'ეს :attribute უნდა იყოს დათარიღებული :date-ით ან მის მომდევნო თარიღებით.',
    'alpha' => 'ეს :attribute უნდა შეიცავდეს მხოლოდ ასოებს.',
    'alpha_dash' => 'ეს :attribute უნდა შეიცავდეს მხოლოდ ასოებს, რიცხვებს, დახრილ ხაზებს და ქვედა ტირეებს.',
    'alpha_num' => 'ეს :attribute უნდა შეიცავდეს მხოლოდ ასოებს და რიცხვებს.',
    'array' => 'ეს :attribute უნდა იყოს Array.',
    'before' => 'ეს :attribute უნდა იყოს დათარიღებული :date-მდე.',
    'before_or_equal' => 'ეს :attribute უნდა იყოს დათარიღებული :date-ით ან :date-მდე თარიღებით.',
    'between' => [
        'array' => 'ეს :attribute უნდა შეიცავდეს :min-დან :max-მდე ელემენტებს.',
        'file' => 'ეს :attribute უნდა იყოს :min-დან :max-მდე კილობაიტი.',
        'numeric' => 'ეს :attribute უნდა იყოს :min-სა :max-ს შორის.',
        'string' => 'ეს :attribute უნდა იყოს :min-დან :max-მდე სიმბოლო.',
    ],
    'boolean' => 'ეს :attribute ველი უნდა იყოს მართალი ან მცდარი.',
    'confirmed' => 'ეს :attribute დადასტურება არ ემთხვევა.',
    'current_password' => 'პაროლი არასწორია.',
    'date' => 'ეს :attribute თარიღი არასწორია.',
    'date_equals' => 'ეს :attribute უნდა იყოს :date-ის ტოლი თარიღი.',
    'date_format' => 'ეს :attribute არ ემთხვევა :format ფორმატს.',
    'declined' => 'ეს :attribute უნდა იქნას უარყოფილი.',
    'declined_if' => 'ეს :attribute უნდა იქნას უარყოფილი როცა :other არის :value.',
    'different' => 'ეს :attribute და :other უნდა იყოს განსხვავებული.',
    'digits' => 'ეს :attribute უნდა შეიცავდეს :digits ციფრს.',
    'digits_between' => 'ეს :attribute უნდა იყოს :min და :max ციფრს შორის.',
    'dimensions' => 'ამ :attribute-ს აქვს არასწორი გამოსახულების ზომები.',
    'distinct' => 'ამ :attribute ველს აქვს დუბლირებული მნიშვნელობა.',
    'doesnt_end_with' => 'ეს :attribute შესაძლოა არ დამთავრდეს ერთ-ერთი შემდგომით: :values.',
    'doesnt_start_with' => 'ეს :attribute შესაძლოა არ დაიწყოს ერთ-ერთი შემდგომით: :values.',
    'email' => 'ეს :attribute უნდა შეიცავდეს ვალიდურ ელ.ფოსტას.',
    'ends_with' => 'ეს :attribute უნდა დასრულდეს ერთ-ერთი შემდგომით: :values.',
    'enum' => 'მონიშნული :attribute არასწორია.',
    'exists' => 'მონიშნული :attribute არასწორია.',
    'file' => 'ეს :attribute უნდა იყოს ფაილი.',
    'filled' => 'ამ :attribute-ს უნდა ჰქონდეს ღირებულება.',
    'gt' => [
        'array' => 'ამ :attribute-ს უნდა ჰქონდეს :value-ზე მეტი ელემენტი.',
        'file' => 'ეს :attribute უნდა იყოს :value კილობაიტზე მეტი .',
        'numeric' => 'ეს :attribute უნდა იყოს :value -ზე მეტი.',
        'string' => 'ეს :attribute უნდა იყოს :value სიმბოლოზე მეტი.',
    ],
    'gte' => [
        'array' => 'ამ :attribute-ს უნდა ჰქონდეს :value ან მასზე მეტი ელემენტი.',
        'file' => 'ეს :attribute უნდა იყოს :value ან მასზე მეტი კილობაიტი.',
        'numeric' => 'ეს :attribute უნდა იყოს :value ან მეტი.',
        'string' => 'ეს :attribute უნდა იყოს :value ან მასზე მეტი სიმბოლო.',
    ],
    'image' => 'ეს :attribute უნდა იყოს გამოსახულება.',
    'in' => 'მონიშნული :attribute არასწორია.',
    'in_array' => 'ეს :attribute ველი არ არსებობს :other-ში.',
    'integer' => 'ეს :attribute უნდა იყოს მთელი რიცხვი.',
    'ip' => 'ეს :attribute უნდა იყოს სწორი IP მისამართი.',
    'ipv4' => 'ეს :attribute უნდა იყოს სწორი IPv4 მისამართი.',
    'ipv6' => 'ეს :attribute უნდა იყოს სწორი IPv6 მისამართი.',
    'json' => 'ეს :attribute უნდა იყოს სწორი JSON string.',
    'lt' => [
        'array' => 'ამ :attribute-ს უნდა ჰქონდეს :value-ზე მცირე ელემენტი.',
        'file' => 'ეს :attribute უნდა იყოს :value კილობაიტზე მცირე.',
        'numeric' => 'ეს :attribute უნდა იყოს :value-ზე მცირე.',
        'string' => 'ეს :attribute უნდა იყოს :value სიმბოლოზე მცირე.',
    ],
    'lte' => [
        'array' => 'ამ :attribute-ს არ უნდა ჰქონდეს :value-ზე მეტი ელემენტი.',
        'file' => 'ეს :attribute უნდა იყოს :value კილობაიტი ან მასზე მცირე.',
        'numeric' => 'ეს :attribute უნდა იყოს :value ან მასზე მცირე.',
        'string' => 'ეს :attribute უნდა იყოს :value ან მასზე მცირე სიმბოლო.',
    ],
    'mac_address' => 'ეს :attribute უნდა იყოს სწორი MAC მისამართი.',
    'max' => [
        'array' => 'ამ :attribute-ს არ უნდა ჰქონდეს :max-ზე მეტი ელემენტი.',
        'file' => 'ეს :attribute არ უნდა იყოს :max კილობაიტზე მეტი.',
        'numeric' => 'ეს :attribute არ უნდა იყოს :max-ზე მეტი.',
        'string' => 'ეს :attribute არ უნდა იყოს :max სიმბოლოზე მეტი.',
    ],
    'mimes' => 'ეს :attribute უნდა იყოს ფაილის ტიპი: :values.',
    'mimetypes' => 'ეს :attribute უნდა იყოს ფაილის ტიპი: :values.',
    'min' => [
        'array' => 'ამ :attribute-ს უნდა ჰქონდეს მინიმუმ :min ელემენტი.',
        'file' => 'ეს :attribute უნდა იყოს მინიმუმ :min კილობაიტი.',
        'numeric' => 'ეს :attribute უნდა იყოს მინიმუმ :min.',
        'string' => 'ეს :attribute უნდა იყოს მინიმუმ :min სიმბოლო.',
    ],
    'multiple_of' => 'ეს :attribute უნდა იყოს :value-ს ჯერადი.',
    'not_in' => 'მონიშნული :attribute არასწორია.',
    'not_regex' => 'ამ :attribute-ის ფორმატი არასწორია.',
    'numeric' => 'ეს :attribute უნდა იყოს რიცხვი.',
    'password' => [
        'letters' => 'ეს :attribute უნდა შეიცავდეს მინიმუმ ერთ ასოს.',
        'mixed' => 'ეს :attribute უნდა შეიცავდეს მინიმუმ ერთ დიდ და ერთ პატარა ასოს.',
        'numbers' => 'ეს :attribute უნდა შეიცავდეს მინიმუმ ერთ რიცვხვს.',
        'symbols' => 'ეს :attribute უნდა შეიცავდეს მინიმუმ ერთ სიმბოლოს.',
        'uncompromised' => 'მოცემული :attribute აღმოჩნდა მონაცემთა გაჟონვაში. გთხოვთ აირჩიოთ განსხვავებული :attribute.',
    ],
    'present' => 'ეს :attribute უნდა იყოს წარმოდგენილი.',
    'prohibited' => 'ეს :attribute ველი აკრძალულია.',
    'prohibited_if' => 'ეს :attribute ველი აკრძალულია როცა :other არის :value.',
    'prohibited_unless' => 'ეს :attribute ველი აკრძალულია, თუ :other არ არის :values -ში.',
    'prohibits' => 'ეს :attribute ველი კრძალავს :other-ის არსებობას.',
    'regex' => 'ეს :attribute ფორმატი არასწორი.',
    'required' => 'ეს :attribute ველი აუცილებელია.',
    'required_array_keys' => 'ეს :attribute ველი უნდა შეიცავდეს ჩანაწერებს: :values-სთვის.',
    'required_if' => 'ეს :attribute ველი აუცილებელია როცა :other არის :value.',
    'required_unless' => 'ეს :attribute ველი აუცილებელია, თუ :other არ არის :values-ში.',
    'required_with' => 'ეს :attribute ველი აუცილებელია როცა :values წარმოდგენილია.',
    'required_with_all' => 'ეს :attribute ველი აუცილებელია როცა :values წარმოდგენილია.',
    'required_without' => 'ეს :attribute ველი აუცილებელია როცა :values წარმოდგენილია არაა.',
    'required_without_all' => 'ეს :attribute ველი აუცილებელია როცა არცერთი :values წარმოდგენილი არაა.',
    'same' => 'ეს :attribute და :other უნდა დაემთხვეს.',
    'size' => [
        'array' => 'ეს :attribute უნდა შეიცავდეს :size ელემენტებს.',
        'file' => 'ეს :attribute უნდა იყოს :size კილობაიტი.',
        'numeric' => 'ეს :attribute უნდა იყოს :size.',
        'string' => 'ეს :attribute უნდა იყოს :size სიმბოლო.',
    ],
    'starts_with' => 'ეს :attribute უნდა იწყებოდეს ერთ-ერთი შემდგომით: :values.',
    'string' => 'ეს :attribute უნდა იყოს string.',
    'timezone' => 'ეს :attribute უნდა შეიცავდეს სწორ დროის სარტყელს.',
    'unique' => 'ეს :attribute უკვე დაკავებულია.',
    'uploaded' => 'ეს :attribute ვერ აიტვირთა.',
    'url' => 'ეს :attribute უნდა იყოს სწორი URL.',
    'uuid' => 'ეს :attribute უნდა იყოს სწორი UUID.',
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
            'rule-name' => 'custom-message',
        ],
    ],
];
