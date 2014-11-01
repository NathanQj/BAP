
<!DOCTYPE html><html dir="ltr" lang="en-US">
<head>
	<meta charset="UTF-8" />
	
		<title>Plupload: UI Widget</title>
	    
    <link href="/favicon.ico" rel="shortcut icon" />

	<link type="text/css" rel="stylesheet" href="http://www.plupload.com/css/bootstrap.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://www.plupload.com/css/font-awesome.min.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://www.plupload.com/css/my.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://www.plupload.com/css/prettify.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://www.plupload.com/css/shCore.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://www.plupload.com/css/shCoreEclipse.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/smoothness/jquery-ui.min.css" media="screen" />
<link type="text/css" rel="stylesheet" href="http://www.plupload.com/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" media="screen" />
    
    <!--[if lte IE 7]>
   	<link rel="stylesheet" type="text/css" href="http://www.plupload.com/css/my_ie_lte7.css" />
    <![endif]-->

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300|Bree+Serif" rel="stylesheet" type="text/css">
	<!--[if IE]>
	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:600italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:700italic" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:600" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Bree+Serif:400" rel="stylesheet" type="text/css">
	<![endif]-->

	    
    <!--[if IE 7]>
    	<link rel="stylesheet" href="http://www.plupload.com/css/font-awesome-ie7.min.css">
    <![endif]-->
    
    <!--[if lt IE 9]>
    <script src="http://www.plupload.com/js/html5shiv.js"></script>
    <![endif]-->

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js" charset="UTF-8"></script>

	
</head>
<body class="examples examples-index">
	<header>
		


        
        <div id="logo">
            <a href="/" class="fit"> </a>
        </div>

		<div class="logo container">
			<div id="plupload">
				<a class="fit" href="/">
					<span>2.1.2</span>
				</a>
			</div>	
		</div>
	</header>


<section id="content">
	<div class="container">
		<div class="page-header pull-left">
						<h1>UI Widget</h1>
					</div>

		<div class="clearfix"> </div>
		
		
<div id="themeswitcher" class="pull-right"> </div>
<script>
	$(function() {
		$.fn.themeswitcher && $('#themeswitcher').themeswitcher({cookieName:''});
	});
</script>


<div id="example">

<p>This example shows you how to use the jQuery UI widget use the "Switch theme" drop down to the right to select different jQuery UI themes.</p>

<div id="uploader">
	<p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
</div>

<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
	$("#uploader").plupload({
		// General settings
		runtimes : 'flash',
		url : "upload.php",

		// Maximum file size
		max_file_size : '6000mb',

		chunk_size: '2mb',

		// Resize images on clientside if we can
		resize : {
			width : 200, 
			height : 200, 
			quality : 90,
			crop: true // crop to exact dimensions
		},

		// Specify what files to browse for
		filters : [
			
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
		flash_swf_url : '../js/Moxie.swf',
	
		// Silverlight settings
		silverlight_xap_url : '../js/Moxie.xap'
	});
});
</script>


</div>

<br />




	</div>
</section>


<footer>
	<div class="container">    
        <div id="logo-footer-1">
        	<a class="fit" href="/"><!-- go home --></a>
        </div>
        <div id="logo-footer-2">
        	<a class="fit" href="http://moxiecode.com" target="_blank"> </a>
        </div>
        <div id="copyright">&copy; 2004-2014 Moxiecode Systems AB. All rights reserved.</div>
    	<div id="tagline">Upload everything and everywhere.</div>
    </div>
</footer>

<script type="text/javascript" src="http://www.plupload.com/js/bootstrap.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://www.plupload.com/js/shCore.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://www.plupload.com/js/shBrushPhp.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://www.plupload.com/js/shBrushjScript.js" charset="UTF-8"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/plupload.full.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/jquery.ui.plupload/jquery.ui.plupload.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/themeswitcher.js" charset="UTF-8"></script>

<script type="text/javascript">
(function($) {
    var langMap = {
        'javascript': 'js',
        'js': 'js',
        'php': 'php',
        'html': 'php'
    };

    $.each(['php', 'javascript', 'html'], function(i, lang) {
        $('pre.' + lang).attr('class', 'brush: ' + langMap[lang] + '; toolbar: false;');
    });
    
    SyntaxHighlighter.all();
}(jQuery));
</script>



</body>
</html>