<ul class="menu">
	<li class="menu-item home">
		<a href="index.php">Accueil</a>
	</li>
	<li class="menu-item infos <?php echo ((strpos($_SERVER['REQUEST_URI'],'infos.php') != false)?'active':'') ?>">
		<a href="infos.php">Mes infos</a>
	</li>
	<li class="menu-item apprendre <?php echo ((strpos($_SERVER['REQUEST_URI'],'apprendre.php') != false)?'active':'') ?> ">
		<a href="apprendre.php">Apprendre</a>
		<ul class="sub-menu">
			<li class="sub-menu-item"><a href="apprendre.php?classe=seconde">Seconde</a></li>
			<li class="sub-menu-item"><a href="apprendre.php?classe=premiere">Premi&egrave;re</a></li>
			<li class="sub-menu-item"><a href="apprendre.php?classe=terminale">Terminal</a></li>
		</ul>
	</li>
	<li class="menu-item video <?php echo ((strpos($_SERVER['REQUEST_URI'],'videos.php') != false)?'active':'') ?>">
		<a href="videos.php">Mes vid&eacute;os</a>
	</li>
	<li class="menu-item resultats <?php echo ((strpos($_SERVER['REQUEST_URI'],'resultats.php') != false)?'active':'') ?>">
		<a href="resultats.php">r&eacute;sultats</a>
	</li>
</ul>