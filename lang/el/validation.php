<?php
return [
    'accepted_if' => 'Το :attribute Πρέπει να γίνει αποχοχή στο :other όταν :value είναι.',
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
    'accepted' => 'Το :attribute πρέπει να είναι αποδεκτό.',
    'active_url' => 'Το :attribute δεν είναι έγκυρο URL.',
    'after' => 'O :attribute πρέπει να είναι μία ημερομηνία μεταγενέστερη από :date.',
    'after_or_equal' => 'Το :attribute πρέπει να είναι μία ημερομηνία μεταγενέστερη ή ίση με :date.',
    'alpha' => 'Το :attribute πρέπει να περιέχει μόνο γράμματα.',
    'array' => 'To :attribute πρέπει να είναι ένας πίνακας.',
    'doesnt_end_with' => 'Το :attribute μπορεί να τελειώνει με ένα από τα παρακάτω: :values.',
    'filled' => 'Το :attribute πεδίο πρέπει να έχει μία αξία.',
    'gte' => [
        'numeric' => 'Το :attribute πρέπει αν είναι μεγαλύτερο ή ίσο με :value.',
        'array' => 'Το :attribute πρέπει να έχει :value αντικείμενα ή περισσότερα.',
        'file' => 'Το :attribute πρέπει να είναι μεγαλύτερο ή ίσο με :value kilobytes.',
        'string' => 'Το :attribute πρέπει να είναι μεγαλύτερο ή ίσο με :value χαρακτήρες.',
    ],
    'ends_with' => 'Το :attribute πρέπει να είναι μεταξύ των παρακάτω: :values.',
    'min' => [
        'string' => 'Το :attribute πρέπει να είναι τουλάχιστον :min χαρακτήρες.',
        'array' => 'Το :attribute πρέπει να έχει τουλάχιστον :min αντικείμενα.',
        'file' => 'Το :attribute πρέπει να είναι τουλάχιστον :min kilobytes.',
        'numeric' => 'Το :attribute πρέπει να είναι τουλάχιστον :min.',
    ],
    'date_format' => 'Η :attribute δεν ταιριάζει με την μορφή :format.',
    'digits' => 'To :attribute πρέπει να είναι :digits ψηφία.',
    'integer' => 'Το :attribute πρέπει να είναι ακέραιος αριθμός.',
    'password' => [
        'letters' => 'Το :attribute πρέπει να περιέχει τουλάχιστον ένα γράμμα.',
        'uncompromised' => 'Το δοθέν :attribute εμφανίζεται να έχει διαρροή δεδομένων. Παρακαλώ επιλέξτε ένα διαφορερικό :attribute.',
        'numbers' => 'Το :attribute πρέπει να περιέχει τουλάχιστον έναν αριθμό.',
        'mixed' => 'Το :attribute πρέπει να περιέχει τουλάχιστον ένα κεφαλαίο και ένα μικρό γράμμα.',
        'symbols' => 'Το :attribute πρέπει να περιέχει τουλάχιστον ένα σύμβολο.',
    ],
    'required_array_keys' => 'Το :attribute πεδίο πρέπει να περιέχει τιμές για: :values.',
    'required_without_all' => 'Το :attribute πεδίο είναι απαραίτητο όταν κανένα από τις :values δεν είναι παρούσες.',
    'ipv6' => 'To :attribute πρέπει να είναι έγκυρη διεύθυνση IPv6.',
    'lte' => [
        'array' => 'To :attribute πρέπει να είναι περισσότερα από :value αντικείμενα.',
        'file' => 'Το :attribute πρέπει να είναι λιγότερο ή ίσο με :value kilobytes.',
        'numeric' => 'Το :attribute πρέπει να είναι λιγότερο ή ίσο με :value .',
        'string' => 'Το :attribute πρέπει να είναι λιγότερο ή ίσο με :value χαρακτήρες.',
    ],
    'max' => [
        'numeric' => 'Το :attribute δεν πρέπει να είναι μεγαλύτερο από :max.',
        'string' => 'Το :attribute δεν πρέπει να είναι μεγαλύτερο από :max χαρακτήρες.',
        'array' => 'To :attribute δεν πρέπει να είναι πάνω από :max αντικείμενα.',
        'file' => 'To :attribute δεν πρέπει να είναι μεγαλύτερο από :max kilobytes.',
    ],
    'prohibited_unless' => 'Το :attribute πεδίο απαγορεύεται εκτός αν :other είναι σε :values.',
    'mac_address' => 'Το :attribute πρέπει να είναι έγκυρη διεύθυνση MAC.',
    'uploaded' => 'Το :attribute απέτυχε να ανέβει.',
    'required_with_all' => 'Το :attribute πεδίο είναι απαραίτητο όταν :values είναι παρόντες.',
    'starts_with' => 'Το :attribute πρέπει να αρχίζει με ένα από τα παρακάτω: :values.',
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
            'rule-name' => 'εξατομικευμένο μήνυμα',
        ],
    ],
    'doesnt_start_with' => 'Το :attribute μπορεί να ξεκινά με ένα από τα παρακάτω: :values.',
    'gt' => [
        'numeric' => 'To :attribute πρέπει να είναι μεγαλύτερο από :value .',
        'string' => 'Το :attribute πρέπει να έχει περισσότερους από :value χαρακτήρες.',
        'array' => 'Το :attribute πρέπει να έχει περισσότερα από :value αντικείμενα.',
        'file' => 'Το :attribute πρέπει να είναι μεγαλύτερο από :value kilobytes.',
    ],
    'lt' => [
        'file' => 'Το :attribute πρέπει να είναι λιγότερο από :value kilobytes.',
        'array' => 'To :attribute:attribute πρέπει να είναι λιγότερο από :value αντικείμενα.',
        'string' => 'Το :attribute πρέπει να είναι λιγότερο από :value χαρακτήρες.',
        'numeric' => 'Το :attribute πρέπει αν είναι λιγότερο από :value.',
    ],
    'before' => 'Το :attribute πρέπει να είναι ημερομηνία πριν από :date.',
    'alpha_dash' => 'Το :attribute πρέπει να περιέχει μόνο γράμματα, αριθμούς, παύλες και κάτω παύλες.',
    'current_password' => 'Ο κωδικός είναι λανθασμένος.',
    'between' => [
        'numeric' => 'Το :attribute πρέπει να είναι μεταξύ :min και :max.',
        'string' => 'Το :attribute πρέπει να είναι μεταξύ :min και :max χαρακτήρες.',
        'file' => 'Το :attribute πρέπει να είναι μεταξύ :min και :max kilobytes.',
        'array' => 'Το :attribute πρέπει να είναι μεταξύ :min και :max στοιχείων.',
    ],
    'confirmed' => 'Η επιβεβαίωση του :attribute δεν ταιριάζει.',
    'declined' => 'Η :attribute πρέπει να απορριφθεί.',
    'declined_if' => 'Η :attribute πρέπει να απορριφθεί όταν :other είναι :value.',
    'different' => 'Η :attribute και :other πρέπει να είναι διαφορετικά.',
    'digits_between' => 'Το :attribute πρέπει να είναι ψηφία μεταξύ :min και :max.',
    'dimensions' => 'Το :attribute έχει μη έγκυρες διαστάσεις εικόνας.',
    'distinct' => 'Το :attribute πεδίο έχει ένα αντίγραφο.',
    'enum' => 'Η επιλεγόμενη :attribute είναι μη έγκυρη.',
    'exists' => 'Η επιλεγόμενη :attribute είναι μη έγκυρη.',
    'file' => 'Το επιλεγόμενο :attribute πρέπει να είναι αρχείο.',
    'date_equals' => 'Η :attribute πρέπει να είναι ημερομηνία ίση με :date.',
    'alpha_num' => 'Το :attribute πρέπει να περιέχει μόνο γράμματα και αριθμούς.',
    'boolean' => 'Το :attribute πεδίο πρέπει να είναι σωστό ή λάθος.',
    'date' => 'Η :attribute δεν είναι έγκυρη ημερομηνία.',
    'email' => 'Το :attribute πρέπει να είναι έγκυρη διεύθυνση email.',
    'before_or_equal' => 'Το :attribute πρέπει να είναι ημερομηνία προγενέστερη ή ίση από :date.',
    'image' => 'Το :attribute πρέπει να είναι εικόνα.',
    'in' => 'Το επιλεγμένο :attribute είναι μη έγκυρο.',
    'in_array' => 'Το :attribute πεδίο δεν υπάρχει στο :other.',
    'ip' => 'Το :attribute πρέπει να είναι έγκυρη διεύθυνση IP.',
    'ipv4' => 'To :attribute πρέπει να είναι έγκυρη διεύθυνση IPv4.',
    'json' => 'Το :attribute πρέπει να είναι έγκυρη JSON σειρά.',
    'mimes' => 'Το :attribute πρέπει να είναι αρχείο τύπου: :values.',
    'mimetypes' => 'Το :attribute πρέπει να είναι αρχείο τύπου: :values.',
    'multiple_of' => 'Το :attribute πρέπει να είναι πολλαπλάσιο του :value.',
    'not_in' => 'Το επιλεγόμενο :attribute δεν είναι έγκυρο.',
    'not_regex' => 'Η :attribute μορφή δεν είναι έγκυρη.',
    'numeric' => 'Το :attribute πρέπει να είναι αριθμός.',
    'present' => 'Το πεδίο :attribute πρέπει να είναι παρόν.',
    'prohibited' => 'Το :attribute πεδίο απαγορεύεται.',
    'prohibits' => 'Το :attribute πεδίο απαγορεύει :other από το να είναι παρόντες.',
    'regex' => 'Η μορφή του :attribute δεν είναι έγκυρη.',
    'string' => 'Το :attribute πρέπει να είναι μία σειρά.',
    'unique' => 'Το :attribute χρησιμοποιείται ήδη.',
    'prohibited_if' => 'Το :attribute πεδίο απαγορεύεται όταν :other είναι :value.',
    'required_if' => 'Το :attribute πεδίο είναι απαραίτητο όταν :other είναι :value.',
    'required_unless' => 'Το :attribute πεδίο είναι απαραίτητο εκτός αν :other είναι σε :values.',
    'required_with' => 'Το :attribute πεδίο είναι απαραίτητο όταν :values είναι παρόν.',
    'required_without' => 'Το :attribute πεδίο είναι απαραίτητο όταν :values δεν είναι παρόν.',
    'same' => 'Τα πεδία :attribute και :other πρέπει να ταιριάζουν.',
    'size' => [
        'array' => 'Το :attribute πρέπει να περιέχει :size αντικείμενα.',
        'file' => 'Το :attribute πρέπει να είναι :size kilobytes.',
        'numeric' => 'Το :attribute πρέπει να είναι :size.',
        'string' => 'Το :attribute πρέπει να είναι :size χαρακτήρες.',
    ],
    'timezone' => 'Το :attribute πρέπει να είναι έγκυρη ζώνη ώρας.',
    'required' => 'Το πεδίο :attribute είναι απαραίτητο.',
    'url' => 'Το :attribute πρέπει να είναι ένα έγκυρο URL.',
    'uuid' => 'To :attribute πρέπει να είναι ένα έγκυρο UUID.',
];
