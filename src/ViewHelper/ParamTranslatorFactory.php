<?php

namespace RcmI18n\ViewHelper;

use Psr\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

class ParamTranslatorFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface|HelperPluginManager
     *
     * @return ParamTranslate
     */
    public function __invoke($container)
    {
        // @BC for ZendFramework
        if ($container instanceof HelperPluginManager) {
            $container = $container->getServiceLocator();
        }

        $paramTranslator = $container->get(
            \RcmI18n\Service\ParameterizeTranslator::class
        );

        return new ParamTranslate($paramTranslator);
    }
}
