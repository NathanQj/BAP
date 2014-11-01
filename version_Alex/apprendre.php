<?php
ob_start();

include("config/config.php");
include("modules/mysql/action/mysqlcon.php");
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
		<?php include('head.php'); ?>
	</head>
	<body>
		<div id="contenu">
			<?php include('header.php'); ?>
			<div class="overlay">	
			</div>	
			<div class="abuse" name="abuse">
				<div><a href="javascript:void(0);"><img id="fermeture" src="ressources/images/croix_fermeture.png"></a></div>
				Ce contenu vous semble inapproprié ?<br>
				Merci d'expliquer pourquoi :<br>
				<textarea rows="10" cols="52"></textarea>
				<input type="submit" value="Envoyer">
			</div>
			<div class="main">
				<div class="principal">
					
					<div class="menu-onglets">
						<div class="menu-onglet active" number="1">Custos personnalisés</div>
						<div class="menu-onglet" number="2">Vidéos populaires</div>
						<div class="menu-onglet" number="3">Historique</div>
					</div>
					<div class="onglets">
						<div class="onglet<?php if ( !isset( $_GET[ 'onglet' ] ) ) echo ' active'; ?>" number="1">
							
							<h3>Niveau</h3>
							
							<div class="nav_select">
								<label>Classe
								<div>
									<select class="size" name="Classes" id="classes" size="1">
										<option <?php if ( isset( $_GET[ 'classe' ] ) && 'all' == $_GET[ 'classe' ] ) echo 'selected="selected"'; ?> value="all">Tous les niveaux</option>
										<option <?php if ( isset( $_GET[ 'classe' ] ) && 'seconde' == $_GET[ 'classe' ] ) echo 'selected="selected"'; ?> value="seconde">Seconde</option>
										<option <?php if ( isset( $_GET[ 'classe' ] ) && 'premiere' == $_GET[ 'classe' ] ) echo 'selected="selected"'; ?> value="premiere">Première</option>
										<option <?php if ( isset( $_GET[ 'classe' ] ) && 'terminal' == $_GET[ 'classe' ] ) echo 'selected="selected"'; ?> value="terminal">Terminal</option>
									</select>
								</div>
								</label>
								
								<label>Matières
								<div>
									<select name="Matières" id="matieres" size="1">
										<option <?php if ( isset( $_GET[ 'classe' ] ) && 'all' == $_GET[ 'classe' ] ) echo 'selected="selected"'; ?> value="all">Toutes les matières</option>
										<option <?php if ( isset( $_GET[ 'matiere' ] ) && 'maths' == $_GET[ 'matiere' ] ) echo 'selected="selected"'; ?> value="maths">Maths</option>
										<option <?php if ( isset( $_GET[ 'matiere' ] ) && 'langues' == $_GET[ 'matiere' ] ) echo 'selected="selected"'; ?> value="langues">Français / langues</option>
										<option <?php if ( isset( $_GET[ 'matiere' ] ) && 'physique' == $_GET[ 'matiere' ] ) echo 'selected="selected"'; ?> value="physique">Physique / Chimie / SVT / Technos</option>
									</select>
								</div>
								</label>
							</div>
							<?php if(isset($video_presentation)){ ?>
							<div class="player" video-id="<?php echo $video_presentation->id() ?>" style="position:relative">
								<h3>Dernier custo proposé</h3>
								<div id="player_apprendre">
									<iframe frameborder="0" width="748px" height="421" src="" style="border:1px solid black"></iframe>
<?php
	$video_like = new Video();
	$video_like->setId( $video_presentation->id() );
?>
									<div class="action_video">
										<a href="javascript:void(0);" data-like="1" class="action_like <?php echo ( 1 == $video_like->getLikes( Helper::getUserId() ) ? '' : 'nolike'); ?>" data-id-video="<?php echo $video_presentation->id() ?>">
											<div id="like" class="addmarginright">
												<!--<img src="ressources/images/poucelikevert.png" style="width:24px"/>-->
												J'aime
											</div>
										</a>
										<a href="javascript:void(0);" id="abuse1" class="action_abuse">
											<div class="addmarginright">
												<!--<span style="font-size:10px;">Signaler<br/>un abus</span>-->
												Signaler un abus
											</div>
										</a>
										<a href="javascript:void(0);">
											<div id="partage-facebook" class="addmarginright" style="top:187px">
												<!--<img src="ressources/images/partage_facebook.png" alt="Partager sur Facebook">-->
												Partager
											</div>
										</a>
										<div id="compteur1" class="compteur"><?php echo $video_like->getLikes(); ?></div>
									</div>
								</div>
							</div>
							<?php }?>
					
							<h3>Custo personnalisés à voir</h3>
							<div>
<?php
								if( isset($_GET['classe']) ):
									switch ( $_GET['classe'] ) {
										case 'seconde':
											$niveau = 'Seconde';
											break;
										case 'premiere':
											$niveau = 'Première';
											break;
										case 'terminal':
											$niveau = 'Terminale';
											break;
										default:
											$niveau = 'Tous les niveaux';
											break;
									}
?>
									<span><?php echo $niveau; ?></span>
<?php
								endif;
?>
								<div class="onglet active video_inline" number="1">
									
									<ul class="video_inline">
<?php
foreach ($videos as $key => $video) {
	if($key !== 'count'){
		$title = $video->title();
?>
										<li href="apprendre.php?id=<?php echo $video->id(); ?>">
<?php
		if($video->isSeen()):
?>
											<img src="ressources/images/dejavue.png" class="deja-vue">
<?php
		endif;
?>
											<img src="media/thumbdir/<?php echo $video->id(); ?>.jpg" />
											<h3><?php echo $title; ?></h3>
<?php
		$name = $video->playlistName();
		$meta = $video->groupby();
?>
											<span class="minus"><?php echo $name[0]; ?></span><br>
<?php
		if(strlen($meta)):
?>
											<span><b>niveau <?php echo ucfirst($meta); ?></b></span><br>
<?php
		else:
?>
											<span>Tout niveau</span><br/>
<?php
		endif;
		if($video->getTotalView()<=1):
?>
											<span class="vue"><?php echo $video->getTotalView(); ?> vue</span>
<?php
		elseif($video->getTotalView()>1):
?>
											<span class="vue"><?php echo $video->getTotalView(); ?> vues</span>
<?php
		endif;
?>
											<span class="time"><?php echo $video->durationString(); ?> </span>
											<span class="like"><?php echo $video->getLikes(); ?></span>
										</li>
<?php
	}
}
?>
									</ul>
								</div>
							</div>
					
						</div>
						<div class="onglet video_inline" number="2">
							
							<h3>La préférée du jour</h3>
							
							<?php if(isset($video_presentation_populaire)){ ?>
							<div class="player" video-id="<?php echo $video_presentation_populaire->id() ?>" style="position:relative">
								<div id="player_apprendre">
									<iframe frameborder="0" width="748px" height="421" src="<?php echo $embed_presentation_populaire ?>&preset=538f2bd79473993ac06d39f9" allowfullscreen onclick="alert('toto');"></iframe>
<?php
	$video_like = new Video();
	$video_like->setId( $video_presentation_populaire->id() );
?>
									<div class="action_video">
										<a href="javascript:void(0);" data-like="2" class="action_like <?php echo ( 1 == $video_like->getLikes( Helper::getUserId() ) ? '' : 'nolike'); ?>" data-id-video="<?php echo $video_presentation_populaire->id() ?>">
											<div id="like" class="addmarginright" style="top:455px">
												<!--<img src="ressources/images/poucelikevert.png" style="width:24px"/>-->
												J'aime
											</div>
										</a>
										<a href="javascript:void(0);" id="abuse2" class="action_abuse">
											<div class="addmarginright" style="top:125px">
												<!--<span style="font-size:10px;">Signaler<br/>un abus</span>-->
												Signaler un abus
											</div>
										</a>
										<a href="javascript:void(0);">
											<div id="partage-facebook" class="addmarginright" style="top:187px">
												<!--<img src="ressources/images/partage_facebook.png" alt="Partager sur Facebook">-->
												Partager
											</div>
										</a>
										<div id="compteur2" class="compteur"><?php echo $video_like->getLikes(); ?></div>
									</div>
								</div>
							</div>
							<?php }?>
							
							<h3>Les meilleures vidéos du moment</h3>
							
							<ul class="video_inline" >
<?php 
$chaineCol = array(44=> 'orange', 45 =>'jaune', 47=>'', 42=>'bleu' );
foreach ($videosPopulaire as $key => $video) {
	if($key !== 'count'){
		$pl = $video->playlist();	
		$chaine = $video->playlistName();
		$title = $video->title();
		if(strlen($title) > 21)
			$title = Helper::ellipsis($video->title(), 21);
		if(strlen($chaine[0]) > 21)
			$chaine[0] = Helper::ellipsis($chaine[0], 21);
?>
									<li href="apprendre.php?id=<?php echo $video->id(); ?>" style="font-size:12px">
<?php
		if($video->isSeen()):
?>
										<img src="ressources/images/dejavue.png" class="deja-vue">
<?php
		endif;
?>
										<img src="media/thumbdir/<?php echo $video->id(); ?>.jpg" />
										<h3><?php echo $video->title(); ?></h3>
<?php
		$name = $video->playlistName();
		$meta = $video->groupby();
?>
										<span class="minus"><?php echo $name[0]; ?></span><br>
<?php
		if(strlen($meta)):
?>
										<span><b>niveau <?php echo ucfirst($meta); ?></b></span><br>
<?php
		else:
?>
										<span>Tout niveau</span><br/>
<?php
		endif;
		if($video->getTotalView()<=1):
?>
										<span class="vue"><?php echo $video->getTotalView(); ?> vue</span>
<?php
		elseif($video->getTotalView()>1):
?>
										<span class="vue"><?php echo $video->getTotalView(); ?> vues</span>
<?php
		endif;
?>
										<span class="time"><?php echo $video->durationString(); ?> </span>
										<span class="like"><?php echo $video->getLikes(); ?></span>
									</li>
<?php
	}
}
?>
								</ul>
							</div>
						</div>
						<div class="onglet" number="3">
							
							<h3>La dernière consultée</h3>
							
							<?php if(isset($video_presentation_historique)){ ?>
								
							<div class="player" video-id="<?php echo $video_presentation_historique->id() ?>" style="position:relative">
								<div id="player_apprendre">
									<iframe frameborder="0" width="748px" height="421" src="<?php echo $embed_presentation_historique ?>&preset=538f2bd79473993ac06d39f9" allowfullscreen onclick="alert('toto');"></iframe>
<?php
	$video_like = new Video();
	$video_like->setId( $video_presentation_historique->id() );
?>
									<div class="action_video">
										<a href="javascript:void(0);"  data-like="3" class="action_like <?php echo ( 1 == $video_like->getLikes( Helper::getUserId() ) ? '' : 'nolike'); ?>" data-id-video="<?php echo $video_presentation_historique->id() ?>">
											<div id="like" class="addmarginright" style="top:455px">
												J'aime
											</div>
										</a>
										<a href="javascript:void(0);" id="abuse3" class="action_abuse">
											<div class="addmarginright" style="top:125px">
												<!--<span style="font-size:10px;">Signaler<br/>un abus</span>-->
												Signaler un abus
											</div>
										</a>
										<a href="javascript:void(0);">
											<div id="partage-facebook" class="addmarginright" style="top:187px">
												<!--<img src="ressources/images/partage_facebook.png" alt="Partager sur Facebook">-->
												Partager
											</div>
										</a>
										<div id="compteur3" class="compteur"><?php echo $video_like->getLikes(); ?></div>
									</div>

								</div>
							</div>
							<?php }?>
							
							<h3>Mes vidéos consultées</h3> 
							
							<ul class="video_inline" >
<?php
foreach ($videosHistorique as $key => $video) {
	if($key !== 'count'){
		$pl = $chaine = $video->playlist();	
		$chaine = $video->playlistName();	
		$title = $video->title();
		if(strlen($title) > 21)
			$title = Helper::ellipsis($video->title(), 21);
		if(strlen($chaine[0]) > 21)
			$chaine[0] = Helper::ellipsis($chaine[0], 21);
?>
								<li href="apprendre.php?id=<?php echo $video->id(); ?>" style="font-size:12px">
<?php
		if($video->isSeen()):
?>
									<img src="ressources/images/dejavue.png" class="deja-vue">
<?php
		endif;
?>
									<img src="media/thumbdir/<?php echo $video->id(); ?>.jpg" />
									<h3><?php echo $video->title(); ?></h3>
<?php
		$name = $video->playlistName();
		$meta = $video->groupby();
?>
									<span class="minus"><?php echo $name[0]; ?></span><br>
<?php
		if(strlen($meta)):
?>
									<span><b>niveau <?php echo ucfirst($meta); ?></b></span><br>
<?php
		else:
?>
									<span>Tout niveau</span><br/>
<?php
		endif;
		if($video->getTotalView()<=1):
?>
									<span class="vue"><?php echo $video->getTotalView(); ?> vue</span>
<?php
		elseif($video->getTotalView()>1):
?>
									<span class="vue"><?php echo $video->getTotalView(); ?> vues</span>
<?php
		endif;
?>
									<span class="time"><?php echo $video->durationString(); ?> </span>
									<span class="like"><?php echo $video->getLikes(); ?></span>
								</li>
<?php
	}
}
?>
							</ul>
					
						</div>
					</div>
				
				</div>
			</div>
			<?php include('bottom.php'); ?>
		</div>
		<script type="text/javascript" src="ressources/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
		function gestion_niveau(){
			if ( '' != $('#classes').val() && '' != $('#matieres').val() ){
				window.location = 'apprendre.php?classe='+$('#classes').val()+'&matiere='+$('#matieres').val();
				return true;
			}
		}
		
		$(document).ready(function(){
			// Abuse
			$('#abuse1, #abuse2, #abuse3').click(function(){
				$('.overlay, .abuse').fadeIn(function(){
					$("body").css("overflow", "hidden");
				});
			});
			
			function gestion_overlay(){
				if ( $(window).height() > $(window).width() ){
					$('.overlay').width( $(window).height()+100 );
				} else {
					$('.overlay').width( $(window).width()+100 );
				}
			}
			
			gestion_overlay();
			
			$('.overlay, #fermeture').on("click", function(){
				$('.overlay, .abuse').fadeOut(function(){
					$("body").css("overflow", "auto");
				});
			});
			
			$('#classes').change( function(){ gestion_niveau() } );
			$('#matieres').change( function(){ gestion_niveau() } );
			
			$('.onglet.active').show();
			$('.sidebar .sub-menu-item, .sidebar .menu-item').on("click", function(){
				$('a', $(this))[0].click();
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
			var eventTimeOut;
			// Action like
			
			$('.action_like').each(function() {
				$( this ).click(function(){
					clearTimeout( eventTimeOut );
					element = $( this );
					like = element.hasClass('nolike') ? true : false;
					eventTimeOut = setTimeout( function(){
						$.ajax({
								url: '',
								type: 'POST',
								data: {action: ( like ? 'like' : 'unlike' ), container_id: element.attr('data-id-video')},
								success: function(data){
									if(data == 1){
										if ( like ){
											element.removeClass('nolike');
										} else {
											element.addClass('nolike');
										}
										var nb_like = $('#compteur'+element.attr('data-like')).html();
										chiffre_like = ( like ) ? 1 : -1;
										$('#compteur'+element.attr('data-like')).html( (parseInt(nb_like)+ chiffre_like ) );
									}
								}
						})
					} , 500 )
				});
			});
			
			$('.video-conseillees li[href]').on("click", function(){
				var onglet = '&onglet='+$('.onglet.active').attr('number');
				document.location.href = $(this).attr("href")+ onglet;				
			});
			
			$('.onglet li[href] h3, .onglet li[href] img').on("click", function(){
				var onglet = ($('.onglet.active').attr('number') != 1 ) ? '&onglet='+$('.onglet.active').attr('number') : '';
				document.location.href = $(this).parent().attr("href")+ onglet;
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
			<?php if(isset($_GET['onglet'])){
				echo '$(".menu-onglet[number='.$_GET['onglet'].']").click();';	
			}?>
		});
		</script>
	</body>
</html>