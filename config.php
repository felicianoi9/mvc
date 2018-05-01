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
	$config['dbname'] = 'r2627_control';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'r2627_feliciano';
	$config['dbpass'] = 'T97ju21@t@t@t';

	define('BASE','http://www.felicianoi9.com.br/control');
}
?>