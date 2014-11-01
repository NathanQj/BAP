<?php
ob_start();
include("config/config.php");

$msg = '';
if(isset($_POST['login']) && isset($_POST['pwd']))
{
	$login 	= isset($_POST['login']) ? $_POST['login'] : false;
	$pwd 	= isset($_POST['pwd']) ? $_POST['pwd'] : false;	
	
	if($login=='custorial' && $pwd=='custorial')
	{
		$_SESSION['accessGranted'] = true;
		header("location:login.php");
		die();
	}
	else {
		$msg = "Identification non reconnue";
		
	}
}
?>
<!Doctype html>
<html>
	<head>
		<title>Custorial - Accès privé</title>
		<link rel="stylesheet" type="text/css" href="ressources/css/style.css">
		<link rel="icon" type="image/png" href="ressources/images/favicon.png">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<style>
			body {background:white}
			.modifier-infos label {width:200px!important}
		</style>
		<script>
		$(document).ready(function(){
			$('input[type="submit"]').click(function(){
				if($('input[name="login"]').val()=='' || $('input[name="pwd"]').val()=='')
				{
					$('#msg').hide().html("Identification non reconnue").fadeIn();
					return false;
				}
			});
			
		});
		</script>
	<body>
		<div style="width:270px;margin:auto;margin-top:15%">
			<img  src="ressources/images/logo.png" />
			<div style="width:100%;height:50px"></div>
			<form class="modifier-infos" style="display:block;clear:both;width:100%;text-align:left" action="checkaccess.php" method="POST"> 
				<div style="float:left;margin-top:3px">Identifiant</div>
				<input type="text" name="login" value="" placeholder="Votre identifiant" style="float:right;height:20px"/><br/>
				<div style="width:100%;height:7px;clear:both"></div>
				<div style="float:left;margin-top:3px">Mot de passe</div>
				<input type="text" name="pwd" value="" placeholder="Votre mot de passe" style="float:right;height:20px" /><br/>
				<div style="width:100%;height:25px;clear:both"></div>
				<div style="margin:auto;width:128px">
				<input type="submit" value="Envoyer"  />
				</div>
				<div style="width:100%;height:15px;clear:both"></div>
				<div style="font-size:14px;color:#25b6ae;text-align: right" id="msg" ><?php echo $msg ?></div>
			</form>
		</div>
	</body>
</html> 