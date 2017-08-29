<?php

namespace RcmI18n\Middleware;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ApiTranslateControllerFactory
{
    /**
     * __invoke
     *
     * @param $serviceContainer ContainerInterface
     *
     * @return ApiTranslateController
     */
    public function __invoke($serviceContainer)
    {
        return new ApiTranslateController(
            $serviceContainer->get('MvcTranslator')
        );
    }
}
