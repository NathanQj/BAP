<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');
include 'view/_head.html';
/******************************** 
			PROCESS 
********************************/


//si l'utilisateur n'est pas connecté
if (!utilisateur_est_connecte()){ 

	//si l'utilisateur valide le formulaire
	if(isset($_POST) && !empty($_POST)){
		
		//si le format de l'adresse mail est correct
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true){
			
			if (isset($_POST['first_name']) && !empty($_POST['first_name'])
				&& isset($_POST['last_name']) && !empty($_POST['last_name'])
				&& isset($_POST['username']) && !empty($_POST['username'])
				&& isset($_POST['password']) && !empty($_POST['password'])
				&& isset($_POST['passverif']) && !empty($_POST['passverif'])
				&& isset($_POST['email']) && !empty($_POST['email']))
			{
					
				//On verifie si le mot de passe et celui de la verification sont identiques
				if($_POST['password']==$_POST['passverif'])
				{
	 				//On verifie si le mot de passe a 6 caracteres ou plus
	                if(strlen($_POST['password'])>=6)
	                {
	                	//On vérifie si le mail et celui de la vérification sont identiques
	                	if($_POST['email']==$_POST['mailverif'])
	                	{

							session_unset();

							$request = $db->prepare('INSERT INTO users (first_name, last_name, username, password, email, user_registered) 
														VALUES (:first_name, :last_name, :username, :password, :email, now())');

							$request->execute(
								array(
									'first_name' => $_POST['first_name'],
									'last_name' => $_POST['last_name'],					
									'username' => $_POST['username'],
									'password' => $_POST['password'],
									'email' => $_POST['email'],
									)
								);

						
						echo "Vous avez bien &eacute;t&eacute; inscrit. Vous pouvez dor&eacute;navant vous connecter.";
						// redirection login
						header('Location:profil.php');
						}
						else
						{
							echo "Les mails ne correspondent pas";
							header('Location:index.php');
						}	
					}
					else
					{
						echo "Le mot de passe doit faire plus de 6 caractères";
						header('Location:index.php');
					}
				}
				else
				{
					echo "Les mots de passe ne correspondent pas";
					header('Location:index.php');
				}
			}
			else
			{
				echo "Remplissez tous les champs";
				header('Location:index.php');
			}
		}
		else
		{
			echo "Remplissez tous les champs correctement";
			header('Location:index.php');
		}
	}
}
else{
	header('Location:index.php');
}

/******************************** 
			VIEW 
********************************/