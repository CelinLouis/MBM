<?php  
session_start();
 require_once "../../cnx.php";
 
 $messages = array();

 $recup_messages = $conn->query("SELECT * FROM an_categorie INNER JOIN an_souscat ON an_categorie.id = an_souscat.id_cat AND an_souscat.id_cat = ".$_GET['id']." ");

 while ($all = $recup_messages->fetch_assoc()) 
 {
 	$messages[] = $all;
 	
 }?>
     <div class="card-body">
	            <table id="example1" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                  <th>Id</th>
		                  <th>Titre</th>
		                </tr>
	                </thead>
	                <tbody>
     <?php
 foreach ($messages as $message) {?>
 	     <tr>
 	     	<td><?php echo ucfirst($message['id']); ?></td>
 	     	<td><?php echo strtoupper($message['label']); ?></td>
 	     	<td class="btn-group btn-group-sm">
              <a href="addSous.php?uid=<?php echo $message['id_cat']; ?>&sid=<?php echo $message['id']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
            </td>
		    <td class="btn-group btn-group-sm">	
               <a href="scripts/delete-sous.php?uid=<?php echo $message['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
            </td>  
		          
 	     </tr>
 		
   <?php } ?>
                   </tbody>
		            <tfoot>
		                <tr>
		                  <th>Id</th>
		                  <th>Titre</th>
		                </tr>
	                </tfoot>
	            </table>
            </div>
    <?php 


    

?>