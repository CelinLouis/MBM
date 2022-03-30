<?php 
require_once "../cnx.php";

$sql = "UPDATE membres SET status='valide' WHERE id=".$_GET['uid'];

if ($conn->query($sql) === TRUE) {
	//echo "Record updated successfully";
	header('Location: allMembers.php');
} 
else {
	//echo "Error updating record: " . $conn->error;
	header('Location: allMembers.php');
}

$conn->close();
 ?>