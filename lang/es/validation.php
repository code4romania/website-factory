<?php
return [
    'declined' => 'El :attribute debe ser rechazado.',
    'enum' => 'El :attribute seleccionado no es válido.',
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
    'accepted' => 'El :attribute debe ser aceptado.',
    'before_or_equal' => 'El :attribute debe tener una fecha anterior o igual a :date.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'dimensions' => 'El :attribute tiene un tamaño de imagen no válido.',
    'digits_between' => 'El :attribute debe tener entre :min y :max dígitos.',
    'doesnt_end_with' => 'El :attribute no puede terminar en los siguientes valores: :values.',
    'gte' => [
        'file' => 'El :attribute debe pesar :value kilobytes o más.',
        'array' => 'El :attribute debe tener :value artículos o más.',
        'numeric' => 'El :attribute debe ser igual o mayor que :value.',
        'string' => 'El :attribute debe tener :value caracteres o más.',
    ],
    'json' => 'El :attribute debe ser una cadena de texto JSON válida.',
    'lte' => [
        'string' => 'El :attribute debe tener :value caracteres o menos.',
        'array' => 'El :attribute no debe tener más de :value artículos.',
        'file' => 'El :attribute debe pesar :value kilobytes o menos.',
        'numeric' => 'El :attribute debe ser menor o igual que :value.',
    ],
    'mimetypes' => 'El :attribute debe contener un archivo de los siguientes tipos: :values.',
    'min' => [
        'file' => 'El :attribute debe pesar al menos :min kilobytes.',
        'array' => 'El :attribute debe tener al menos :min artículos.',
        'numeric' => 'El :attribute debe tener al menos :min.',
        'string' => 'El :attribute debe tener al menos :min caracteres.',
    ],
    'integer' => 'El :attribute debe ser un número entero.',
    'max' => [
        'string' => 'El :attribute no debe tener más de :max caracteres.',
        'array' => 'El :attribute no debe tener más de :max artículos.',
        'file' => 'El :attribute no debe pesar más de :max kilobytes.',
        'numeric' => 'El :attribute no debe ser mayor que :max.',
    ],
    'password' => [
        'mixed' => 'El :attribute debe tener al menos una mayúscula y una minúscula.',
        'letters' => 'El :attribute debe contener al menos una letra.',
        'numbers' => 'El :attribute debe tener al menos un número.',
        'symbols' => 'El :attribute debe tener al menos un símbolo.',
        'uncompromised' => 'Los datos del :attribute proporcionado se encontraron en una filtración de datos. Por favor, seleccione un :attribute diferente.',
    ],
    'prohibited_if' => 'El campo :attribute está prohibido cuando :other sea :value.',
    'lt' => [
        'string' => 'El :attribute debe tener menos de :value caracteres.',
        'array' => 'El :attribute debe tener menos de :value artículos.',
        'file' => 'El :attribute debe pesar menos de :value kilobytes.',
        'numeric' => 'El :attribute debe ser menor que :value.',
    ],
    'not_regex' => 'El formato :attribute no es válido.',
    'required_array_keys' => 'El campo :attribute debe contener entradas para: :values.',
    'required_with' => 'El campo :attribute es necesario cuando :values esté presente.',
    'starts_with' => 'El :attribute debe comenzar con alguno de los siguientes valores: :values.',
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
            'rule-name' => 'mensaje-personalizado',
        ],
    ],
    'gt' => [
        'array' => 'El :attribute debe tener más de :value artículos.',
        'file' => 'El :attribute debe pesar más de :value kilobytes.',
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'string' => 'El :attribute debe tener más de :value caracteres.',
    ],
    'required_unless' => 'El campo :attribute es necesario a menos que :other esté en :values.',
    'size' => [
        'array' => 'El :attribute debe contener :size artículos.',
        'file' => 'El :attribute debe pesar :size kilobytes.',
        'numeric' => 'El :attribute debe medir :size.',
        'string' => 'El :attribute debe tener :size caracteres.',
    ],
    'accepted_if' => 'El :attribute debe ser aceptado cuando :other sea :value.',
    'after' => 'El :attribute debe tener una fecha posterior a :date.',
    'after_or_equal' => 'El :attribute debe tener una fecha posterior o igual a :date.',
    'alpha_dash' => 'El :attribute únicamente puede contener letras, números, y guiones (-, _).',
    'alpha_num' => 'El :attribute únicamente debe tener letras y números.',
    'before' => 'El :attribute debe tener una fecha anterior a :date.',
    'between' => [
        'array' => 'El :attribute debe tener entre :min y :max artículos.',
        'file' => 'El :attribute debe pesar entre :min y :max kilobytes.',
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'string' => 'El :attribute debe tener entre :min y :max caracteres.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'current_password' => 'La contraseña es incorrecta.',
    'date' => 'El :attribute no es una fecha válida.',
    'date_equals' => 'El :attribute debe tener una fecha igual a :date.',
    'date_format' => 'El :attribute no coincide con el formato :format.',
    'declined_if' => 'EL :attribute debe ser rechazado cuando :other sea :value.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :attribute debe tener :digits dígitos.',
    'active_url' => 'El ::attribute no es una URL válida.',
    'alpha' => 'El :attribute sólo puede contener letras.',
    'array' => 'El :attribute debe ser una tabla.',
    'distinct' => 'El campo :attribute tien un valor duplicado.',
    'doesnt_start_with' => 'El :attribute no puede iniciar con los siguientes valores: :values.',
    'email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El :attribute debe terminar con alguno de los siguientes valores: :values.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute requiere un valor.',
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'El :attribute seleccionado no es válido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'ip' => 'El :attribute debe tener una dirección IP válida.',
    'ipv4' => 'El :attribute debe tener una dirección IPv4 válida.',
    'ipv6' => 'El :attribute debe tener una dirección IPv6 válida.',
    'mac_address' => 'El :attribute debe tener una dirección MAC válida.',
    'mimes' => 'El :attribute sólo puede contener un archivo de tipo: :values.',
    'multiple_of' => 'El :attribute debe ser un múltiplo de :value.',
    'not_in' => 'El :attribute seleccionado no es válido.',
    'numeric' => 'El :attribute debe ser un número.',
    'present' => 'El campo :attribute debe ser completado.',
    'prohibited' => 'El campo :attribute está prohibido.',
    'prohibited_unless' => 'El campo :attribute está prohibido a menos que :other esté en :values.',
    'prohibits' => 'El campo :attribute prohibe que :other esté presente.',
    'regex' => 'El formato :attribute no es válido.',
    'required' => 'El campo :attribute es necesario.',
    'required_if' => 'El campo :attribute es necesario cuando :other sea :value.',
    'required_with_all' => 'El campo :attribute es necesario cuando :values estén presentes.',
    'required_without' => 'El campo :attribute es necesario cuando :values no esté presente.',
    'same' => 'El :attribute y :other deben coincidir.',
    'string' => 'El :attribute debe ser una entrada de texto.',
    'timezone' => 'El :attribute debe ser una zona horaria válida.',
    'uploaded' => 'El :attribute no se pudo cargar.',
    'url' => 'El :attribute debe ser una URL válida.',
    'uuid' => 'El :attribute debe ser una UUID válida.',
    'required_without_all' => 'El campo :attribute es necesario cuando ningún :values estén presentes.',
    'unique' => 'El :attribute ya pertenece a otro usuario.',
];
