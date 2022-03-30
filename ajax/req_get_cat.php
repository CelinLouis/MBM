<?php  
	session_start();
	require '../cnx.php';

	if (isset($_POST['id_souscat'])) {
		$id_souscat = $_POST['id_souscat'];
		if ($id_souscat == 0) {
			 
		}
		else
		{
			$req= $conn->query("SELECT *,count(*) as n FROM an_souscat WHERE id_souscat = '".$id_souscat."' ");
			$res = $req->fetch_assoc();
			if ($res['lbl_form'] != "") {
				echo $res['lbl_form'];
			}
			else
			{
				echo "error";
			}
			
		}
		
	}
	
?>