<?php 
	include "../cnx.php";

	$membre = $_POST['u'];
	$c_name = $_POST['c_name'];
	$c_num = $_POST['c_num'];
	$name = $_POST['name'];
	$f_name = $_POST['f_name'];
	$reg = $_POST['reg'];
	$addr = $_POST['addr'];
	$p_code = $_POST['p_code'];
	$city = $_POST['city'];
	$phone = $_POST['phone'];

	$sql = "UPDATE membres SET  name='".$name."', first_name='".$f_name."', region=".$reg.", address='".$addr."', post_code=".$p_code.", city='".$city."', phone='".$phone."', comp_name='".$c_name."', comp_num='".$c_num."'' WHERE id=".$membre;
	
	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $conn->error;
	}
	
	$conn->close();
 ?>