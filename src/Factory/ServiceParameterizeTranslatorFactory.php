<?php

namespace RcmI18n\FactoryFactory;

use RcmI18n\Service\ParameterizeTranslator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ParameterizeTranslatorFactory implements FactoryInterface
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
        $translator = $this->serviceLocator->get('MvcTranslator');

        return new ParameterizeTranslator($translator);
    }
}
