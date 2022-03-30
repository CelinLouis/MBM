<?php 
	
	require "../cnx.php";
  	session_start();

	if(isset($_POST['id_annonce']))
    {
      	$conn->query("DELETE FROM an_favori WHERE	id_membres = '".$_SESSION['id']."' && id_annonces = '".$_POST['id_annonce']."' ");

      	$r=$conn->query("SELECT COUNT(*) as n FROM an_favori WHERE	id_membres = '".$_SESSION['id']."' ");
      	$res=$r->fetch_assoc();
      	echo $res['n'];
      	//echo "supprimer";
    }
?>