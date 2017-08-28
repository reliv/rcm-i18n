<?php

namespace RcmI18n\Factory;

use Psr\Container\ContainerInterface;
use RcmI18n\ViewHelper\ParamTranslate;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

class ViewHelperParamTranslatorFactory
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
