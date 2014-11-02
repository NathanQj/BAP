	<nav id="menu">
		<div class="container">
			<ul>
				<li>
					<a href="index.php">Accueil</a>
				</li>
				<li>
					<a href="discover.php">Decouvrir</a>
				</li>
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
				<li>
					<a href="profil.php?<?php echo $datas['username']; ?>">Profil</a>
				</li>
				<li>
					<a href="upload.php">Publier une vidéo</a>
				</li>
				<?php 
					}
				}else{ ?>
				<li>
					<a href="register.php">Inscription</a>
				</li>
				<li>
					<a href="login.php">Se connecter</a>
				</li>
				<?php } ?>
				<li>
					<a href="contact.php">Contact</a>
				</li>
				<?php if(user_is_admin()){ ?>
				<li>
					<a href="back_off">Accès au back office</a>
				</li>					
				<?php }

				?>
			</ul>
		</div><!-- end .container -->
	</nav><!-- end #menu -->

	<form action="#" method="post" accept-charset="utf-8">
		<input type="text" name="recherche" value="" placeholder="Recherche...">
	</form>
	
