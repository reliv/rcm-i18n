<?php

namespace RcmI18n\Factory;

use Psr\Container\ContainerInterface;
use RcmI18n\Service\ParameterizeHtmlTranslator;

class ServiceParameterizeHtmlTranslatorFactory
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
        $htmlPurifier = $container->get('RcmHtmlPurifier');

        return new ParameterizeHtmlTranslator($translator, $htmlPurifier);
    }
}
