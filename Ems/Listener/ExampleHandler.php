<?php
namespace Ems\Listener;

use Tk\EventDispatcher\SubscriberInterface;
use Tk\Kernel\KernelEvents;
use Tk\Event\ControllerEvent;
use Tk\Event\GetResponseEvent;
use App\AppEvents;
use Tk\EventDispatcher\Event;

/**
 * Class StartupHandler
 *
 * @author Michael Mifsud <info@tropotek.com>
 * @link http://www.tropotek.com/
 * @license Copyright 2015 Michael Mifsud
 */
class ExampleHandler implements SubscriberInterface
{


    /**
     *
     * @param GetResponseEvent $event
     */
    public function onSystemInit(GetResponseEvent $event)
    {
        //$this->plugin = \Eg\Plugin::getInstance();
        //vd('Example: onSystemInit');

        //vd($event->getRequest()->getAttribute('courseCode'));
        //vd(\Tk\Config::getInstance()->getCourse());

    }

    /**
     * Check the user has access to this controller
     *
     * @param ControllerEvent $event
     */
    public function onControllerAccess(ControllerEvent $event)
    {
        //vd('sample: onControllerAccess');
        $plugin = \sample\Plugin::getInstance();
        $config = $plugin->getConfig();

        $institution = $config->getInstitution();
        if($institution && $plugin->isInstitutionEnabled($institution->getId())) {
            vd('Plugin execution for institution stuff: ' . $institution->name);
        }

        $course = $config->getCourse();
        if ($course && $plugin->isCourseEnabled($course->getId())) {
            vd('Plugin execution for course stuff: ' . $course->name);
        }

    }

    /**
     * Check the user has access to this controller
     *
     * @param Event $event
     */
    public function onControllerShow(Event $event)
    {
        //vd('Example: onControllerShow');
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
            KernelEvents::REQUEST => array('onSystemInit', -10),
            KernelEvents::CONTROLLER => array('onControllerAccess', 0),
            AppEvents::SHOW => array('onControllerShow', 0)
        );
    }
    
}