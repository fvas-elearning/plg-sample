<?php
$config = \Tk\Config::getInstance();

/** @var \Composer\Autoload\ClassLoader $composer */
$composer = $config->getComposer();
if ($composer)
    $composer->add('Eg\\', dirname(__FILE__));

/** @var \Tk\Routing\RouteCollection $routes */
$routes = $config['site.routes'];

$params = array('role' => 'admin');
$routes->add('sample-admin-settings', new \Tk\Routing\Route('/sampleSettings.html', 'Tk\Eg\Controller\SystemSettings::doDefault', $params));

$params = array('role' => array('admin', 'client'));
$routes->add('sample-institution-settings', new \Tk\Routing\Route('/sampleInstitutionSettings.html', 'Tk\Eg\Controller\InstitutionSettings::doDefault', $params));

$params = array('role' => array('client', 'staff'));
$routes->add('sample-profile-settings', new \Tk\Routing\Route('/sampleProfileSettings.html', 'Tk\Eg\Controller\ProfileSettings::doDefault', $params));

$params = array('role' => array('client', 'staff'));
$routes->add('sample-subject-settings', new \Tk\Routing\Route('/sampleSubjectSettings.html', 'Tk\Eg\Controller\SubjectSettings::doDefault', $params));


