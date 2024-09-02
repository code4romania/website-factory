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
    'accepted' => ':attribute muss akzeptiert werden.',
    'array' => ':attribute muss ein Array sein.',
    'before_or_equal' => ':attribute muss ein Datum vor oder gleich :date sein.',
    'date_format' => ':attribute entspricht nicht dem Format :format.',
    'gte' => [
        'string' => ':attribute muss größer oder gleich den Zeichen :value sein.',
        'array' => ':attribute muss :value oder mehrere Elemente haben.',
        'file' => ':attribute muss größer oder gleich dem :value Kilobytes sein.',
        'numeric' => ':attribute muss größer oder gleich dem :value sein.',
    ],
    'ip' => ':attribute muss eine gültige IP-Adresse sein.',
    'lt' => [
        'string' => ':attribute muss kleiner als :value Zeichnen sein.',
        'file' => ':attribute muss kleiner als :value kilobytes sein.',
        'numeric' => ':attribute muss kleiner als :value sein.',
        'array' => ':attribute muss weniger als :value Elemente haben.',
    ],
    'lte' => [
        'file' => ':attribute muss kleiner oder gleich dem :value Kilobytes sein.',
        'array' => ':attribute darf nicht mehr als :value elemente haben.',
        'numeric' => ':attribute muss kleiner oder gleich dem :value sein.',
        'string' => ':attribute muss kleiner oder gleich den :value Zeichen sein.',
    ],
    'required' => ':attribute Feld ist erforderlich.',
    'size' => [
        'array' => ':attribute muss die :size Elemente enthalten.',
        'file' => ':attribute muss :size kilobytes sein.',
        'numeric' => ':attribute muss :size sein.',
        'string' => ':attribute muss :size Zeichen sein.',
    ],
    'starts_with' => ':attribute muss mit einer der folgenden Angaben beginnen: :values.',
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
            'rule-name' => 'benutzerdefinierte Nachricht',
        ],
    ],
    'accepted_if' => ':attribute muss akzeptiert werden wenn :other :value ist.',
    'active_url' => ':attribute ist keine gültige URL.',
    'after' => ':attribute muss ein Datum nach :date sein.',
    'after_or_equal' => ':attribute muss ein Datum nach oder gleich :date sein.',
    'alpha' => ':attribute darf nur Buchstaben enthalten.',
    'alpha_num' => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'before' => ':attribute muss ein Datum vor :date sein.',
    'between' => [
        'array' => ':attribute muss zwischen :min und :max liegen.',
        'file' => ':attribute muss zwischen :min und :max Kilobytes liegen.',
        'numeric' => ':attribute muss zwischen :min und :max liegen.',
        'string' => ':attribute muss zwischen den Zeichen :min und :max liegen.',
    ],
    'boolean' => ':attribute muss true oder false sein.',
    'confirmed' => ':attribute Bestätigung stimmt nicht überein.',
    'current_password' => 'Das Passwort ist falsch.',
    'date' => ':attribute ist kein gültiges Datum.',
    'date_equals' => ':attribute muss ein Datum sein, das dem :date entspricht.',
    'declined' => ':attribute muss abgelehnt werden.',
    'declined_if' => ':attribute muss abgelehnt werden, wenn :other :value ist.',
    'different' => ':attribute und :other müssen unterschiedlich sein.',
    'digits' => ':attribute muss :digits Ziffern sein.',
    'dimensions' => ':attribute hat ungültige Bildabmessungen.',
    'distinct' => 'Das Feld :attribute hat einen doppelten Wert.',
    'doesnt_start_with' => ':attribute darf nicht mit einer der folgenden Angaben beginnen: :values.',
    'email' => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => ':attribute muss mit einer der folgenden Angaben enden: :values.',
    'enum' => 'Das ausgewählte :attribute ist ungültig.',
    'exists' => 'Das ausgewählte :attribute ist ungültig.',
    'file' => ':attribute muss eine Datei sein.',
    'gt' => [
        'array' => ':attribute muss mehr als :value elemente haben.',
        'file' => ':attribute muss größer als :value Kilobytes sein.',
        'string' => ':attribute muss größer als :value Zeichen sein.',
        'numeric' => ':attribute muss größer als :value sein.',
    ],
    'image' => ':attribute muss ein Bild sein.',
    'in' => 'Das ausgewählte :attribute ist ungültig.',
    'integer' => ':attribute muss eine ganze Zahl sein.',
    'ipv4' => ':attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => ':attribute muss eine gültige IPv6-Adresse sein.',
    'json' => ':attribute muss eine gültige JSON-string sein.',
    'mac_address' => ':attribute muss eine gültige MAC-Adresse sein.',
    'max' => [
        'file' => ':attribute darf nicht größe als :max kilobytes sein.',
        'numeric' => ':attribute darf nicht größer als :max sein.',
        'string' => ':attribute darf nicht größer als :max Zeichen sein.',
        'array' => ':attribute darf nicht mehr als :max Elemente haben.',
    ],
    'mimes' => ':attribute muss eine Datei vom Typ: :values sein.',
    'min' => [
        'array' => ':attribute muss mindestens :min Elemente haben.',
        'file' => ':attribute muss mindestens :min Kilobytes sein.',
        'numeric' => ':attribute muss mindestens :min sein.',
        'string' => ':attribute muss mindestens :min Zeichen haben.',
    ],
    'not_in' => 'Das ausgewählte :attribute ungültig ist.',
    'not_regex' => 'Das Format des/der :attribute(s) ungültig ist.',
    'numeric' => ':attribute muss eine Zahl sein.',
    'password' => [
        'mixed' => ':attribute muss mindestens einen Großbuchstaben und einen Kleinbuchstaben enthalten.',
        'numbers' => ':attribute muss mindestens eine Zahl enthalten.',
        'symbols' => ':attribute muss mindestens ein Symbol enthalten.',
        'letters' => ':attribute muss mindestens einen Buchstaben enthalten.',
        'uncompromised' => 'Das angegebene :attribute ist in einem Datenleck aufgetaucht. Bitte wählen Sie ein anderes: :attribute.',
    ],
    'present' => 'Das :attribute Feld muss vorhanden sein.',
    'prohibited' => ':attribute Feld ist verboten.',
    'prohibited_if' => ':attribute Feld ist verboten, wenn :other :value ist.',
    'prohibited_unless' => ':attribute Feld ist verboten, wenn :other nicht in :values enthalten ist.',
    'prohibits' => ':attribute Feld verbietet das Vorhandensein von :other.',
    'regex' => ':attribute Format ist ungültig.',
    'required_array_keys' => ':attribute Feld muss Einträge für: :values enthalten.',
    'required_if' => ':attribute Feld ist erforderlich, wenn :other :value ist.',
    'required_with' => ':attribute Feld ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all' => ':attribute Feld ist erforderlich, wenn :values vorhanden ist.',
    'required_without' => ':attribute Feld ist erforderlich, wenn :values nicht vorhanden ist.',
    'same' => ':attribute und :other müssen übereinstimmen.',
    'string' => ':attribute muss eine String sein.',
    'timezone' => ':attribute muss eine gültige Zeitzone sein.',
    'unique' => ':attribute ist bereits vergeben.',
    'uploaded' => ':attribute konnte nicht hochgeladen werden.',
    'url' => ':attribute muss eine gültige URL sein.',
    'alpha_dash' => ':attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'digits_between' => ':attribute muss zwischen den Ziffern :min und :max liegen.',
    'doesnt_end_with' => ':attribute darf nicht mit einer der folgenden Angaben enden: :values.',
    'filled' => ':attribute muss einen Wert haben.',
    'in_array' => 'Das Feld :attribute ist in :other nicht vorhanden.',
    'mimetypes' => ':attribute muss eine Datei vom Typ: :values sein.',
    'multiple_of' => ':attribute muss ein Vielfaches von :value sein.',
    'required_unless' => ':attribute Feld ist erforderlich, es sei denn, :other steht in :values.',
    'required_without_all' => ':attribute Feld ist erforderlich, wenn keines der :values vorhanden ist.',
    'uuid' => ':attribute muss eine gültige UUID sein.',
];
