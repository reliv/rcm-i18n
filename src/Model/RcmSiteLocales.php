<?php

namespace RcmI18n\Model;

use Rcm\Api\Repository\Site\FindActiveSites;

/**
 * RcmSiteLocales
 *
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2017 Reliv International
 * @license   License.txt New BSD License
 * @link      https://github.com/reliv
 */
class RcmSiteLocales implements Locales
{
    /**
     * @var FindActiveSites
     */
    protected $findActiveSites;

    /**
     * @var array
     */
    protected $locales = null;

    /**
     * @param FindActiveSites $findActiveSites
     */
    public function __construct(FindActiveSites $findActiveSites)
    {
        $this->findActiveSites = $findActiveSites;
    }

    /**
     * @return array
     */
    protected function buildLocales()
    {
        $list = [];

        $sites = $this->findActiveSites->__invoke();

        /** @var \Rcm\Entity\Site $site */
        foreach ($sites as $site) {
            $countryName = $site->getCountry()->getCountryName();
            $languageName = $site->getLanguage()->getLanguageName();
            $list[$site->getLocale()] = $countryName . ' - ' . $languageName;
        }

        return array_unique($list);
    }

    /**
     * Returns all locales used by active sites
     *
     * @return array
     */
    public function getLocales()
    {
        if ($this->locales === null) {
            $this->locales = $this->buildLocales();
        }

        return $this->locales;
    }

    /**
     * Returns true if locale is valid
     *
     * @param $locale
     *
     * @return boolean
     */
    public function localeIsValid($locale)
    {
        $locales = $this->getLocales();

        return array_key_exists($locale, $locales);
    }
}
