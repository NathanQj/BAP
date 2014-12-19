<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');
/******************************** 
      PROCESS 
********************************/
if(user_is_admin()){
	if(isset($_POST) && !empty($_POST)){
		include 'view/uploads_gestion.html';

		$sql = "SELECT * FROM videos"; 

		$request = $db->prepare($sql); 
		$request->execute(); 

		$result = $request->fetchAll(PDO::FETCH_ASSOC);

		$req = $db->prepare('UPDATE videos 
							 SET validation = :validation
							 WHERE id = :id');
		$req->execute(array(
			'validation' => $_POST['validation'],
			'id' => $_GET['id'],
		));

	}
	header('Location: uploads_gestion.php');
}