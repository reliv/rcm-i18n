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
     * @var RcmUserService
     */
    protected $rcmUserService;

    /**
     * @param RcmUserService $rcmUserService
     */
    public function __construct(
        RcmUserService $rcmUserService
    ) {
        $this->rcmUserService = $rcmUserService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return bool
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    ): bool
    {
        $privilege = (array_key_exists('privilege', $options) ? $options['privilege'] : 'read');

        return $this->rcmUserService->isAllowed(
            'translations',
            $privilege
        );
    }
}
