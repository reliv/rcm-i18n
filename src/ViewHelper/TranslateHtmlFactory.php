<?php

namespace RcmI18n\ViewHelper;

use Psr\Container\ContainerInterface;
use RcmHtmlPurifier\Api\Purify;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\HelperPluginManager;

/**
 * TranslateHtmlFactory
 *
 * @category  Reliv
 * @package   RcmI18n\Factory
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class TranslateHtmlFactory
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
                Purify::class
            )
        );
    }
}
