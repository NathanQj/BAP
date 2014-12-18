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

	//si l'utilisateur valide le formulaire
	if(isset($_POST) && !empty($_POST))
	{
		
		//si le format de l'adresse mail est correct
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true)
		{
			
			if (isset($_POST['first_name']) && !empty($_POST['first_name'])
				&& isset($_POST['last_name']) && !empty($_POST['last_name'])
				&& isset($_POST['username']) && !empty($_POST['username'])
				&& isset($_POST['password']) && !empty($_POST['password'])
				&& isset($_POST['passverif']) && !empty($_POST['passverif'])
				&& isset($_POST['email']) && !empty($_POST['email'])
				&& isset($_POST['lycee']) && !empty($_POST['lycee'])
				&& isset($_POST['classe']) && !empty($_POST['classe']))
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

							$request = $db->prepare('UPDATE users 
														SET first_name = :first_name,
															last_name = :last_name,
															username = :username,
															password = :password, 
															email = :email, 
															lycee = :lycee, 
															classe = :classe,
															home = :home
																WHERE username = :username');

							$datas = $request->fetch();
							$request->execute(
								array(
									'first_name' => $_POST['first_name'],
									'last_name' => $_POST['last_name'],										
									'username' => $_SESSION['username'],
									'password' => $_POST['password'],
									'email' => $_POST['email'],					
									'lycee' => $_POST['lycee'],
									'classe' => $_POST['classe'],
									'home' => 1,
									)
								);

						echo "Vous avez bien modifi&eacute; votre profil.";
						// redirection profil
						$url = 'profil.php?username='.$_SESSION["username"];
						header('Location:' .$url);
						}
						else
						{
							$url = 'profil.php?username='.$_SESSION["username"];
							echo "Les mails ne correspondent pas";
							header('Location:' .$url);
						}	
					}
					else
					{
						$url = 'profil.php?username='.$_SESSION["username"];
						echo "Le mot de passe doit faire plus de 6 caractères";
						header('Location:' .$url);
					}
				}
				else
				{
					$url = 'profil.php?username='.$_SESSION["username"];
					echo "Les mots de passe ne correspondent pas";
					header('Location:' .$url);
				}
			}
			else
			{
				$url = 'profil.php?username='.$_SESSION["username"];
				echo "Remplissez tous les champs";
				header('Location:' .$url);
			}
		}
		else
		{
			$url = 'profil.php?username='.$_SESSION["username"];
			echo "Remplissez tous les champs correctement";
			header('Location:' .$url);
		}
	}

/******************************** 
			VIEW 
********************************/

include 'view/_menu.php';
include 'view/edit_profil.html';
include 'view/_footer.html';