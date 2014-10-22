<?php

require('config/db.php');
require('config/session.php');

if (isset($_POST['username']) && !empty($_POST['username'])
	&& isset($_POST['password']) && !empty($_POST['password'])
	&& isset($_POST['first_name']) && !empty($_POST['first_name'])
	&& isset($_POST['last_name']) && !empty($_POST['last_name'])
	&& isset($_POST['email']) && !empty($_POST['email'])
	&& isset($_POST['lycee']) && !empty($_POST['lycee'])
	&& isset($_POST['classe']) && !empty($_POST['classe'])
	&& isset($_POST['birthday']) && !empty($_POST['birthday'])){
	
	session_unset();

	$request = $db->prepare('INSERT INTO users (username, password, first_name, last_name, email, lycee, classe, birthday) VALUES (:username, :password, :first_name, :last_name, :email, :lycee, :classe, :birthday)');

	$request->execute(
		array(
			'username' => $_POST['username'],
			'password' => $_POST['password'],
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email'],
			'lycee' => $_POST['lycee'],
			'classe' => $_POST['classe'],			
			'birthday' => $_POST['birthday']
			)
		);

	echo "Inscription réussie";
	// redirection login
	header('Location:login.php');

}

	
?>