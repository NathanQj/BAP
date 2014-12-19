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

include 'view/_head.html';
include 'view/_menu.php';
include 'view/index.html';
include 'view/_footer.html';

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
		else
		{
			header('Location:index.php?error=user_ou_mdp_incorrects');
		}		
	}

	$request->closeCursor();
	header('Location:index.php?error=user_ou_mdp_incorrects');
}

/******************************** 
			VIEW 
********************************/
include 'view/_head_index.html';
include 'view/login.html';
}