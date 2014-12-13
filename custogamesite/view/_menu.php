	<a href="index.php">
		<div id="header">
			<img src="view/img/logo.png" id="logo" alt='logo'>
			<img src="view/img/header/custogame.png" id="custogame" alt="custogame">
			<?php 
				if(isset($_SESSION['username']) && !empty($_SESSION['username'])){?> 
			<div  class="disconnect">
				<a href="profil.php?username=<?php  echo $_SESSION['username']; ?>"><?php  echo $_SESSION['username']; ?></a>
				<br/>
				<a href="logout.php">Déconnexion</a>
			</div>
			<?php }?>
		</div><!-- !#header -->
	</a>
	<nav id="menu">
		<ul>
			<a href="index.php"><li>Accueil</li></a>
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
			<a href="profil.php?username=<?php echo $datas['username']; ?>"><li>Profil</li></a>
			<a href="upload.php"><li>Publier une vidéo</li></a>
			<?php 
				}
			}else{ ?>
			<a href="register.php"><li>Inscription</li></a>
			<a href="login.php"><li>Se connecter</li></a>
			<?php } ?>
			<a href="lots.php"><li>Lots</li></a>
			<a href="discover.php"><li>Decouvrir</li></a>
			<a href="contact.php"><li>Contact</li></a>
			<?php if(user_is_admin()){ ?>
			<a href="back_off"><li>Accès au back office</li></a>		
			<?php }

			?>
		</ul>
	</nav><!-- end #menu -->