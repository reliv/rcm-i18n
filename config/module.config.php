<?php

/**
 * ZF2 Plugin Config file
 *
 * This file contains all the configuration for the Module as defined by ZF2.
 * See the docs for ZF2 for more information.
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @author    Westin Shafer <wshafer@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */

return [

    'RcmI18n' => [
        'defaultLocale' => 'en_US',
        /* register a translation listener or null if no listener required
            Example: 'translationListener' => 'RcmI18n\Event\MissingTranslationListener'
        */
        'translationListener' => null,
    ],
    'Rcm' => [
        'HtmlIncludes' => [
            'scripts' => [
                'libraries' => [
                    '/bower_components/angular-translate/angular-translate.min.js' => [],
                ],
            ],
            'headScriptFile' => [
                /**
                 * Must not be in combined scripts because this is
                 * a php generated list of translations
                 */
                '/rcmi18n/translations.js' => [],
            ],
        ],
    ],
    'RcmUser' => [
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
    ],
    'navigation' => [
        'RcmAdminMenu' => [
            'Site' => [
                'pages' => [
                    'Translations' => [
                        'label' => 'Translations',
                        'class' => 'rcmAdminMenu RcmBlankDialog Translations',
                        'uri' => '/modules/rcm-i18n/admin/message-editor.html',
                        'title' => 'Translations',
                    ]
                ]
            ],
        ]
    ],
    'translator' => [
        'locale' => 'en_US',
        'event_manager_enabled' => true,
        'remote_translation' => [
            [
                'type' => 'RcmI18n\DbLoader',
            ],
        ],
    ],
    /**
     * Can be removed after ZF2 PR
     */
    'service_manager' => [
        'factories' => [
            'MvcTranslator' =>
                'RcmI18n\Factory\TranslatorFactory',
            'RcmI18n\Model\Locales' =>
                'RcmI18n\Factory\LocalesFactory',
            /* This listener auto adds missing translations to the DB */
            'RcmI18n\Event\MissingTranslationListener' =>
                'RcmI18n\Factory\MissingTranslationListenerFactory',
            'RcmI18n\Service\ParameterizeTranslator' =>
                'RcmI18n\Factory\ServiceParameterizeTranslatorFactory',
        ]
    ],
    'translator_plugins' => [
        'factories' => [
            'RcmI18n\DbLoader' => 'RcmI18n\Factory\LoaderFactory',
        ]
    ],
    'doctrine' => [
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
    ],
    'controllers' => [
        'invokables' => [
            'RcmI18n\Controller\Locale' =>
                'RcmI18n\Controller\LocaleController',
            'RcmI18n\Controller\Messages' =>
                'RcmI18n\Controller\MessagesController',
            'RcmI18n\Controller\SiteTranslationsJs' =>
                'RcmI18n\Controller\SiteTranslationsJsController',
            'RcmI18n\Controller\ApiTranslateController' =>
                'RcmI18n\Controller\ApiTranslateController',

        ]
    ],
    'controller_plugins' => [
        'factories' => [
            'paramTranslate' => 'RcmI18n\Factory\ControllerPluginParamTranslatorFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'RcmI18n\Locale' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/rcmi18n/locales',
                    'defaults' => [
                        'controller' => 'RcmI18n\Controller\Locale',
                    ],
                ],
            ],
            'RcmI18n\Messages' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/rcmi18n/messages/:locale[/:id]',
                    'defaults' => [
                        'controller' => 'RcmI18n\Controller\Messages',
                    ],
                ],
            ],
            'RcmI18n\SiteTranslationsJs' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/rcmi18n/translations.js',
                    'defaults' => [
                        'controller' => 'RcmI18n\Controller\SiteTranslationsJs',
                    ],
                ],
            ],
            'RcmI18n\ApiTranslate' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route' => '/api/rcm-translate-api[/:namespace]',
                    'defaults' => [
                        'controller' => 'RcmI18n\Controller\ApiTranslateController',
                        'namespace' => 'default',
                    ],
                ],
            ],
        ]
    ],
    'view_helpers' => [
        'factories' => [
            'translate' => 'RcmI18n\Factory\TranslateHtmlFactory',
            'paramTranslate' => 'RcmI18n\Factory\ViewHelperParamTranslatorFactory',
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'asset_manager' => [
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
    ],
];
