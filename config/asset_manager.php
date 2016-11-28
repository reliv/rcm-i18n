<?php
/**
 * asset_manager.php
 */
return [
    'resolver_configs' => [
        'aliases' => [
            'modules/rcm-i18n/' => __DIR__ . '/../public/',
        ],
        'collections' => [

            'modules/rcm/modules.js' => [
                'modules/rcm-i18n/rcm-i18n.js',
            ],
            'modules/rcm-admin/admin.js' => [
                'modules/rcm-i18n/admin/rcm-i18n-admin.js',
            ],
            'modules/rcm-admin/admin.css' => [
                'modules/rcm-i18n/admin/styles.css'
            ],
        ],
    ],
];
