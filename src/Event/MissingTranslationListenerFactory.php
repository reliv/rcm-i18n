<?php

namespace RcmI18n\Event;

use Psr\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class MissingTranslationListenerFactory
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\Factory
 * @author    James Jervis <jjervis@relivinc.com>
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class MissingTranslationListenerFactory
{
    /**
     * createService
     *
     * @param ContainerInterface|ServiceLocatorInterface $container
     *
     * @return MissingTranslationListener
     */
    public function __invoke($container)
    {
        $config = $container->get('config');
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $container->get('Doctrine\ORM\EntityManager');

        return new MissingTranslationListener($config, $entityManager);
    }
}
