<?php

namespace RcmI18n\Factory;

use RcmI18n\Controller\Plugin\ParamTranslate;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ControllerPluginParamTranslatorFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $pluginServiceManager
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $pluginServiceManager)
    {
        $serviceLocator = $pluginServiceManager->getServiceLocator();

        $paramTranslator = $serviceLocator->get(
            'RcmI18n\Service\ParameterizeTranslator'
        );

        return new ParamTranslate($paramTranslator);
    }
}
