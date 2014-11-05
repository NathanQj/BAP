<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');
/******************************** 
			PROCESS 
********************************/
if (utilisateur_est_connecte()) 
{
	if ($_FILES['icone']['error'] > 0) $erreur = "Erreur lors du transfert";
	
	if ($_FILES['icone']['size'] > $maxsize) $erreur = "Le fichier est trop gros";
	
	$extensions_valides = array( 'mp4' , 'avi' , 'mkv' , 'mpg' );
	//1. strrchr renvoie l'extension avec le point (« . »).
	//2. substr(chaine,1) ignore le premier caractère de chaine.
	//3. strtolower met l'extension en minuscules.
	$extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
	
	if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";
	$image_sizes = getimagesize($_FILES['icone']['tmp_name']);
	
	if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";

}
else
{
	header('Location:login.php');
}
/******************************** 
			VIEW 
********************************/
include 'view/_head.html';
include 'view/_menu.php';
include 'view/upload.html';
include 'view/_footer.html';
