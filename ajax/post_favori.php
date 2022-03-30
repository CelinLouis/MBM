<?php
  require "../cnx.php";
  session_start();

  if (isset($_POST['addfavorite']))
  {
    if($_POST['addfavorite'] == "adfav")
    {
      $conn->query("INSERT INTO an_favori(id_membres, id_annonces) VALUES ('".$_SESSION['id']."', '".$_POST['id_annonce']."')");
      echo "inserer";
    }
    if($_POST['addfavorite'] == "delfav")
    {
      $conn->query("DELETE FROM an_favori WHERE	id_membres = '".$_SESSION['id']."' && id_annonces = '".$_POST['id_annonce']."' ");
      echo "supprimer";
    }
  }
?>
