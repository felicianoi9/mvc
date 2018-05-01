<?php
require 'environment.php';

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'post';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	$config['dbname'] = 'rogerio_admin';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'rogerio_felician';
	$config['dbpass'] = '[D-wmTJ.%,K9';
	define('BASE','http://www.ensinafacil.com.br/sistema');
}
?>