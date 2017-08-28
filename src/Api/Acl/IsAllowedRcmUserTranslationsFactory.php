<?php

namespace RcmI18n\Api\Acl;

use Psr\Container\ContainerInterface;
use RcmUser\Service\RcmUserService;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class IsAllowedRcmUserTranslationsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return IsAllowedRcmUserTranslations
     */
    public function __invoke($serviceContainer)
    {
        return new IsAllowedRcmUserTranslations(
            $serviceContainer->get(RcmUserService::class)
        );
    }
}
