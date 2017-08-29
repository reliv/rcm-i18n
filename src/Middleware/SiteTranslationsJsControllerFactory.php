<?php

namespace RcmI18n\Middleware;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Rcm\Service\CurrentSite;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class SiteTranslationsJsControllerFactory
{
    /**
     * __invoke
     *
     * @param $serviceContainer ContainerInterface
     *
     * @return SiteTranslationsJsController
     */
    public function __invoke($serviceContainer)
    {
        return new SiteTranslationsJsController(
            $serviceContainer->get(EntityManager::class),
            $serviceContainer->get(CurrentSite::class)
        );
    }
}
