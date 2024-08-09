<?php
return [
    'date_equals' => ':attribute mora biti datum jednak :date.',
    'digits' => ':attribute mora biti :digits znamenke.',
    'lt' => [
        'string' => ':attribute mora biti manji od :value znamenki.',
        'array' => ':attribute mora imati manje od :value stavki.',
        'file' => ':attribute mora biti manji od :value kilobajta.',
        'numeric' => ':attribute mora biti manji od :value.',
    ],
    'password' => [
        'mixed' => ':attribute mora sadržavati barem jedno veliko i jedno malo slovo.',
        'uncompromised' => 'Dati :attribute se pojavio u curenju podataka. Molimo, odaberite drugi :attribute.',
        'letters' => ':attribute mora sadržavati barem jedno slovo.',
        'numbers' => ':attribute mora sadržavati barem jedan broj.',
        'symbols' => ':attribute mora sadržavati barem jedan znak.',
    ],
    'required_without' => ':attribute polje je potrebno kada :values nije prisutan.',
    'current_password' => 'Lozinka je netačna.',
    'gt' => [
        'file' => ':attribute mora biti veći od :value kilobajta.',
        'array' => ':attribute mora imati više od :value stavki.',
        'numeric' => ':attribute mora biti veći od :value.',
        'string' => ':attribute mora biti veći od :value znakova.',
    ],
    'min' => [
        'string' => ':attribute mora biti barem :min znakova.',
        'array' => ':attribute mora imati barem :min stavki.',
        'file' => ':attribute mora iznositi barem :min kilobajta.',
        'numeric' => ':attribute mora biti barem :min.',
    ],
    'prohibited_unless' => ':attribute polje je zabranjeno osim ako :other je u :values.',
    'starts_with' => ':attribute mora započeti s jednim od sljedećih: :values.',
    'doesnt_end_with' => ':attribute ne smije završiti sa jednom od slijedećih: :values.',
    'file' => ':attribute mora biti datoteka.',
    'uuid' => ':attribute mora biti validan UUID.',
    'gte' => [
        'numeric' => ':attribute mora biti veći ili jednak :value.',
        'array' => ':attribute mora imati :value ili više stavki.',
        'file' => ':attribute mora biti veći ili jednak :value kilobajta.',
        'string' => ':attribute mora biti veći ili jednak :value znamenki.',
    ],
    'ip' => ':attribute mora biti validna IP adresa.',
    'mimes' => ':attribute mora biti datoteka tipa: :values.',
    'required_if' => ':attribute polje je potrebno kada :other je :value.',
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
    'accepted' => ':attribute mora biti prihvaćen.',
    'json' => ':attribute mora biti validan JSON string.',
    'lte' => [
        'string' => ':attribute mora biti manji od ili jednak :value znamenki.',
        'array' => ':attribute ne smije imati više od :value stavki.',
        'file' => ':attribute mora biti manji od ili jednak :value kilobajta.',
        'numeric' => ':attribute mora biti manji od ili jednak :value.',
    ],
    'prohibited' => ':attribute polje je zabranjeno.',
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
            'rule-name' => 'prilagođena poruka',
        ],
    ],
    'before_or_equal' => ':attribute mora biti datum prije ili jednak :date.',
    'accepted_if' => ':attribute mora biti prihvaćen kada :other je :value.',
    'active_url' => ':attribute nije validan URL.',
    'after' => ':attribute mora biti datum poslije :date.',
    'after_or_equal' => ':attribute mora biti datum poslije ili jednak :date.',
    'alpha' => ':attribute mora sadržavati samo slova.',
    'alpha_dash' => ':attribute mora sadržavati samo slova, brojeve, crtice i donje crte.',
    'alpha_num' => ':attribute mora sadržavati samo slova i brojeve.',
    'array' => ':attribute mora biti u nizu.',
    'before' => ':attribute mora biti datum nakon :date.',
    'between' => [
        'array' => ':attribute mora imati između :min i :max stavki.',
        'file' => ':attribute mora biti između :min i :max kilobajta.',
        'numeric' => ':attribute mora biti između :min i :max.',
        'string' => ':attribute mora biti između :min i :max znakova.',
    ],
    'boolean' => ':attribute polje mora biti tačno ili netačno.',
    'confirmed' => ':attribute potrvda se ne podudara.',
    'date' => ':attibute nije validan datum.',
    'date_format' => ':attribute se ne slaže sa formatom :format.',
    'declined' => ':attibute mora biti odbijen.',
    'declined_if' => ':attibute mora biti odbijen kada :other je :value.',
    'different' => ':attribute i :other moraju biti drugačiji.',
    'digits_between' => ':attribute mora biti između :min i :max znamenki.',
    'dimensions' => ':attribute ima neodgovarajuće dimenzije slike.',
    'distinct' => ':attribute polje ima dupliciranu vrijednost.',
    'doesnt_start_with' => ':attribute ne smije započeti sa jednom od slijedećih: :values.',
    'email' => ':attribute mora biti validna email adresa.',
    'ends_with' => ':attribute mora završiti sa jednim/jednom od slijedećih: :values.',
    'enum' => 'Selektovani :attribute nije validan.',
    'exists' => 'Selektovani :attribute nije validan.',
    'filled' => ':attribute polje mora imati vrijednost.',
    'image' => ':attribute mora biti slika.',
    'in' => 'Selektovani :attribute nije validan.',
    'in_array' => ':attribute polje ne postoji u :other.',
    'integer' => ':attribute mora biti cijeli broj.',
    'ipv4' => ':attribute mora biti validna IPv4 adresa.',
    'mac_address' => ':attribute mora biti validna MAC adresa.',
    'max' => [
        'array' => ':attribute ne smije imati više od :max stavki.',
        'file' => ':attribute ne smije biti veći od :max kilobajta.',
        'numeric' => ':attribute ne smije biti veći od :max.',
        'string' => ':attribute ne smije biti veći od :max znakova.',
    ],
    'mimetypes' => ':attribute mora biti datoteka tipa: :values.',
    'multiple_of' => ':attribute mora biti višekratnik od :value.',
    'not_in' => 'Selektirani :attribute nije validan.',
    'not_regex' => 'Format :attribute nije validan.',
    'numeric' => ':attribute mora biti broj.',
    'present' => ':attribute polje mora biti prisutno.',
    'ipv6' => ':attribute mora biti validna IPv6 adresa.',
    'prohibited_if' => ':attribute polje je zabranjeno kada :other je :value.',
    'prohibits' => ':attribute polje zabranjuje :other da bude prisutno.',
    'regex' => ':attribute format nije validan.',
    'required' => ':attribute polje je potrebno.',
    'required_array_keys' => ':attribute polje mora da sadrži unose za :values.',
    'required_unless' => ':attribute polje je potrebno osim ukoliko :other je u :values.',
    'required_with' => ':attribute polje je potrebno kada :values je prisutan.',
    'required_with_all' => ':attribute polje je potrebno kada :values su prisutni.',
    'required_without_all' => ':attribute polje je potrebno kada nikakvi :values nisu prisutni.',
    'same' => ':attribute i :other se moraju poklapati.',
    'size' => [
        'array' => ':attribute mora sadržavati :size stavke.',
        'file' => ':attribute mora biti :size kilobajta.',
        'numeric' => ':attribute mora biti :size.',
        'string' => ':attribute mora biti :size znakova.',
    ],
    'timezone' => ':attribute mora biti važeća vremenska zona.',
    'unique' => ':attribute je već zauzeto.',
    'uploaded' => ':attribute se nije uspjeo učitati.',
    'url' => ':attribute mora biti validan URL.',
    'string' => ':attribute mora biti tekstni niz.',
];
