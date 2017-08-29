<?php

namespace RcmI18n\RemoteLoader;

use Psr\Container\ContainerInterface;
use Zend\I18n\Translator\LoaderPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @category  Reliv
 * @package   src\RcmI18n
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class DoctrineDbLoaderFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface|LoaderPluginManager
     *
     * @return DoctrineDbLoader
     */
    public function __invoke($container)
    {
        ddd(get_class($container));
        // @BC for ZendFramework
        if ($container instanceof LoaderPluginManager) {
            $container = $container->getServiceLocator();
        }

        return new DoctrineDbLoader(
            $container->get(
                'Doctrine\ORM\EntityManager'
            )
        );
    }
}
