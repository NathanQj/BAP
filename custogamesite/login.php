<?php

require('config/db.php');
require('config/session.php');

if (isset($_POST['username']) && !empty($_POST['username'])
	&& isset($_POST['password']) && !empty($_POST['password'])){

		// on détruit les variables de session qui ont pu être créees auparavent
	session_unset();

	// on ne sélectionne que les personnes dont le username
	// correspond à celui qui a été entré dans le formulaire
	$request = $db->prepare('SELECT id, username, password FROM author WHERE username=:username');
	

	$request->execute(
		array(
			'username' => $_POST['username'])
		);		

	
	while ($data = $request->fetch()){
		// password entré = password BDD
		if ($data['password'] == $_POST['password']){
			// on remplit des variables de session qui concernent l'user connecté
			$_SESSION['id_user'] = $data['id'];
			$_SESSION['username_user'] = $data['username'];

			// redirection page d'accueil
			header('Location:index.php');
		}
	}

	$request->closeCursor();

	// if : username ou pass incorrect
	echo 'Pseudo et/ou mot de passe incorrects';
}
?>

<form action="login.php" method="post">
	<input type="text" name="username" placeholder="Pseudo"><br/>
	<input type="password" name="password" placeholder="Password"><br/>
	<input type="submit" value="Connexion" />
</form>