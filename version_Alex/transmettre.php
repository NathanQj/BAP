<?php
ob_start();
include("config/config.php");

if(!isset($_SESSION['_frontUserInfo']['i_autocode']))
{
	header("location:login.php");
	die();
}
ob_end_flush();

?>
<!Doctype html>
<html>
	<head>
		<?php include('head.php'); ?>
	
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>GetShareVideo by Imaload</title>
<!--                       CSS                       -->
	<!-- Main Stylesheet -->
<link rel="stylesheet" href="ressources/css/style.css" type="text/css" media="screen" />
<!-- favicon -->
 <link rel="icon" type="image/png" href="ressources/images/favicon.png">
		<!-- jQuery -->

<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://www.plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />
  
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js" charset="UTF-8"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js" charset="UTF-8"></script>


<script type="text/javascript" src="modules/upload/plupload-2.1.2/js/plupload.full.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="modules/upload/plupload-2.1.2/js/jquery.ui.plupload/jquery.ui.plupload.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="modules/upload/plupload-2.1.2/js/i18n/fr.js"></script>
<script>
var timer = null;
	// Initialize the widget when the DOM is ready
$(function() {
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : 'modules/upload/action/uploadtoqueue.php',
 
        // Maximum file size
        max_file_size : '2000mb',
 
        chunk_size: '200mb',

        // Specify what files to browse for
        filters : [
            {title : "Video", extensions : "mov,mp4,mpg"}
        ],
 
        // Rename files by clicking on their titles
        rename: true,
         
        // Sort files
        sortable: true,
 
        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,
 
        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },
 
        // Flash settings
        flash_swf_url : 'modules/upload/plupload-2.1.2/js/Moxie.swf',
     
        // Silverlight settings
        silverlight_xap_url : 'modules/upload/plupload-2.1.2/js/Moxie.xap',
        
        init: {
        	StateChanged: function(up) {
                // Called when the state of the queue is changed
                //log('[StateChanged]', up.state == plupload.STARTED ? "STARTED" : "STOPPED");
				if (up.files.length === (up.total.uploaded + up.total.failed)) 
				{
				   window.parent.location = "transmettre.php?onglet=2";
				}
            },
        	
        }
    });
   
   timer = setInterval(function() {
   		if( $('img[src="ressources/images/processing.gif"]').length)
	   		updatePic();
	   	else
	   		clearInterval(timer);
   }, 2000);  
});
function updatePic()
{
	$('img[src="ressources/images/processing.gif"]').each(function(idx, el){
		$.ajax({
	    url:'media/thumbdir/'+$(el).attr("rel")+'.jpg',
	    type:'HEAD',
	    error: function()
	    {
	        //file not exists
	    },
	    success: function()
	    {
	    	clearInterval(timer);
	        window.location.reload();
	    }
	});
	});
	
}
</script>
	<style>
		* {text-align:left}
		.plupload_progress_container
		{
			height: 14px;
		    margin-top: 10px;
		}
		.ui-corner-all, .ui-corner-left, .ui-corner-right {border-radius:0!important}
		.plupload_header_title {font-family:'kankin';text-transform:uppercase}
		.plupload_header_text {font-family:'biko';font-size:1.2em}
		.plupload_button {
	font-family:'biko';		
	background: #25b6ae!important;
	padding: 5px 10px 5px 10px;
	text-transform: uppercase;
	margin-right: 20px;
	cursor: pointer;
	border-radius:0!important;
	color:white!important
	}
	label.ui-widget{background:none!important}
	.plupload_view_switch .ui-button{margin-right:1px!important}
	.plupload_logo {background:url('ressources/images/camera.png') top left no-repeat;
	 background-position:-1px -1px!important}
	</style>
	</head>

	</head>
	<body>
		<div id="contenu">
			<?php include('header.php'); ?>
		
			<div class="main">
				<div class="principal">
					
					<div class="menu-onglets">
						<div class="menu-onglet active" number="1">Créer un custo</div>
						<div class="menu-onglet" number="2">Mes custos</div>
					</div>
					<div class="onglets">
						
						<div class="onglet<?php if ( !isset( $_GET[ 'onglet' ] ) ) echo ' active'; ?>" number="1">
							<p>Crée une vidéo custo, met là à disposition et gagne des points en même temps.</p>
							<div>
								<form >
									<div id="uploader" >
										<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
									</div>
								</form>
							</div>
						</div>
						<div class="onglet" number="2">
							<?php if (isset( $video )): ?>
							<div class="player" video-id="<?php echo $video->id() ?>" style="position:relative">
								<div id="player_apprendre">
								<?php if($video->dmcInfos()): ?>
									
									<h3>Mon dernier custo diffusé</h3>
									
									<iframe id="ma" frameborder="0" width="748px" height="421px" src="" allowfullscreen style="border:1px solid black"></iframe>
								<?php else: ?>
									<h3>La dernière vidéo postée est en cours de traitement...</h3>	<br/><br/>
								<?php endif ?>	
								</div>
							</div>
							<?php endif; ?>
							<?php if ( isset($videosMoi['count']) && 0 == $videosMoi['count'] ): ?>
								<p>Il est temps de créer tes propres custos, rendez vous dans <a href="transmettre.php">créer un custo</a></p>
							<?php else: ?>
								<h3>Tous mes custos réalisés</h3>
							<?php endif; ?>
							
							<ul>
								<?php foreach ($videosMoi as $key => $video) {
								if($key !== 'count'){
									$title = $video->title();
									print('<li href="transmettre.php?id='.$video->id().'&onglet=2">');
									
									if($video->dmcInfos('status') == 'ready')
										print('<img src="media/thumbdir/'.$video->id().'.jpg" />');
									else
										print('<img src="ressources/images/processing.gif" style="width:100px!important" rel="'.$video->id().'" />');
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
					</div>
					
					
				</div>
			</div>	
			<?php include('bottom.php'); ?>
		</div>
		<script>
			$('.onglet.active').show();
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
			
			$('.onglet li[href] h3, .onglet li[href] img').on("click", function(){
				
				if($(this).hasClass('editVideo') || $(this).hasClass('removeVideo'))
					return false;
				
				var onglet = '&onglet='+$('.onglet.active').attr('number');
				document.location.href = $(this).parent().attr("href")+ onglet;				
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
							
							if($('.player').attr('video-id')==id)
							{
								window.location.reload();
							}
							
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
			
		</script>
	</body>
</html>