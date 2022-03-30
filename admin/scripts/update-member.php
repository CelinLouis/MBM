<?php
	require_once "../../cnx.php";

	if (isset($_POST['submit'])) {
		$member = $_POST['id'];

		$account_type = $_POST['radio1'];
		$username = $_POST['username'];

		$name = $_POST['name'];
		$first_name = $_POST['first_name'];
		$comp_name = $_POST['comp_name'];
		$comp_num = $_POST['comp_num'];

		$email = $_POST['email'];
		$phone = $_POST['phone'];
		
		$region = $_POST['region'];
		$city = $_POST['city'];
		$post_code = $_POST['post_code'];
		$address = $_POST['address'];

		$sql = "UPDATE membres SET account_type='".$account_type."', username='".$username."', name='".$name."', first_name='".$first_name."', comp_name='".$comp_name."', comp_num='".$comp_num."', email='".$email."', phone='".$phone."', region='".$region."', city='".$city."', post_code='".$post_code."', address='".$address."'  WHERE id=".$member;

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}
	}

	$conn->close();

	header('Location: ../allMembers.php');
?>