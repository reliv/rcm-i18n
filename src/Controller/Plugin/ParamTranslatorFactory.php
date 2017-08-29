<?php

namespace RcmI18n\Controller\Plugin;

use Psr\Container\ContainerInterface;
use Zend\Mvc\Controller\PluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class ParamTranslatorFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface|PluginManager
     *
     * @return ParamTranslate
     */
    public function __invoke($container)
    {
        // @BC for ZendFramework
        if ($container instanceof PluginManager) {
            $container = $container->getServiceLocator();
        }

        $paramTranslator = $container->get(
            \RcmI18n\Service\ParameterizeTranslator::class
        );

        return new ParamTranslate($paramTranslator);
    }
}
