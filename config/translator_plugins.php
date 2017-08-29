<?php
/**
 * translator_plugins.php
 */
return [
    'factories' => [
        RcmI18n\RemoteLoader\RemoteLoader::class
        => \RcmI18n\RemoteLoader\DoctrineDbLoaderFactory::class,
    ]
];
