<?php
$config = \Tk\Config::getInstance();

// NOTE:
// You must manually include all required php files if you are not using composer to install the plugin.
// Alternatively be sure to use the plugin namespace for all classes such as \sample\Ems\MyClass


/** @var \Tk\Routing\RouteCollection $routes */
$routes = $config['site.routes'];

$params = array('access' => \App\Db\User::ROLE_ADMIN);
$routes->add('sample-admin-settings', new \Tk\Routing\Route('/sample/adminSettings.html', 'Ems\Controller\SystemSettings::doDefault', $params));


$params = array('access' => \App\Db\User::ROLE_CLIENT);
$routes->add('sample-sample-institution-settings', new \Tk\Routing\Route('/sample/institutionSettings.html', 'Ems\Controller\InstitutionSettings::doDefault', $params));


$params = array('access' => array(\App\Db\User::ROLE_CLIENT, \App\Db\User::ROLE_STAFF));
$routes->add('sample-sample-course-settings', new \Tk\Routing\Route('/sample/courseSettings.html', 'Ems\Controller\CourseSettings::doDefault', $params));


