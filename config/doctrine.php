<?php
/**
 * doctrine.php
 */
return [
    'connection' => [
        'orm_default' => [
            'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
            'params' => [
                'charset' => 'UTF8'
            ],
        ]
    ],
    'driver' => [
        'RcmI18n' => [
            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
            'cache' => 'array',
            'paths' => [
                __DIR__ . '/../src/Entity'
            ]
        ],
        'orm_default' => [
            'drivers' => [
                'RcmI18n' => 'RcmI18n'
            ]
        ]
        /**
         * NOTE: SOME KIND OF DOCTRINE UTF8 SETTING IS REQUIRED HERE OR
         * FRENCH CHARACTERS WILL NOT DISPLAY CORRECTLY IN BROWSERS
         */
    ],
];
