<?php

namespace RcmI18n\Controller\Plugin;

use RcmI18n\Service\ParameterizeTranslator;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Class ParamTranslate
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\ViewHelper
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ParamTranslate extends AbstractPlugin
{
    /**
     * @var ParameterizeTranslator
     */
    protected $paramTranslator;

    /**
     * @param ParameterizeTranslator $paramTranslator
     */
    public function __construct(ParameterizeTranslator $paramTranslator)
    {
        $this->paramTranslator = $paramTranslator;
    }

    /**
     * __invoke
     *
     * @param        $message
     * @param array  $prams
     * @param string $textDomain
     * @param null   $locale
     *
     * @return string
     */
    public function __invoke(
        $message,
        $prams = [],
        $textDomain = 'default',
        $locale = null
    ) {
        return $this->paramTranslator->translate(
            $message,
            $prams,
            $textDomain,
            $locale
        );
    }
}
