<?php
	include("include/header.php");
?>

<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child forms">

		<h1>Formulaire de contact</h1>
		<form action="" method="post">
			<div>			
				<input type="text" name="contact_name" placeholder="Votre nom" value="" required />
				<input type="text" name="contact_email" placeholder="Votre email" value="" required />
				<input type="text" name="contact_phone" placeholder="Votre numéro de téléphone (optionnel)" value="" required />
				
				<select name="contact">
					<option value="1">La direction</option>				</select>

				<input type="text" name="contact_title" placeholder="Sujet du message" value="" required />
				<textarea class="textarea-height-strong" name="contact_msg" placeholder="Votre message" required></textarea>
			
			</div>
			
			<input type="submit" name="Valider" value="Valider" />
			
		</form>
    <?php 

   if (isset($_POST['Valider'])) 
   {
        
       if (!empty($_POST['contact_name']) AND !empty($_POST['contact_email']) AND !empty($_POST['contact_phone']) AND !empty($_POST['contact_title']) AND !empty($_POST['contact_msg'])) 
       {    
            $sujet = '=?UTF-8?B?'.base64_encode($_POST['contact_title']).'?=';
            $header = "MIME-VERSION/ 1.0\r\n";
            $header .= 'From:"myresto@myresto.me"<support@primfx.com'."\n";
            $header .= 'Content-Type:text/html; charset="utf-8"'."\n";
            $header .= 'Content-Transfer-Encoding: 8bit';

                 $name = htmlspecialchars($_POST['contact_name']);
                 $email = htmlspecialchars($_POST['contact_email']);
                 $num = htmlspecialchars($_POST['contact_phone']);
                 $msg = htmlspecialchars($_POST['contact_msg']);
            
            $destinateur = "rakotonirinacelinlouis66@gmail.com";

            $expediteur = $name.' <'. $email.'>';
            
            $message='
            <html>
              <body>
                  <div align="center">
                      J\'ai envoyé ce mail avec php !
                      <br />
                      <img src="http://www.primfx.com/mailing/separation.png"/>
                      <br />
                      <u> Nom de l\'expediteur :</u>'.$name.'
                      <br />
                      <u> Email :</u>'.$email.'
                      <br />
                      <u> Telephone :</u>'.$num.'
                      <br />
                      <u> message :</u>'.$msg.'
                      </div>
                      </body>
                      <html>
            ';

            mail($destinateur, $sujet, $message, $expediteur, $header);

              $msg ="Votre message a été bien envoyé";

            }else{
                   $msg ="Tout les champs doivent être complete";
            }
  }

?>

    
	</div>
  <?php 
        if (isset($msg)) 
        {
           echo $msg;
        }
    ?>
</div>
    
<?php
	include("include/footer.php");
?>
