<?php

namespace RcmI18n\Service;

use Zend\I18n\Translator\TranslatorInterface;

/**
 * Class ParameterizeTranslator
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\Service
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright ${YEAR} Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ParameterizeTranslator
{
    /**
     * @var string
     */
    protected $openTag = '{';
    /**
     * @var string
     */
    protected $closeTag = '}';

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(
        TranslatorInterface $translator
    ) {
        $this->translator = $translator;
    }

    /**
     * getTranslator
     *
     * @return TranslatorInterface.
     */
    protected function getTranslator()
    {
        return $this->translator;
    }

    /**
     * paramTranslate
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
        $translator = $this->getTranslator();

        $message = $translator->translate(
            $message,
            $textDomain,
            $locale
        );

        foreach ($params as $name => $value) {
            $message = str_replace(
                $this->openTag . $name . $this->closeTag,
                $value,
                $message
            );
        }

        return $message;
    }
}
