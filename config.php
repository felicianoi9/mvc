<?php
require 'environment.php';

global $config;

$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'controlvendas';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
	define('BASE','http://localhost/controlvendas'); 
} else {
	$config['dbname'] = 'ndswxxcq_control';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'ndswxxcq_rogerio';
	$config['dbpass'] = 'T97ju21@t@t@t';

	define('BASE','https://www.felicianoi9.com.br/control');
}
?>