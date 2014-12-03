<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');
/******************************** 
      PROCESS 
********************************/

if(isset($_POST) && !empty($_POST)){
	include 'view/uploads_gestion.html';

	$req = $db->prepare('UPDATE videos 
						 SET validation = :validation
						 WHERE id = :id');
	$req->execute(array(
		'validation' => $_POST['validation'],
		'id' => $_GET['id'],
	));
	header('Location: uploads_gestion.php');
}