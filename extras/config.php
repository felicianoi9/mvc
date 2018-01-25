<?php
require 'environment.php';



$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'controlvendas';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
	define('BASE_URL','http://localhost/controlvendas'); 
} else {
	$config['dbname'] = 'banco';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'usuario';
	$config['dbpass'] = 'senha';
	define('BASE_URL','http://www.meusite.com.br/pasta/');
}

global $db;
try{

	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'],$config['dbpass'] );

}catch(PDOException $e){
	echo 'ERRO: '.$e->getMessage();
	exit;
}
?>