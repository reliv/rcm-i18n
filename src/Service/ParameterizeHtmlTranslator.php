<?php

namespace RcmI18n\Service;

use Zend\I18n\Translator\TranslatorInterface;

/**
 * Class ParameterizeHtmlTranslator
 *
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2016 Reliv International
 * @license   License.txt
 * @link      https://github.com/reliv
 */
class ParameterizeHtmlTranslator extends ParameterizeTranslator
{
    /**
     * @var \HTMLPurifier
     */
    protected $htmlPurifier;

    /**
     * ParameterizeHtmlTranslator constructor.
     *
     * @param TranslatorInterface $translator
     * @param \HTMLPurifier       $htmlPurifier
     */
    public function __construct(
        TranslatorInterface $translator,
        \HTMLPurifier $htmlPurifier
    ) {
        $this->htmlPurifier = $htmlPurifier;
        parent::__construct($translator);
    }

    /**
     * translate
     *
     * @param string $message
     * @param array  $params
     * @param string $textDomain
     * @param null   $locale
     *
     * @return string
     */
    public function translate(
        $message,
        $params = [],
        $textDomain = 'default',
        $locale = null
    ) {
        $result = parent::translate($message, $params, $textDomain, $locale);

        return $this->htmlPurifier->purify($result);
    }
}
