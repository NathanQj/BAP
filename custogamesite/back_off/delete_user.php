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
	$sql = "DELETE FROM users WHERE id = :id";

			$req = $db->prepare($sql);
			$req->execute(
				array(
				
				'id' => $_GET['id']
					)
				);

			header('Location: users_gestion.php');

			}


/******************************** 
			VIEW 
********************************/


else
{
	echo 'Accès interdit, vous n\'êtes pas administrateur !';
}