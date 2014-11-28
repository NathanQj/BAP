<?php
/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');

/******************************** 
			PROCESS 
********************************/
//Si l'utilisateur est connecté, on affiche l'index avec les vidéos
	if(isset($_SESSION['username']) OR !empty($_SESSION['username'])){
		header('Location:index.php');
}

//Si l'utilisateur n'est pas connecté, on affiche l'index avec l'espace d'inscription/connexion
else{
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
	header('Location:login.php');
}

/******************************** 
			VIEW 
********************************/
include 'view/login.html';
}