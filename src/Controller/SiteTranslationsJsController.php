<?php


namespace RcmI18n\Controller;

use Rcm\Controller\AbstractRestfulJsonController;
use RcmI18n\Entity\Message;

/**
 * Class TranslationsAppStateController
 *
 * @category  Reliv
 * @package   RcmI18n\Controller
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class TranslationsAppStateController extends AbstractRestfulJsonController
{
    /**
     * getLocale
     *
     * @return mixed
     */
    protected function getLocale()
    {
        return $this->getServiceLocator()->get(
            \Rcm\Service\CurrentSite::class
        )->getLocale();
    }

    /**
     * getSiteTranslations
     *
     * @return mixed
     */
    protected function getSiteTranslations()
    {
        $locale = $this->getLocale();
        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $query = $em->createQueryBuilder()
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

    /**
     * getList
     *
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function getList()
    {
        $response = $this->getResponse();
        $response->getHeaders()->addHeaders(
            array(
                'Content-Type' => 'application/javascript',
                'Pragma' => 'cache',
                'Cache-Control' => 'max-age=3600',
            )
        );

        $locale = $this->getLocale();
        $siteTranslations = $this->getSiteTranslations();
        $translationJson = json_encode($siteTranslations);

        $content =
            'var rcmI18nTranslations = {' .
            " defaultLocale: '{$locale}'," .
            " translations: {'{$locale}': $translationJson}," .
            ' get: function (defaultText, locale) {' .
            '  if(!locale){locale = rcmI18nTranslations.defaultLocale;}' .
            '  if (typeof rcmI18nTranslations.translations[locale][defaultText] === "string") ' .
            '  {return rcmI18nTranslations.translations[locale][defaultText];}' .
            '  return defaultText;' .
            ' }' .
            '};';

        $response->setContent($content);

        return $response;
    }
}
