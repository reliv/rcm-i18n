<?php

namespace RcmI18n\Api\Acl;

use Psr\Http\Message\ServerRequestInterface;
use RcmUser\Service\RcmUserService;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class IsAllowedRcmUserTranslations implements IsAllowed
{
    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return bool
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    ): bool {
        $privilege = (array_key_exists('privilege', $options) ? $options['privilege'] : 'read');

        return false; //This was disabled durring the ACL2 project because it doesn't follow new rules.
    }
}
