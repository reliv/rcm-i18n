<?php

namespace RcmI18n\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\I18n\Translator\Translator;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ApiTranslateController
{
    /**
     * @param Translator $translator
     */
    public function __construct(
        Translator $translator
    ) {
        $this->translator = $translator;
    }

    /**
     * getTranslator
     *
     * @return Translator
     */
    protected function getTranslator()
    {
        return $this->translator;
    }

    /**
     * __invoke
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable|null          $next
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {
        $translator = $this->getTranslator();

        // @todo Might be a better way to prevent spamming
        // We ignore events so we don't get spammed.
        $translator->disableEventManager();

        $trimFilter = new StringTrim();

        $stripTagsFilter = new StripTags();

        $namespace = (string)$request->getAttribute('namespace', 'default');

        $translationParams = $request->getQueryParams();

        $translations = [];

        foreach ($translationParams as $message) {
            $message = (string)urldecode($message);
            // Clean
            $message = $stripTagsFilter->filter($message);
            $message = $trimFilter->filter($message);

            $translations[$message] = $translator->translate($message, $namespace);
        }

        return new JsonResponse($translations);
    }
}
