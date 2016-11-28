<?php
/**
 * rcm-user.php
 */
return [
    'Acl\Config' => [
        'ResourceProviders' => [
            'RcmI18nTranslations' => [
                'translations' => [
                    'resourceId' => 'translations',
                    'parentResourceId' => null,
                    'privileges' => [
                        'read',
                        'update',
                        'create',
                        'delete',
                    ],
                    'name' => 'Translations',
                    'description' => 'Creating translations for other countries',
                ]
            ]
        ]
    ]
];
