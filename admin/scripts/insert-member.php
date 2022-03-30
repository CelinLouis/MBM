<?php
	require_once "../../cnx.php";
	echo 'ok';
	if (isset($_POST['submit'])) {
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
		
		$defaultHashedPassword = password_hash('test', PASSWORD_DEFAULT);
		echo 'ok';
		$sql = "INSERT INTO membres (account_type, username, name, first_name, comp_name, comp_num, email, phone, region, city, post_code, address, password) VALUES('".$account_type."', '".$username."', '".$name."', '".$first_name."', '".$comp_name."', '".$comp_num."', '".$email."', '".$phone."', '".$region."', '".$city."', '".$post_code."', '".$address."', '.$defaultHashedPassword.')";
		echo $sql;
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	$conn->close();
	header('Location: ../allMembers.php');
?>