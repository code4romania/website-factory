<?php
return [
    'accepted_if' => 'Le :attribute doit être accepté quand :other is :value.',
    'active_url' => 'Le :attribute n\'a pas un URL valide.',
    'after' => 'Le :attribute doit avoir une date après :date.',
    'after_or_equal' => 'Le :attribute doit avoir une date égale ou après le :date.',
    'alpha' => 'Le :attribute doit contenir uniquement des lettres.',
    'alpha_dash' => 'Le :attribute doit contenir uniquement des lettres, chiffres, traits d\'union et tiret du bas.',
    'alpha_num' => 'Le :attribute doit contenir uniquement des chiffres et des lettres.',
    'before' => 'Le :attribute doit être daté avant le :date.',
    'before_or_equal' => 'Le :attribute doit être daté avant le ou le :date.',
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
    'accepted' => 'Le :attribute doit être accepté.',
    'array' => 'Le :attribute doit être un tableau.',
    'between' => [
        'array' => 'The :attribute doit avoir entre :min et :max d\'articles.',
        'string' => 'Le :attribute doit être entre :min et :max de caractères.',
        'file' => 'Le :attribute doit être entre :min et :max kilobytes.',
        'numeric' => 'Le :attribute doit être entre :min et :max.',
    ],
    'boolean' => 'Le champ de l\':attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation de :attribute ne correspond pas.',
    'current_password' => 'Le mot de passe est incorrect.',
    'date' => 'Le :attribute n\'est pas une date valide.',
    'date_equals' => 'Le :attribute doit être une date égale à :date.',
    'date_format' => 'Le :attribute ne correspond pas au format :format.',
    'declined' => 'Le :attribute est refusé.',
    'different' => 'Le :attribute et :other doivent être différent.',
    'digits' => 'Le :attribute doit être :digits chiffres.',
    'dimensions' => 'Le :attribute a des dimensions incorrectes.',
    'distinct' => 'Le champ de l\' :attribute a une valeur en doublon.',
    'email' => 'Le :attribute doit être une adresse mail valide.',
    'doesnt_start_with' => 'Le :attribute peut ne pas commencer par l\'un de ces :values.',
    'ends_with' => 'Le :attribute doit se terminer par l\'un de ces :values.',
    'exists' => 'Le :attribute sélectionné n\'est pas valide.',
    'file' => 'Le :attribute doit être un dossier.',
    'filled' => 'Le champ de l\':attribute doit contenir une valeur.',
    'gt' => [
        'array' => 'Le :attribute doit avoir plus de :value articles.',
        'numeric' => 'Le :attribute doit être supérieur à :value.',
        'string' => 'Le :attribute doit être supérieur à :value caractères.',
        'file' => 'Le :attribute doit être supérieur à :value kilobytes.',
    ],
    'gte' => [
        'array' => 'Le :attribute doit avoir :value articles ou plus.',
        'file' => 'Le :attribute doit être supérieur ou égal à :value kilobytes.',
        'numeric' => 'Le :attribute doit être supérieur ou égal à :value.',
        'string' => 'Le :attribute doit être plus supérieur ou égal à :value caractères.',
    ],
    'image' => 'Le :attribute doit être une image.',
    'in' => 'Le :attribute sélectionné n\'est pas valide.',
    'in_array' => 'Le champ de l\':attribute n\'existe pas dans :other.',
    'integer' => 'Le :attribute doit être un nombre entier.',
    'ip' => 'Le :attribute doit être une adresse IP valide.',
    'ipv6' => 'Le :attribute doit être une adresse IPv6 valide.',
    'json' => 'Le :attribute doit être une chaîne de JSON valide.',
    'lt' => [
        'array' => 'Le :attribute doit avoir moins de :value articles.',
        'string' => 'Le :attribute doit être moins de :value caractères.',
        'file' => 'Le :attribute doit être moins de :value kilobytes.',
        'numeric' => 'Le :attribute doit être moins de :value.',
    ],
    'declined_if' => 'Le :attribute est refusé quand :other est :value.',
    'enum' => 'Le :attribute sélectionné n\'est pas valide.',
    'digits_between' => 'Le :attribute doit être entre :min et :max chiffres.',
    'doesnt_end_with' => 'Le :attribute peut ne pas se terminer avec l\'un des ces :values.',
    'ipv4' => 'Le :attribute doit être une adresse IPv4 valide.',
    'lte' => [
        'array' => 'Le :attribute ne doit pas avoir plus de :value articles.',
        'string' => 'Le :attribute doit être inférieur ou égal à :value caractères.',
        'file' => 'Le :attribute doit être inférieur ou égal à :value kilobytes.',
        'numeric' => 'Le :attribute doit être inférieur ou égal à :value.',
    ],
    'mac_address' => 'Le :attribute doit être une adresse MAC valide.',
    'min' => [
        'string' => 'Le :attribute doit avoir au moins :min caractères.',
        'array' => 'Le :attribute doit avoir au moins :min articles.',
        'file' => 'Le :attribute doit avoir au moins :min kilobytes.',
        'numeric' => 'Le :attribute doit avoir au moins :min.',
    ],
    'max' => [
        'string' => 'Le :attribute ne pas être supérieur à :max caractères.',
        'array' => 'Le :attribute ne doit pas contenir plus de :max articles.',
        'file' => 'Le :attribute ne doit pas être supérieur à :max kilobytes.',
        'numeric' => 'Le :attribute ne pas être supérieur à :max.',
    ],
    'password' => [
        'letters' => 'Le :attribute doit contenir au moins une lettre.',
        'mixed' => 'Le :attribute doit au moins contenir une lettre majuscule et minuscule.',
        'numbers' => 'Le :attribute doit au moins contenir un chiffre.',
        'symbols' => 'Le :attribute doit contenir au moins un symbole.',
        'uncompromised' => 'L\':attribute concerné est apparu dans une fuite de données. Veuillez choisir un :attribute différent.',
    ],
    'mimes' => 'Le :attribute doit être un dossier de type :values.',
    'mimetypes' => 'Le :attribute doit être un dossier de type :values.',
    'multiple_of' => 'Le :attribute doit être un multiple de :value.',
    'not_in' => 'L\':attribute sélectionné est invalide.',
    'not_regex' => 'Le format de l\':attribute n\'est pas valide.',
    'numeric' => 'Le :attribute doit être un nombre.',
    'starts_with' => 'Le :attribute doit commencer avec l\'une des :values suivantes.',
    'required_array_keys' => 'Le champ de :attribute doit contenir les entrées pour :values.',
    'required_unless' => 'Le champ de le :attribute est requis à moins que :other est dans :values.',
    'required_without_all' => 'Le champ de l\':attribute est requis quand aucunes :values ne sont présentes.',
    'present' => 'Le champ de l\':attribute doit être présent.',
    'prohibited' => 'Le champ de l\':attribute est interdit.',
    'prohibited_if' => 'Le champ de l\':attribute est interdit quand :other est :value.',
    'prohibited_unless' => 'Le champ de le :attribute est interdit à moins que :other est dans :values.',
    'prohibits' => 'Le champ de l\':attribute interdit à :other d\'être présent.',
    'regex' => 'Le format de l\':attribute est invalide.',
    'required' => 'Le champ de l\':attribute est requis.',
    'required_if' => 'Le champ de l\':attribute est requis quand :other est :value.',
    'required_with' => 'Le champ de l\':attribute est requis quand :values est présent.',
    'required_with_all' => 'Le champ de l\':attribute est requis quand :values sont présentes.',
    'required_without' => 'Le champ de l\':attribute est requis quand :values n\'est pas présent.',
    'same' => 'Le :attribute et :other doivent correspondre.',
    'size' => [
        'array' => 'Le :attribute doit contenir :size articles.',
        'file' => 'Le :attribute doit être :size kilobytes.',
        'numeric' => 'Le :attribute doit être :size.',
        'string' => 'Le :attribute doit être :size caractères.',
    ],
    'string' => 'Le :attribute doit être une chaîne.',
    'timezone' => 'Le :attribute doit être un fuseau horaire valide.',
    'unique' => 'Le :attribute a déjà été pris.',
    'uploaded' => 'Le :attribute ne s\'est pas téléchargé.',
    'url' => 'Le :attribute doit être un URL valide.',
    'uuid' => 'Le :attribute doit être un UUID valide.',
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
            'rule-name' => 'message personnalisé',
        ],
    ],
];
