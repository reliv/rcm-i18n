<?php
/**
 * routes.php
 */
return [
    'modules.rcm-i18n.asset' => [
        'name' => 'modules.rcm-i18n.asset',
        'path' => '/modules/rcm-i18n/{fileName:.*}',
        'middleware' => \RcmI18n\Middleware\AssetController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
];
