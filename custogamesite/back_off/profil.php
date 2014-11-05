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
	

/******************************** 
			VIEW 
********************************/
include 'view/_header.html';
include 'view/_menu.html';
include 'view/profil.html';
}
else
{
	echo 'Accès interdit, vous n\'êtes pas administrateur !';
}