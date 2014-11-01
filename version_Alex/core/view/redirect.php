<script>
	
	$(document).ready(function(){
		$('#main-nav').css('visibility','hidden');
		var url 	= 'http://<?php echo $_SERVER['HTTP_HOST']."**".$_SERVER['PHP_SELF']."?module=".$redirectModule."&view=".$redirectView."#id=".$highlightmnu ?>';
		var url 	= '<?php echo __BACKURL."/index.php?module=".$redirectModule."&view=".$redirectView."#id=".$highlightmnu ?>';
		
		document.location = url;
	});
	
</script>