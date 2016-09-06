<?php

namespace RcmI18n\Event;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\I18n\Translator\Translator;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AddMissingTranslationListener
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   moduleNameHere
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 */
class EmailMissingTranslationListener implements ListenerAggregateInterface
{
    const DO_NOT_TRANSLATE = 'DO_NOT_TRANSLATE';

    /**
     * @var array
     */
    protected $config;

    /**
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        throw new \Exception('EmailMissingTranslationListener not complete');
    }

    /**
     * getConfig
     *
     * @return array|object
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     * getDefaultLocale
     *
     * @return array
     */
    protected function getDefaultLocale()
    {
        $config = $this->getConfig();

        return $config['RcmI18n']['defaultLocale'];
    }

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $events->attach(
            Translator::EVENT_MISSING_TRANSLATION,
            array(
                $this,
                'emailMissingTranslation'
            )
        );
    }

    /**
     * Detach all previously attached listeners
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function detach(EventManagerInterface $events)
    {
    }

    /**
     * emailMissingTranslation
     *
     * @param EventInterface $event
     *
     * @return void
     */
    public function emailMissingTranslation($event)
    {
        $params = $event->getParams();

        $defaultLocale = $this->getDefaultLocale();

        if ($params['locale'] !== $defaultLocale) {
            // @todo write and implement this
        }
    }
}
