<?php

namespace RcmI18nTest\RemoteLoader;

use RcmI18n\Factory\RemoteLoaderDoctrineDbLoaderFactory;
use Zend\I18n\Translator\LoaderPluginManager;
use Zend\ServiceManager\ServiceManager;

require __DIR__ . '/../../autoload.php';

class RemoteLoaderDoctrineDbLoaderFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \RcmI18n\Factory\RemoteLoaderDoctrineDbLoaderFactory
     */
    function testCreateService()
    {
        $sm = new ServiceManager();
        $sm->setService(
            'Doctrine\ORM\EntityManager',
            $this->getMockBuilder('Doctrine\ORM\EntityManager')
                ->disableOriginalConstructor()
                ->getMock()
        );
        $loadPluginMgr = new LoaderPluginManager();
        $loadPluginMgr->setServiceLocator($sm);
        $unit = new RemoteLoaderDoctrineDbLoaderFactory();
        $this->assertInstanceOf(
            'RcmI18n\RemoteLoader\DoctrineDbLoader',
            $unit->createService($loadPluginMgr)
        );
    }
}
