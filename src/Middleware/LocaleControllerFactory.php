<?php

namespace RcmI18n\Middleware;

use Psr\Container\ContainerInterface;
use Rcm\Service\CurrentSite;
use RcmI18n\Model\Locales;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class LocaleControllerFactory
{
    /**
     * __invoke
     *
     * @param $serviceContainer ContainerInterface
     *
     * @return LocaleController
     */
    public function __invoke($serviceContainer)
    {
        return new LocaleController(
            $serviceContainer->get(Locales::class),
            $serviceContainer->get(CurrentSite::class)
        );
    }
}
