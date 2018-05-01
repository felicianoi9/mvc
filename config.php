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

	define('BASE','http://200.201.210.50/~r2627/control');
}
?>

