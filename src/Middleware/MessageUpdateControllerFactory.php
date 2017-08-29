<?php

namespace RcmI18n\Middleware;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use RcmHtmlPurifier\Api\Purify;
use RcmI18n\Api\Acl\IsAllowed;
use RcmI18n\Model\Locales;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class MessageUpdateControllerFactory
{
    /**
     * __invoke
     *
     * @param $serviceContainer ContainerInterface
     *
     * @return MessageUpdateController
     */
    public function __invoke($serviceContainer)
    {
        return new MessageUpdateController(
            $serviceContainer->get(IsAllowed::class),
            $serviceContainer->get(Purify::class),
            $serviceContainer->get(EntityManager::class),
            $serviceContainer->get(Locales::class)
        );
    }
}
