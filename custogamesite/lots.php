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
$clsmnt1 = SelectUsersFromClassement_1($db);
$clsmnt2 = SelectUsersFromClassement_2($db);
$clsmnt3 = SelectUsersFromClassement_3($db); 
$clsmnt47 = SelectUsersFromClassement_47($db); 
/******************************** 
			VIEW 
********************************/
include 'view/_menu.php';
include 'view/lots.html';
include 'view/_footer.html';