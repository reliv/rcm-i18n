<?php

namespace RcmI18n\Factory;

use Interop\Container\ContainerInterface;
use RcmI18n\Model\Locales;
use RcmI18n\Model\RcmSiteLocales;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * ModelRcmSiteLocalesFactory
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
class ModelRcmSiteLocalesFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface|ServiceLocatorInterface $container
     *
     * @return Locales
     */
    public function __invoke($container)
    {
        return new RcmSiteLocales(
            $container->get('Doctrine\ORM\EntityManager')->getRepository(\Rcm\Entity\Site::class)
        );
    }
}
