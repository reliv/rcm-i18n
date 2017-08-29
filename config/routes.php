<?php
/**
 * Expressive
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

    'rcmi18n.locales' => [
        'name' => 'rcmi18n.locales',
        'path' => '/rcmi18n/locales',
        'middleware' => \RcmI18n\Middleware\LocaleController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],

    'rcmi18n.messages.locale' => [
        'name' => 'rcmi18n.messages.locale',
        'path' => '/rcmi18n/messages/{rcmi18n-locale}',
        'middleware' => \RcmI18n\Middleware\MessagesController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],

    'rcmi18n.messages.locale.id' => [
        'name' => 'rcmi18n.messages.locale.id',
        'path' => '/rcmi18n/messages/{rcmi18n-locale}/{rcmi18n-message-id}',
        'middleware' => \RcmI18n\Middleware\MessageUpdateController::class,
        'options' => [],
        'allowed_methods' => ['PUT'],
    ],

    'rcmi18n.translations-js' => [
        'name' => 'rcmi18n.translations-js',
        'path' => '/rcmi18n/translations.js',
        'middleware' => \RcmI18n\Middleware\SiteTranslationsJsController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],

    'api.rcm-translate-api.namespace' => [
        'name' => 'api.rcm-translate-api.namespace',
        'path' => '/api/rcm-translate-api[/{rcmi18n-namespace}]',
        'middleware' => \RcmI18n\Middleware\ApiTranslateController::class,
        'options' => [],
        'allowed_methods' => ['GET'],
    ],
];
