<?php

namespace RcmI18n\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use RcmHtmlPurifier\Api\Purify;
use RcmI18n\Api\Acl\IsAllowed;
use RcmI18n\Entity\Message;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

/**
 * MessagesController
 *
 * @category  Reliv
 * @package   RcmI18n\Controller
 * @author    Inna Davis <idavis@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */
class MessagesController extends AbstractRestfulController
{
    /**
     * @param array $options
     *
     * @return bool
     */
    protected function isAllowed(array $options = [])
    {
        /** @var IsAllowed $isAllowed */
        $isAllowed = $this->serviceLocator->get(IsAllowed::class);

        return $isAllowed->__invoke(
            ServerRequestFactory::fromGlobals(),
            $options
        );
    }

    /**
     * @param $html
     *
     * @return string
     */
    protected function purify($html)
    {
        /** @var Purify $purify */
        $purify = $this->serviceLocator->get(Purify::class);

        return $purify->__invoke(
            $html
        );
    }

    /**
     * getList
     *
     * @return mixed|\Zend\Stdlib\ResponseInterface|JsonModel
     */
    public function getList()
    {
        /** @var EntityManager $em */
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        /** @var EntityRepository $messageRepo */
        $messageRepo = $em->getRepository(\RcmI18n\Entity\Message::class);

        $locale = $this->params()->fromRoute('locale');

        $defaultMessages = $messageRepo->findBy(['locale' => 'en_US']);
        $localeMessages = $messageRepo->findBy(['locale' => $locale]);

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

        return new JsonModel($translations);
    }

    /**
     * Update translations
     *
     * @param mixed $id   Id of text that need to be translated
     * @param mixed $data Data
     *
     * @return mixed|\Zend\Stdlib\ResponseInterface|JsonModel
     * @throws \Exception
     */
    public function update($id, $data)
    {

        if (!$this->isAllowed(['privilege' => 'update'])) {
            $response = $this->getResponse();
            $response->setStatusCode(Response::STATUS_CODE_401);
            $response->setContent($response->renderStatusLine());

            return $response;
        }

        /** @var EntityManager $em */
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        /** @var EntityRepository $messageRepo */
        $messageRepo = $em->getRepository(\RcmI18n\Entity\Message::class);

        $locale = $this->params()->fromRoute('locale');

        /**
         * White-list local and default test to make sure nothing funny is
         * making its way to the DB. All default text's used must already exist
         * in the en_US locale
         */
        $usMessage = $messageRepo->findOneBy(
            ['locale' => 'en_US', 'defaultText' => $data['defaultText']]
        );
        if (!$this->getServiceLocator()->get('RcmI18n\Model\Locales')
            ->localeIsValid($locale)
        ) {
            return $this->buildBadRequestResponse('invalid locale');
        } elseif (!$usMessage instanceof Message) {
            return $this->buildBadRequestResponse('invalid defaultText');
        }

        /**
         * Purify text to make sure nothing funny is making its way to the DB
         */
        $cleanText = $this->purify($data['text']);

        $message = $messageRepo->findOneBy(
            ['locale' => $locale, 'messageId' => $id]
        );

        if ($message instanceof Message) {
            $message->setText($cleanText);
        } else {
            $message = new Message();
            $message->setLocale($locale);
            $message->setDefaultText($usMessage->getDefaultText());
            $message->setText($cleanText);

            $em->persist($message);
        }
        $em->flush();

        return new JsonModel($message);
    }

    /**
     * @param $message
     *
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function buildBadRequestResponse($message)
    {
        $response = $this->getResponse();
        $response->setStatusCode(Response::STATUS_CODE_400);
        $response->setContent(
            $response->renderStatusLine()
            . ' - ' . $message
        );

        return $response;
    }
}
