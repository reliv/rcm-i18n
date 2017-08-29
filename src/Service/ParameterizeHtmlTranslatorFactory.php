<?php

namespace RcmI18n\Service;

use Psr\Container\ContainerInterface;

class ParameterizeHtmlTranslatorFactory
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
