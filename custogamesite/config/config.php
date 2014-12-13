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




//Variables:

$valid_default = 'En cours';

// Vérifie si l'utilisateur est connecté   
function utilisateur_est_connecte() {
 
	return !empty($_SESSION['id']);
}

function user_is_admin() {
	if(utilisateur_est_connecte()){
		if($_SESSION['username'] == 'Custorial'){
			
			return true;
		}	
	}
}

// Photos par Level :

	function SelectAllImages(PDO $db) {

		$sql = "SELECT picture FROM users"; 

		$req = $db->prepare($sql); 
		$req->execute(); 

		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		return $result; 
}

// Classement des joueurs : (top3)

	function SelectUsersFromClassement(PDO $db){
		$sql = ('SELECT username, xp FROM users ORDER BY xp DESC limit 0,3');

		$req = $db->prepare($sql);
		$req->execute();

		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		//on retourne le tableau de résultats
		return $result;
	}

// Classement des joueurs : (#1)

	function SelectUsersFromClassement_1(PDO $db){
		$sql = ('SELECT username, xp FROM users ORDER BY xp DESC limit 0,1');

		$req = $db->prepare($sql);
		$req->execute();

		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		//on retourne le tableau de résultats
		return $result;
	}

// Classement des joueurs : (#2)

	function SelectUsersFromClassement_2(PDO $db){
		$sql = ('SELECT username, xp FROM users ORDER BY xp DESC limit 1,1');

		$req = $db->prepare($sql);
		$req->execute();

		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		//on retourne le tableau de résultats
		return $result;
	}

// Classement des joueurs : (#3)

	function SelectUsersFromClassement_3(PDO $db){
		$sql = ('SELECT username, xp FROM users ORDER BY xp DESC limit 2,1');

		$req = $db->prepare($sql);
		$req->execute();

		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		//on retourne le tableau de résultats
		return $result;
	}

// Classement des joueurs : (top3)

	function SelectUsersFromClassement_47(PDO $db){
		$sql = ('SELECT username, xp FROM users ORDER BY xp DESC limit 3,46');

		$req = $db->prepare($sql);
		$req->execute();

		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		//on retourne le tableau de résultats
		return $result;
	}

// Récupération des vidéos dans la BDD : 
	function SelectVideosFromBDD(PDO $db){
		$req = $db->prepare('SELECT * FROM videos ORDER BY auteur DESC');
		$req->execute(array());

		$datas = $req->fetchAll(PDO::FETCH_ASSOC);
		return $datas;
	}


// Configuration des photos de profil:
	function AttributeProfilPicture(PDO $db){


	}

