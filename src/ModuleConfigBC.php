<?php

namespace RcmI18n;

/**
 * Class ModuleConfigBc
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ModuleConfigBc
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
             * @bc ZF2 ONLY
             * controller_plugins
             */
            'controller_plugins' => require(__DIR__ . '/../config/controller_plugins.php'),
            /**
             * @bc ZF2 ONLY
             * translator
             */
            'translator' => require(__DIR__ . '/../config/translator.php'),
            /**
             * @bc ZF2 ONLY
             * translator_plugins
             */
            'translator_plugins' => require(__DIR__ . '/../config/translator_plugins.php'),
            /**
             * @bc ZF2 ONLY
             * view_helpers
             */
            'view_helpers' => require(__DIR__ . '/../config/view_helpers.php'),
        ];
    }
}
