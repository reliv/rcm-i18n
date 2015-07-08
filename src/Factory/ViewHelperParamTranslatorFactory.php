<?php

namespace RcmI18n\FactoryFactory;

use RcmI18n\ViewHelper\ParamTranslate;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewHelperParamTranslatorFactory implements FactoryInterface
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
        $paramTranslator = $this->serviceLocator->get(
            'RcmI18n\Service\ParameterizeTranslator'
        );

        return new ParamTranslate($paramTranslator);
    }
}
