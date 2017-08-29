<?php

namespace RcmI18n\Middleware;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rcm\Service\CurrentSite;
use RcmI18n\Entity\Message;
use Zend\Diactoros\Response;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class SiteTranslationsJsController
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var CurrentSite
     */
    protected $currentSite;

    /**
     * @param EntityManager $entityManager
     * @param CurrentSite   $currentSite
     */
    public function __construct(
        EntityManager $entityManager,
        CurrentSite $currentSite
    ) {
        $this->entityManager = $entityManager;
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
        $response = new Response(
            'php://memory',
            200,
            [
                'Content-Type' => 'application/javascript',
                'Pragma' => 'cache',
                'Cache-Control' => 'max-age=3600',
            ]
        );

        $locale = $this->getLocale();
        $siteTranslations = $this->getSiteTranslations();
        $translationJson = json_encode($siteTranslations);

        $content
            = 'var rcmI18nTranslations = {' .
            " defaultLocale: '{$locale}'," .
            " translations: {'{$locale}': $translationJson}," .
            ' get: function (defaultText, locale) {' .
            '  if(!locale){locale = rcmI18nTranslations.defaultLocale;}' .
            '  if (typeof rcmI18nTranslations.translations[locale][defaultText] === "string") ' .
            '  {return rcmI18nTranslations.translations[locale][defaultText];}' .
            '  return defaultText;' .
            ' }' .
            '};';

        $body = $response->getBody();

        $body->write($content);
        $body->rewind();

        return $response->withBody($body);
    }

    /**
     * getLocale
     *
     * @return mixed
     */
    protected function getLocale()
    {
        return $this->currentSite->getLocale();
    }

    /**
     * getSiteTranslations
     *
     * @return mixed
     */
    protected function getSiteTranslations()
    {
        $locale = $this->getLocale();

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
