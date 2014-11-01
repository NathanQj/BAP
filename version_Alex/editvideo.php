<?php
ob_start();

include("config/config.php");
include("constant.php");

ob_end_flush();
$id 				= $_GET['id'];
	
?>
<!Doctype html>
<html>
	<head>
		<?php include('head.php'); ?>
		<style>
			form {padding:30px;padding-top:10px;text-align:left}
			label {display:inline-block;width:80px;background: #25b6ae;font-family:'biko';color:white;padding:5px;padding-bottom:3px;margin-bottom:2px}
			input[type=text]{padding:4px;width:350px;}
			select[type=text]{padding:4px;margin-left:10px}
		</style>
		<script>
			$(document).ready(function(){
				
				$('.update-infos').click(function(){
					var id    = <?php echo $id ?>;
					var title = $('input[name="title"]').val();
					var classe = $('select[name="classe"]').val();
					var topic1 = $('select[name="matiere"]').val();
					
					$.ajax({
						url: '', 
						type: 'POST', 
						data: {action: 'updateinfos',id: id, title:title, classe:classe, matiere:topic1 },
						success: function(){
							window.parent.location = "transmettre.php?id="+id+"&onglet=2";
						},
						error: function(e){
							
						}
					});
					return false
				});
				
			});
		</script>
	</head>
	<body>
		<form >
			<h2>Complétez les infos</h2>
			<label>Titre</label>
			<input type="text" name="title" value="<?php echo $video->title(); ?>" /><br/>
			<label>Classe </label>
			<select name="classe">
				<option value="">Choisir...</option>
				<option value="SECONDE" <?php echo $video->groupby()=="SECONDE" ? 'selected' : '' ?>>Seconde</option>
				<option value="PREMIERE"  <?php echo $video->groupby()=="PREMIERE" ? 'selected' : '' ?>>Première</option>
				<option value="TERMINALE"  <?php echo $video->groupby()=="TERMINALE" ? 'selected' : '' ?>>Terminale</option>
			</select>
			<br/>
			<label>Matière </label>
			<select name="matiere">
				<option value="">Choisir...</option>
				<option value="<?php echo __PLAYLIST_MATH ?>" <?php echo $pl==__PLAYLIST_MATH ? 'selected' : '' ?>>Maths</option>
				<option value="<?php echo __PLAYLIST_FRANCAIS ?>" <?php echo $pl==__PLAYLIST_FRANCAIS ? 'selected' : '' ?>>Français</option>
				<option value="<?php echo __PLAYLIST_CHIMIE ?>" <?php echo $pl==__PLAYLIST_CHIMIE ? 'selected' : '' ?>>Physique / Chimie / SVT / Technos</option>
			</select>
			<br/><br/>
			<input type="submit" class="update-infos">
		</form>
	</body>
</html>