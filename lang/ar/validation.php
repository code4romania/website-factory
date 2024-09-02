<?php
return [
    'before_or_equal' => 'يجب أن يكون ال :attribute بتاريخ بعد أو يساوي :date.',
    'lt' => [
        'array' => 'يجب أن يحتوى ال :attribute على عناصر ذات قيمة أقل من :value.',
        'string' => 'يجب أن يكون حجم ال :attribute أقل من :value حروف.',
        'file' => 'يجب أن يكون حجم ا ال :attribute أقل من :value كيلوبايت.',
        'numeric' => 'يجب أن يكون حجم ال :attribute أقل من :value.',
    ],
    'prohibited_unless' => 'يكون حقل ال :attribute ممنوعا إلا في حال :other هو في :values.',
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
    'accepted' => 'يجب قبول ال :attribute.',
    'between' => [
        'string' => 'يجب أن يحتوى ال :attribute على عناصر بين :min و :max من الحروف.',
        'numeric' => 'يجب أن يكون ال :attribute بين :min و :max.',
        'array' => 'يجب أن يحتوى ال :attribute على عناصر بين :min و :max.',
        'file' => 'يجب أن يكون ال :attribute بين :min و :max كيلوبايت.',
    ],
    'filled' => 'حقل ال :attribute يجب أن يكون قيمة.',
    'integer' => 'يجب أن يكون ال :attribute عددًا صحيحًا.',
    'lte' => [
        'numeric' => 'يجب أن يكون حجم ا ال :attribute أقل من أو يساوي :value.',
        'array' => 'يجب أن يكون حجم ال :attribute أكبر من :value عناصر.',
        'file' => 'يجب أن يكون حجم ال :attribute أقل من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يكون حجم ا ال :attribute أقل من أو يساوي :value أحرف.',
    ],
    'max' => [
        'string' => 'لا يجب أن يكون ال :attribute أكبر من:max من الحروف.',
        'array' => 'لا يجب أن يحتوى ال :attribute على أكبر من :max من العناصر.',
        'file' => 'لا يجب أن يكون ال :attribute أكبر من:max من الكيلوبايت.',
        'numeric' => 'لا يجب أن يكون ال :attribute أكبر من :max .',
    ],
    'password' => [
        'mixed' => 'يجب أن يحتوي ال :attribute على حرف كبير واحد على الأقل وحرف صغير واحد.',
        'uncompromised' => 'ظهر ال :attribute المُدخل في بيانات مسربة. يرجى اختيار ال :attribute آخر.',
        'letters' => 'يجب أن يحتوي ال :attribute على حرف واحد على الأقل.',
        'numbers' => 'يجب أن يحتوي ال :attribute على ر قم واحد على الأقل.',
        'symbols' => 'يجب أن يحتوي ال :attribute على رمز واحد على الأقل.',
    ],
    'required_without_all' => 'حقل ال :attribute مطلوب عندما لا تكون :values موجودة.',
    'date_format' => 'لا يتطابق ال :attribute مع الصيغة :format.',
    'digits' => 'يجب أن يكون ال :attribute :digits أرقام.',
    'email' => 'يجب أن يكون ال :attribute بريدا إلكترونيا صالحا.',
    'gt' => [
        'file' => 'يجب أن يكون ال :attribute أكبر من :value كيلوبايت.',
        'numeric' => 'يجب أن تكون ال :attribute أكبر من :value.',
        'string' => 'يجب أن يكون ال :attribute أكبر من :value حروف.',
        'array' => 'يجب أن يحتوي ال :attribute على أكثر من :value من العناصر.',
    ],
    'in_array' => 'ال :attribute ليس موجود في :other.',
    'multiple_of' => 'يجب أن يكون ال :attribute مضاعفًا لـ :value.',
    'boolean' => 'يجب أن يكون حقل ال :attribute صحيحًا أو خطأً.',
    'digits_between' => 'يجب أن يكون ال :attribute بين :min و :max للأرقام.',
    'not_in' => 'ال :attribute الذي تم اختياره غير صالح.',
    'not_regex' => 'صيغة ال :attribute غير صالحة.',
    'required_unless' => 'حقل ال :attribute مطلوب إلا في حال :other هو في :values.',
    'size' => [
        'numeric' => 'يجب أن يكون ال :attribute :size.',
        'array' => 'يجب أن يحتوي ال :attribute على عناصر :size.',
        'file' => 'يجب أن يحتوي ال :attribute على عناصر :size كيلوبايت.',
        'string' => 'يجب أن يكون ال :attribute :size أحرف.',
    ],
    'timezone' => 'يجب أن يكون ال :attribute منطقة زمنية صالحة.',
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
            'rule-name' => 'رسالة مخصصة',
        ],
    ],
    'gte' => [
        'string' => 'يجب أن يكون ال :attribute أكبر من أو يساوي :value حروف.',
        'array' => 'يجب أن يكون ال :attribute: :value عناصر أو أكثر.',
        'file' => 'يجب أن يكون ال :attribute أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'يجب أن يكون ال :attribute أكبر من أو يساوي :value.',
    ],
    'ip' => 'يجب أن تكون ال :attribute عنوان IP صالح.',
    'min' => [
        'file' => 'يجب أن يكون حجم ا ال :attribute على الأقل :min من الكيلوبايت.',
        'array' => 'يجب أن يحتوى ال :attribute على :min من العناصر.',
        'numeric' => 'يجب أن يكون ال :attribute على الأقل :min.',
        'string' => 'يجب أن يكون ال :attribute على الأقل :min من الحروف.',
    ],
    'uuid' => 'يجب أن يكون ال :attribute عبارة عن UUID صالح.',
    'alpha' => 'يجب أن يحتوي ال :attribute على أحرف فقط.',
    'accepted_if' => 'يجب قبول :attribute عندما يكون :other هو :value.',
    'active_url' => 'The :attribute ليست بعنوان URL صالح.',
    'after' => 'The :attribute يجب أن يكون بتاريخ بعد :date.',
    'after_or_equal' => 'يجب أن يكون The :attribute تاريخ بعد أو يساوي :date.',
    'alpha_dash' => 'يجب أن يحتوي ال :attribute فقط على أحرف وأرقام وشرطات وعلامات سفلية.',
    'alpha_num' => 'يجب أن يحتوى ال :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون ال :attribute مكون من مصفوفة.',
    'before' => 'يجب أن يكون ال :attribute بتاريخ قبل :date.',
    'confirmed' => 'تأكيد ال :attribute غير مطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'ال :attribute ليس بتاريخ صالح.',
    'date_equals' => 'The :attribute must be a date before or equal to :date.',
    'declined' => 'يجب رفض ال :attribute.',
    'declined_if' => 'يجب رفض ال :attribute عندما :other هو :value.',
    'different' => 'ال :attribute و :other يجب أن يكون مختلفا.',
    'dimensions' => 'يحتوي ال :attribute على أبعاد صورة غير صالحة.',
    'distinct' => 'حقل ال :attribute يحتوي على قيمة مكررة.',
    'doesnt_end_with' => 'لا يمكن أن ينتهي ال :attribute بواحدة من القيم التالية:values.',
    'doesnt_start_with' => 'لا يمكن أن يبدأ ال :attribute بواحدة مما يلي: :values.',
    'ends_with' => 'يجب أن ينتهي ال :attribute بواحدة مما يلي: :values.',
    'enum' => 'ال :attribute الذي تم اخيتاره غير صالح.',
    'exists' => 'ال :attribute الذي تم اختياره غير صالح.',
    'file' => 'يجب أن يكون ال :attribute ملف.',
    'image' => 'ال :attribute يجب أن يكون صورة.',
    'in' => 'ال :attribute غير صالح.',
    'ipv4' => 'يجب أن تكون ال :attribute عنوان IPv4 صالح.',
    'ipv6' => 'يجب أن تكون ال :attribute عنوان IPv6 صالح.',
    'json' => 'يجب أن يكون ال :attribute عبارة عن سلسلة JSON صالحة.',
    'mac_address' => 'يجب أن يكون ال :attribute عنوان MAC صالحًا.',
    'mimes' => 'يجب أن يكون ال :attribute عبارة عن ملف من نوع: :values.',
    'mimetypes' => 'يجب أن يكون ال :attribute عبارة عن ملف من نوع: :values.',
    'numeric' => 'يجب أن يكون ال :attribute رقما.',
    'present' => 'حقل ال :attribute يجب أن يكون حاضر.',
    'prohibited' => 'حقل ال :attribute يجب أن يكون ممنوعا.',
    'prohibited_if' => 'يكون حقل ال :attribute ممنوعا عندما :other هو :value.',
    'prohibits' => 'يمنع حقل ال :attribute :other من أن يكون موجودا.',
    'regex' => 'صيغة ال :attribute غير صالحة.',
    'required' => 'صيغة ال :attribute مطلوبة.',
    'required_array_keys' => 'يجب أن يحتوي حقل ال :attribute على مدخلات لـ: :values.',
    'required_if' => 'حقل ال :attribute مطلوب عندما :other يكون :value.',
    'required_with' => 'حقل ال :attribute مطلوب عندما :values موجودة.',
    'required_with_all' => 'حقل ال :attribute مطلوب عندما تكون :values موجودة.',
    'required_without' => 'حقل ال :attribute مطلوب عندما :values غير موجودة.',
    'same' => 'ال :attribute و:other يجب أن يتطابقان.',
    'starts_with' => 'يجب أن يبدأ ال :attribute بواحدة مما يلي: :values.',
    'string' => 'يجب أن يكون ال :attribute شريحة.',
    'unique' => 'تم اخيتار ال :attribute مسبقا.',
    'uploaded' => 'فشل ال :attribute في التحميل.',
    'url' => 'يجب أن يكون ال :attribute عنوان URL صالح.',
];
