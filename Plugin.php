<?php
namespace sample;


use Tk\EventDispatcher\EventDispatcher;


/**
 * Class Plugin
 *
 * @author Michael Mifsud <info@tropotek.com>
 * @link http://www.tropotek.com/
 * @license Copyright 2016 Michael Mifsud
 */
class Plugin extends \App\Plugin\Iface
{

    /**
     * A helper method to get the Plugin instance globally
     * 
     * @return \Tk\Plugin\Iface
     */
    static function getInstance()
    {
        return \App\Plugin\Factory::getInstance()->getPlugin('sample');
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
        
        $this->getPluginFactory()->registerInstitutionPlugin($this);
        vd('--');
        /** @var EventDispatcher $dispatcher */
        $dispatcher = \App\Factory::getEventDispatcher();
        $dispatcher->addSubscriber(new \Ems\Listener\ExampleHandler());
        
        
        
        
        
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
        $data = \Tk\Db\Data::create($this->getPluginName());
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
        $data = \Tk\Db\Data::create($this->getPluginName());
        $data->clear();
        $data->save();
    }

    /**
     * @return \Tk\Uri
     */
    public function getSettingsUrl()
    {
        return \Tk\Uri::create('/admin/sample/settings.html');
    }

    /**
     * Get the course settings URL, if null then there is none
     *
     * @return string|\Tk\Uri|null
     */
    public function getClientSettingsUrl()
    {
        // TODO: Implement getClientSettingsUrl() method.
        return \Tk\Uri::create('/client/sample/settings.html');
    }

    /**
     * Get the course settings URL, if null then there is none
     *
     * @return string|\Tk\Uri|null
     */
    public function getCourseSettingsUrl()
    {
        // TODO: Implement getCourseSettingsUrl() method.
    }
}