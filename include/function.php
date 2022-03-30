<?php  
	
	function liste_annee(){
		
		$date_actuel = date('Y');

		for($i=2000; $i<$date_actuel;$i++){
			echo "<option value=".$i.">".$i."</option>";
		}
	}
?>