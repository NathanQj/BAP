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
/******************************** 
			VIEW 
********************************/

include 'view/_menu.php';
include 'view/video.html';
include 'view/_footer.html';