<?php
$config = \Tk\Config::getInstance();

/** @var \Tk\Routing\RouteCollection $routes */
$routes = $config['site.routes'];

$params = array('access' => \App\Db\User::ROLE_ADMIN);
$routes->add('admin-sample-settings', new \Tk\Routing\Route('/admin/sample/settings.html', 'Eg\Controller\Admin\Settings::doDefault', $params));



