<?php

require 'environment.php';

$config =  array();

if(ENVIRONMENT=='development'){
	define("BASE_URL","http://localhost/felicianoi9/");
	$config['dbname']='mvc_estrutura';
	$config['host']='localhost';
	$config['dbuser']='root';
	$config['dbpass']='';

}else{
	define("BASE_URL","http://www.meusite.com.br/alguma_pasta/");
	$config['dbname'] = 'banco';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'usuario';
	$config['dbpass'] = 'senha';


}

global $db;
try{

	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'],$config['dbpass'] );

}catch(PDOException $e){
	echo 'ERRO: '.$e->getMessage();
	exit;
}