<?php

namespace RcmI18n;

/**
 * Class ModuleConfig
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ModuleConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            /**
             * asset_manager
             */
            'asset_manager' => require(__DIR__ . '/../config/asset_manager.php'),
            /**
             * dependencies
             */
            'dependencies' => require(__DIR__ . '/../config/dependencies.php'),
            /**
             * @bc ONLY
             * controller_plugins
             */
            'controller_plugins' => require(__DIR__ . '/../config/controller_plugins.php'),
            /**
             * doctrine
             */
            'doctrine' => require(__DIR__ . '/../config/doctrine.php'),
            /**
             * RcmI18n
             */
            'RcmI18n' => require(__DIR__ . '/../config/rcm-i18n.php'),
            /**
             * Rcm
             */
            'Rcm' => require(__DIR__ . '/../config/rcm.php'),
            /**
             * RcmUser
             */
            'RcmUser' => require(__DIR__ . '/../config/rcm-user.php'),
            /**
             * Expressive routes
             */
            'routes' => require(__DIR__ . '/../config/routes.php'),
            /**
             * navigation
             */
            'navigation' => require(__DIR__ . '/../config/navigation.php'),
            /**
             * @bc ONLY
             * translator
             */
            'translator' => require(__DIR__ . '/../config/translator.php'),
            /**
             * @bc ONLY
             * translator_plugins
             */
            'translator_plugins' => require(__DIR__ . '/../config/translator_plugins.php'),
            /**
             * @bc ONLY
             * view_helpers
             */
            'view_helpers' => require(__DIR__ . '/../config/view_helpers.php'),
        ];
    }
}
