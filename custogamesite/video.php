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
}
else
{
	header('Location:login.php');
}
$req = $db->prepare('SELECT * FROM videos WHERE id = :id');
$req->execute(
	array(
		'id' => $_GET['id'],
		)
	);


	$datas = $req->fetch();
		if ($datas['validation'] == 'nope' OR $datas['validation'] == 'En cours'){
			header('Location:login.php');
		}
		else{
/******************************** 
			VIEW 
********************************/

include 'view/_menu.php';
include 'view/video.html';
include 'view/_footer.html';
		}