<?php

namespace RcmI18n\Controller;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\I18n\Translator\Translator;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

/**
 * Class ApiController
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2015 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class ApiTranslateController extends AbstractRestfulController
{
    /**
     * getTranslator
     *
     * @return Translator
     */
    protected function getTranslator()
    {
        return $this->serviceLocator->get('MvcTranslator');
    }

    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList()
    {
        $translator = $this->getTranslator();

        // @todo Might be a better way to prevent spamming
        // We ignore events so we don't get spammed.
        $translator->disableEventManager();

        $trimfilter = new StringTrim();

        $stripTagsFilter = new StripTags();

        $namespace = (string) $this->params()->fromRoute('namespace');

        $translationParams = $this->params()->fromQuery();

        $translations = [];

        foreach ($translationParams as $message) {
            $message = (string) urldecode($message);
            // Clean
            $message = $stripTagsFilter->filter($message);
            $message = $trimfilter->filter($message);

            $translations[$message] = $translator->translate($message, $namespace);
        }

        return new JsonModel($translations);
    }
}
