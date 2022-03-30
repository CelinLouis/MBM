<?php 
if(isset($_POST['btn'])){
	$file = $_FILES['file'];
	$res = empty($file) ? "true" : "false";
	echo $res;
	print_r($file);
	die();
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];

	$fileDest = "uploads/".$fileName;

	if(move_uploaded_file($fileTmpName, $fileDest)){
		echo '<img src="'.$fileDest.'">';
	}
	else{
		echo "Erreur";
	}
}
?>
