<?php

$host = 'localhost';
$db_name = 'alexnaudiim'; // à remplir avec le nom de la BDD
$user = 'root';
$password= '';


try{
	$db = new PDO("mysql:dbname=".$db_name.";host=".$host, $user, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo 'Error while connecting : ' . $e->getMessage();
}


// Vérifie si l'utilisateur est connecté   
function utilisateur_est_connecte() {
 
	return !empty($_SESSION['id']);
}

function user_is_admin() {

	if($_SESSION['username'] == 'Custorial'){
		
		return true;
	}
}