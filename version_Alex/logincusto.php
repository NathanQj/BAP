<?php
ob_start();

if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], "index.php") && isset($_POST['email']) && isset($_POST['pass'])){
		//traitement php connection
		
		$db = new PDO('mysql:host='.zbSERVER.';dbname='.zbDB, zbLOGIN, zbPWD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$requete = $db->prepare('SELECT * FROM custuser WHERE s_email = :email AND s_pass = :pass');
		$requete->bindValue(':email', $_POST['email']);
		$requete->bindValue(':pass', $_POST['pass']);
		
		
		$requete->execute();
		
		$user = $requete->fetch();
		
		if (isset($user[0])){
						$_SESSION['cuser_id'] = ((strlen($user['i_autocode']) != 0)?$user['i_autocode']:'');
			$_SESSION['cfirstname'] = ((strlen($user['s_firstname']) != 0)?$user['s_firstname']:'');
			$_SESSION['clastname'] = ((strlen($user['s_lastname']) != 0)?$user['s_lastname']:'');
			$_SESSION['cemail'] = ((strlen($user['s_email']) != 0)?$user['s_email']:'');
			$_SESSION['cage'] = ((strlen($user['s_age']) != 0)?$user['s_age']:'');
			$_SESSION['cprofil'] = ((strlen($user['s_profile']) != 0)?$user['s_profile']:'');
			$_SESSION['cfaible'] = ((strlen($user['s_pointfaible']) != 0)?$user['s_pointfaible']:'');
			$_SESSION['cfort'] = ((strlen($user['s_pointfort']) != 0)?$user['s_pointfort']:'')  ;
			$_SESSION['cinterest'] = ((strlen($user['s_interest']) != 0)?$user['s_interest']:'');
			$_SESSION['cgames'] = ((strlen($user['s_games']) != 0)?$user['s_games']:'');
		} else {
			$_SESSION['error'] = 'fail';
			$_SESSION['email'] = $_POST['email'];
			header('Location: index.php');
		}
		
		//données de base
		/*$_SESSION['cuser_id'] = 1;
		$_SESSION['cfirstname'] = 'Pierre';
		$_SESSION['clastname'] = 'Dupond';
		$_SESSION['cemail'] = 'pierre@gmail.com';
		$_SESSION['cage'] = '16';
		$_SESSION['cprofil'] = 'CONCEPTUEL';
		$_SESSION['cfaible'] = '42';
		$_SESSION['cfort'] = '34';
		$_SESSION['cinterest'] = 'facebook';
		$_SESSION['cgames'] = 'DrawSomething';
		 
		 */
}elseif(!strpos($_SERVER['REQUEST_URI'], 'index.php')){
 if (!isset($_SESSION['cuser_id'])) {
		header('Location: index.php');
	}
}
?>