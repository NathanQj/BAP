<?php
ob_start();
chdir("../../../");

include 'config/config.php';
$action 	= isset($_POST['action']) 		? $_POST['action'] : false;
$login 		= isset($_POST['login']) 		? $_POST['login'] : false;
$pwd 		= isset($_POST['password']) 	? $_POST['password'] : false;
$mail 		= isset($_POST['mail']) 		? $_POST['mail'] : false;
$cookie 	= isset($_POST['cookie']) 		? $_POST['cookie'] : false;



if($action=='checkUser')
{
	$access = new userAuthentication($login, $pwd, false);
	if($access->checkLogin())
	{

		if($cookie)
			$t = mktime(0,0,0,date("m") + 1  ,date("d"),date("Y"));
		else
			$t = mktime(0,0,0,date("m") + 1  ,date("d"),date("Y")-1);	
		setcookie('front_login', $login, $t, '/');
		setcookie('front_pwd', $pwd, $t, '/');
		echo 1;

	}
	else
	{
		
		echo 0;

	} 
}
elseif($action=="checkUserFB")
{
	$user = new frontUserAccount();
	if(!$user->checkUnicityFB($_POST['login'])){
		// user already known
		$access = new userAuthentication($login, 'bla', false);

		if($id = $access->checkFBLogin())
		{
			// just update avatar
			$pic = file_get_contents($_POST['picture']);
			file_put_contents("media/profiles/".$id.".jpg", $pic);
			echo 1;
	
		}
		else
		{
			
			echo 0;
	
		} 
	}	else {
			// new user, insert into local table after retrieveing FB data
			unset($_POST['id']);
			unset($_POST['action']);
			unset($_POST['password']);
			unset($_POST['login']);
			$mysql->BeginTrans();
			$user->insertUser($_POST);
			$mysql->CommitTrans();
			$access = new userAuthentication($login, '', false);
			if($id = $access->checkFBLogin())
			{
				$pic = file_get_contents($_POST['picture']);
				file_put_contents("media/profiles/".$id.".jpg", $pic);
				
				
				echo 1;
		
			}
			else
			{
				
				echo 0;
		
			} 
		}
}
if($action=='reloadUser')
{
	$access = new userAuthentication($login, $_SESSION['_frontUserInfo']['s_pwd'], false);
	if($access->checkLogin())
	{
		echo 1;

	}
	else
	{
		echo '0';

	} 
}
else if($action=='checkMail')
{	
	$check = new mailAuthentication($mail);
	$data = $check->checkMail();

	if( $data )
	{

		$mt = new mailTo();
		$mt->mail4forgetId( $data );

		echo 1;

	}else{

		echo 0;

	};
	
}


ob_end_flush();
?>