<?php
return [
    403 => [
        'title' => 'Interdit',
        'message' => 'Vous ne pouvez pas accéder à cette page.',
    ],
    404 => [
        'title' => 'Non trouvé',
        'message' => 'La page recherchée n\'a pas pu être trouvé.',
    ],
    401 => [
        'message' => 'Vous n\'êtes pas autorisé pour accéder à cette page.',
        'title' => 'non autorisé',
    ],
    419 => [
        'message' => 'Votre session a expiré, merci de rafraîchir la page et essayer à nouveau.',
        'title' => 'Session expirée',
    ],
    429 => [
        'title' => 'Trop de demandes',
        'message' => 'Vos demandes n\'ont pas aboutis en raison de la quantité.',
    ],
    500 => [
        'title' => 'Erreur de serveur interne',
        'message' => 'Oups, une erreur s\'est produite sur nos serveurs.',
    ],
    503 => [
        'title' => 'Service indisponible',
        'message' => 'Une maintenance est en cours, merci d\'essayer ultérieurement.',
    ],
];
