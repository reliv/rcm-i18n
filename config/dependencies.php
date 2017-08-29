<?php
/**
 * dependencies.php
 */
return [
    'factories' => [
        /* ZF2 over-ride */
        'MvcTranslator'
        => \RcmI18n\Service\MvcTranslatorFactory::class,

        \RcmI18n\Api\Acl\IsAllowed::class
        => \RcmI18n\Api\Acl\IsAllowedRcmUserTranslationsFactory::class,

        /* This listener auto adds missing translations to the DB */
        RcmI18n\Event\MissingTranslationListener::class
        => \RcmI18n\Event\MissingTranslationListenerFactory::class,

        \RcmI18n\Middleware\ApiTranslateController::class
        => \RcmI18n\Middleware\ApiTranslateControllerFactory::class,

        \RcmI18n\Middleware\AssetController::class
        => \RcmI18n\Middleware\AssetControllerFactory::class,

        \RcmI18n\Middleware\LocaleController::class
        => \RcmI18n\Middleware\LocaleControllerFactory::class,

        \RcmI18n\Middleware\MessagesController::class
        => \RcmI18n\Middleware\MessagesControllerFactory::class,

        \RcmI18n\Middleware\MessageUpdateController::class
        => \RcmI18n\Middleware\MessageUpdateControllerFactory::class,

        \RcmI18n\Middleware\SiteTranslationsJsController::class
        => \RcmI18n\Middleware\SiteTranslationsJsControllerFactory::class,

        /* Locales default */
        RcmI18n\Model\Locales::class
        => \RcmI18n\Model\RcmSiteLocalesFactory::class,

        /* RemoteLoader default */
        \RcmI18n\RemoteLoader\RemoteLoader::class
        => \RcmI18n\RemoteLoader\DoctrineDbLoaderFactory::class,

        /* ParameterizeTranslator */
        RcmI18n\Service\ParameterizeTranslator::class
        => \RcmI18n\Service\ParameterizeTranslatorFactory::class,

        /* ParameterizeHtmlTranslator */
        RcmI18n\Service\ParameterizeHtmlTranslator::class
        => \RcmI18n\Service\ParameterizeHtmlTranslatorFactory::class
    ]
];
