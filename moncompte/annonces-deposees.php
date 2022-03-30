<?php

session_start(); 
if (!isset($_SESSION['id'])) {
	header("Location: ../connexion.php");
} 
else {
	include "inc/header.php";
 ?>
 <title>Mes Annonces</title>

<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child">
		<div class="listing-infos">
			<h1>Mes annonces</h1>
		</div>

		<?php 
			$membre = $_SESSION['id'];

			$sql = "SELECT * FROM an_annonces WHERE id_membres=". $membre;
			$result = $conn->query($sql);
					
			if ($result->num_rows > 0) {
				echo '<p>Toutes les annonces : 1 à <span class="span-end-ads">0</span> sur <span class="span-total">'. $result->num_rows .'</span></p>';
				while($row = $result->fetch_assoc()) {
		 ?>
		<div class="background-ads-listing-container">
			<a href="" data-heart="" data-id="" class="icon-heart "></a>
			<a href="../annonce-detail.php?an=<?= $row['id'] ?>" class="background-ads-listing  flex-container" title="">
				<div class="bloc-listing-picture">
					<img src="<?= "../". $row['an_photo_1']  ?>" alt="" />
				</div>
				<div class="bloc-listing-first">
					<p class="title-listing"><?= $row['an_title']  ?></p>
					<div class="flex-container">
						<p class="localisation-listing">
							<?= $row['an_address'] ?><br />						
							<?= $row['an_city'] ?>, <?= $row['an_region'] ?><br />
							<span class="price-listing"><?= $row['an_price'] ?> Ar</span>
						</p>
						<div class="category-listing">
							<p></p>
						</div>
					</div>
				</div>
				<div class="bloc-listing-last">
					<p>
						date<?= $row['an_datenreg'] ?><br />heure<?php  ?><br />
					</p>
				</div>
			</a>
		</div>
		<?php 
				}
			}
			else {
				echo '<div class="text-page"><p class="text-center">Vous n avez encore deposees aucune annonce</p></div>';
			}
		?>
	</div>
</div>
	</div>
</div>

<?php 
	include "inc/footer.php";
 ?>
 <?php 
}
  ?>