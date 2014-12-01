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
					$auteur_id = $datas['id'];

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
include 'view/post_upload.html';
include 'view/_footer.html';