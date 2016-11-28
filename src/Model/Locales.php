<?php

namespace RcmI18n\Model;

/**
 * Interface Locales
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
interface Locales
{
    /**
     * Returns all locales used by active sites
     *
     * @return array
     */
    public function getLocales();

    /**
     * Returns true if locale is valid
     *
     * @param string $locale
     *
     * @return boolean
     */
    public function localeIsValid($locale);
}
