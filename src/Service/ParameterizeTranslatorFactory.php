<?php

namespace RcmI18n\Service;

use Psr\Container\ContainerInterface;

class ParameterizeTranslatorFactory
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
