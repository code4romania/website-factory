<?php
return [
    'accepted_if' => ':attribute deve essere accettato quando :other è :value.',
    'active_url' => ':attribute non è un URL valido.',
    'after' => ':attribute deve essere una data successiva a :date.',
    'after_or_equal' => ':attribute deve essere una dara successiva o uguale a :date.',
    'alpha' => ':attribute può solo contenere lettere.',
    'alpha_num' => ':attribute può solo contenere lettere e numeri.',
    'array' => ':attribute deve essere una matrice.',
    'before' => ':attribute deve essere una data che precede :date.',
    'between' => [
        'array' => ':attribute deve avere tra :min e :max elementi.',
        'file' => ':attribute deve essere tra :min e :max kilobyte.',
        'numeric' => ':attribute deve essere tra :min e :max.',
        'string' => ':attribute deve essere tra :min e :max caratteri.',
    ],
    'boolean' => ':attribute deve essere vero o falso.',
    'current_password' => 'La password è incorretta.',
    'date_format' => ':attribute non corrisponde al formato :format.',
    'declined' => ':attribute deve essere rifiutato.',
    'declined_if' => ':attribute deve essere rifiutato quando :other è :value.',
    'digits' => ':attribute deve essere :digits cifre.',
    'digits_between' => ':attribute deve essere tra :min e :max cifre.',
    'dimensions' => ':attribute ha dimensioni dell\'immagine non valide.',
    'distinct' => 'Il campo :attribute ha un valore duplicato.',
    'doesnt_start_with' => ':attribute non può iniziare con uno dei seguenti: :values.',
    'email' => ':attribute deve essere un indirizzo email valido.',
    'ends_with' => ':attribute deve terminare con uno dei seguenti elementi: :values.',
    'enum' => ':attribute selezionato non è valido.',
    'file' => ':attribute deve essere un file.',
    'filled' => 'Il campo :attribute deve avere un valore.',
    'gt' => [
        'array' => ':attribute deve avere più di :value elementi.',
        'file' => ':attribute deve essere maggiore di :value kilobytes.',
        'numeric' => ':attribute deve essere maggiore di :value.',
        'string' => ':attribute deve essere maggiore di :value caratteri.',
    ],
    'exists' => ':attribute selezionato non è valido.',
    'doesnt_end_with' => ':attribute non può terminare con uno dei seguenti: :values.',
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
    'accepted' => ':attribute deve essere accettato.',
    'alpha_dash' => ':attribute può solo contenere lettere, numeri e trattini.',
    'before_or_equal' => ':attribute deve essere una data precedente o uguale a :date.',
    'date_equals' => ':attribute deve essere una data uguale a :date.',
    'different' => ':attribute e :other devono essere diversi.',
    'confirmed' => 'La conferma di :attribute non corrisponde.',
    'date' => ':attribute non è una data valida.',
    'gte' => [
        'string' => ':attribute deve essere maggiore o uguale a :value caratteri.',
        'array' => ':attribute deve avere :value o più elementi.',
        'file' => ':attribute deve essere maggiore o uguale a :value kilobytes.',
        'numeric' => ':attribute deve essere maggiore o uguale a :value.',
    ],
    'lt' => [
        'numeric' => ':attribute deve essere minore di :value.',
        'array' => ':attribute deve avere meno di :value elementi.',
        'file' => ':attribute deve essere minore di :value kilobytes.',
        'string' => ':attribute deve essere minore di :value caratteri.',
    ],
    'min' => [
        'array' => 'Il :attribute deve contenere almeno :min elementi.',
        'file' => 'Il :attribute deve essere di almeno :min kilobyte.',
        'numeric' => 'Il :attribute deve essere almeno :min.',
        'string' => ':attribute deve contenere almeno :min caratteri.',
    ],
    'prohibited_if' => 'Il campo :attribute è vietato quando :other è :value.',
    'ipv6' => ':attribute deve essere un indirizzo IPv6 valido.',
    'lte' => [
        'numeric' => ':attribute deve essere minore o uguale a :value.',
        'string' => ':attribute deve essere minore o uguale a :value caratteri.',
        'array' => ':attribute non deve avere più di :value elementi.',
        'file' => ':attribute deve essere minore o uguale a :value kilobytes.',
    ],
    'password' => [
        'mixed' => ':attribute deve contenere almeno una lettera maiuscola e una minuscola.',
        'letters' => 'Il :attribute deve contenere almeno una lettera.',
        'numbers' => 'Il :attribute deve contenere almeno un numero.',
        'symbols' => ':attribute deve contenere almeno un simbolo.',
        'uncompromised' => 'Il dato :attribute è apparso in una fuga di dati. Scegli un :attribute diverso.',
    ],
    'required_with_all' => 'Il campo :attribute è obbligatorio quando sono presenti :values.',
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
            'rule-name' => 'messaggio personalizzato',
        ],
    ],
    'max' => [
        'file' => 'Il :attribute non deve superare :max kilobyte.',
        'array' => ':attribute non può avere più di :max elementi.',
        'numeric' => ':attribute non deve essere maggiore di :max.',
        'string' => ':attribute non deve contenere più di :max caratteri.',
    ],
    'multiple_of' => ':attribute deve essere un multiplo di :value.',
    'required_array_keys' => 'Il campo :attribute deve contenere voci per: :values.',
    'string' => ':attribute deve essere una stringa.',
    'uploaded' => 'Il caricamento di :attribute non è riuscito.',
    'size' => [
        'array' => 'Il :attribute deve contenere elementi :size.',
        'file' => 'Il :attribute deve essere :size kilobyte.',
        'numeric' => 'Il :attribute deve essere :size.',
        'string' => ':attribute deve contenere caratteri :size.',
    ],
    'image' => ':attribute deve essere un\'immagine.',
    'in' => ':attribute selezionato non è valido.',
    'in_array' => ':attribute campo non esiste in :other.',
    'integer' => ':attribute deve essere un numero intero.',
    'ip' => ':attribute deve essere un indirizzo IP valido.',
    'ipv4' => ':attribute deve essere un indirizzo IPv4 valido.',
    'json' => ':attribute deve essere un JSON string valido.',
    'mac_address' => ':attribute deve essere un indirizzo MAC valido.',
    'mimes' => ':attribute deve essere un file di tipo: :values.',
    'mimetypes' => ':attribute deve essere un file di tipo: :values.',
    'not_in' => ':attribute selezionato non è valido.',
    'not_regex' => 'Il formato :attribute non è valido.',
    'numeric' => ':attribute deve essere un numero.',
    'present' => 'Il campo :attribute deve essere presente.',
    'prohibited' => 'Il campo :attribute è vietato.',
    'prohibited_unless' => 'Il campo :attribute è vietato a meno che :other non sia in :values.',
    'prohibits' => 'Il campo :attribute impedisce la presenza di :other.',
    'regex' => 'Il formato :attribute non è valido.',
    'required' => 'Il campo :attribute è obbligatorio.',
    'required_if' => 'Il campo :attribute è obbligatorio quando :other è :value.',
    'required_unless' => 'Il campo :attribute è obbligatorio a meno che :other non sia in :values.',
    'required_with' => 'Il campo :attribute è obbligatorio quando :values è presente.',
    'required_without' => 'Il campo :attribute è obbligatorio quando :values non è presente.',
    'required_without_all' => 'Il campo :attribute è obbligatorio quando nessuno dei :values è presente.',
    'same' => ':attribute e :other devono corrispondere.',
    'starts_with' => ':attribute deve iniziare con uno dei seguenti: :values.',
    'timezone' => ':attribute deve essere un fuso orario valido.',
    'unique' => 'L\' :attribute è già stato preso.',
    'url' => ':attribute deve essere un URL valido.',
    'uuid' => 'Il :attribute deve essere un UUID valido.',
];
