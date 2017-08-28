<?php
/**
 * dependencies.php
 */
return [
    'factories' => [
        /* ZF2 over-ride */
        'MvcTranslator'
        => RcmI18n\Factory\TranslatorFactory::class,

        \RcmI18n\Api\Acl\IsAllowed::class
        => \RcmI18n\Api\Acl\IsAllowedRcmUserTranslationsFactory::class,

        /* This listener auto adds missing translations to the DB */
        RcmI18n\Event\MissingTranslationListener::class
        => RcmI18n\Factory\MissingTranslationListenerFactory::class,

        /* Locales default */
        RcmI18n\Model\Locales::class
        => RcmI18n\Factory\ModelRcmSiteLocalesFactory::class,

        /* RemoteLoader default */
        \RcmI18n\RemoteLoader\RemoteLoader::class
        => RcmI18n\Factory\RemoteLoaderDoctrineDbLoaderFactory::class,

        /* ParameterizeTranslator */
        RcmI18n\Service\ParameterizeTranslator::class
        => RcmI18n\Factory\ServiceParameterizeTranslatorFactory::class,

        /* ParameterizeHtmlTranslator */
        RcmI18n\Service\ParameterizeHtmlTranslator::class
        => RcmI18n\Factory\ServiceParameterizeHtmlTranslatorFactory::class
    ]
];
