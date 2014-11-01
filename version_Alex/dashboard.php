<?php ob_start();
include("config/config.php");
include("constant.php");
if(!isset($_SESSION['_frontUserInfo']['i_autocode']))
{
	header("location:index.php");
	die();
}


ob_end_flush();
?>
<!Doctype html>
<html>
	<head>
		<?php include("head.php"); ?>
	</head>
	<body>
		<div id="contenu">
			<?php include("header.php"); ?>
			<div class="main">
				<div class="principal">
					<div class="menu-onglets">
						<div class="menu-onglet active" number="1">Mes infos</div>
						<div class="menu-onglet" number="2">Mes résultats</div>
					</div>
					<div class="onglets">
						<div class="onglet active" number="1">
							<div class="voir-infos">
								<span class="modifier">Modifier mon profil</span>
								<div class="general">
									<h3>Mes données</h3>
<?php
									$avatar = __PATH_AVATAR.Helper::getUserId().'.jpg';
									if (is_file( __FRONT_PATH.$avatar ) ):
?>
										<img src="<?php echo $avatar; ?>" class="img-profil">
<?php
									endif;									
?>
									
									<table style="margin-left:0">
										<tr>
											<th>Nom :</th>
											<td>
												<?php print($_SESSION['_frontUserInfo']['s_lastname']); ?>
												<span class="gender <?php print($_SESSION['_frontUserInfo']['s_genre']); ?>"></span>
											</td>
										</tr><tr>
											<th>Pr&eacute;nom :</th>
											<td><?php print($_SESSION['_frontUserInfo']['s_firstname']); ?></td>
										</tr><tr>
											<th>&Acirc;ge : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_age']); ?></td>
										</tr><tr>
											<th>Niveau scolaire : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_nvscolaire']); ?></td>
										</tr><tr>
											<th>Ville : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_city']); ?></td>
										</tr><tr>
											<th>Mail : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_login']); ?></td>
										</tr>
										<?php if ( isset( $_SESSION['_frontUserInfo']['b_facebook'] ) && $_SESSION['_frontUserInfo']['b_facebook'] == '1'): ?>
											<tr>
												<th>Compte facebook : </th>
												<td><b><a target="_blank" href="https://www.facebook.com/<?php echo $_SESSION['_frontUserInfo']['s_pwd']; ?>">https://www.facebook.com/<?php echo $_SESSION['_frontUserInfo']['s_pwd']; ?></a></b></td>
											</tr>
										<?php endif; ?>
										<tr>
											<th>Lacunes : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_lacunes']); ?></td>
										</tr><tr>
											<th>Programme personnalisé : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_programme_personnalise']); ?></td>
										</tr><tr>
											<th>Portfolio : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_portfolio']); ?></td>
										</tr><tr>
											<th>Profil Custorial :</th>
											<td><?php print($_SESSION['_frontUserInfo']['s_profile']); ?></td>
										</tr>
									</table>
								</div>
								<div class="besoins">
									<h3>Mes Besoins</h3>
									<table>
										<tr>
											<th>Lacunes : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_lacunes']); ?></td>
										</tr><tr>
											<th>Programme personnalisé : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_programme_personnalise']); ?></td>
										</tr><tr>
											<th>Portfolio : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_portfolio']); ?></td>
										</tr>
									</table>
								</div>
								<div class="interets">
									<h3>Mes Passions</h3>
									<table>
										<tr>
											<th>Centres d'int&eacute;r&ecirc;t : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_interest']); ?></td>
										</tr><tr>
											<th>Fils de jeux : </th>
											<td><?php print($_SESSION['_frontUserInfo']['s_games']); ?></td>
										</tr>
									</table>
								</div>
								<div class="rewards-info">
									<h3>Mes points</h3>
									<div class="reward-block">
										<div>
											<span>Mes points : </span>
											<span class="reward-count">0</span>
											<span class="reward-count">0</span>
											<span class="reward-count">4</span>
											<span class="reward-count">0</span>
										</div>
									</div>
									<table>
										<tr>
											<th>Nombre de vid&eacute;os post&eacute;es : </th>
											<td>3 vid&eacute;os</td>
										</tr><tr>
											<th>Nombre de vid&eacute;os vues : </th>
											<td>17 vid&eacute;os</td>
										</tr>
									</table>
								</div>
								<div class="thematique">
									<h3>Mes consultations</h3>
									<img src="ressources/images/thematique.png">
								</div>
								<div class="apprentissage">
									<h3>Temps d'apprentissage</h3>
									<div class="selecteur-apprentissage">
										<p>
											<span class="active" value="jour">par jour</span>
											/
											<span value="semaine">par semaine</span>
											/
											<span value="mois">par mois</span>
										</p>
									</div>
									<div class="imgs-apprentissage">
										<img src="ressources/images/japprentissage.png" value="jour">
										<img src="ressources/images/sapprentissage.png" value="semaine">
										<img src="ressources/images/mapprentissage.png" value="mois">
									</div>
								</div>
							</div>
							<div class="modifier-infos">
								<form class="visibility" id="avatar_form" action="<?php echo __FRONT_URL; ?>modules/frontuser/action/uploadface.php" target="uploadFrame" method="post" enctype="multipart/form-data">
									<input type="file" name="avatar_file" id="avatar_file" onchange="uploadAvatar();">
									<iframe id="uploadFrame" name="uploadFrame" src="#"></iframe>
								</form>
								<input type="hidden" id="resultUploadAvatar" value="" onchange="affichageAvatar();">
								<input type="hidden" name="errorAvatar" id="errorAvatar">
								<input type="hidden" id="pathUploadAvatar" value="">
								<input type="hidden" id="absolutePathUploadAvatar" name="absolutePathUploadAvatar" value="">

								<form name="infos">
									<input type="reset" value="Annuler" id="annuler">
									<input type="submit">
									<div class="general">
										<h3>Mes données</h3>
										
<?php
										$avatar = __PATH_AVATAR.Helper::getUserId().'.jpg';
										if (!is_file( __FRONT_PATH.$avatar ) ):
											$avatar = sprintf( AVATAR_DEFAULT, 128);
										endif;
?>
										<a href="#"><img id="modifier-avatar" src="<?php echo $avatar; ?>" class="img-profil" onclick="addAvatar();"></a>
										<div id="libelle_error_avatar" class="error"></div>
				
										<table>
											<tr>
												<th>Nom :</th>
												<td>
													<input type="text" value="<?php print($_SESSION['_frontUserInfo']['s_lastname']) ?>" name="s_lastname">
													<span class="gender male"><input type="radio" name="s_genre" value="male" <?php print(($_SESSION['_frontUserInfo']['s_genre'] == "male")?'checked': ''); ?>></span>
													<span class="gender female"><input type="radio" name="s_genre" value="female" <?php print(($_SESSION['_frontUserInfo']['s_genre'] == "female")?'checked': ''); ?>></span>
												</td>
											</tr><tr>
												<th>Pr&eacute;nom :</th>
												<td><input type="text" value="<?php print($_SESSION['_frontUserInfo']['s_firstname']); ?>" name="s_firstname"></td>
											</tr><tr>
												<th>&Acirc;ge : </th>
												<td><input type="number" min="1" value="<?php print($_SESSION['_frontUserInfo']['s_age']); ?>" name="s_age"></td>
											</tr><tr>
												<th>Niveau scolaire : </th>
												<td>
													<select name="s_nvscolaire">
														<option value=""></option>
														<option value="seconde" <?php echo ( ( $_SESSION['_frontUserInfo']['s_nvscolaire'] == "seconde") ? 'selected="selected"' : '') ;?>>Seconde</option>
														<option value="première" <?php echo ( ( $_SESSION['_frontUserInfo']['s_nvscolaire'] == "première") ? 'selected="selected"' : '') ;?>>Première</option>
														<option value="terminale" <?php echo ( ( $_SESSION['_frontUserInfo']['s_nvscolaire'] == "terminale") ? 'selected="selected"' : '') ;?>>Terminale</option>
													</select>
												</td>
											</tr><tr>
												<th>Ville :</th>
												<td><input type="text" value="<?php print($_SESSION['_frontUserInfo']['s_city']); ?>" name="s_city"></td>
											</tr><tr>
												<th>Mail :</th>
												<td><input type="text" value="<?php print($_SESSION['_frontUserInfo']['s_login']); ?>" name="s_login"></td>
											</tr>
											<?php if ( isset( $_SESSION['_frontUserInfo']['b_facebook'] ) && $_SESSION['_frontUserInfo']['b_facebook'] == '1'): ?> 
											<tr>
												<th>Compte facebook :</th>
												<td><b><a target="_blank" href="https://www.facebook.com/<?php echo $_SESSION['_frontUserInfo']['s_pwd']; ?>">https://www.facebook.com/<?php echo $_SESSION['_frontUserInfo']['s_pwd']; ?></a></b></td>
											</tr>
											<?php endif; ?>
										</table>
									</div>
									
									<div class="besoins">
										<h3>Mes Besoins</h3>
										<span>Lacunes : </span>
										<textarea name="s_lacunes"><?php print($_SESSION['_frontUserInfo']['s_lacunes']); ?></textarea>
										<span>Programme personnalisé : </span>
										<textarea name="s_programme_personnalise"><?php print($_SESSION['_frontUserInfo']['s_programme_personnalise']); ?></textarea>
										<span>Portfolio : </span>
										<textarea name="s_portfolio"><?php print($_SESSION['_frontUserInfo']['s_portfolio']); ?></textarea>
									</div>
									
									<div class="interets">
										<h3>Mes passions</h3>
										<span>Centres d'int&eacute;r&ecirc;t : </span>
										<textarea name="s_interest"><?php print($_SESSION['_frontUserInfo']['s_interest']); ?></textarea>
										<span>Fils de jeux : </span>
										<textarea name="s_games"><?php print($_SESSION['_frontUserInfo']['s_games']); ?></textarea>
									</div>
								</form>
							</div>
						</div>
						<div class="onglet" number="2">
							<div class="resultat">
								<div class="qcm-infos">
									<p><b>Nom du QCM</b></p>
									<p class="orange">Maths</p>
									<p>Note obtenue : <span>C</span></p>
									<p>Nombre de fautes : <b>10 fautes</b></p>
									<p>Temps : <b>08:00</b></p>
								</div>
								<img src="ressources/images/resultat1.png">
							</div>
							<div class="resultat">
								<div class="qcm-infos">
									<p><b>Nom du QCM</b></p>
									<p class="jaune">Fran&ccedil;ais / Langues</p>
									<p>Note obtenue : <span>B+</span></p>
									<p>Nombre de fautes : <b>4 fautes</b></p>
									<p>Temps : <b>06:40</b></p>
								</div>
								<img src="ressources/images/resultat2.png">
							</div>
							<div class="resultat">
								<div class="qcm-infos">
									<p><b>Nom du QCM</b></p>
									<p class="bleu">Physique / Chimie / SVT /Technos</p>
									<p>Note obtenue : <span>B+</span></p>
									<p>Nombre de fautes : <b>4 fautes</b></p>
									<p>Temps : <b>06:40</b></p>
								</div>
								<img src="ressources/images/resultat3.png">
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include('bottom.php'); ?>
		</div>
		<script type="text/javascript" src="ressources/js/jquery-1.11.1.min.js"></script>
		<script>
		
		function addAvatar(){
			$('#avatar_file').click();
		}
		
		function uploadAvatar(){
			$('#avatar_form').submit();
		}
		
		function affichageAvatar(){
			if ( 0 == $('#resultUploadAvatar').val() ){
				switch( $('#errorAvatar').val() ){
					case 'taille_photo':
						$('#libelle_error_avatar').html('Le poids de votre photo ne doit pas dépasser 1 Mo.');
					break;
					case 'format_photo':
						$('#libelle_error_avatar').html('Votre avatar doit être au format jpg, png ou gif.');
					break;
					default:
						$('#libelle_error_avatar').html('Une erreur est survenue pendant le transfert de la photo.');
					break;
				}
				$('#libelle_error_avatar').show();
			} else if ( 1 == $('#resultUploadAvatar').val() ){
				$('#libelle_error_avatar').html( '' );
				$('#libelle_error_avatar').hide();
				$('#modifier-avatar').attr('src',$('#absolutePathUploadAvatar').val());
			}
		}
		
		$(document).ready(function(){
			$('.imgs-apprentissage img').first().show();
			$('.onglet.active').show();
			$('.sidebar .sub-menu-item, .sidebar .menu-item').on("click", function(){
				$('a', this)[0].click();
			});

			$('.menu-onglet').on("click", function(){
				if($('.onglet.active').attr('number') != $(this).attr('number')){
					$('.menu-onglet.active').removeClass('active');
					current = $('.onglet.active');
					next = $('.onglet[number=' + $(this).attr('number') +']');
					$(current).fadeOut("slow", function(){
						$(next).fadeIn("slow");
					});
					$(current).removeClass('active');
					$(next,this).addClass('active');
					$(this).addClass('active');					
				}
			});
			
			$('.modifier').on("click", function(){
				
				$('.voir-infos').fadeOut("slow", function(){
					
					$('.modifier-infos').fadeIn("slow");
				});
			});

			$('.selecteur-apprentissage span').on("click", function(){
				if($('.selecteur-apprentissage span.active').attr('value') != $(this).attr('value')){
					that=$(this);
					$('.imgs-apprentissage img[value=' + $('.selecteur-apprentissage span.active').attr('value') +']').fadeOut("fast", function(){
						$('.imgs-apprentissage img[value=' + $(that).attr("value") +']').fadeIn("fast");
						$('.selecteur-apprentissage span.active').removeClass('active');
						$(that).addClass('active');		
					});

				}
			});

			$('.nvscolaire').on("click", function(){
				$('.nvscolaire.active').removeClass("active");
				$('input[name=nvscolaire]').val($(this).text());
				$(this).addClass("active");
			});
			
			var timeOut ="";
			$('.menu-item.apprendre').on("mouseover",function(){
				$('.sub-menu', this).slideDown();
				clearTimeout(timeOut);
			});
			
			$('.menu-item.apprendre').on("mouseout",function(){
				that = this;
				timeOut = setTimeout(function(){$('.sub-menu', that).slideUp()}, 3000);
			});
			
			$('#annuler').click(function(){
				document.location.href = "dashboard.php";
			});
			
			$('form[name=infos]').on("submit",function(){
				that = this;
				
				data =$(this).serializeArray();
				data.push({name: "action", value:"update"});
				data.push({name:"id", value:"<?php print(Helper::getUserId()); ?>"});
				$.ajax({
					url: 'modules/frontuser/action/actions.php',
					type: "POST",
					data: data,
					success: function(data){
						if(data == 1){
							$.ajax({
								url: 'modules/login/action/actions.php', 
								type: 'POST', 
								data: {action: 'reloadUser', login: $('[name=s_login]',that).val()},
								success: function(){
									document.location.href = "dashboard.php"
								}
							});
						
						}
					}
				});
				return false;
			})
		});
		</script>
	</body>
</html>