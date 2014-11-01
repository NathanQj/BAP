<?php
include("config/config.php");
if(!isset($_SESSION['_frontUserInfo']['i_autocode']))
{
	header("location:index.php");
	die();
}


if(isset($_POST['id'])){
	
}else{
	header('Location: index.php');
}
