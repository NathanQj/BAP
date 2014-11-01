<?php
	$t = mktime(0,0,0,date("m") + 1  ,date("d"),date("Y")-1);
	setcookie('front_login', '', $t, '/');
	setcookie('front_pwd', '', $t, '/');
	
	session_start();
	session_destroy();
	header('Location: index.php');
?>