<?php

namespace RcmI18n\Factory;

use RcmI18n\RemoteLoader\DoctrineDbLoader;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * RemoteLoaderDoctrineDbLoaderFactory
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   src\RcmI18n
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RemoteLoaderDoctrineDbLoaderFactory implements FactoryInterface
{
    /**
     * createService
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return DoctrineDbLoader
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();

        return new DoctrineDbLoader(
            $serviceLocator->get(
                'Doctrine\ORM\EntityManager'
            )
        );
    }
}
