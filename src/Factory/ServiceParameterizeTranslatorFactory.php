<?php

namespace RcmI18n\Factory;

use Psr\Container\ContainerInterface;
use RcmI18n\Service\ParameterizeTranslator;

class ServiceParameterizeTranslatorFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $container
     *
     * @return mixed
     */
    public function __invoke($container)
    {
        $translator = $container->get('MvcTranslator');

        return new ParameterizeTranslator($translator);
    }
}
