<?php
ob_start();
include("config/config.php");
include("constant.php");
if(!isset($_SESSION['_frontUserInfo']['i_autocode']))
{
	header("location:login.php");
	die();
}
ob_end_flush();

//preparation des videos 

?>
<!Doctype html>
<html>
	<head>
		<?php include('head.php'); ?>
	</head>
	<body>
		<div id="contenu">
			<?php include('header.php'); ?>
			<div class="main">
				<div class="col1">
					<div class="teaser">
						<h3>À la une</h3>
						<!--embed dailymotion-->
						<iframe width="540" scrolling="no" height="315" frameborder="0" src="" style="border:1px solid black"></iframe>
						
					</div>
					<div class="apprendre">
						<div class="content">
							<a href="apprendre.php">
								<h2>Apprendre</h2>
								<span class="profil-incomplet">Profite des vidéos tutos de tes amis pour te mettre à niveau<br>à ton rythme.<br></span>
							</a>
						</div>
					</div>
					<div class="create">
						<div class="content">
							<a href="transmettre.php">
								<h2>Transmettre</h2>
								<span class="profil-incomplet">Crée des vidéos tutos, partage-les, et gagne des points.</span>
							</a>
						</div>
					</div>
					<div class="infos">
						<div class="content">
							<a href="dashboard.php">
								<h2>Dashboard</h2>
								<span class="profil-incomplet">Consulte tes résultats et ton profil.<br></span>
							</a>
						</div>
					</div>
				</div>
				<div class="col2">
					<div class="profils">
						<h3>Mes amis custorials</h3>
						<ul>
							<?php
							$pseudo = array(	
	"Emma",	
	"Chloé",								
	"Nathan",
	"Camille",
	"Lucas",
	"Enzo",
	"Leo",
	"Sarah",
	"Manon",
	"Hugo",
	"Jade",
	"Gabriel",
	"Ethan",
	"Mathis",
	"Jules",
	);
							?>
							<?php for($i=1; $i < 15; $i++): ?>
							<li>
								<img src="media/connected/<?php echo $i ?>.jpg" /> 
								<p><?php echo $pseudo[$i-1] ?></p>
							</li>
							<?php endfor ?>
							<li>
								<img src="ressources/images/profils.png" /> 
								<p>Jules</p>
							</li>
						</ul>
					</div>
					<div class="partage_points">
						<div class="partage_points_content">	
							<h2>Gagne des points</h2>
							<div>
								<img src="ressources/images/fnac.png" width="50px" height="50px"/>
								<img src="ressources/images/logo_micromania.png" width="81px" height="50px"/>
								<img src="ressources/images/640px-decathlon-logo.png" width="103px" height="30px"/>
								<img src="ressources/images/Logo_mcdo.png" width="55px" height="50px"/>
								<img src="ressources/images/infos-inactif.png" width="97px" height="50px"/>
							</div>
							<ul>
								<li><span>10 000</span> points, la custobox Fnac</li>
								<li><span>7000</span> points, la custobox Micromania</li>
								<li><span>1000</span> points, la custobox Décathlon</li>
								<li><span>500</span> points, la custobox Mc Donald</li>
								<li><span>100</span> points, la custobox Gaumont</li>
							</ul>
						</div>
					</div>
					<!-- <div class="likeus">					
						<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FFacebookDevelopers&amp;width&amp;height=210&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px;height:210px;" allowTransparency="true"></iframe>
					</div> -->
				</div>
				<div class="populaire">
					<h3>Vid&eacute;os populaires</h3>
					<ul class="inline-video" >
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
						<li href="apprendre.php?onglet=2&id=<?php echo $video->id(); ?>" style="font-size:12px"> <img src="media/thumbdir/<?php echo $video->id(); ?>.jpg" />
							<p title="<?php echo $video->title(); ?>">
								<span class="videoHomeTitle"><?php echo $title; ?></span><br>
								<span><?php echo $chaine[0]; ?></span><br/>
								<div class="content_vu_like">
	<?php
			if($video->getTotalView()<=1):
	?>
									<span class="vu"><?php echo $video->getTotalView(); ?> vue</span>
	<?php
			elseif($video->getTotalView()>1):
	?>
									<span class="vu"><?php echo $video->getTotalView(); ?> vues</span>
	<?php
			endif;
	?>
									<span style="float:right"> <img src="ressources/images/like.png"  style="width:14px;height:14px;border:0;margin-right:2px"/><?php echo $video->getLikes();?></span>
								</div>
							</p>
						</li>
	<?php
		}
	}
	?>
					</ul>
				</div>
					
				<div class="historique">
					<h3>Historique</h3>
					<ul class="inline-video">
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
						<li href="apprendre.php?onglet=3&id=<?php echo $video->id(); ?>" style="font-size:12px"> <img src="media/thumbdir/<?php echo $video->id(); ?>.jpg" />
							<p title="<?php echo $video->title(); ?>">
								<span class="videoHomeTitle"><?php echo $title; ?></span><br>
								<span><?php echo $chaine[0]; ?></span><br/>
								<div class="content_vu_like">
	<?php 
			if($video->getTotalView()<=1):
									//. $video->getTotalView(). ' nombre de vues');
	?>
									<span class="vu"><?php echo $video->getTotalView(); ?> vue</span>
	<?php 
			elseif($video->getTotalView()>1):
	?>
									<span class="vu"><?php echo $video->getTotalView(); ?> vues</span>
	<?php
			endif;
									//print('<br>'. $video->getLikes() . ' Likes');		
	?>
									<span style="float:right"> <img src="ressources/images/like.png"  style="width:14px;height:14px;border:0;margin-right:2px"/><?php echo $video->getLikes(); ?></span>
								</div>
							</p>
						</li>
	<?php
		}
	}
	?>
					</ul>
				</div>
			</div>
				<?php include('bottom.php'); ?>
			<div id="fb-root"></div>
		</div>
		
		<div class="overlay">	
		</div>	
		<div class="qcm" name="profilling">
			<form name="profilling" method="post" action="infos.php"  enctype="text/plain">
				<div class="qcm-page qcm-pres" number="0">
					<h2>BONJOUR</h2>
					<!--<img src="ressources/images/qcm.png">-->
					<div class="image_qcm">
						<img src="ressources/images/apprendre.png">
					</div>
					<p>Pour <b>CR&Eacute;ER</b> ou <b>CONSULTER</b> des vid&eacute;os nous avons besoin de mieux te connaitre.<br>Merci de remplir ton profil avec ces questions</p>
					<span class="suivant">R&eacute;ponds aux questions</span>
				</div>
				<div class="qcm-page" number="1">
					<div class="page-number">Question 1/5</div>
					<img src="ressources/images/qcm3.jpg"> 
					<h3>1/ Quel est ton passe temps pr&eacute;f&eacute;r&eacute; ?</h3>
					<div class="checkbox">
						<input type="checkbox" value="PROJET"  name="profilling-1" id="p11"><label class="check-style" for="p11">Sports et sorties</label><br>
						<input type="checkbox" value="CONCRET" name="profilling-1" id="p12"><label class="check-style" for="p12">Jouer avec des amis, glander</label><br>
						<input type="checkbox" value="CONCEPTUEL" name="profilling-1" id="p13"><label class="check-style" for="p13">Jouer aux jeux</label>
					</div>
					<div class="next-page">Valider</div>
				</div>
				<div class="qcm-page" number="2">
					<div class="page-number">Question 2/5</div>
					<img src="ressources/images/qcm4.png"> 
					<h3>2/ Les heures de colles ?</h3>
					<div class="checkbox">
						<input type="checkbox" value="PROJET" name="profilling-2" id="p21"><label class="check-style" for="p21">Abonn&eacute;</label><br>
						<input type="checkbox" value="CONCRET" name="profilling-2" id="p22"><label class="check-style" for="p22">Parfois</label><br>
						<input type="checkbox" value="CONCEPTUEL" name="profilling-2" id="p23"><label class="check-style" for="p23">Jamais</label>
					</div>
					<div class="next-page">Valider</div>
				</div>
				<div class="qcm-page" number="3">
					<div class="page-number">Question 3/5</div>
					<img src="ressources/images/qcm5.jpg"> 
					<h3>3/ Et les parents ?</h3>
					<div class="checkbox">
						<input type="checkbox" value="PROJET" name="profilling-3" id="p31"><label class="check-style" for="p31">Plut&ocirc;t cools</label><br>
						<input type="checkbox" value="CONCRET" name="profilling-3" id="p32"><label class="check-style" for="p32">Plut&ocirc;t comme tout le monde</label><br>
						<input type="checkbox" value="CONCEPTUEL" name="profilling-3" id="p33"><label class="check-style" for="p33">Plut&ocirc;t stricts</label>
					</div>
					<div class="next-page">Valider</div>
				</div>
				<div class="qcm-page" number="4">
					<div class="page-number">Question 4/5</div>
					<img src="ressources/images/qcm1.jpg"> 
					<h3>4/ Quelle est ta mati&egrave;re pr&eacute;f&eacute;r&eacute;e ?</h3>
					<div class="checkbox">
						<input type="checkbox" value="CONCEPTUEL" name="profilling-4" id="p44"><label class="check-style" for="p44">Math&eacute;matiques</label><br>
						<input type="checkbox" value="PROJET" name="profilling-4" id="p45"><label class="check-style" for="p45">Fran&ccedil;ais / Langues</label><br>
						<input type="checkbox" value="CONCRET" name="profilling-4" id="p42"><label class="check-style" for="p42">Physique / Chimie / SVT / Technos</label>							
					</div>
					<div class="next-page">Valider</div>
				</div>
				<div class="qcm-page" number="5">
				<div class="page-number">Question 5/5</div>
					<img src="ressources/images/qcm2.jpg"> 
					<h3>5/ Ton point faible ?</h3>
					<div class="checkbox">
						<input type="checkbox" value="<?php print(MATH); ?>" name="profilling-5" id="p51"><label class="check-style" for="p51">Math&eacute;matiques</label><br>
						<input type="checkbox" value="<?php print(FRANCAIS); ?>" name="profilling-5" id="p52"><label class="check-style" for="p52">Fran&ccedil;ais / Langues</label><br>
						<input type="checkbox" value="<?php print(CHIMIE); ?>" name="profilling-5" id="p53"><label class="check-style" for="p53">Physique / Chimie / SVT / Technos	</label>
					</div>
					<input type="submit" value="Valider" id="submit">
				</div>
			</form>
		</div>
				
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
		<script type="text/javascript" src="ressources/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			var target = null;
			<?php
				if(isset($_SESSION['_frontUserInfo']['s_profile']) && strlen($_SESSION['_frontUserInfo']['s_profile']) > 1){
					echo 'profilcompleted = true;';
				}else {
					echo 'profilcompleted = false;';
				}
			?>
			if(!profilcompleted || 1){
				$('.profil-incomplet').show(400, function(){
					$(this).css("display: inherit");
				});

			}
			
			$('.content, .create, .menu').on('click', function(){

				if(!profilcompleted){
					target = $('a', $(this)).attr('href');
					$('.overlay, .qcm').fadeIn(function(){
						$("body").css("overflow-x", "hidden");
					});
					return false;
				} else document.location.href = $('a', $(this)).attr('href');
			});

			$('.qcm-page[number=0]').show();
			
			$('.qcm-page[number=0]').on("click", function(){
				$(this).fadeOut("slow", function(){$('.qcm-page[number=1]').fadeIn();});
			})

			$('.qcm input[type=checkbox]').on("click", function(){
				if(!$(this).attr("checked"))
					$(this).siblings().attr("checked",false);
			});

			$('.next-page').on("click", function(){
				that = $(this);
				if(typeof $(':checked', $(this).parent())[0] != "undefined")
					$(this).parent().fadeOut("slow", function(){$(that).parent().next().fadeIn();});
				else alert('Veuillez remplir le questionaire')
			});
			
			$('li[href], #changeProfile').on("click", function(){
				
				if(!profilcompleted)
				{
					target = $(this).attr("href");
					$('.overlay, .qcm').fadeIn(function(){
						$("body").css("overflow-x", "hidden");
					});
					return false;
				}
				else
					document.location.href = $(this).attr("href");
			});
			
			function gestion_overlay(){
				if ( $(window).height() > $(window).width() ){
					$('.overlay').width( $(window).height()+26 );
				} else {
					$('.overlay').width( $(window).width()+26 );
				}
			}
			
			gestion_overlay();
			
			$('.overlay').on("click", function(){
				$('.overlay, .qcm').fadeOut(function(){
					$("body").css("overflow", "auto");
				});
			});
			
			// Enregistrement quizz
			$('#submit').click(function(){
				$(this).parent().append('<img src="ressources/images/ajax-loader.gif" class="quizz-progressbar"/>');
				$(this).remove();
				
				setTimeout(function(){ 
					
				var profile = '';
				var pfort	= '';
				var pfaible = '';
				var r1 = $('input[name="profilling-1"]:checked').val();
				var r2 = $('input[name="profilling-2"]:checked').val();
				var r3 = $('input[name="profilling-3"]:checked').val();
				var r4 = $('input[name="profilling-4"]:checked').val();
				var projet 	= (r1 == "PROJET") + (r2=="PROJET") + (r3=="PROJET");
				var concret	= (r1 == "CONCRET") + (r2=="CONCRET") + (r3=="CONCRET");
				var concept = (r1 == "CONCEPTUEL") + (r2=="CONCEPTUEL") + (r3=="CONCEPTUEL");
				
				if(projet == concret && projet==concept)
				{
					projet 	= (r4 == "PROJET")  + 0;
					concret	= (r4 == "CONCRET") + 0;
					concept = (r4 == "CONCEPTUEL") + 0;
				}
				if(projet < concret && concept < concret)
					profile = "CONCRET";
				else if(concret < projet && concept < projet)
					profile = "PROJET";
				else if(projet < concept && concret < concept)
					profile = "CONCEPTUEL";
				else
					profile = "NON DEFINI";
					
				pfort 	= $('input[name="profilling-4"]:checked').attr("id");
				pfaible = $('input[name="profilling-5"]:checked').attr("id");
				
				$.ajax({
						url: 'modules/quizz/action/actions.php', 
						type: 'POST', 
						data: {profile: profile, pfort: pfort, pfaible: pfaible},
						success: function(data){
							if(data == 1){
								$('body').fadeOut(function(){
									document.location.href = target;
								});
							}
						}
					});	
				
				}, 1000);
				
				return false;
			});

		});
		</script>
	</body>
</html>