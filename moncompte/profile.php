<?php
include("inc/header.php");

if (!isset($_SESSION['id'])) {
	header("Location: ../connexion.php");
} 
else { 
	
 ?>
<title>Profile Page</title>

<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child index-container">
		<input id="u" type="hidden" name="" value="<?= $_SESSION['id'] ?>">
		<div class="ad-page-parent-container flex-container">
			<div class="ad-page-large-container">
				<?php 
					$sql = "SELECT a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_entetes b ON a.id=b.id_annonce ORDER BY b.id ASC LIMIT 0, 5";
					$result = $conn->query($sql);
					/*var_dump($result);
					die();*/
					if ($result AND $result->num_rows > 0) {
						//echo '<div class="background-ads-listing-container">';
						echo '<div class="list-premium">';
						echo '<h2 class="icon-star">Annonces en tete</h2>';
						// output data of each row
						while($row = $result->fetch_assoc()) {
				 ?>	
						<a href="../annonce-detail.php?an=<?php $row['id'] ?>" class="background-ads-premium" title="cliquer pour avoir plus de détail sur l'annonce">
							<img src="<?= "../". $row['photo1'] ?>"  alt="" />
							<div class="bloc-premium-infos">
								<p><?= $row['title'] ?><br />
									<!--span class="txt-info-premium">Boeny</span><br /-->
									<span class="txt-price-premium"><strong><?= $row['price'] ?></strong></span>
								</p>
							</div>
						</a>
					
				<?php 
						}
						echo '<br>';
						echo '<a class="btn button" href="../listes-annonces.php">Voir Plus</a>';
						echo "</div>";
						//echo "</div>";
					} 
					else {
						echo "";
					}
				 ?>
				

				 <?php 
					$sql = "SELECT a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_premiums b ON a.id=b.id_annonce ORDER BY b.id ASC LIMIT 0, 5";
					$result = $conn->query($sql);
					
					if ($result AND $result->num_rows > 0) {
						//echo '<div class="background-ads-listing-container">';
						echo '<div class="list-premium">';
						echo '<h2 class="icon-star">Annonces premium</h2>';
						// output data of each row
						while($row = $result->fetch_assoc()) {
				 ?>	
						<a href="../annonce-detail.php?an=<?= $row['id'] ?>" class="background-ads-premium" title="cliquer pour avoir plus de détail sur l'annonce">
							<img src="<?= "../". $row['photo1'] ?>"  alt="" />
							<div class="bloc-premium-infos">
								<p><?= $row['title'] ?><br />
									<!--span class="txt-info-premium">Boeny</span><br /-->
									<span class="txt-price-premium"><strong><?= $row['price'] ?></strong></span>
								</p>
							</div>
						</a>
				<?php 
						}

						echo '<a class="btn button" href="../listes-annonces.php">Voir Plus</a>';
						echo "</div>";
						//echo "</div>";
					} 
					else {
						echo "";
					}
				 ?>


				<?php 
					$sql = "SELECT a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_urgentes b ON a.id=b.id_annonce ORDER BY b.id ASC LIMIT 0, 5";
					$result = $conn->query($sql);
					
					if ($result AND $result->num_rows > 0) {
						//echo '<div class="background-ads-listing-container">';
						echo '<div class="list-premium">';
						echo '<h2 class="icon-star">Annonces urgentes</h2>';
						// output data of each row
						while($row = $result->fetch_assoc()) {
				 ?>
						<a href="../annonce-detail.php?an=<?= $row['id'] ?>" class="background-ads-premium" title="cliquer pour avoir plus de détail sur l'annonce">
							<img src="<?= "../". $row['photo1'] ?>"  alt="" />
							<div class="bloc-premium-infos">
								<p><?= $row['title'] ?><br />
									<!--span class="txt-info-premium">Boeny</span><br /-->
									<span class="txt-price-premium"><strong><?= $row['price'] ?></strong></span>
								</p>
							</div>
						</a>
				<?php 
						}

						echo '<a class="btn button" href="../listes-annonces.php">Voir Plus</a>';
						echo "</div>";
						//echo "</div>";
					} 
					else {
						echo "";
					}
				 ?>
				

				<?php 
					$sql = "SELECT a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_encadrees b ON a.id=b.id_annonce ORDER BY b.id ASC LIMIT 0, 5";
					$result = $conn->query($sql);
					
					if ($result AND $result->num_rows > 0) {
						//echo '<div class="background-ads-listing-container">';
						echo '<div class="list-premium">';
						echo '<h2 class="icon-star">Annonces encadrees</h2>';
						// output data of each row
						while($row = $result->fetch_assoc()) {
				 ?>	
						<a href="../annonce-detail.php?an=<?= $row['id'] ?>" class="background-ads-premium" title="cliquer pour avoir plus de détail sur l'annonce">
							<img src="<?= "../". $row['photo1'] ?>"  alt="" />
							<div class="bloc-premium-infos">
								<p><?= $row['title'] ?><br />
									<!--span class="txt-info-premium">Boeny</span><br /-->
									<span class="txt-price-premium"><strong><?= $row['price'] ?></strong></span>
								</p>
							</div>
						</a>
				<?php 
						}

						echo '<a class="btn button" href="../listes-annonces.php">Voir Plus</a>';
						echo "</div>";
						//echo "</div>";
					} 
					else {
						echo "";
					}
				 ?>
				

				<?php 
					$sql = "SELECT a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a ORDER BY a.id ASC LIMIT 0, 5";
					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
						//echo '<div class="background-ads-listing-container">';
						echo '<div class="list-premium">';
						echo '<h2 class="icon-star">Annonces recentes</h2>';
						// output data of each row
						while($row = $result->fetch_assoc()) {
				 ?>	
						<a href="../annonce-detail.php?an=<?= $row['id'] ?>" class="background-ads-premium" title="cliquer pour avoir plus de détail sur l'annonce">
							<img src="<?= "../". $row['photo1'] ?>"  alt="" />
							<div class="bloc-premium-infos">
								<p><?= $row['title'] ?><br />
									<!--span class="txt-info-premium">Boeny</span><br /-->
									<span class="txt-price-premium"><strong><?= $row['price'] ?></strong></span>
								</p>
							</div>
						</a>
				<?php 
						}

						echo '<a class="btn button" href="../listes-annonces.php">Voir Plus</a>';
						echo "</div>";
						//echo "</div>";
					} 
					else {
						echo "";
					}
				 ?>
			
			</div>

			<div class="ad-page-small-container">
				<div class="ad-page-bloc-infos contact">
					<p class="title"><span>Profile</span></p>
					<?php 
						$membre = $_SESSION['id'];
						$sql = "SELECT * FROM membres WHERE id=".$membre;
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
							// output data of each row
							$row = $result->fetch_assoc()
					 ?>
					<p class="name-contact"><?= $row['first_name'] ." ". $row['name'] ?></p>
					<p>Email : <?= $row['email'] ?></p>
					<p>Telephone : <?= $row['phone'] ?></p>
					<p>Adresse : <?= $row['address'] ?></p>
					<p>Ville : <?= $row['city'] ?></p>
					<?php 
						$reg = $row['region'];

						$sql_ = "SELECT * FROM an_region WHERE id=".$reg;
						$result_ = $conn->query($sql_);
						if ($result_->num_rows > 0) {
							// output data of each row
							$row_ = $result_->fetch_assoc()
					 ?>
					<p>Region : <?= $row_['label'] ?></p>
					<?php 
						} 
						else {
							echo "0 results";
						}
					 ?>
					<p>Code Postal : <?= $row['post_code'] ?></p>
					<?php
							/*if ($row['account_type'] === "MEMBRE") {
								echo '<p><a id="pro" class="" href="switchToPRO.php">S inscrire pour le compte PRO</a></p>';
							}*/
					 ?>
					<a href="editProfile.php?u=<?= $row['id'] ?>">Modifier mon profile</a>
					<?php
						} 
						else {
							echo "0 results";
						}
						
						$conn->close();

					 ?>
				</div>

				<div class="ad-page-bloc-infos management">
					<p class="title"><span>Annonce</span></p>
					<a href="annonces-deposees.php">Mes annonces deposees</a>
					<a href="annonces-favorites.php">Mes annonces favorites</a>
					<a href="listes-annonces.php">Voir toutes les annonces</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
include("inc/footer.php");

}
 ?>

 <script type="text/javascript">
 	$(function(){
 		var url = $('#pro').attr('href');

 		$('#pro').on('click', function(){
 			var u = $('#u').val();

 			$.post(
 				"ajax/" + url,
 				{
 					u: u
 				},
 				function(data, status){
 					console.log(data);
 				}
 			);
 		});
 	});
 </script>