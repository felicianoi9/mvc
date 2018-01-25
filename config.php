<?php
require 'environment.php';

global $config;

$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'controlvendas';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
	define('BASE','http://localhost/felicianoi9.control'); 
} else {
	$config['dbname'] = 'felicia1_controlvendas';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'felicia1_control';
	$config['dbpass'] = 'T97ju21@t@t';
	define('BASE','http://felicianoi9.com.br/control');
}
?>