<?php
namespace sample;


use Tk\Event\Dispatcher;


/**
 * Class Plugin
 *
 * @author Michael Mifsud <info@tropotek.com>
 * @link http://www.tropotek.com/
 * @license Copyright 2016 Michael Mifsud
 */
class Plugin extends \Tk\Plugin\Iface
{

    const ZONE_INSTITUTION = 'institution';
    const ZONE_COURSE_PROFILE = 'profile';
    const ZONE_COURSE = 'course';

    /**
     * A helper method to get the Plugin instance globally
     *
     * @return \Tk\Plugin\Iface
     */
    static function getInstance()
    {
        return \Tk\Config::getInstance()->getPluginFactory()->getPlugin('sample');
    }


    // ---- \Tk\Plugin\Iface Interface Methods ----
    
    
    /**
     * Init the plugin
     *
     * This is called when the session first registers the plugin to the queue
     * So it is the first called method after the constructor.....
     *
     */
    function doInit()
    {
        // TODO: Implement doInit() method.
        include dirname(__FILE__) . '/config.php';
        $config = $this->getConfig();

        // Register the plugin for the different client areas if they are to be enabled/disabled/configured by those roles.
        $this->getPluginFactory()->registerZonePlugin($this, self::ZONE_INSTITUTION);
        $this->getPluginFactory()->registerZonePlugin($this, self::ZONE_COURSE_PROFILE);
        $this->getPluginFactory()->registerZonePlugin($this, self::ZONE_COURSE);

        /** @var Dispatcher $dispatcher */
        $dispatcher = \Tk\Config::getInstance()->getEventDispatcher();

        $institution = \App\Factory::getInstitution();
        if($institution && $this->isZonePluginEnabled(self::ZONE_INSTITUTION, $institution->getId())) {
            $config->getLog()->debug($this->getName() . ': Sample init client plugin stuff: ' . $institution->name);
            $dispatcher->addSubscriber(new \Ems\Listener\ExampleHandler(self::ZONE_INSTITUTION, $institution->getId()));
        }
        /** @var \App\Db\Course $course */
        $course = \App\Factory::getCourse();
        if ($course && $this->isZonePluginEnabled(self::ZONE_COURSE, $course->getId())) {
            $config->getLog()->debug($this->getName() . ': Sample init course plugin stuff: ' . $course->name);
            $dispatcher->addSubscriber(new \Ems\Listener\ExampleHandler(self::ZONE_COURSE, $course->getId()));

            $profile = $course->getProfile();
            if ($profile && $this->isZonePluginEnabled(self::ZONE_COURSE_PROFILE, $profile->getId())) {
                $config->getLog()->debug($this->getName() . ': Sample init course profile plugin stuff: ' . $profile->name);
                $dispatcher->addSubscriber(new \Ems\Listener\ExampleHandler(self::ZONE_COURSE_PROFILE, $profile->getId()));
            }
        }
    }
    
    /**
     * Activate the plugin, essentially
     * installing any DB and settings required to run
     * Will only be called when activating the plugin in the
     * plugin control panel
     *
     */
    function doActivate()
    {
        // TODO: Implement doActivate() method.

        // Init Settings
        $data = \Tk\Db\Data::create($this->getName());
        $data->set('plugin.title', 'EMS III Example Plugin');
        $data->set('plugin.email', 'null@unimelb.edu.au');
        $data->save();
    }

    /**
     * Deactivate the plugin removing any DB data and settings
     * Will only be called when deactivating the plugin in the
     * plugin control panel
     *
     */
    function doDeactivate()
    {
        // TODO: Implement doDeactivate() method.
        
        // Delete any setting in the DB
        $data = \Tk\Db\Data::create($this->getName());
        $data->clear();
        $data->save();
    }

    /**
     * Get the course settings URL, if null then there is none
     *
     * @return string|\Tk\Uri|null
     */
    public function getZoneSettingsUrl($zoneName)
    {
        switch ($zoneName) {
            case self::ZONE_INSTITUTION:
                return \Tk\Uri::create('/sample/institutionSettings.html');
            case self::ZONE_COURSE_PROFILE:
                return \Tk\Uri::create('/sample/courseProfileSettings.html');
            case self::ZONE_COURSE:
                return \Tk\Uri::create('/sample/courseSettings.html');
        }
        return null;
    }

    /**
     * @return \Tk\Uri
     */
    public function getSettingsUrl()
    {
        return \Tk\Uri::create('/sample/adminSettings.html');
    }

}