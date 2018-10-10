<?php
return array(
	'_root_'  => 'welcome/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

	'login' => array('auth/login', 'name' => 'login'),

	'signup' => array('auth/signup', 'name' => 'signup'),

	'index' => array('auth/index', 'name' => 'index'),

	'api/login' => array('user/api/auth/login', 'name' => 'api_login'),

	'api/signup' => array('user/api/auth/signup', 'name' => 'api_signup'),
);
