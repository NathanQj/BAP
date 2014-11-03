<?php
/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');
/******************************** 
			PROCESS 
********************************/
if (isset($_POST['username']) && !empty($_POST['username'])
	&& isset($_POST['password']) && !empty($_POST['password'])){

		// on détruit les variables de session qui ont pu être créees auparavent
	session_unset();

	// on ne sélectionne que les personnes dont le username
	// correspond à celui qui a été entré dans le formulaire
	$request = $db->prepare('SELECT id, username, password FROM users WHERE username=:username');
	

	$request->execute(
		array(
			'username' => $_POST['username'])
		);		

	
	while ($data = $request->fetch()){
		// password entré = password BDD
		if ($data['password'] == $_POST['password']){
			// on remplit des variables de session qui concernent l'user connecté
			$_SESSION['id'] = $data['id'];
			$_SESSION['username'] = $data['username'];

			// redirection page d'accueil
			header('Location:index.php');
		}
	}

	$request->closeCursor();

	// if : username ou pass incorrect
	echo 'Pseudo et/ou mot de passe incorrects';
}

/******************************** 
			VIEW 
********************************/
include 'view/head.html';
include 'view/_menu.php';
include 'view/login.html';
include 'view/_footer.html';

var_dump($_SESSION);