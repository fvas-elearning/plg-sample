<?php
$config = \App\Config::getInstance();
$routes = $config->getRouteCollection();
if (!$routes) return;

/** @var \Composer\Autoload\ClassLoader $composer */
$composer = $config->getComposer();
if ($composer)
    $composer->add('Tk\\Eg\\', dirname(__FILE__));


$routes->add('sample-admin-settings', new \Tk\Routing\Route('/admin/sampleSettings.html', 'Tk\Eg\Controller\SystemSettings::doDefault'));

$routes->add('sample-client-institution-settings', new \Tk\Routing\Route('/client/sampleInstitutionSettings.html', 'Tk\Eg\Controller\InstitutionSettings::doDefault'));
$routes->add('sample-client-profile-settings', new \Tk\Routing\Route('/client/sampleProfileSettings.html', 'Tk\Eg\Controller\ProfileSettings::doDefault'));
$routes->add('sample-client-subject-settings', new \Tk\Routing\Route('/client/sampleSubjectSettings.html', 'Tk\Eg\Controller\SubjectSettings::doDefault'));

$routes->add('sample-staff-profile-settings', new \Tk\Routing\Route('/staff/sampleProfileSettings.html', 'Tk\Eg\Controller\ProfileSettings::doDefault'));
$routes->add('sample-staff-subject-settings', new \Tk\Routing\Route('/staff/sampleSubjectSettings.html', 'Tk\Eg\Controller\SubjectSettings::doDefault'));


