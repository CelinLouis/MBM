<?php 
require_once "../../cnx.php";

$advId = $_GET['aid'];

$sql = "DELETE FROM an_annonces WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $advId);
$stmt->execute();

echo "Record deleted successfully";

$stmt->close();

$conn->close();

header('Location: ../allAdvs.php');
?>