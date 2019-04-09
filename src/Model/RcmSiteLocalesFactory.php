<?php

namespace RcmI18n\Model;

use Psr\Container\ContainerInterface;
use Rcm\Api\Repository\Site\FindActiveSites;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2017 Reliv International
 * @license   License.txt New BSD License
 * @link      https://github.com/reliv
 */
class RcmSiteLocalesFactory
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
