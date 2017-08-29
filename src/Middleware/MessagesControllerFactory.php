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
class MessagesControllerFactory
{
    /**
     * __invoke
     *
     * @param $serviceContainer ContainerInterface
     *
     * @return MessagesController
     */
    public function __invoke($serviceContainer)
    {
        return new MessagesController(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
