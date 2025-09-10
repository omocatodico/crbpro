<?php
defined('BASEPATH') OR exit('No direct script access allowed');

return array(

	'config' => array(
		'base_url' => 'http://prenota.tambosi.asetti.co:8361/',
		'log_threshold' => 1,
		'index_page' => 'index.php',
		'uri_protocol' => 'REQUEST_URI',
	),

	'database' => array(
		'hostname' => '172.21.0.43',
		'port' => '3306',
		'username' => 'crbsuser',
		'password' => 'dbuserciao',
		'database' => 'crbsdb',
		'dbdriver' => 'mysqli',
	),

);
