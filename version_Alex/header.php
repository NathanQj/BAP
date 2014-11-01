
<div class="header">
	<a href="home.php">
		<img class="logo" src="ressources/images/logo.png" />
	</a>
	<div class="citation">"Celui qui connaît sa propre valeur réussit toujours"</div>
	<div class="citation citation_signature">Proverbe oriental</div>
	<div class="reward-block">
		<div>
			<span>Mes Points : </span>
			<span class="reward-count">0</span>
			<span class="reward-count">0</span>
			<span class="reward-count">4</span>
			<span class="reward-count">0</span>
		</div>
	</div>
	<div class="search">
		<img class="loupe" src="ressources/images/loupe.png" />
		<form name="search" action="search.php" method="post" onsubmit="return false">
			<input type="text" placeholder="Rechercher un custo" name="search_text" disabled="disabled"/>
			<input type="submit" value="OK" />
		</form>
	</div>
	<div class="header-profil">
		<a id="changeProfile" href="dashboard.php" title="Modifier mon profil">
		<?php if(file_exists('media/profiles/'.Helper::getUserId().'.jpg')): ?>
		<img class="profil" src="media/profiles/<?php echo Helper::getUserId().".jpg" ?>"/>
		<?php else: ?>
		<img class="profil" src="https://cdn4.iconfinder.com/data/icons/avatar-and-user/86/Avatar_person_user_character_man_woman_human-04-64.png"/>
		<?php endif ?>	
		</a>
		<p>Bienvenue <?php echo $_SESSION['_frontUserInfo']['s_firstname'] ?><br/><a href="logout.php">D&eacute;connexion</a></p>
	</div>
</div>
<div class="nav">
	<ul>
		<li class="menu"><a href="index.php" class="<?php if ( strrpos( $_SERVER['PHP_SELF'], 'index.php') ) echo 'menu_actif'; ?>">Accueil</a></li><li class="menu"><a href="apprendre.php" class="<?php if ( strrpos( $_SERVER['PHP_SELF'], 'apprendre.php') ) echo 'menu_actif'; ?>">Apprendre</a></li><li class="menu"><a href="transmettre.php" class="<?php if ( strrpos( $_SERVER['PHP_SELF'], 'transmettre.php') ) echo 'menu_actif'; ?>">Transmettre</a></li><li class="menu"><a href="dashboard.php" class="<?php if ( strrpos( $_SERVER['PHP_SELF'], 'dashboard.php') ) echo 'menu_actif'; ?>">Dashboard</a></li>
	</ul>
</div>
<script>
	$(document).ready(function(){
		
		$('#like').click(function(){
			
		});
		$('#abuse').click(function(){
			
		});
	});
	
</script>
