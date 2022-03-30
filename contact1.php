<?php
	include("include/header.php");
?>

<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child forms">

		<h1>Formulaire de contact</h1>
		<form action="post_contact.php" method="post">
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

	</div>
</div>

<?php
	include("include/footer.php");
?>