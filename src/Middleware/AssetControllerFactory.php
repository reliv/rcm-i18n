<?php

namespace RcmI18n\Middleware;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class AssetControllerFactory
{
    /**
     * __invoke
     *
     * @param $serviceContainer ContainerInterface
     *
     * @return AssetController
     */
    public function __invoke($serviceContainer)
    {
        return new AssetController();
    }
}
