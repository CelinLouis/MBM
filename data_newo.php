<?php

session_start();
	include('cnx.php');

if(isset($_POST["action"]))
{
    

    $query = " SELECT *,an_region.label as lblregion,an_annonces.an_price as price, an_annonces.id as an_id ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_annonces INNER JOIN an_souscat on(an_souscat.id = an_annonces.an_souscat) INNER join an_categorie on (an_categorie.id = an_souscat.id_cat) INNER JOIN an_region on (an_annonces.an_region = an_region.id) WHERE an_annonces.status = 1 ";

    $row = "SELECT count(*) as allcount FROM an_annonces INNER JOIN an_souscat on(an_souscat.id = an_annonces.an_souscat) INNER join an_categorie on (an_categorie.id = an_souscat.id_cat) INNER JOIN an_region on (an_annonces.an_region = an_region.id) WHERE an_annonces.status = 1";


   if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND (an_annonces.an_price BETWEEN  '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."')
		";
        $row .= "
		 AND (an_annonces.an_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."')
		";
		
	}

    if (isset($_POST['categorie']) && $_POST['categorie'] == 1) 
    {

    	if(isset($_POST["minimum_annee"], $_POST["maximum_annee"]) && !empty($_POST["minimum_annee"]) && !empty($_POST["maximum_annee"]))
	   {
		$query .= "
		 AND (an_annonces.an_anneev BETWEEN  '".$_POST["minimum_annee"]."' AND '".$_POST["maximum_annee"]."')
		";
        $row .= "
		 AND (an_annonces.an_anneev BETWEEN '".$_POST["minimum_annee"]."' AND '".$_POST["maximum_annee"]."')
		";	
	   }

	   if(isset($_POST["minimum_kilo"], $_POST["maximum_kilo"]) && !empty($_POST["minimum_kilo"]) && !empty($_POST["maximum_kilo"]))
	   {
		$query .= "
		 AND (an_annonces.an_kmeterv BETWEEN  '".$_POST["minimum_kilo"]."' AND '".$_POST["maximum_kilo"]."')
		";
        $row .= "
		 AND (an_annonces.an_kmeterv BETWEEN '".$_POST["minimum_kilo"]."' AND '".$_POST["maximum_kilo"]."')
		";	
	   }
       
       if(isset($_POST["energie"]))
	   {
		$energie_filter = implode("','", $_POST["energie"]);

		$query .= "
		 AND an_annonces.an_energyv IN('".$energie_filter."')
		";
		$row .= "
		 AND an_annonces.an_energyv IN('".$energie_filter."')
		";
	   }

    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 2) {

    	if(isset($_POST["minimum_annee"], $_POST["maximum_annee"]) && !empty($_POST["minimum_annee"]) && !empty($_POST["maximum_annee"]))
	   {
		$query .= "
		 AND (an_annonces.an_anneem BETWEEN  '".$_POST["minimum_annee"]."' AND '".$_POST["maximum_annee"]."')
		";
        $row .= "
		 AND (an_annonces.an_anneem BETWEEN '".$_POST["minimum_annee"]."' AND '".$_POST["maximum_annee"]."')
		";
	   }

	   if(isset($_POST["minimum_cylindre"], $_POST["maximum_cylindre"]) && !empty($_POST["minimum_cylindre"]) && !empty($_POST["maximum_cylindre"]))
	   {
		$query .= "
		 AND (an_annonces.an_cylinder BETWEEN  '".$_POST["minimum_cylindre"]."' AND '".$_POST["maximum_cylindre"]."')
		";
        $row .= "
		 AND (an_annonces.an_cylinder BETWEEN '".$_POST["minimum_cylindre"]."' AND '".$_POST["maximum_cylindre"]."')
		";
	   }

    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 8) {
    	
    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 9) {
    	# code...
    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 11) {
    	# code...
    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 10) {
    	# code...
    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 14) {
    	
    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 12) {
    	# code...
    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 13) {
    	# code...
    }elseif (isset($_POST['categorie']) && $_POST['categorie'] == 15) {
    	# code...
    }else{
    	$_POST['categorie'] = "";
    }



	if (isset($_POST["Ventes"]))
	{
		$type_ventes = implode("','", $_POST["Ventes"]);
		$query .= "  AND an_annonces.an_type IN('".$type_ventes."') ";
		$row .= " AND an_annonces.an_type IN('".$type_ventes."') ";

	}

	if (isset($_POST["Achats"]))
	{
		$type_achats = implode("','", $_POST["Achats"]);
		$query .= "  AND an_annonces.an_type IN('".$type_achats."') ";
		$row .= " AND an_annonces.an_type IN('".$type_achats."') ";

	}
    
    if (isset($_POST["Achats"],$_POST["Ventes"]))
	{
		$query = " SELECT *,an_region.label as lblregion,an_annonces.an_price as price, an_annonces.id as an_id ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_annonces INNER JOIN an_souscat on(an_souscat.id = an_annonces.an_souscat) INNER join an_categorie on (an_categorie.id = an_souscat.id_cat) INNER JOIN an_region on (an_annonces.an_region = an_region.id) ";

        $row = "SELECT count(*) as allcount FROM an_annonces INNER JOIN an_souscat on(an_souscat.id = an_annonces.an_souscat) INNER join an_categorie on (an_categorie.id = an_souscat.id_cat) INNER JOIN an_region on (an_annonces.an_region = an_region.id)";

	}
    

	 if(empty($_POST["title"]))
	{
	    if(isset($_POST["recherche"]) && !empty($_POST["recherche"]) )
		{
			$query .= "
			 AND (an_annonces.an_title  LIKE '%".$_POST["recherche"]."%' OR an_annonces.an_desc  LIKE '%".$_POST["recherche"]."%' OR an_annonces.an_city LIKE '%".$_POST["recherche"]."%' )
			";
			 $row .= "
		 AND (an_annonces.an_title  LIKE '%".$_POST["recherche"]."%' OR an_annonces.an_desc  LIKE '%".$_POST["recherche"]."%' OR an_annonces.an_city LIKE '%".$_POST["recherche"]."%' )
		";
			

		}
    }

	if(isset($_POST["title"]))
	{
	  if(isset($_POST["recherche"]) && !empty($_POST["recherche"]) )
	   {
		$query .= "
		 AND (an_annonces.an_title   LIKE '%".$_POST["recherche"]."%')
		";
		$row .= "
		 AND (an_annonces.an_title   LIKE '%".$_POST["recherche"]."%')
		";
        
	  }
	}


	if(isset($_POST["postal"]) && !empty($_POST["postal"]) )
	{
		$query .= "
		 AND ( an_annonces.an_postcode  LIKE '%".$_POST["postal"]."%' )
		";
		$row .= "
		 AND ( an_annonces.an_postcode  LIKE '%".$_POST["postal"]."%' )
		";
     
	}
    
    if (isset($_POST["region"]) && !empty($_POST["region"])) 
    {
    	$query .= "
		AND an_annonces.an_region IN('".$_POST["region"]."')
		";
		$row .= "
		 AND an_annonces.an_region IN('".$_POST["region"]."')
		"; 

    }

	if (isset($_POST["categorie"]) && !empty($_POST["categorie"])) 
    {
    	$query .= "
		AND an_annonces.an_souscat IN('".$_POST["categorie"]."')
		";
		$row .= "
		 AND an_annonces.an_souscat IN('".$_POST["categorie"]."')
		"; 

    }
    
    $contt = $conn->query($row);
    $records = mysqli_fetch_assoc($contt);
    $totalRecords = $records['allcount'];

    $limit = 5;
    $page = ''; 

	$reste =  $totalRecords % $limit;

	if ($reste === 0) {
		$nbpage =  $totalRecords/$limit;
	}else{
        $nbpage = floor( $totalRecords/$limit)+1;
	}
        
    if(isset($_POST["page"]))  
    {  
      $page = $_POST["page"];  
    }  
    else  
    {  
      $page = 1;  
    }  
    
	$offset = ($page-1)*$limit;

    $query .= " ORDER BY an_datenreg DESC limit $limit offset $offset";

    $statement = $conn->query($query);
	$isa = $statement->num_rows;
    
    ?>
   
    <div class="listing-infos" style="position: relative;bottom: 10px;right: 350px">
					<h1>Petites Annonces</h1>
						<p>
						<a class="listing-infos-link " href="listes-annonces.php">Toutes les offres</a> :
							<span class="txt_info_nb_ads"><?php echo $totalRecords; ?></span>
						</p>
						<p>
								<a class="listing-infos-link " href="listes-annonces.php">Region</a> :
								<?php  
								   if (isset($_POST['region'] ) && $_POST['region'] != '')
								   { 
								   $region = $_POST["region"];
                                    $result_region1 = $conn->query(" SELECT * FROM an_region WHERE id =  '".$region."' ");
                                    $result_region = $result_region1->fetch_assoc();
									?>
									<a class="txt_info_nb_ads" href="listes-annoncesO.php?region=<?php echo $_POST['region'] ?>"><?php echo $result_region['label']; ?></a>
									 <title><?php echo $result_region['label']; ?></title>
								<?php }else{ ?>
									<a class="txt_info_nb_ads" href="index.php">Toutes régions</a>
									 <title>Toutes régions</title>
								<?php } ?>

						</p>
    </div> 
    
    <?php
    
    $output = '';

	if ($isa > 0) {
		//$total_row = $statement->rowCount();
			while ( $result = $statement ->fetch_assoc()) {
				if (isset($_SESSION['id'])) {
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
			}else{
					$output .= '<div class="background-ads-listing-container" style="width:100%">
			<a href="" data-heart="1" data-id="16" class="icon-heart "></a>
			<a href="annonce-detail.php?an='.$result['an_id'].'" class="background-ads-listing  flex-container" title="">
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

			}

		echo $output;
		
           
		    ?>
          <div class="listing-pagination " >
          		<ul class="pagination">
          		<?php for ($i=1; $i <= $nbpage; $i++) { ?>
          			<li   class="page-item <?php if($i==$page) echo 'active' ?>">
          				<span class='pagination_link page-link'  id="<?php echo $i; ?>"><?php echo $i; ?></span>
          			</li>
          		<?php } ?>
               </ul>
          </div>

		<?php
	}
	else{
		echo '<div class="text-page" style="width:100%">
		<p class="text-center">Aucune annonce ne correspond à votre recherche</p>
		</div>';
	}


}

?>
