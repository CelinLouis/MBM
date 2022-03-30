<?php

session_start();
	include('cnx.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM product, an_type WHERE product.product_status = '1' AND product.product_type = an_type.id
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["brand"]))
	{
		$brand_filter = implode("','", $_POST["brand"]);
		$query .= "
		 AND product_brand IN('".$brand_filter."')
		";
	}
	if(isset($_POST["ram"]))
	{
		$ram_filter = implode("','", $_POST["ram"]);
		$query .= "
		 AND product_ram IN('".$ram_filter."')
		";
	}
	if(isset($_POST["storage"]))
	{
		$storage_filter = implode("','", $_POST["storage"]);
		$query .= "
		 AND product_storage IN('".$storage_filter."')
		";
	}
	if (isset($_POST["type"])) 
	{
		$type_filter = implode("','", $_POST["type"]);
		$query .= " 
		AND product_type IN('".$type_filter."') 
		";
	}

	$statement = $conn->query($query);
	//$total_row = $statement->rowCount();
	$output = '';
	//if($total_row > 0)
	//{
		while ( $result = $statement->fetch_assoc()) {
			$output .= '
			<div class="background-ads-listing-container">
				<a href="../../../selection.html" data-heart="1" data-id="11" class="icon-heart "></a>
				<a href="view.php?Id='. $result['product_id'] .'" class="background-ads-listing  flex-container" title="We sell beautiful labrador, contact us for more information.">
				    <div class="bloc-listing-picture">
					<img src="image/'. $result['product_image'] .'" alt="" />				</div>
					<div class="bloc-listing-first">
					<p class="title-listing">'. $result['product_name'] .'</p>
					<div class="flex-container">
						<p class="localisation-listing">
							Prix : '. $result['product_price'] .' Ar  <br />
							Camera : '. $result['product_camera'].' MP	<br />
                            RAM : '. $result['product_ram'] .' GB 				
			                                                    
			                                                    
					                                            </p>
						
					</div>
				</div>
				<div class="bloc-listing-last">
					<p>
					   Storage : '. $result['product_storage'] .' GB 
					   Brand : '. $result['product_brand'] .' <br /><span class="logo-urgent">'. $result['label'] .'</span>
					</p>
				</div>
				
			</a>
			
		</div><br>

					
					








			';
		}




			
			 
			
						
						
						
			
				
				
					
										
						
						





	//}
	//else
	//{
	//	$output = '<h3>No Data Found</h3>';
	//}
	echo $output;
}

?>