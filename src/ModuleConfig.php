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
        ];
    }
}
