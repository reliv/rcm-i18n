<?php

namespace RcmI18n\Middleware;

use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RcmI18n\Entity\Message;
use Zend\Diactoros\Response\JsonResponse;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class MessagesController
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $messageRepository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->messageRepository = $entityManager->getRepository(Message::class);
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
        $locale = $request->getAttribute('locale');

        $defaultMessages = $this->messageRepository->findBy(['locale' => 'en_US']);
        $localeMessages = $this->messageRepository->findBy(['locale' => $locale]);

        $translations = [];
        foreach ($defaultMessages as $defaultMessage) {
            /** @var \RcmI18n\Entity\Message $defaultMessage */
            $defaultText = $defaultMessage->getDefaultText();

            $text = null;
            $messageId = null;

            /** @var Message $localeMessage */
            foreach ($localeMessages as $localeMessage) {
                if ($localeMessage->getDefaultText() == $defaultText) {
                    $text = $localeMessage->getText();
                    $messageId = $localeMessage->getMessageId();
                    break;
                }
            }

            $translations[] = [
                'locale' => $locale,
                'defaultText' => $defaultText,
                'messageId' => $messageId,
                'text' => $text
            ];
        }

        return new JsonResponse($translations);
    }
}
