<?php
	include("include/header.php");


	if (isset($_POST['Valider'])) {
        
   if (!empty($_POST['contact_name']) AND !empty($_POST['contact_email']) AND !empty($_POST['contact_phone']) AND !empty($_POST['contact_title']) AND !empty($_POST['contact_msg'])) 
   {
	$header = "MIME-VERSION/ 1.0\r\n";
    $header .= 'From:"PrimFX.com"<support@primfx.com'."\n";
    $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
    $header .= 'Content-Transfer-Encoding: 8bit';
    
    $message='
    <html>
      <body>
          <div align="center">
              J\'ai envoyé ce mail avec php !
              <br />
              <img src="http://www.primfx.com/mailing/separation.png"/>
              <br />
              <u> Nom de l\'expediteur :</u>'.$_POST['contact_name'].'
              <br />
              <u> Email :</u>'.$_POST['contact_email'].'
              <br />
              <u> Telephone :</u>'.$_POST['contact_phone'].'
              <br />
              <u> Nom de l\'expediteur :</u>'.$_POST['contact_msg'].'
              </div>
              </body>
              <html>
    ';

    mail("rakotonirinacelinlouis66@gmail.com", "DU SITE MBM", $message, $header);

			$msg ="Votre message a été bien envoyé";
		}else{
           $msg ="Tout les champs doivent être complete";
		}
	}
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

				<input type="text" name="contact_title" placeholder="Sujet du message" value=""  />
				<textarea class="textarea-height-strong" name="contact_msg" placeholder="Votre message" ></textarea>
			
			</div>
			
			<input type="submit" name="Valider" value="Valider" />
			
		</form>
  
	</div>
</div>
    
<?php
    if (isset($msg)) {
    	echo $msg;
    }
	include("include/footer.php");
?>