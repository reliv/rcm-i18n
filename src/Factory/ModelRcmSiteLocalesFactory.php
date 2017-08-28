<?php

namespace RcmI18n\Factory;

use Interop\Container\ContainerInterface;
use Rcm\Api\Repository\Site\FindActiveSites;
use RcmI18n\Model\Locales;
use RcmI18n\Model\RcmSiteLocales;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * ModelRcmSiteLocalesFactory
 *
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @link      https://github.com/reliv
 */
class ModelRcmSiteLocalesFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface|ServiceLocatorInterface $container
     *
     * @return Locales
     */
    public function __invoke($container)
    {
        return new RcmSiteLocales(
            $container->get(FindActiveSites::class)
        );
    }
}
