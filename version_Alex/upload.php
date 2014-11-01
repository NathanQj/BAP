<?php 
ob_start();
include("config/config.php");
?>
<!Doctype html>
<html>
	<head>
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
	// Initialize the widget when the DOM is ready
$(function() {
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : 'modules/upload/action/uploadtoqueue.php',
 
        // Maximum file size
        max_file_size : '2000mb',
 
        chunk_size: '100mb',
 
        // Resize images on clientside if we can
        resize : {
            width : 200,
            height : 200,
            quality : 90,
            crop: true // crop to exact dimensions
        },
 
        // Specify what files to browse for
        /*filters : [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip,avi"}
        ],*/
 
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
				   window.parent.location = "videos.php?lastupload";
				}
            },
        	
        }
    });
   
});
</script>
	<style>
		* {text-align:left}
		.plupload_progress_container
		{
			height: 14px;
		    margin-top: 10px;
		    width: 100px;
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

<body >
	
	<div>
		
		<form >
			<div id="uploader" >
				<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
			</div>
		</form>
	
	</div>
	
	
</body>


