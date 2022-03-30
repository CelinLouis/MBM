<?php  
	include("include/header.php");
?>
<title>Créer un compte PRO</title>
<div class="container-100 header-end"></div>



<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG. Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="container-100">
	<div class="container-100-child forms">
		
		<h1>Création de votre compte PRO</h1>
		<form method="post" action="ins2_validation.php">
			
			<div>
				<?php
					if (isset($_GET['error'])) {
						if ($_GET['error'] == "emptyfields") {
							echo '<p style="color: red;">Tous les champs doivent etre rempli.</p>';
						}
						elseif ($_GET['error'] == "invalidpostcode") {
							echo '<p style="color: red;">Le code postale ne doit contenir que des chiffres.</p>';	
						}
						elseif ($_GET['error'] == "invalidmail") {
							echo '<p style="color: red;">Votre adresse email est invalide.</p>';
						}
						elseif ($_GET['error'] == "existingmail") {
							echo '<p style="color: red;">L\'adresse email que vous avez compose est deja prise.</p>';
						}
						elseif ($_GET['error'] == "passwordlen") {
							echo '<p style="color: red;">La longueur de votre mot de passe doit etre superieur a 8 caracteres.</p>';
						}
						elseif ($_GET['error'] == "passwordcheck") {
							echo '<p style="color: red;">Les deux mots de passe ne correspondent pas.</p>';
						}
					}
					elseif (isset($_GET['success'])) {
						echo '<p style="color: green;">Votre compte a bien ete cree.</p>';
					}
				?>
								
				<a class="button-facebook-connect" href="https://www.facebook.com/v2.10/dialog/oauth?client_id=1409867919278394&amp;state=7cc09fec853040001dce04a6aa788031&amp;response_type=code&amp;sdk=php-sdk-5.6.1&amp;redirect_uri=https%3A%2F%2Fwww.script-pag.com%2Fdemo%2FPagrowoc%2Ffb_connect.php%3Ftype%3D2&amp;scope=email">Créer un compte avec Facebook</a>
								
				<input type="hidden" name="ip" value="197.149.62.133" />
				
				<input type="text" class="" name="comp_name" placeholder="Nom de votre entreprise" value="<?= isset($_GET['c_name']) ? $_GET['c_name'] : ''; ?>" />
				<input type="text" class="" name="comp_num" placeholder="N° Entreprise" value="<?= isset($_GET['c_num']) ? $_GET['c_num'] : ''; ?>" />
													
				<select name="civility">
					<option value="M"  >M</option>
					<option value="Mme"  >Mme</option>
					<option value="Melle"  >Melle</option>
				</select>
				
				<input type="text" class="" name="name" placeholder="Votre nom" value="" />
				<input type="text" class="" name="first_name" placeholder="Votre prénom" value="" />
				
				<select id="form_county" name="reg" onchange="DisplayCounties()"><option value="0">Choisissez la région</option><option value="1">Auvergne-Rhône-Alpes</option><option value="2">Bourgogne-Franche-Comté</option><option value="3">Bretagne</option><option value="4">Centre-Val-de-Loire</option><option value="5">Corse</option><option value="6">Grand-Est</option><option value="7">Hauts-de-France</option><option value="8">Ile-de-France</option><option value="9">Normandie</option><option value="10">Nouvelle-Aquitaine</option><option value="11">Occitanie</option><option value="12">Pays de la Loire</option><option value="13">Provence-Alpes-Côte-d&#039;Azur</option><option value="14">Guadeloupe</option><option value="15">Guyane</option><option value="16">La Réunion</option><option value="17">Martinique</option><option value="18">Mayotte</option></select>			 
				<div id="display_counties">
									</div>
				
								
				<input type="text" class="" name="address" placeholder="Votre adresse" value="" />
			 
				<input type="text" class="" name="postcode" placeholder="Votre code postal (ex : 75000)" value="" />
								
				<input type="text" class="" name="city" placeholder="Votre ville" value="" />
								
				<input type="text" class="" name="phone" placeholder="Votre numéro de téléphone" value="" />
				<input type="text" class="" name="email" placeholder="Votre email" value="" />
				<input type="password" class="" name="pas" placeholder="Mot de passe" value="" />
				<input type="password" class="" name="pas2" placeholder="Confirmation du mot de passe" value="" />
				
				<p>
					<input type="checkbox" id="gtc" name="gtc" value="1"  />
					<label for="gtc">Je reconnais avoir lu et accepter les <a href="info/Conditions-generales-d-utilisation-3.html" class="first-color bold" target="_blank">Conditions générales d'utilisation</a> et la <a href="info/Politique-de-confidentialite-5.html" class="first-color bold" target="_blank">Politique de confidentialité</a></label>
				</p>
				
			</div>
				
			<input type="submit" value="Valider" />
			
		</form>

	</div>
</div>
<?php  
	include("include/footer.php");
?>
<script>
	var visit_latitude = 0;
	var visit_longitude = 0;
</script>

<script src="../js/map.js"></script>




<script>
window.___gcfg = {lang: 'fr'}; 

(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = '../../../../apis.google.com/js/platform.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>

<script>
	var more_premium = new dialogBox();
	more_premium.init({
		container: 'body',
		wrapper: {element: 'div', id: 'more-premium-box'},
		triggered: {event: 'click', element: '.more-premium-box'},
		width: '50%',
		height: '50%',
		content: 'https://www.script-pag.com/demo/Pagrowoc/more_premium.php',
		active_breakpoint: true,
		breakpoint: {width: 501, height: 501},
		breakpoint_dimensions: {width: '90%', height: '90%'}
	});
	</script>

</body>

<!-- Mirrored from www.script-pag.com/demo/Pagrowoc/fr/acc_created.php?type=2 by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 16:42:16 GMT -->
</html>