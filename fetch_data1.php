<?php

session_start();
	include('cnx.php');

if(isset($_POST["action"]))
{   
	
	$query = "
		SELECT *,an_annonces.an_price as price, an_annonces.id as an_id, an_region.label as lblregion ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_categorie INNER JOIN (an_souscat INNER JOIN (an_annonces INNER JOIN an_region ON an_annonces.an_region = an_region.id) ON an_souscat.id = an_annonces.an_souscat) ON an_categorie.id = an_souscat.id_cat 

	"; 

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
	if (isset($_POST["region"])) {
    	$region_filter = implode("','", $_POST["region"]);
    	$query .= " 
		AND an_annonces.an_region IN('".$region_filter."') 
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

	$statement = $conn->query($query);
	
	//$total_row = $statement->rowCount();
	$output = '';
	
		while ( $result = $statement ->fetch_assoc()) {
			$output .= '
		<div class="background-ads-listing-container">
		<a href="" data-heart="1" data-id="16" class="icon-heart "></a>
		<a href="annonce-detail.php?an='.$result['an_id'].'" class="background-ads-listing  flex-container" title="">
				<div class="bloc-listing-picture">
					<img src=" '.$result['an_photo1'].'" alt="">				
				</div>
				
				<div class="bloc-listing-first">
					<p class="title-listing">'.$result['an_title'].'</p>
					<div class="flex-container">
						<p class="localisation-listing">
							'.$result['lblregion'].' / '.$result['an_city'].'<br>
							'.$result['an_address'].'							
						</p>
								
						<div class="category-listing">
							<p>
								'.$result['an_type'].' / '.$result['lblscat'].'								
							</p>
						</div>
								
					</div>
				</div>

				<div class="bloc-listing-last">
					<p>
						Déposée le '.$result['an_datenreg'].'
						<!--strong>0 Photo</strong--> 					
					</p>
				</div>
             </a><br>

			';
		}

	echo $output;
}


?>