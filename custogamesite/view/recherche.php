<div id="discover">
	<div id="recherche">
		<form action="search_action.php" method="get">
			<h2>Recherche</h2>
			<h3>Choix du niveau</h3><br>
			<div class="row">
				<div class="col-md-3">
				</div>				
				<div class="col-md-3">
					<select name="vid_category"><p>Matière :</p><br/
						<?php
							$req = $db->prepare('SELECT * FROM videos_categories ORDER BY cat_name ASC');
							$req->execute(
								array());
							while ($category = $req->fetch(PDO::FETCH_ASSOC))
							{
								?>
						<option>
							<?php echo $category['cat_name']; ?>
						</option>					
						<?php } ?>
					</select>
					<br/>
				</div>
				<div class="col-md-3">
					<select name="grade_name"><p>Classe</p><br/>
						<?php 
							$req = $db->prepare('SELECT * FROM videos_grades ORDER BY grade_name ASC');
							$req->execute(
								array());
							while ($grade = $req->fetch(PDO::FETCH_ASSOC))
							{
								?>
						<option>
							<?php echo $grade['grade_name']; ?>
						</option>					
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<input type="submit" value="Rechercher" class="bluebox"></input>
		</form>
	</div>
	<!-- !recherche -->
	<div class="container">




	</div>
</div>
<!-- !discover -->