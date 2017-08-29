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
    /**
     * asset_manager
     */
    'asset_manager' => require(__DIR__ . '/asset_manager.php'),
    /**
     * controllers
     */
    'controllers' => [
        'invokables' => [
            'RcmI18n\Controller\Locale'
            => \RcmI18n\Controller\LocaleController::class,

            'RcmI18n\Controller\Messages'
            => \RcmI18n\Controller\MessagesController::class,

            'RcmI18n\Controller\SiteTranslationsJs'
            => \RcmI18n\Controller\SiteTranslationsJsController::class,

            'RcmI18n\Controller\ApiTranslateController'
            => \RcmI18n\Controller\ApiTranslateController::class,
        ]
    ],
    /**
     * controller_plugins
     */
    'controller_plugins' => [
        'factories' => [
            'paramTranslate'
            => \RcmI18n\Controller\Plugin\ParamTranslatorFactory::class,
        ],
    ],
    /**
     * doctrine
     */
    'doctrine' => require(__DIR__ . '/doctrine.php'),
    /**
     * RcmI18n
     */
    'RcmI18n' => require(__DIR__ . '/rcm-i18n.php'),
    /**
     * Rcm
     */
    'Rcm' => require(__DIR__ . '/rcm.php'),
    /**
     * RcmUser
     */
    'RcmUser' => require(__DIR__ . '/rcm-user.php'),
    /**
     * navigation
     */
    'navigation' => require(__DIR__ . '/navigation.php'),
    /**
     * router
     */
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
     * service_manager
     */
    'service_manager' => require(__DIR__ . '/dependencies.php'),
    /**
     * translator
     */
    'translator' => require(__DIR__ . '/translator.php'),
    /**
     * translator_plugins
     */
    'translator_plugins' => require(__DIR__ . '/translator_plugins.php'),
    /**
     * view_helpers
     */
    'view_helpers' => [
        'factories' => [
            'translate'
            => \RcmI18n\ViewHelper\TranslateHtmlFactory::class,

            'paramTranslate'
            => \RcmI18n\ViewHelper\ParamTranslatorFactory::class,
        ]
    ],
    /**
     * view_manager
     */
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
