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

/******************************** 
			VIEW 
********************************/
include 'view/report.html';
include 'view/_footer.html';
}
else
{
	header('Location: index.php');
}
?>