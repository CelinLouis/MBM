<?php 
session_start();
     require_once "../../cnx.php";

     setlocale(LC_TIME, 'fr');

     if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['cat']) && !empty($_POST['cat'])){
     	$title = htmlspecialchars(trim($_POST['title']));
      $cat = htmlspecialchars(trim($_POST['cat']));

     	$conn->query(" INSERT INTO `an_souscat` (`id`, `id_cat`, `label`) VALUES ('', '".$cat."', '".$title."') ");

     	echo '
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                Vos données a été bien envoyé!!!
              </div>

     	';

           
     }else{
     	echo '
           <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                   Veulliez remplire le champ formulaire SVP!!!
              </div>

     	' ;
     }

 ?>