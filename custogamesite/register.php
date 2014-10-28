<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');

/******************************** 
			PROCESS 
********************************/

//si l'utilisateur valide le formulaire
if(isset($_POST) && !empty($_POST)){
	
	//si le format de l'adresse mail est correct
	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true){
		
		if (isset($_POST['username']) && !empty($_POST['username'])
			&& isset($_POST['password']) && !empty($_POST['password'])
			&& isset($_POST['first_name']) && !empty($_POST['first_name'])
			&& isset($_POST['last_name']) && !empty($_POST['last_name'])
			&& isset($_POST['email']) && !empty($_POST['email'])
			&& isset($_POST['sexe']) && !empty($_POST['sexe'])
			&& isset($_POST['lycee']) && !empty($_POST['lycee'])
			&& isset($_POST['classe']) && !empty($_POST['classe'])
			&& isset($_POST['birthday']) && !empty($_POST['birthday'])){
			
			session_unset();

			$request = $db->prepare('INSERT INTO users (username, password, first_name, last_name, email, sexe, lycee, classe, birthday) 
										VALUES (:username, :password, :first_name, :last_name, :email, :sexe, :lycee, :classe, :birthday)');

			$request->execute(
				array(
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'email' => $_POST['email'],
					'sexe' => $_POST['sexe'],
					'lycee' => $_POST['lycee'],
					'classe' => $_POST['classe'],			
					'birthday' => $_POST['birthday']
					)
				);

		
		echo "Inscription réussie";
		// redirection login
		// header('Location:login.php');
		}
	}
	else
	{
		$error = 'Format de l\'adresse email incorrect';
	}
}

/******************************** 
			VIEW 
********************************/
include 'view/_header.html';
include 'view/_menu.html';
include 'view/register.html';
include 'view/_footer.html';