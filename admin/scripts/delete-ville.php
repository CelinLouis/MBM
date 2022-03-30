<?php 
require_once "../../cnx.php";

$userId = $_GET['uid'];

$sql = "DELETE FROM an_ville WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

echo "Record deleted successfully";

$stmt->close();

$conn->close();
?>