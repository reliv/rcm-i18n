<?php

namespace RcmI18n\Factory;

use Psr\Container\ContainerInterface;
use RcmI18n\Controller\Plugin\ParamTranslate;
use Zend\Mvc\Controller\PluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class ControllerPluginParamTranslatorFactory
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
