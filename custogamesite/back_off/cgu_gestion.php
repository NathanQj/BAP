<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session_admin.php');

/******************************** 
			PROCESS 
********************************/

if(user_is_admin()){
	
	//si l'utilisateur valide le formulaire
	if(isset($_POST) && !empty($_POST))
	{
		if (isset($_POST['content']) && !empty($_POST['content']))
		{
			$request = $db->prepare('UPDATE cgu 
										SET content = :content');
			$request->execute(
				array(
					'content' => $_POST['content'],
					)
				);
		echo "Vous avez bien modifi&eacute; les CGU.";
		// redirection profil
		header('Location:cgu.php');
		}
	else
	{
		echo "Remplissez le champ correctement";
	}
}
	
/******************************** 
			VIEW 
********************************/
include 'view/_header.html';
include 'view/_menu.html';
include 'view/cgu_gestion.html';
}
else
{
	echo 'Accès interdit, vous n\'êtes pas administrateur !';
}