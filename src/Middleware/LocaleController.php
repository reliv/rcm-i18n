<?php

namespace RcmI18n\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rcm\Service\SiteService;
use RcmI18n\Model\Locales;
use Zend\Diactoros\Response\JsonResponse;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class LocaleController
{
    /**
     * @var Locales
     */
    protected $locales;

    /**
     * @var SiteService
     */
    protected $siteService;

    /**
     * @param Locales     $locales
     * @param SiteService $siteService
     */
    public function __construct(
        Locales $locales,
        SiteService $siteService
    ) {
        $this->locales = $locales;
        $this->siteService = $siteService;
    }

    /**
     * __invoke
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $site = $this->siteService->getCurrentSite(
            $request->getUri()->getHost()
        );

        return new JsonResponse(
            [
                'locales' => $this->locales->getLocales(),
                'currentSiteLocale' => $site->getLocale()
            ]
        );
    }
}
