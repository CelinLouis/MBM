<?php
$file1 = array();
$file2 = array();
$file3 = array();
$file4 = array();
$file5 = array();
$file6 = array();
$file7 = array();
$file8 = array();

if(isset($_POST['submit'])){
	$file1 = $_FILES['photo1'];
	$file2 = $_FILES['photo2'];
	$file3 = $_FILES['photo3'];
	$file4 = $_FILES['photo4'];
	$file5 = $_FILES['photo5'];
	$file6 = $_FILES['photo6'];
	$file7 = $_FILES['photo7'];
	$file8 = $_FILES['photo8'];	
}

$file1Name = $file1['name'];
$file1TmpName = $file1['tmp_name'];
$file1Err = $file1['error'];
$file1Dest = "uploads/".$file1Name;

$file2Name = $file2['name'];
$file2TmpName = $file2['tmp_name'];
$file2Err = $file2['error'];
$file2Dest = "uploads/".$file2Name;

$file3Name = $file3['name'];
$file3TmpName = $file3['tmp_name'];
$file3Err = $file3['error'];
$file3Dest = "uploads/".$file3Name;

$file4Name = $file4['name'];
$file4TmpName = $file4['tmp_name'];
$file4Err = $file4['error'];
$file4Dest = "uploads/".$file4Name;

$file5Name = $file5['name'];
$file5TmpName = $file5['tmp_name'];
$file5Err = $file5['error'];
$file5Dest = "uploads/".$file5Name;

$file6Name = $file6['name'];
$file6TmpName = $file6['tmp_name'];
$file6Err = $file6['error'];
$file6Dest = "uploads/".$file6Name;

$file7Name = $file7['name'];
$file7TmpName = $file7['tmp_name'];
$file7Err = $file7['error'];
$file7Dest = "uploads/".$file7Name;

$file8Name = $file8['name'];
$file8TmpName = $file8['tmp_name'];
$file8Err = $file8['error'];
$file8Dest = "uploads/".$file8Name;

if(move_uploaded_file($fileTmpName, $fileDest)){
	echo '<img src="'.$fileDest.'">';
}
else{
	echo "Erreur";
}
?>