<?php

$host = 'mysql51-87.perso';
$dbname = 'alexnaudiim';
$user = 'alexnaudiim';
$pass = 'MarlinNauda';


try{
	$db = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
catch(Exception $e)
{
    echo 'Erreur : '.$e->getMessage().'<br />';
    echo 'N° : '.$e->getCode();
}