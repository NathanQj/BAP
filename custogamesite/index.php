<?php

/******************************** 
	 DATABASE & FUNCTIONS 
********************************/
require('config/config.php');
require('config/session.php');
/******************************** 
			PROCESS 
********************************/
//On affiche un message de bienvenue, si lutilisateur est connecte, on affiche son pseudo
?>
Bonjour<?php if(isset($_SESSION['username']))
{
	echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
}
?>,<br />
Bienvenue sur le site du CustoGame.<br />
<?php



/******************************** 
			VIEW 
********************************/
include 'view/head.html';

include 'view/_menu.php';


include 'view/index.html';


include 'view/_footer.html';