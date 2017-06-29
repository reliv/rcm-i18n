<?php

namespace RcmI18n\Factory;

use Interop\Container\ContainerInterface;
use RcmI18n\ViewHelper\TranslateHtml;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

/**
 * TranslateHtmlFactory
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\Factory
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ViewHelperTranslateHtmlFactory
{
    /**
     * __invoke
     *
     * @param $container ContainerInterface|ServiceLocatorInterface|HelperPluginManager
     *
     * @return TranslateHtml
     */
    public function __invoke($container)
    {
        // @BC for ZendFramework
        if ($container instanceof HelperPluginManager) {
            $container = $container->getServiceLocator();
        }

        return new TranslateHtml(
            $container->get(
                'RcmHtmlPurifier'
            )
        );
    }
}
