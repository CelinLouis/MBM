<?php 

include "cnx.php";

$actuel = date("Y-m-d H:i:s");

$sql = "SELECT * FROM an_entetes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " .$row["lastname"]. "<br>";
		if ($row['end_at'] === $actuel) {
			$sql = "DELETE FROM an_entetes WHERE id=". $row['id'];
			
			if ($conn->query($sql) === TRUE) {
				echo "Record deleted successfully";
			} 
			else {
				echo "Error deleting record: " . $conn->error;
			}
		}
	}
} 
else {
	echo "0 results";
}

$conn->close();

 ?>