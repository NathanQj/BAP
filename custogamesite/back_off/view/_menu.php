	<div id="header">
			<a href="logout.php">Déconnexion</a><br/>
	</div><!-- !#header -->
	<nav id="menu">
		<ul>
			<a href="index.php">Accueil</a><br/>
			<?php if (utilisateur_est_connecte()) { 

				$req = $db->prepare('SELECT * FROM users WHERE username = :username ');
				$req->execute(
					array(
						'username' => $_SESSION['username']
						)
					);
					while ($datas = $req->fetch())
				{ 
				?>
			<a href="profil.php?<?php echo $datas['username']; ?>">Profil</a><br/>
			<a href="upload.php">Publier une vidéo</a><br/>
			<?php 
				}
			}else{ ?>
			<a href="register.php">Inscription</a><br/>
			<a href="login.php">Se connecter</a><br/>
			<?php } ?>
			<a href="lots.php">Lots</a><br/>
			<a href="discover.php">Decouvrir</a><br/>
			<a href="contact.php">Contact</a><br/>
			<?php if(user_is_admin()){ ?>
			<a href="../">Accès au Front Office</a><br/>		
			<?php }

			?>
		</ul>
	</nav><!-- end #menu -->

<!-- 	
	<form action="#" method="post" accept-charset="utf-8">
		<input type="text" name="recherche" value="" placeholder="Recherche...">
	</form>
-->
