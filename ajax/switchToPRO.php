<?php 

	include "../cnx.php";

	$membre = $_POST['u'];

	$sql = "UPDATE membres SET account_type='PRO' WHERE id=".$membre;
	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}
	
	$conn->close();
 ?>