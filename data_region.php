<?php

session_start();
	include('cnx.php');

if(isset($_POST["action"]))
{
	//echo $_POST["action"];die();
	if ($_POST["action"] == "data_region") {
		//$query = "SELECT *,an_annonces.an_price as price, an_annonces.id as an_id, an_region.label as lblregion ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_categorie INNER JOIN (an_souscat INNER JOIN (an_annonces INNER JOIN an_region ON an_annonces.an_region = an_region.id) ON an_souscat.id = an_annonces.an_souscat) ON an_categorie.id = an_souscat.id_cat AND (an_annonces.an_region = '".$_SESSION['region']."')";

		$query = "SELECT *,an_region.label as lblregion,an_annonces.an_price as price, an_annonces.id as an_id, an_region.label as lblregion ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_annonces INNER JOIN an_souscat on(an_souscat.id = an_annonces.an_souscat) INNER join an_categorie on (an_categorie.id = an_souscat.id_cat) INNER JOIN an_region on (an_annonces.an_region = an_region.id) WHERE an_annonces.an_region = '".$_SESSION['region']."' ";
	}
	if ($_POST["action"] == "liste_annonces") {
		//$query = "SELECT *,an_annonces.an_price as price, an_annonces.id as an_id, an_region.label as lblregion ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_categorie INNER JOIN (an_souscat INNER JOIN (an_annonces INNER JOIN an_region ON an_annonces.an_region = an_region.id) ON an_souscat.id = an_annonces.an_souscat) ON an_categorie.id = an_souscat.id_cat";
		$query = "SELECT *,an_region.label as lblregion,an_annonces.an_price as price, an_annonces.id as an_id ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_annonces INNER JOIN an_souscat on(an_souscat.id = an_annonces.an_souscat) INNER join an_categorie on (an_categorie.id = an_souscat.id_cat) INNER JOIN an_region on (an_annonces.an_region = an_region.id) ";
	}

   if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND (an_annonces.an_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."')
		";
	}

	if (isset($_POST["type"]))
	{
		$type_filter = implode("','", $_POST["type"]);
		$query .= "
		AND an_annonces.an_type IN('".$type_filter."')
		";

	}
    if (isset($_POST["categorie"])) {
    	$categorie_filter = implode("','", $_POST["categorie"]);
    	$query .= "
		AND an_annonces.an_souscat IN('".$categorie_filter."')
		";

    }
    if(empty($_POST["title"]))
	{
	    if(isset($_POST["recherche"]) && !empty($_POST["recherche"]) )
		{
			$query .= "
			 AND (an_annonces.an_title  LIKE '%".$_POST["recherche"]."%' OR an_annonces.an_desc  LIKE '%".$_POST["recherche"]."%' OR an_annonces.an_city LIKE '%".$_POST["recherche"]."%' )
			";

		}
    }
	if(isset($_POST["postal"]) && !empty($_POST["postal"]) )
	{
		$query .= "
		 AND ( an_annonces.an_postcode  LIKE '%".$_POST["postal"]."%' )
		";

	}
	if(isset($_POST["title"]))
	{
	  if(isset($_POST["recherche"]) && !empty($_POST["recherche"]) )
	   {
		$query .= "
		 AND (an_annonces.an_title   LIKE '%".$_POST["recherche"]."%')
		";

	  }
	}

	$query .= "ORDER BY an_datenreg DESC";

	$statement = $conn->query($query);
	if ($statement->num_rows>0) {
		//$total_row = $statement->rowCount();


		$output = '';
			while ( $result = $statement ->fetch_assoc()) {
				$req=$conn->query("SELECT COUNT(*) as n FROM an_favori WHERE id_membres = '".$_SESSION['id']."' && id_annonces = '".$result['an_id']."' ");
				$res=$req->fetch_assoc();
				$fav="";
				if($res['n']>0){ $fav = "selected"; }

				$output .= '
			<div class="background-ads-listing-container" style="width:100%">
			<a id="'.$result['an_id'].'" style="cursor:pointer;" class="icon-heart '.$fav.'" onclick="favori($(this));"></a>
			<a style="text-decoration:none" href="annonce-detail.php?an='.$result['an_id'].'" class="background-ads-listing  flex-container" title="">
					<div class="bloc-listing-picture">
						<img src=" '.$result['an_photo1'].'" alt="">
					</div>

					<div class="bloc-listing-first">
						<p class="title-listing" style="color:black">'.ucfirst(strtolower($result['an_title'])).'<br> ( '.$result['an_type'].' / '.$result['lblscat'].' )</p>
						<p  style="color:black">

						</p>
						<p class="" style="color:#FFA500">'.$result['an_price'].' Ar</p>
						<div class="flex-container">
							<p class="localisation-listing"  style="color:black">
								'.$result['lblregion'].' / '.ucfirst(strtolower($result['an_city'])).'<br>
								'.ucfirst(strtolower($result['an_address'])).'
							</p>

							<div class="category-listing">

							</div>

						</div>
					</div>

					<div class="bloc-listing-last">
						<p  style="color:black">
							Déposée le '.$result['an_datenreg'].'
							<!--strong>0 Photo</strong-->
						</p>
					</div>
	             </a><br>

				';
			}

		echo $output;
	}
	else{
		echo '<div class="text-page" style="width:100%">
		<p class="text-center">Aucune annonce ne correspond à votre recherche</p>
		</div>';
	}


}

?>
