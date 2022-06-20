<?php
declare(strict_types=1);

return [
    'configurazione_app' => [
        'telefono_info' => '051-123456789',
    ],

    'nome_app' => 'App Partenza',

    'telefono_info' => '000-1234-56-789',

    'mail' => [
        'smtp' => 'smtp.cup2000.it',
        'porta' => 25,
        'from' => 'noreply@lepida.it',
        'mittente' => 'Partenza [ANDREA]',
        'pathTemplate' => $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'mailTemplate'.DIRECTORY_SEPARATOR,
        'destinatari' => [
            1 => [
                'andreacarlo.toniolo@lepida.it', 'actoniolo@gmail.com'
            ],
            2 => [
                'andreacarlo.toniolo@lepida.it'
            ],
            3 => [
                'andreacarlo.toniolo@lepida.it'
            ]
        ]
    ],

    'sentry' => [
        'dsn' => 'https://dde1352b3f5c485283242127e4c2f295@sentrydev.lepida.it/52',
        //        'dsn' => 'http://619e6da8c4bb4fbe98b885b932ee6736@htdevsen01vm.ad.lepida.it:9000/45',
//        'dsn' => 'http://619e6da8c4bb4fbe98b885b932ee6736@dentrydev.lepida.it:9000/45',
        'environment' => 'andrea',
        'release' => '0.0.1',
    ],
];
