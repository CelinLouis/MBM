<?php 
	include "../cnx.php";

	//echo $_POST['an']. ' ' .$_POST['nb'];
	$debut = date("Y-m-d H:i:s");
	$fin = date("Y-m-d H:i:s", strtotime("+". $_POST['nb'] ." days"));

	$sql = "INSERT INTO an_entetes (id_annonce, start_at, end_at) VALUES (". $_POST['an'] .", '". $debut ."', '". $fin ."')";
	
	if ($conn->query($sql) === TRUE) {
		echo "Votre annonce est maintenant parmi les annonces en tete pendant ". $_POST['nb'] ." jours.";
	} 
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

 ?>