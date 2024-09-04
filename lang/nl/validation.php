<?php
return [
    'declined_if' => 'Een :attribute moet worden geweigerd wanneer :other is :value.',
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
    'accepted' => 'Een :attribute moet worden geaccepteerd.',
    'alpha_dash' => 'Een :attribute mag alleen letters, cijfers, streepjes en underscores bevatten.',
    'doesnt_end_with' => 'Een :attribute mag niet eindigen met een van de volgende: :values.',
    'enum' => 'De geselecteerde :attribute is ongeldig.',
    'filled' => 'Een :attribute veld moet een waarde hebben.',
    'gt' => [
        'string' => 'Een :attribute moet groter zijn dan :value tekens.',
        'array' => 'Een :attribute moet meer dan :value items hebben.',
        'file' => 'Een :attribute moet groter zijn dan :value kilobytes.',
        'numeric' => 'Een :attribute moet groter zijn dan :value.',
    ],
    'file' => 'Een :attribute moet een bestand zijn.',
    'gte' => [
        'string' => 'Een :attribute moet groter zijn dan of gelijk aan :value tekens.',
        'array' => 'Een :attribute moet :value items of meer hebben.',
        'file' => 'Een :attribute moet groter zijn dan of gelijk aan :value kilobytes.',
        'numeric' => 'Een :attribute moet groter zijn dan of gelijk aan :value.',
    ],
    'numeric' => 'Een :attribute moet een getal zijn.',
    'ipv6' => 'Een :attribute moet een geldig IPv6-adres zijn.',
    'lt' => [
        'numeric' => 'Een :attribute moet kleiner zijn dan :value.',
        'array' => 'Een :attribute moet minder dan :value items hebben.',
        'file' => 'Een :attribute moet kleiner zijn dan :value kilobytes.',
        'string' => 'Een :attribute moet kleiner zijn dan :value tekens.',
    ],
    'lte' => [
        'file' => 'Een :attribute moet kleiner zijn dan of gelijk aan :value kilobytes.',
        'array' => 'Een :attribute mag niet meer dan :value items hebben.',
        'numeric' => 'Een :attribute moet kleiner zijn dan of gelijk aan :value.',
        'string' => 'Een :attribute moet kleiner zijn dan of gelijk aan :value tekens.',
    ],
    'max' => [
        'file' => 'Een :attribute mag niet groter zijn dan :max kilobytes.',
        'array' => 'Een :attribute mag niet meer dan :max items hebben.',
        'numeric' => 'Een :attribute mag niet groter zijn dan :max.',
        'string' => 'Een :attribute mag niet groter zijn dan :max tekens.',
    ],
    'min' => [
        'array' => 'Een :attribute moet minstens :min items hebben.',
        'file' => 'Een :attribute moet minstens :min kilobytes zijn.',
        'numeric' => 'Een :attribute moet minstens :min zijn.',
        'string' => 'Een :attribute moet minstens :min tekens zijn.',
    ],
    'not_in' => 'De geselecteerde :attribute is ongeldig.',
    'password' => [
        'mixed' => 'Een :attribute moet minstens één hoofdletter en één kleine letter bevatten.',
        'letters' => 'Een :attribute moet minstens één letter bevatten.',
        'numbers' => 'Een :attribute moet minstens één getal bevatten.',
        'symbols' => 'Een :attribute moet minstens één symbool bevatten.',
        'uncompromised' => 'De gegeven :attribute s verschenen in een datalek. Kies een andere :attribute.',
    ],
    'prohibited_if' => 'Een :attribute veld is verboden wanneer :other is :value.',
    'required_array_keys' => 'Een :attribute veld moet vermeldingen bevatten voor :values.',
    'required_without_all' => 'Een :attribute veld is vereist als geen van :values aanwezig zijn.',
    'prohibited_unless' => 'Een :attribute veld is verboden tenzij :other is in :values.',
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
            'rule-name' => 'Custom-message',
        ],
    ],
    'accepted_if' => 'Een :attribute moet worden geaccepteerd wanneer :other is :value.',
    'active_url' => 'Een :attribute is geen geldige URL.',
    'after' => 'Een :attribute moet een datum zijn na :date.',
    'after_or_equal' => 'Een :attribute moet een datum zijn na of gelijk aan :date.',
    'alpha' => 'Een :attribute mag alleen letters bevatten.',
    'alpha_num' => 'Een :attribute mag alleen letters en cijfers bevatten.',
    'array' => 'Een :attribute moet een array zijn.',
    'before' => 'Een :attribute moet een datum zijn vóór :date.',
    'before_or_equal' => 'Een :attribute moet een datum zijn voor of gelijk aan :date.',
    'between' => [
        'array' => 'Een :attribute moet tussen :min en :max items hebben.',
        'file' => 'Een :attribute moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'Een :attribute moet tussen :min en :max zijn.',
        'string' => 'Een :attribute moet tussen :min en :max tekens zijn.',
    ],
    'boolean' => 'Een :attribute veld moet waar of onwaar zijn.',
    'confirmed' => 'Een :attribute bevestiging komt niet overeen.',
    'current_password' => 'Het wachtwoord is onjuist.',
    'date' => 'Een :attribute is geen geldige datum.',
    'date_equals' => 'Een :attribute moet een datum zijn die gelijk is aan :date.',
    'date_format' => 'Een :attribute komt niet overeen met het formaat :format.',
    'declined' => 'Een :attribute moet worden geweigerd.',
    'different' => 'De :attribute en :other moet anders zijn.',
    'digits' => 'Een :attribute moet :digits cijfers zijn.',
    'digits_between' => 'Een :attribute moet tussen :min en :max cijfers zijn.',
    'dimensions' => 'Een :attribute heeft ongeldige afbeeldingsafmetingen.',
    'distinct' => 'Een :attribute veld heeft een dubbele waarde.',
    'doesnt_start_with' => 'Een :attribute mag niet beginnen met een van de volgende: :values.',
    'email' => 'Een :attribute moet een geldig e-mailadres zijn.',
    'ends_with' => 'Een :attribute moet eindigen met een van de volgende: :values.',
    'exists' => 'De geselecteerde :attribute is ongeldig.',
    'image' => 'Een :attribute moet een afbeelding zijn.',
    'in' => 'De geselecteerde :attribute is invalid.',
    'in_array' => 'Een :attribute veld bestaat niet in :other.',
    'integer' => 'Een :attribute moet een geheel getal zijn.',
    'ip' => 'Een :attribute moet een geldig IP-adres zijn.',
    'ipv4' => 'Een :attribute moet een geldig IPv4-adres zijn.',
    'json' => 'Een :attribute moet een geldige JSON-string zijn.',
    'mac_address' => 'Een :attribute moet een geldig MAC-adres zijn.',
    'mimes' => 'Een :attribute moet een bestand van het type: :values zijn.',
    'mimetypes' => 'Een :attribute moet een bestand van het type :values zijn.',
    'multiple_of' => 'Een :attribute moet een veelvoud zijn van :value.',
    'not_regex' => 'Een :attribute formaat is ongeldig.',
    'present' => 'Een :attribute veld moet aanwezig zijn.',
    'prohibited' => 'Een :attribute veld is verboden.',
    'regex' => 'Een :attribute formaat is ongeldig.',
    'required' => 'Een :attribute veld is vereist.',
    'required_if' => 'Een :attribute veld is vereist wanneer :other is :value.',
    'required_with_all' => 'Een :attribute veld is vereist wanneer :values aanwezig zijn.',
    'prohibits' => 'Een :attribute veld verbiedt :other om aanwezig te zijn.',
    'required_unless' => 'Een :attribute veld is vereist tenzij :other is in :values.',
    'required_with' => 'Een :attribute veld is vereist als :values aanwezig is.',
    'required_without' => 'Een :attribute veld is vereist als :values niet aanwezig is.',
    'same' => 'Een :attribute en :other moet overeenkomen.',
    'size' => [
        'array' => 'Een :attribute moet :size items bevatten.',
        'file' => 'Een :attribute moet :size kilobytes zijn.',
        'numeric' => 'Een :attribute moet :size zijn.',
        'string' => 'Een :attribute moet :size tekens zijn.',
    ],
    'starts_with' => 'Een :attribute moet beginnen met een van de volgende: :values.',
    'string' => 'Een :attribute moet een string zijn.',
    'timezone' => 'Een :attribute moet een geldige tijdzone zijn.',
    'unique' => 'Een :attribute is al bezet.',
    'uploaded' => 'Een :attribute mislukt bij het uploaden.',
    'url' => 'Een :attribute moet een geldige URL zijn.',
    'uuid' => 'Een :attribute moet een geldige UUID zijn.',
];
