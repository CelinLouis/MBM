<?php 
require_once "../cnx.php";

$sql = "UPDATE an_annonces SET an_payment='payee' WHERE id=".$_GET['aid'];

if ($conn->query($sql) === TRUE) {
	//echo "Record updated successfully";
	header('Location: allAdvs.php');
} 
else {
	//echo "Error updating record: " . $conn->error;
	header('Location: allAdvs.php');
}

$conn->close();
 ?>