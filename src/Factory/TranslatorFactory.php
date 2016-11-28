<?php

namespace RcmI18n\Factory;

use Interop\Container\ContainerInterface;
use Zend\I18n\Translator\Translator;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * MvcTranslatorFactory
 *
 * LongDescHere
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
class TranslatorFactory
{
    /**
     * __invoke
     *
     * @param ContainerInterface|ServiceLocatorInterface $container
     *
     * @return \Zend\Mvc\I18n\Translator
     */
    public function __invoke($container)
    {
        $config = $container->get('config');
        $translator = Translator::factory($config['translator']);

        /**
         * Work-around for the translator loader plugin manager not having a config
         * key that it looks for.
         */
        foreach ($config['translator_plugins']['factories'] as $name => &$factory) {
            $pluginManager = $translator->getPluginManager();
            $pluginManager->setServiceLocator($container);
            $pluginManager->setFactory(
                $name,
                $factory
            );
        }
        $translator->setLocale(\Locale::getDefault());

        /* Register listener if configured */
        $translationListener = $config['RcmI18n']['translationListener'];

        if (!empty($translationListener) && $container->has($translationListener)) {
            $listener = $container->get(
                $translationListener
            );
            $event = $translator->getEventManager();
            $listener->attach($event);
        }

        return new \Zend\Mvc\I18n\Translator($translator);
    }
}
