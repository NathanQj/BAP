<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Custorial</title>
	</head>
	<body>
<?php
		chdir("../../../");
		
		include 'config/config.php';
 
		$result = frontUserAccount::uploadAvatar();

?>

		<script type="text/javascript">
			window.parent.document.getElementById('resultUploadAvatar').value = '<?php echo (int) $result['success']; ?>';
			window.parent.document.getElementById('pathUploadAvatar').value = '<?php echo $result['name']; ?>';
			window.parent.document.getElementById('absolutePathUploadAvatar').value = '<?php echo __FRONT_URL.$result['name']; ?>';
			window.parent.document.getElementById('errorAvatar').value = '<?php echo $result['error']; ?>';
			window.parent.document.getElementById('resultUploadAvatar').onchange();
		</script>
		
    </body>
</html>
