<?php
return [
    'active_url' => ':attribute não é um URL válido.',
    'after' => ':attribute tem de ser uma data após :date.',
    'after_or_equal' => ':attribute tem de ser uma data após ou igual a :date.',
    'alpha' => ':attribute tem de conter apenas letras.',
    'alpha_num' => ':attribute tem de conter apenas letras e números.',
    'array' => ':attribute tem de ser uma variável.',
    'before_or_equal' => ':attribute tem de ser uma data antes ou igual a :date.',
    'between' => [
        'array' => ':attribute tem de ter entre :min e :max itens.',
        'numeric' => ':attribute tem de ser entre :min e :max.',
        'string' => ':attribute tem de ser entre :min e :max carácteres.',
        'file' => ':attribute tem de ser entre :min e :max quilobytes.',
    ],
    'boolean' => 'O campo de :attribute tem de ser verdadeiro ou falso.',
    'confirmed' => 'A confirmação de :attribute não corresponde.',
    'current_password' => 'A palavra-passe não está correcta.',
    'date' => ':attribute não é uma data válida.',
    'date_format' => ':attribute não corresponde ao formato :format.',
    'declined' => 'Tem de declinar :attribute.',
    'declined_if' => ':attribute tem de ser declinado quando :other é :value.',
    'digits' => ':attribute tem de ter :digits dígitos.',
    'digits_between' => ':attribute tem de ser entre :min e :max dígitos.',
    'dimensions' => ':attribute tem dimensões inválidas de imagem.',
    'distinct' => 'O campo de :attribute tem um valor duplicado.',
    'doesnt_start_with' => ':attribute não pode começar com uma das seguintes :values.',
    'email' => ':attribute tem de ser um endereço e-mail válido.',
    'ends_with' => ':attribute tem der acabar com uma das seguintes: :values.',
    'enum' => 'A seleccção de :attribute é inválida.',
    'file' => ':attribute tem de ser um ficheiro.',
    'filled' => 'O campo de :attribute tem de ter um valor.',
    'gt' => [
        'array' => ':attribute tem de ter mais de :value itens.',
        'numeric' => ':attribute tem de ser maior que :value.',
        'string' => ':attribute tem de ser maior do que :value carácteres.',
        'file' => ':attribute tem de ser maior do que :value quilobytes.',
    ],
    'gte' => [
        'array' => ':attribute tem de ter :value ou mais itens.',
        'file' => ':attribute tem de ser maior ou igual a :value quilobytes.',
        'numeric' => ':attribute tem de ser maior ou igual a :value.',
        'string' => ':attribute tem de ser maior ou igual a :value carácteres.',
    ],
    'image' => ':attribute tem de ser uma imagem.',
    'in' => ':attribute seleccionado é inválido.',
    'in_array' => 'O campo de :attribute não existe em :other.',
    'integer' => ':attribute tem de ser um número inteiro.',
    'ipv4' => ':attribute tem de ser um endereço IPv4 válido.',
    'ipv6' => ':attribute tem de ser um endereço IPv6 válido.',
    'json' => ':attribute tem de ser um JSON string válido.',
    'lt' => [
        'file' => ':attribute tem de ser menos do que :value quilobytes.',
        'numeric' => ':attribute tem de ser menos do que :value.',
        'string' => ':attribute tem de ser menos do que :value carácteres.',
        'array' => ':attribute tem de ter menos do que :value itens.',
    ],
    'lte' => [
        'array' => ':attribute não pode ter mais do que :value itens.',
        'numeric' => ':attribute tem de ser menos ou igual a :value.',
        'string' => ':attribute tem de ser menos ou igual a :value carácteres.',
        'file' => ':attribute tem de ser menos ou igual a :value quilobytes.',
    ],
    'mac_address' => ':attribute tem de ser um endereço MAC válido.',
    'max' => [
        'array' => ':attribute não pode ter mais do que :max itens.',
        'numeric' => ':attribute não pode ser maior que :max.',
        'string' => ':attribute não pode ser maior do que :max carácteres.',
        'file' => ':attribute não pode ser maior do que :max quilobytes.',
    ],
    'mimes' => ':attribute tem de ser um ficheiro do tipo :values.',
    'min' => [
        'array' => ':attribute tem de ter pelo menos :min itens.',
        'file' => ':attribute tem de ser pelo menos :min quilobytes.',
        'numeric' => ':attribute tem de ser pelo menos :min.',
        'string' => ':attribute tem de ser pelo menos :min carácteres.',
    ],
    'not_in' => ':attribute seleccionado é inválido.',
    'not_regex' => 'O formato de :attribute é invalido.',
    'numeric' => ':attribute tem de ser um número.',
    'password' => [
        'letters' => ':attribute tem de conter pelo menos uma letra.',
        'numbers' => ':attribute tem de conter pelo menos um número.',
        'symbols' => ':attribute tem de conter pelo menos um símbolo.',
        'uncompromised' => ':attribute apareceu num vazamento de informações. Por favor escolha :attribute diferente.',
        'mixed' => ':attribute tem de conter pelo menos uma maiúscula e uma minúscula.',
    ],
    'present' => 'O campo de :attribute tem de ser presente.',
    'prohibited' => 'O campo de :attribute é proibido.',
    'prohibits' => 'O campo de :attribute proibe a existência de :other.',
    'regex' => 'O formato de :attribute é inválido.',
    'required' => 'O campo de :attribute é obrigatório.',
    'required_array_keys' => 'O campo de :attribute tem de conter registos para: :values.',
    'required_unless' => 'O campo de :attribute é obrigatório a não ser que :other esteja em :values.',
    'required_with' => 'O campo de :attribute é obrigatório quando :values estiver presente.',
    'required_without' => 'O campo de :attribute é obrigatório quando :values não estiver presente.',
    'required_without_all' => 'O campo de :attribute é obrigatório quando nenhum dos :values estiverem presentes.',
    'same' => ':attribute e :other têm de corresponder.',
    'size' => [
        'array' => ':attribute tem de conter :size itens.',
        'numeric' => ':attribute tem de ter :size.',
        'string' => 'Os carácteres de :attribute tem de ser :size.',
        'file' => ':attribute tem de ter :size quilobytes.',
    ],
    'starts_with' => ':attribute tem de começar com um dos seguintes: :values.',
    'string' => ':attribute tem de ser um string.',
    'unique' => ':attribute já foi utilizado.',
    'uploaded' => 'Teve uma falha na carregação de :attribute.',
    'url' => ':attribute tem de ser um URL válido.',
    'uuid' => ':attribute tem de ser um UUID válido.',
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
            'rule-name' => 'mensagem-padrão',
        ],
    ],
    'accepted_if' => ':attribute tem de ser aceite quando :other é :value.',
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
    'accepted' => ':attribute tem de ser aceite.',
    'alpha_dash' => ':attribute tem de conter apenas letras, números, hífens e subtraços.',
    'required_if' => 'O campo de :attribute é obrigatório quando :other é :value.',
    'before' => ':attribute tem de ser uma data antes de :date.',
    'date_equals' => ':attribute tem de ser uma data igual a :date.',
    'ip' => ':attribute tem de ser um endereço IP válido.',
    'required_with_all' => 'O campo de :attribute é obrigatório quando :values estiverem presentes.',
    'timezone' => ':attribute tem de ser um fuso horário válido.',
    'different' => ':attribute e :other têm de ser diferentes.',
    'exists' => 'A seleccção de :attribute é inválida.',
    'doesnt_end_with' => ':attribute não pode acabar-se com uma das seguintes :values.',
    'mimetypes' => ':attribute tem de ser um ficheiro do tipo :values.',
    'prohibited_if' => 'O campo de :attribute é proibido quando :other é :value.',
    'multiple_of' => ':attribute tem de ser um múltiplo de :value.',
    'prohibited_unless' => 'O campo de :attribute é proibido a não ser que :other está em :values.',
];
