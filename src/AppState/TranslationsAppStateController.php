<?php

namespace RcmI18n\AppState;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rcm\Service\SiteService;
use RcmI18n\Entity\Message;
use Reliv\AppState\GetInterface;
use Zend\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TranslationsAppStateController implements GetInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var SiteService
     */
    protected $siteService;

    /**
     * @param EntityManager $entityManager
     * @param SiteService $siteService
     */
    public function __construct(
        EntityManager $entityManager,
        SiteService $siteService
    ) {
        $this->entityManager = $entityManager;
        $this->siteService = $siteService;
    }

    /**
     * Get current state for a request
     *
     * @param Request $request The request currently being processed
     * @param array $options Arbitrary options that may influence state produced
     * @return mixed The state produced, which may be any JSON-encodable value
     */
    public function __invoke(Request $request, array $options)
    {
        $locale = $this->getLocale($request);
        $siteTranslations = $this->getSiteTranslations($locale);

        return [
            'defaultLocale' => $locale,
            'translations' => $siteTranslations
        ];
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return string
     */
    protected function getLocale(
        ServerRequestInterface $request
    ) {
        $site = $this->siteService->getSite(
            $request->getUri()->getHost()
        );

        return $site->getLocale();
    }

    /**
     * @param string $locale
     *
     * @return array
     */
    protected function getSiteTranslations(
        string $locale
    ) {
        $query = $this->entityManager->createQueryBuilder()
            ->select(
                'message.text,message.defaultText'
            )
            ->from(Message::class, 'message')
            ->where('message.locale = :locale')
            ->setParameter('locale', $locale);

        $query->setParameter('locale', $locale);

        $result = $query->getQuery()->getArrayResult();

        $result = $this->prepareData($result);

        return $result;
    }

    /**
     * prepareData Format and clean translations
     *
     * @param $result
     *
     * @return array
     */
    protected function prepareData($result)
    {
        $preparedData = [];
        foreach ($result as $key => $row) {
            $preparedData[$row['defaultText']] = strip_tags(html_entity_decode($row['text']));
        }

        return $preparedData;
    }
}
