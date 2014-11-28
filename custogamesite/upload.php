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
if (utilisateur_est_connecte()) 
{

				$req = $db->prepare('SELECT * FROM users WHERE username = :username ');
				$req->execute(
					array(
						'username' => $_SESSION['username']
						)
					);
					while ($datas = $req->fetch())
				{ 

					$username = $datas['username']; 

				}


	//si l'utilisateur valide le formulaire
	if(isset($_POST) && !empty($_POST)){

		$dossier = 'upload/';
		$fichier = basename($_FILES['custo']['name']);
		$taille_maxi = 25000000000;
		$taille = filesize($_FILES['custo']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.avi', '.wmv', '.mov', '.h264', '.flv', '.rmvb',);
		$extension = strrchr($_FILES['custo']['name'], '.'); 
		//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
		}
		if($taille>$taille_maxi)
		{
			$erreur = 'Le fichier est trop gros...';
		}
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			//On formate le nom du fichier ici...
			$fichier = strtr($fichier, 
			'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
			if(move_uploaded_file($_FILES['custo']['tmp_name'], $dossier . $fichier)) 
			//Si la fonction renvoie TRUE, c'est que le fichier a bien été envoyé dans le dossier.
			{
				if (isset($_POST['title']) && !empty($_POST['title'])
					&& isset($_POST['description']) && !empty($_POST['description']))
				{				
							$request = $db->prepare('INSERT INTO videos (filename, title, description, date, auteur) 
														VALUES (:filename, :title, :description, now(), :auteur)');

							$request->execute(
								array(
									'filename' => $fichier,
									'title' => $_POST['title'],
									'description' => $_POST['description'],
									'auteur' => $username,
									)
								);
				echo 'Upload effectué avec succès !';
				header('Location:upload.php');
				}
			}
		}
		else
		{
			 echo $erreur;
		}
	}
}
else
{
	header('Location:login.php');
}
/******************************** 
			VIEW 
********************************/

include 'view/_menu.php';
include 'view/upload.html';
include 'view/_footer.html';
