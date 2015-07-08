<?php
/**
 * Purifying & translating view helper
 *
 * Works like ZF2's translate view helper but it also filters web script out of the
 * translation since they came from the DB and can't be trusted not to contain
 * XSS attacks. This filtering allows translations to contain things like <br> tags
 * that would not normally make it through an escapeHtml() call.
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\ViewHelper
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

namespace RcmI18n\ViewHelper;

use RcmI18n\Service\ParameterizeTranslator;
use Zend\I18n\Translator\TranslatorAwareInterface;
use Zend\I18n\View\Helper\AbstractTranslatorHelper;

/**
 * Purifying & translating view helper
 *
 * Works like ZF2's translate view helper but it also filters web script out of the
 * translation since they came from the DB and can't be trusted not to contain
 * XSS attacks. This filtering allows translations to contain things like <br> tags
 * that would not normally make it through an escapeHtml() call..
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18n\ViewHelper
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ParamTranslate extends AbstractTranslatorHelper implements
    TranslatorAwareInterface
{
    protected $paramTranslator;

    /**
     * @param ParameterizeTranslator $paramTranslator \
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
