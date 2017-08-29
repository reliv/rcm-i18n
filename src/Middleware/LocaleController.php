<?php

namespace RcmI18n\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rcm\Service\CurrentSite;
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
     * @var CurrentSite
     */
    protected $currentSite;

    /**
     * @param Locales     $locales
     * @param CurrentSite $currentSite
     */
    public function __construct(
        Locales $locales,
        CurrentSite $currentSite
    ) {
        $this->locales = $locales;
        $this->currentSite = $currentSite;
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
        return new JsonResponse(
            [
                'locales' => $this->locales->getLocales(),
                'currentSiteLocale' => $this->currentSite->getLocale()
            ]
        );
    }
}
