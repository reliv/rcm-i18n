<?php

namespace RcmI18n\Factory;

use RcmI18n\Service\ParameterizeTranslator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServiceParameterizeTranslatorFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $translator = $serviceLocator->get('MvcTranslator');

        return new ParameterizeTranslator($translator);
    }
}
