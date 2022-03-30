<?php
	include("include/header.php");


?>

<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child forms">

		<h1>Formulaire de contact</h1>
		<form action="" method="post">
			<div>			
				<input type="text" name="contact_name" placeholder="Votre nom" value="<?php if(isset($_POST['contact_name'])) { echo $_POST['contact_name'];}?>" />
				<input type="text" name="contact_email" placeholder="Votre email" value=""  />
				<input type="text" name="contact_phone" placeholder="Votre numéro de téléphone (optionnel)" value=""  />
				
				<select name="contact">
					<option value="1">La direction</option>				</select>

				<input type="text" name="objet" placeholder="Sujet du message" value=""  />
				<textarea class="textarea-height-strong" name="message" placeholder="Votre message" ></textarea>
			
			</div>
			
			<input type="submit" name="Valider" value="Valider" />
			
		</form>
  
	</div>
</div>
    
<?php
        
   if (isset($_POST['Valider']) AND !empty($_POST['contact_name']) AND !empty($_POST['contact_email']) AND !empty($_POST['contact_phone']) AND !empty($_POST['objet']) AND !empty($_POST['message'])) 
   {
    
    extract($_POST);
    $destinateur = "rakotonirinacelinlouis66@gmail.com";
    $expediteur = $contact_name.' <'. $contact_email.'>';
    $mail = mail($destinateur, $objet, $message,$expediteur.'DU SITE MBM.COM');
     
     if ($mail) 
     {
       $msg ="Votre message a été bien envoyé";
     }else
     {
        $msg ="Votre message n'a pas été envoyé";
     }

      
    }else
    {
           $msg ="Tout les champs doivent être complete";
    }


    if (isset($msg)) {
    	echo $msg;
    }
	include("include/footer.php");
?>