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
			<div class="main">
				<div class="principal" style="position:relative">
					<div id="mes-videos">
						<button class="openSubmitVideo2"><img src="ressources/images/camera.png" /><span style="position:relative;top:-15px">CREER tes vidéos</span></button>
					</div>					<div class="player" video-id="<?php echo $video->id() ?>" style="position:relative">
						<div id="player_apprendre">
						<?php if($videoReady): ?>
							<iframe id="ma" frameborder="0" width="748px" height="421px" src="" allowfullscreen style="border:1px solid black"></iframe>
<?php
	$video_like = new Video();
	$video_like->setId( $video->id() );
?>
							<a href="javascript:void(0);" class="<?php echo ( 1 == $video->getLikes( Helper::getUserId() ) ? '' : 'nolike'); ?>" data-id-video="<?php echo $video->id() ?>" id="action_like">
								<div id="like" class="addmarginright" style="top:20px">
									<img src="ressources/images/poucelikevert.png" style="width:24px"/>
								</div>
							</a>
							<div id="abuse" class="addmarginright" style="top:83px">
								<span style="font-size:10px;">Signaler<br/>un abus</span>
							</div>
							<div id="partage-facebook" class="addmarginright" style="top:144px">
								<img src="ressources/images/partage_facebook.png" alt="Partager sur Facebook">
							</div>
						<?php else: ?>
							<h3>La dernière vidéo postée est en cours de traitement...</h3>	<br/><br/>
						<?php endif ?>	
						</div>
					</div>
					<div class="menu-onglets">
						<div class="menu-onglet" number="1">Mes vid&eacute;os</div>
						<div class="menu-onglet" number="2">mon historique</div>
					</div>
					<div class="onglets">
						<div class="onglet " number="1">
							<ul>
								<?php foreach ($videosMoi as $key => $video) {
								if($key !== 'count'){
									$title = $video->title();
									print('<li href="videos.php?id='.$video->id().'">');
									
									if($video->dmcInfos('status') == 'ready')
										print('<img src="media/thumbdir/'.$video->id().'.jpg" />');
									else
										print('<img src="ressources/images/processing.gif" style="width:100px!important" />');
									print('<h3>'. $title.'</h3>');
									$list = $video->playList();
									$list = isset($list[0]) ? $list[0] : '';
									if ($list == __PLAYLIST_MATH){
										$color = "orange";
									} elseif($list == __PLAYLIST_FRANCAIS){
										$color = "jaune";
									} else{
										$color = "bleu";
									}
									$name = $video->playlistName();
									$meta = $video->groupby();
									if(isset($name[0]))
										print('<span class="'.$color.'">'. $name[0] . '</span><br>');
									if(isset($meta)){
										$meta = strlen($meta) ? ucfirst($meta) : 'non précisé';
										print('<span><b>niveau '. $meta . '</b></span><br>');
									}
									print('<span class="time">'.$video->durationString(). '</span>');
									print('<span class="like">'.$video->getLikes().'</span>');
									if($video->getTotalView()<=1)
										print('<span class="vue">'. $video->getTotalView() . ' vue</span>');
									else if($video->getTotalView()>1)
										print('<span class="vue">'. $video->getTotalView() . ' vues</span>');
									print('<span style="float:right;margin-right:15px" rel="'.$video->id().'">');
									print('<img class="editVideo" src="https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/new-24-16.png" style="width:16px!important;height:16px!important" />');
									print('<img class="removeVideo" src="https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/cross-24-16.png" style="margin-left:10px;width:16px!important;height:16px!important" />');
									print('</span>');
									print('</li>');
								}
							}
							?>
							</ul>
						</div>
						<div class="onglet" number="2">
							<ul>
							<?php foreach ($videosHistorique as $key => $video) {
								if($key !== 'count'){
									$title = $video->title();
									print('<li href="videos.php?id='.$video->id().'">');
									if($video->dmcInfos('status') == 'ready')
										print('<img src="media/thumbdir/'.$video->id().'.jpg" />');
									else
										print('<img src="ressources/images/processing.gif" style="width:100px!important" />');
									print('<h3>'. $title.'</h3>');
									$list = $video->playList();
									$list = isset($list[0]) ? $list[0] : '';
									if ($list == __PLAYLIST_MATH){
										$color = "orange";
									} elseif($list == __PLAYLIST_FRANCAIS){
										$color = "jaune";
									} else{
										$color = "bleu";
									}
									$name = $video->playlistName();
									$meta = $video->groupby();
									if(isset($name[0]))
										print('<span class="'.$color.'">'. $name[0] . '</span><br>');
									if(isset($meta)){
										$meta = strlen($meta) ? ucfirst($meta) : 'non précisé';
										print('<span><b>niveau '. $meta . '</b></span><br>');
									}
									print('<span class="time">'. $video->durationString() . '</span>');
									//print('<span class="like">'. $video->getLikes() . '</span>');								
									print('<span class="like">'.rand(1,99).'</span>');
									if($video->getTotalView()<=1)
										print('<span class="vue">'. $video->getTotalView() . ' vue</span>');
									else if($video->getTotalView()>1)
										print('<span class="vue">'. $video->getTotalView() . ' vues</span>');
									print('</li>');
								}
							}
							?>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
			<div class="overlay">	
			</div>	
			<div class="abuse" name="abuse">
				Ce contenu vous semble inapproprié ?<br>
				Merci d'expliquer pourquoi :<br>
				<textarea rows="10" cols="52"></textarea>
			</div>
			<?php include('bottom.php'); ?>
		</div>
		<script type="text/javascript" src="ressources/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			
			// Abuse
			$('#abuse').click(function(){
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
			
			$('.overlay').on("click", function(){
				$('.overlay, .abuse').fadeOut(function(){
					$("body").css("overflow", "auto");
				});
			});
			
			var eventTimeOut;
			// Action like
			$('#action_like').click(function(){
				clearTimeout( eventTimeOut );
				eventTimeOut = setTimeout( function(){
					$.ajax({
							url: 'modules/frontuser/action/actions.php',
							type: 'POST',
							data: {action: 'like', container_id: $('#action_like').attr('data-id-video')},
							success: function(data){
								if(data == 1){
									$('#action_like').removeClass('nolike');
								}
							}
					})
				} , 500 )
			});
			
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
			$('.video-conseillees li[href]').on("click", function(){
				var onglet = '&onglet=1';//+$('.onglet.active').attr('number');
				document.location.href = $(this).attr("href")+ onglet;				
			});
			
			$('.onglet li[href] h3, .onglet li[href] img').on("click", function(){
				
				if($(this).hasClass('editVideo') || $(this).hasClass('removeVideo'))
					return false;
				
				var onglet = '&onglet='+$('.onglet.active').attr('number');
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
			
			<?php if(isset($_GET['onglet'])): ?>
			$('.menu-onglet[number="<?php echo $_GET['onglet']; ?>"]').trigger('click');//addClass('active');
			<?php else: ?>
			$('.menu-onglet[number="1"]').trigger('click');//addClass('active');	
			<?php endif ?>
			$('.onglet.active').show();
			
			
			$('.removeVideo').click(function(){
				
				if(confirm('Voulez-vous vraiment supprimer cette vidéo?'))
				{
					var id = $(this).parent().attr('rel');
					var li = $(this).parents('li');
					$.ajax({
						url: 'modules/media/action/expanded_action.php', 
						type: 'POST', 
						data: {action: 'putInTrash',id: id },
						success: function(){
							$(li).fadeOut(450);
						},
						error: function(e){
							$(li).parents('li').fadeOut(450);
						}
					});
				}
				
			});
			
			$('.editVideo').click(function(){
			
				var id = $(this).parent().attr('rel');
				var fb = new myFacebox('editvideo.php?id='+id, {mode:'iframe', width:600,height:250});
				return false;
			
			});
			
			$('.openSubmitVideo2').click(function(){
				document.location.href = 'transmettre.php';
			});

		});
		</script>
	</body>
</html>