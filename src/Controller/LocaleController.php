<?php

namespace RcmI18n\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class LocaleController extends AbstractRestfulController
{
    /**
     * getList
     *
     * @return mixed|\Zend\Stdlib\ResponseInterface|JsonModel
     */
    public function getList()
    {
        return new JsonModel(
            [
                'locales' =>
                    $this->getServiceLocator()
                        ->get('RcmI18n\Model\Locales')->getLocales()
                ,
                'currentSiteLocale' => $this->getServiceLocator()->get(
                    \Rcm\Service\CurrentSite::class
                )->getLocale()
            ]
        );
    }
}
