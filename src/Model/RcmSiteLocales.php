<?php

namespace RcmI18n\Model;

use Rcm\Repository\Site;

/**
 * Locales
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\Model
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class RcmSiteLocales implements Locales
{
    /**
     * @var Site
     */
    protected $siteRepo;

    /**
     * @var array
     */
    protected $locales = null;

    /**
     * Constructor
     *
     * @param Site $siteRepo Rcm Site Repo
     */
    public function __construct(Site $siteRepo)
    {
        $this->siteRepo = $siteRepo;
    }

    /**
     * @return array
     */
    protected function buildLocales()
    {
        $list = [];

        /** @var \Rcm\Entity\Site $site */
        foreach ($this->siteRepo->getSites(true) as $site) {
            $list[$site->getLanguage()->getIso6391()
            . '_' . $site->getCountry()->getIso2()]
                = $site->getCountry()->getCountryName()
                . ' - ' . $site->getLanguage()->getLanguageName();
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
