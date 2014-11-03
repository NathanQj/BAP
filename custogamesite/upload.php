<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');
/******************************** 
			PROCESS 
********************************/
if (!utilisateur_est_connecte()) {
	header('Location:register.php');
}
else{
	// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
	if (isset($_FILES['custo']) AND $_FILES['custo']['error'] == 0){
		// Testons si le fichier n'est pas trop gros
		if ($_FILES['custo']['size'] <= 1000000)
		{
			$infosfichier = pathinfo($_FILES['custo']['name']);
			$extension_upload = $infosfichier['extension'];
			$extensions_autorisees = array('mov', 'mpeg4', 'mp4', 'avi', 'wmv', 'mpegps', 'flv', '3gpp', 'webm');
			if (in_array($extension_upload, $extensions_autorisees))
			{
				// On peut valider le fichier et le stocker définitivement
				move_uploaded_file($_FILES['custo']['tmp_name'], 'uploads/videos' . basename($_FILES['custo']['name']));
				echo "L'envoi a bien été effectué !";                
			}
			else
			{
				echo "L\'extension du fichier n'est pas acceptée";
			}
		}
		else
		{
			echo "Le fichier est trop lourd";
		}
	}
}
/******************************** 
			VIEW 
********************************/
include 'view/head.html';
include 'view/_menu.php';
include 'view/upload.html';
include 'view/_footer.html';