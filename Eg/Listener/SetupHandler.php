<?php
namespace Eg\Listener;

use Tk\Event\Subscriber;
use Eg\Plugin;

/**
 * @author Michael Mifsud <info@tropotek.com>
 * @link http://www.tropotek.com/
 * @license Copyright 2015 Michael Mifsud
 */
class SetupHandler implements Subscriber
{

    /**
     * @param \Tk\Event\GetResponseEvent $event
     * @throws \Tk\Db\Exception
     * @throws \Tk\Exception
     */
    public function onRequest(\Tk\Event\GetResponseEvent $event)
    {
        /* NOTE:
         *  If you require the Institution object for an event
         *  be sure to subscribe events here.
         *  As any events fired before this event do not have access to
         *  the institution object, unless you manually save the id in the
         *  session on first page load?
         */
        $config = \App\Config::getInstance();
        $dispatcher = $config->getEventDispatcher();
        $plugin = Plugin::getInstance();


        if (class_exists('/Uni/Config') && $config instanceof \Uni\Config) {
            $institution = $config->getInstitution();
            if ($institution && $plugin->isZonePluginEnabled(Plugin::ZONE_INSTITUTION, $institution->getId())) {
                \Tk\Log::debug($plugin->getName() . ': Sample init client plugin stuff: ' . $institution->name);
                $dispatcher->addSubscriber(new \Eg\Listener\ExampleHandler(Plugin::ZONE_INSTITUTION, $institution->getId()));
            }
            $course = $config->getCourse();
            if ($course && $plugin->isZonePluginEnabled(Plugin::ZONE_COURSE, $course->getId())) {
                \Tk\Log::debug($plugin->getName() . ': Sample init course plugin stuff: ' . $course->name);
                $dispatcher->addSubscriber(new \Eg\Listener\ExampleHandler(Plugin::ZONE_COURSE, $course->getId()));
            }
            $profile = $config->getProfile();
            if ($profile && $plugin->isZonePluginEnabled(Plugin::ZONE_COURSE_PROFILE, $profile->getId())) {
                \Tk\Log::debug($plugin->getName() . ': Sample init course profile plugin stuff: ' . $profile->name);
                $dispatcher->addSubscriber(new \Eg\Listener\ExampleHandler(Plugin::ZONE_COURSE_PROFILE, $profile->getId()));
            }
        }

    }

    public function onInit(\Tk\Event\KernelEvent $event)
    {
        //vd('onInit');
    }

    public function onController(\Tk\Event\ControllerEvent $event)
    {
        //vd('onController');
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            //\Tk\Kernel\KernelEvents::INIT => array('onInit', 0),
            //\Tk\Kernel\KernelEvents::CONTROLLER => array('onController', 0),
            \Tk\Kernel\KernelEvents::REQUEST => array('onRequest', -10)
        );
    }
    
    
}