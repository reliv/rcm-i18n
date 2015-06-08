<?php


namespace RcmI18n\Controller;

use Doctrine\ORM\Query;
use Rcm\Controller\AbstractRestfulJsonController;

/**
 * Class SiteTranslationsJsController
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\Controller
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class SiteTranslationsJsController extends AbstractRestfulJsonController
{
    /**
     * getLocale
     *
     * @return mixed
     */
    protected function getLocale()
    {
        return $this->getServiceLocator()->get(
            'Rcm\Service\CurrentSite'
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
            ->from('RcmI18n\Entity\Message', 'message')
            ->where('message.locale = :locale')
            ->setParameter('locale', $locale);

        $query->setParameter('locale', $locale);

        $result = $query->getQuery()->getArrayResult();

        $result = $this->prepareData($result);

        return $result;
    }

    /**
     * prepareData
     *
     * @param $result
     *
     * @return array
     */
    protected function prepareData($result)
    {
        $preparedData = [];
        foreach ($result as $key => $row) {
            $preparedData[$row['defaultText']] = $row['text'];
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
                'Content-Type' => 'application/javascript'
            )
        );

        $locale = $this->getLocale();
        $siteTranslations = $this->getSiteTranslations();
        $translationJson = json_encode($siteTranslations);

        $content =
            'var rcmI18nTranslations = {' .
            '"get": function(defaultText) {if(typeof rcmI18nTranslations[defaultText] === "string"){return rcmI18nTranslations[defaultText];} return defaultText;},' .
            "locale: '{$locale}'," .
            "translations: $translationJson" .
            '};';

        $response->setContent($content);

        return $response;
    }
}
