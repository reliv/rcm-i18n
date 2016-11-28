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
    'asset_manager' => require(__DIR__ . '/asset_manager.php'),
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
    'doctrine' => require(__DIR__ . '/doctrine.php'),
    'RcmI18n' => require(__DIR__ . '/rcm-i18n.php'),
    'Rcm' => require(__DIR__ . '/rcm.php'),
    'RcmUser' => require(__DIR__ . '/rcm-user.php'),
    'navigation' => require(__DIR__ . '/navigation.php'),
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
    'translator' => [
        'locale' => 'en_US',
        'event_manager_enabled' => true,
        'remote_translation' => [
            [
                'type' => 'RcmI18n\DbLoader',
            ],
        ],
    ],
    'translator_plugins' => [
        'factories' => [
            'RcmI18n\DbLoader' => 'RcmI18n\Factory\LoaderFactory',
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
];
