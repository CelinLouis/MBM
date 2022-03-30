<?php
	require "include/header.php";
?>
<title>Déposer une annonce</title>
<script>
	var BASEURL = 'https://www.script-pag.com/demo/fr';
	var BASEURLIMG = 'https://www.script-pag.com/demo';
	var BASELAT = '-18.766947';
	var BASELNG = '46.869107';
</script>
<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child forms form-deposit">
		<h1>Déposer une petite annonce</h1>
		<form id="form_dep_annonce" method="post" action="">
			<div>
				<!--INFORMATION CLIENT-->
				<!--
				<?php //if (!isset($_SESSION['id'])): ?>
					<h3 class="first">Vos informations</h3>
					<input type="text" id="an_nom" class="short " name="an_nom" placeholder="Votre nom" value="" />
					<input type="text" id="an_email" class="short " name="an_email" placeholder="Votre email" value="" />
					<p>Votre email ne sera pas visible par les utilisateurs du site.<br />Ils pourront vous contacter en utilisant un formulaire prévu à cet effet.</p>
					<input type="text" id="an_phone" class="short " name="an_phone" placeholder="Votre numéro de téléphone" value="" />
					<p>
						<input type="checkbox" id="phone_hidden" name="phone_hidden" value="1"  />
						<label for="phone_hidden">Cacher votre numéro dans l'annonce</label>
					</p>
					<input type="password" id="an_password" class="short " name="an_password" placeholder="Mot de passe" value="" />
					<input type="password" id="an_conf_password" class="short " name="an_conf_password" placeholder="Confirmation du mot de passe" value="" />
				<?php //endif ?>
				-->

				<!--ANNONCE-->
				<h3>Votre annonce</h3>
				<select id="options" name="an_souscat[]" class="short">
					<option value="0">Choisissez la catégorie</option>
					<?php
						$sql = "SELECT  c.id as id, c.label as cat FROM an_categorie c";

						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()) {
							echo '<option value="0" disabled class="background_select_cat uppercase" style="background:#F5F5F5;">-- '.strtoupper($row['cat']).' --</option>';
							$idCat = $row['id'];

							$sql2 = "SELECT s.id as id, s.label as scat FROM an_souscat s WHERE s.id_cat=".$idCat;

							$result2 = $conn->query($sql2);
							while($row2 = $result2->fetch_assoc()) {
								echo '<option value="'.$row2['id'].'">'.$row2['scat'].'</option>';
							}
						}
					?>
				</select><br>
				<label for="options" class="error" style="display:none;">Please choose one.</label>

				<div>


					<select id="an_marquev" name="an_marquev[]" class="short option-1">
						<option value="0">-- Choisissez Marque --</option>
						<option>Alfa Romeo</option>
						<option>Aston Martin</option>
						<option>Audi</option>
						<option>Bentley</option>
						<option>BMW</option>
						<option>Cadillac</option>
						<option>Chevrolet</option>
						<option>Citroen</option>
						<option>Dacia</option>
						<option>Daewoo</option>
						<option>Daihatsu</option>
						<option>Dodge</option>
						<option>Ferrari</option>
						<option>Fiat</option>
						<option>Ford</option>
						<option>Ginetta</option>
						<option>Honda</option>
						<option>Hummer</option>
						<option>Hyundai</option>
						<option>Isuzu</option>
						<option>Jaguar</option>
						<option>Jeep</option>
						<option>Kia</option>
						<option>Lada</option>
						<option>Lamborghini</option>
						<option>Lancia</option>
						<option>Land Rover</option>
						<option>Lexus</option>
						<option>Lotus</option>
						<option>Maserati</option>
						<option>Mazda</option>
						<option>Mercedes-Benz</option>
						<option>Mitsubishi</option>
						<option>Morgan</option>
						<option>Nissan</option>
						<option>Opel</option>
						<option>Peugeot</option>
						<option>Porche</option>
						<option>Renault</option>
						<option>Rolls-Royce</option>
						<option>Rover</option>
						<option>Saab</option>
						<option>Seat</option>
						<option>Skoda</option>
						<option>Smart</option>
						<option>Subaru</option>
						<option>Suzuki</option>
						<option>Toyota</option>
						<option>TVR</option>
						<option>Volkswagen</option>
						<option>Volvo</option>
					</select>

					<select id="an_anneev" name="an_anneev[]" class="short option-1">
						<option value="0">-- Choisissez Année-Modèle --</option>
						<option value="avant 2000">Avant 2000</option>
						<?php
							$date_actuel = date('Y');

							for($i=2000; $i<$date_actuel;$i++){
								echo "<option value=".$i.">".$i."</option>";
							}
						 ?>
					</select>
					<!--label for="an_annee[]" class="error" style="display:none;">Please choose one.</label-->
					<input class="short option-1" type="text" id="an_kmeterv" name="an_kmeterv" placeholder="Kilométrage">

					<select name="an_energyv[]" id="an_energyv" class="short option-1">
				        <option value="0">-- Choisissez type Carburant --</option>
				        <option value="Essence">Essence</option>
						<option value="Diesel">Diesel</option>
						<option value="GPL">GPL</option>
						<option value="Electrique">Electrique</option>
						<option value="Hybride">Hybride</option>
				    </select>
					<!--label for="an_energy[]" class="error" style="display:none;">Please choose one.</label-->
					<select name="an_vitessev[]" id="an_vitessev"  class="short option-1">
					    <option value="0" >-- Choisissez Boîte de vitesse --</option>
						<option value="1">Automatique</option>
					    <option value="2">Manuelle</option>
					</select>
					<!--label for="an_vitesse[]" class="error" style="display:none;">Please choose one.</label-->

					<input class="short option-2" type="text" id="an_kmeterm" name="an_kmeterm" placeholder="Kilométrage">
					<select id="an_anneem" name="an_anneem[]" class="short option-2">
						<option value="0">-- Choisissez Année-Modèle --</option>
						<option value="avant 2000">Avant 2000</option>
						<?php
							$date_actuel = date('Y');

							for($i=2000; $i<$date_actuel;$i++){
								echo "<option value=".$i.">".$i."</option>";
							}
						 ?>
					</select>
					<!--<label for="an_annee[]" class="error" style="display:none;">Please choose one.</label-->
					<input class="short option-2" type="text" id="an_cylinder" name="an_cylinder" placeholder="Cylindrée">

					<input class="short option-3" type="text" id="an_kmeterc" name="an_kmeterc" placeholder="Kilométrage">


					<!--<label for="an_vitesse[]" class="error" style="display:none;">Please choose one.</label>-->

					<input class="short option-8" type="number" name="an_surfacevm" id="an_surfacevm" placeholder="Surface de la Maison">
					<input class="short option-8" type="number" name="an_piecevm" id="an_piecevm" placeholder="Nombre de pieces">
					<input class="short option-8" type="number" name="an_capacityvm" id="an_capacityvm" placeholder="Capacité de la Maison">

					<input class="short option-9" type="number" name="an_surfacelm" id="an_surfacelm" placeholder="Surface de la Maison">
					<input class="short option-9" type="number" name="an_piecelm" id="an_piecelm" placeholder="Nombre de pieces">
					<input class="short option-9" type="number" name="an_capacitylm" id="an_capacitylm" placeholder="Capacité de la Maison">

					<input class="short option-10" type="number" name="an_surfacet" id="an_surfacet" placeholder="Surface du Terrain">

					<input class="short option-11" type="number" name="an_surfacecl" id="an_surfacecl" placeholder="Surface de la Maison">
					<input class="short option-11" type="number" name="an_piececl" id="an_piececl" placeholder="Nombre de pieces">
					<input class="short option-11" type="number" name="an_capacitycl" id="an_capacitycl" placeholder="Capacité de la Maison">

					<input class="short option-12" type="date" name="an_debutlv" id="an_debutlv" placeholder="Debut du Location">
					<input class="short option-12" type="date" name="an_finlv" id="an_finlv" placeholder="Fin du Location">
					<input class="short option-12" type="number" name="an_surfacelv" id="an_surfacelv" placeholder="Surface de la Maison">
					<input class="short option-12" type="number" name="an_piecelv" id="an_piecelv" placeholder="Nombre de pieces">
					<input class="short option-12" type="number" name="an_capacitylv" id="an_capacitylv" placeholder="Capacité de la Maison">

					<input class="short option-13" type="number" name="an_surfacel" id="an_surfacel" placeholder="Surface du Locaux">
					<input class="short option-13" type="number" name="an_piecel" id="an_piecel" placeholder="Nombre de pieces">

					<input class="short option-14" type="number" name="an_surfaceg" id="an_surfaceg" placeholder="Surface du Garage">

					<input class="short option-15" type="number" name="an_surfacebc" id="an_surfacebc" placeholder="Surface du Bureau">
					<input class="short option-15" type="number" name="an_piecebc" id="an_piecebc" placeholder="Nombre de pieces">

					<select name="an_temploi[]" id="an_temploi" class="short option-16">
						<option value="0">Type d'emploi</option>
						<option value="permanent">Permanent</option>
						<option value="temporaire">Temporaire</option>
					</select>

					<select name="an_tcours[]" id="an_tcours" class="short option-17">
						<option value="0">Type du cour</option>
						<option value="jour">Du Jour</option>
						<option value="soir">Du Soir</option>
						<option value="vacance">De Vacance</option>
					</select>

					<select name="an_cporte[]" id="an_cporte" class="short option-19">
						<option value="0">Categorie</option>
						<option value="chemise">Chemise</option>
						<option value="tshirt">Tshirt</option>
						<option value="short">Short</option>
						<option value="pantalon">Pantalon</option>
						<option value="chaussure">Chaussure</option>
					</select>
					<select name="an_tporte[]" id="an_tporte" class="short option-19">
						<option value="0">Qualite</option>
						<option value="neuf">Neuf</option>
						<option value="occasion">Occasion</option>
					</select>
					<select name="an_pporte[]" id="an_pporte" class="short option-19">
						<option value="0">Personne</option>
						<option value="enfant">Enfant</option>
						<option value="femme">Femme</option>
						<option value="homme">Homme</option>
					</select>

					<select name="an_cmonbij[]" id="an_cmonbij" class="short option-21">
						<option value="0">Categorie</option>
						<option value="bague">Bague</option>
						<option value="boucle-d-oreille">Boucle d'oreille</option>
						<option value="bracelet">Bracelet</option>
						<option value="collier">Collier</option>
						<option value="montre">Montre</option>
					</select>
					<select name="an_mmonbij[]" id="an_mmonbij" class="short option-21">
						<option value="argent">Argent</option>
						<option value="or">Or</option>
						<option value="autre">Autre</option>
					</select>
					<select name="an_pmonbij[]" id="an_pmonbij" class="short option-21">
						<option value="0">Personne</option>
						<option value="enfant">Enfant</option>
						<option value="femme">Femme</option>
						<option value="homme">Homme</option>
					</select>

					<select name="an_imgson[]" id="an_imgson" class="short option-22">
						<option value="0">Categorie</option>
						<option value="ampli">Ampli</option>
						<option value="appareil-photo">Appareil photo</option>
						<option value="camera">Camera</option>
						<option value="micro">Micro</option>
						<option value="suboufer">Suboufer</option>
						<option value="autre">Autre</option>
					</select>

					<select name="an_info[]" id="an_info" class="short option-23">
						<option value="0">Categorie</option>
						<option value="accessoire">Accessoire</option>
						<option value="ordinateur-portable">Ordinateur Portable</option>
						<option value="moniteur">Moniteur</option>
						<option value="unite-centrale">Unite Centrale</option>
					</select>

					<select name="an_tel[]" id="an_tel" class="short option-24">
						<option value="0">Plateforme</option>
						<option value="android">Android</option>
						<option value="ios">iOS</option>
					</select>

					<select name="an_jeu[]" id="an_jeu" class="short option-25">
						<option value="0">Plateforme</option>
						<option value="pc">PC</option>
						<option value="playstation">Playstation</option>
						<option value="nitendo">Nitendo</option>
						<option value="xbox">Xbox</option>
					</select>

					<select name="an_genref[]" id="an_genref" class="short option-30">
						<option value="0">Choisir le genre</option>
						<option value="1">Action, Aventure</option>
						<option value="2">Comédie</option>
						<option value="3">Documentaire</option>
						<option value="4">Drame</option>
						<option value="5">Horreur</option>
						<option value="6">Fantastique</option>
						<option value="7">Policier</option>
						<option value="8">Romance</option>
						<option value="9">Science-Fiction</option>
						<option value="10">Western</option>
						<option value="11">Autres</option>
					</select>
					<input type="number" name="an_nombref" id="an_nombref" placeholder="Nombre des films" class="short option-30">

					<select name="an_genrem[]" id="an_genrem" class="short option-31">
						<option value="0">Choisir le genre</option>
						<option value="1">House, Techno, Electro, Dance</option>
						<option value="2">Jazz</option>
						<option value="3">Metal</option>
						<option value="4">Classique</option>
						<option value="5">Pop, Rock</option>
						<option value="6">R&B, Soul</option>
						<option value="7">Rap, Hip Hop</option>
						<option value="8">Reggae</option>
						<option value="9">Autres</option>
					</select>
					<input type="number" name="an_nombrem" id="an_nombrem" placeholder="Nombre des musiques" class="short option-31">


				</div>


				<div id="display_an_price"></div>

				<div id="options_form"></div>

				<p class="bold">Type d'annonce :</p>
				<p>
					<input type="radio" id="typ1" name="an_type[]" value="Offre"  />
					<label for="typ1">Vendre</label>

					<input type="radio" id="typ2" name="an_type[]" value="Demande"  />
					<label for="typ2">Acheter</label>
					<br>
					<label for="an_type[]" class="error" style="display:none;">Please choose one.</label>
				</p>

				<div>
					<input type="text" class="short " id="an_title" name="an_title" placeholder="Titre de votre annonce" value="" />
					<br>
					<label for="an_title" class="error" style="display:none;">Please choose one.</label>
				</div>
				<div>
					<textarea class="textarea-height-strong " cols="60" rows="10" placeholder="Votre annonce" id="an_desc" name="an_desc"></textarea>
					<br>
					<label for="an_desc" class="error" style="display:none;">Please choose one.</label>
				</div>

				<div>
					<input type="text" id="an_price" class="short " name="an_price" placeholder="Prix" value="" /><span><b>Ariary</b> <?php //echo "&nbsp;(optionnel)" ?></span>
					<br>
					<label for="an_price" class="error" style="display:none;">Please choose one.</label>

				</div>

				<!--LOCALISATION OFFRE-->
				<h3>Localisation</h3>
				<div id="geoloc-error1" class="tahoma" style="display:none;">Veuillez saisir et selectionner une ville ou un code postal.</div>
				<div id="geoloc-error2" class="tahoma" style="display:none;">Votre navigateur ne permet pas de vous géolocaliser.</div>
				<div id="geoloc-error3" class="tahoma" style="display:none;">Vous avez refusé la géolocalisation.</div>
				<div id="geoloc-error4" class="tahoma" style="display:none;">Une erreur est survenue lors de la géolocalisation.</div>
				<div id="geoloc-info" class="tahoma" style="display:none;">Vérifiez les informations ci-dessous.<br />Vous pouvez préciser votre position en déplaçant le marqueur sur la carte.</div>
				<a href="javascript:void(0)" id="geolocalisation-link" class="first-color bold">Cliquer ici pour vous géolocaliser</a>
				<input type="hidden" name="lat" id="lat" value="0" />
				<input type="hidden" name="lng" id="lng" value="0" />
				<div class="geolocalisation flex-container">
					<div>
						<select id="an_region" name="an_region[]" class="">
							<option value="0">Choisissez la région</option>
							<?php
								$sql = "SELECT  r.id as id, r.label as reg FROM an_region r";

								$result = $conn->query($sql);
								while($row = $result->fetch_assoc()) {
									echo '<option value="'.$row['id'].'">'.$row['reg'].'</option>';
								}
							?>
						</select>
						<div id="display_counties"></div>
						<div>
							<input type="text" id="an_city" class="" name="an_city" placeholder="Votre ville" value="" />
						</div>
						<div>
							<input type="text" id="an_postcode" class="" name="an_postcode" placeholder="Votre code postal (ex : 401)" value="" />
						</div>
						<div>
							<input type="text" id="an_address" class="" name="an_address" placeholder="Adresse" value="" />
						</div>
					</div>
					<div id="display-map"></div>
				</div>

				<div id="upload_file_wrap" style="display:none;"></div>

				<div id="upload_photo_wrap"></div>

				<!--h3>Options</h3>

				<div class="option">
					<h3>OPTION <span class="color-top-option">ANNONCE EN TÊTE</span></h3>
					<p>
						<input type="radio" id="opt_type1_1" name="opt_type1" value="0" checked />
						<label for="opt_type1_1">Pas d'option en tête</label>
					</p>
					<p>
						<input type="radio" id="opt_type1_2" name="opt_type1" value="1"  />
						<label for="opt_type1_2">Mon annonce remonte <span class="color-top-option">en tête</span> tous les jours pendant : 7 Jour(s) : 15,00 €</label>
					</p>
					<p>
						<input type="radio" id="opt_type1_3" name="opt_type1" value="2"  />
						<label for="opt_type1_3">Mon annonce remonte <span class="color-top-option">en tête</span> tous les jours pendant : 15 Jour(s) : 25,00 €</label>
					</p>
					<p>
						<input type="radio" id="opt_type1_4" name="opt_type1" value="3"  />
						<label for="opt_type1_4">Mon annonce remonte <span class="color-top-option">en tête</span> tous les jours pendant : 30 Jour(s) : 40,00 €</label>
					</p>
				</div>

				<div class="option">
					<h3>OPTION <span class="color-premium-option">PREMIUM</span></h3>
					<p>
						<input type="radio" id="opt_type2_1" name="opt_type2" value="0" checked />
						<label for="opt_type2_1">Pas d'option premium</label>
					</p>
					<p>
						<input type="radio" id="opt_type2_5" name="opt_type2" value="4"  />
						<label for="opt_type2_5">Mon annonce <span class="color-premium-option">premium</span> pendant : 7 Jour(s) : 5,00 €</label>
					</p>
					<p>
						<input type="radio" id="opt_type2_6" name="opt_type2" value="5"  />
						<label for="opt_type2_6">Mon annonce <span class="color-premium-option">premium</span> pendant : 15 Jour(s) : 9,00 €</label>
					</p>
					<p>
						<input type="radio" id="opt_type2_7" name="opt_type2" value="6"  />
						<label for="opt_type2_7">Mon annonce <span class="color-premium-option">premium</span> pendant : 30 Jour(s) : 16,00 €</label>
					</p>
				</div>

				<div class="option">
					<h3>OPTION <span class="color-urgent-option">LOGO URGENT</span></h3>
					<p>
						<input type="radio" id="opt_type3_1" name="opt_type3" value="0" checked />
						<label for="opt_type3_1">Pas d'option logo urgent</label>
					</p>
					<p>
						<input type="radio" id="opt_type3_8" name="opt_type3" value="7"  />
						<label for="opt_type3_8"><span class="color-urgent-option">Logo urgent</span> sur mon annonce pendant : 7 Jour(s) : 3,00 €</label>
					</p>
					<p>
						<input type="radio" id="opt_type3_9" name="opt_type3" value="8"  />
						<label for="opt_type3_9"><span class="color-urgent-option">Logo urgent</span> sur mon annonce pendant : 15 Jour(s) : 5,00 €</label>
					</p>
				</div>

				<div class="option">
					<h3>OPTION <span class="color-framed-option">ANNONCE ENCADRÉES</span></h3>
					<p>
						<input type="radio" id="opt_type4_1" name="opt_type4" value="0" checked />
						<label for="opt_type4_1">Pas d'option annonce encadrées</label>
					</p>
					<p>
						<input type="radio" id="opt_type4_10" name="opt_type4" value="9"  />
						<label for="opt_type4_10">Mon annonce <span class="color-framed-option">Encadrée</span> pendant : 30 Jour(s) : 10,00 €</label>
					</p>
				</div-->
				<input type="hidden" id="photo1" name="">
				<input type="hidden" id="photo2" name="">
				<input type="hidden" id="photo3" name="">
				<input type="hidden" id="photo4" name="">
				<input type="hidden" id="photo5" name="">
				<input type="hidden" id="photo6" name="">
				<input type="hidden" id="photo7" name="">
				<input type="hidden" id="photo8" name="">

				<p class="gtc">
					<input type="checkbox" id="an_cond" name="an_cond" value="1"  />
					<label for="an_cond">Je reconnais avoir lu et accepter les <a href="info/Conditions-generales-d-utilisation-3.html" class="first-color bold" target="_blank">Conditions générales d'utilisation</a> et la <a href="info/Politique-de-confidentialite-5.html" class="first-color bold" target="_blank">Politique de confidentialité</a></label><br>
					<label for="an_cond" class="error" style="display:none;float: left;">Please choose one.</label>
				</p>

			</div>

			<div id="uploadForm"  target="uploadFrame" name="upload" >
				<h3>Vos photos</h3>
				<p>
					<span class="bold">Vous pouvez télécharger 3 photo(s) GRATUITEMENT + 5 dans le pack payant<br />En fonction de la taille de votre image, le téléchargement peut prendre plusieurs minutes.</span>
				</p>

				<!--p>Le prix du pack photo est de : 19,00 €</p-->

				<p>
					<span id="err_depot_1" class="p-error">L'extension de votre fichier n'est pas autorisée. Merci de choisir une image dont l'extension (jpg,jpeg ou png).</span>
					<span id="err_depot_2" class="p-error">Le poids de votre fichier est trop lourd.</span>
					<span id="err_depot_3" class="p-error">Une erreur s'est produite lors du téléchargement.</span>
					<span id="err_depot_4" class="p-error">Vous avez atteint le nombre maximum de photo</span>
				</p>

				<div id="upload" class="flex-container">
					<div><a id="imgdel_1" class="upload_delete_link" href="includes/display/ad_photos_upload_delete681a.html?id=1"></a>
						<span>1</span>
						<input id="file_1" type="file" class="input-file" name="photo1" />
						<p class="loading" id="loading_1" style="background:transparent;">
							<img id="imgload_1" src="images/loading.gif" alt="" />
						</p>
						<img class="upload_photo" id="imgshow_1" src="images/upload_photo.png" alt="" />

					</div>

					<div>
						<a id="imgdel_2" class="upload_delete_link" href="includes/display/ad_photos_upload_delete0b30.html?id=2" ></a>
						<span>2</span>
						<input id="file_2" type="file" class="input-file" name="photo2" />
						<p class="loading" id="loading_2" style="background:transparent;">
							<img id="imgload_2" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_2" class="upload_photo" src="images/upload_photo.png" alt="" />

					</div>

					<div>
						<a id="imgdel_3" class="upload_delete_link" href="includes/display/ad_photos_upload_deleted708.html?id=3"></a>
						<span>3</span>
						<input id="file_3" type="file" class="input-file" name="photo3" />
						<p class="loading" id="loading_3" style="background:transparent;">
							<img id="imgload_3" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_3" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_4" class="upload_delete_link" href="includes/display/ad_photos_upload_deletedcfd.html?id=4"></a>
						<span>4</span>
						<input id="file_4" type="file" class="input-file" name="photo4" />
						<p class="loading" id="loading_4" style="background:transparent;">
							<img id="imgload_4" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_4" class="upload_photo"  src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_5" class="upload_delete_link" href="includes/display/ad_photos_upload_deleted61c.html?id=5"></a>
						<span>5</span>
						<input id="file_5" type="file" class="input-file" name="photo5" />
						<p class="loading" id="loading_5" style="background:transparent;">
							<img id="imgload_5" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_5" class="upload_photo"  src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_6" class="upload_delete_link" href="includes/display/ad_photos_upload_delete3a9f.html?id=6"></a>
						<span>6</span>
						<input id="file_6" type="file" class="input-file" name="photo6" />
						<p class="loading" id="loading_6" style="background:transparent;">
							<img id="imgload_6" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_6" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_7" class="upload_delete_link" href="includes/display/ad_photos_upload_delete8803.html?id=7"></a>
						<span>7</span>
						<input id="file_7" type="file" class="input-file" name="photo7" />
						<p class="loading" id="loading_7" style="background:transparent;">
							<img id="imgload_7" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_7" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_8" class="upload_delete_link" href="includes/display/ad_photos_upload_deletec3c9.html?id=8"></a>
						<span>8</span>
						<input id="file_8" type="file" class="input-file" name="photo15" />
						<p class="loading" id="loading_8" style="background:transparent;">
							<img id="imgload_8" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_8" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>

					<div id="ad_photo_pack_button">
						<a class="upload_delete_link" href="javascript:void(0)"></a><span>+</span>
						<img class="upload_photo" src="images/upload_photo.png" alt="" />
						<p>5 Photo(s) supplémentaire(s)</p>
					</div>
				</div>

				<input type="hidden" name="nb_photo_free" id="nb_photo_free" data-nb-photo-free="3" data-nb-photo-total="8" />

			</div>
			<input type="hidden" id="iduser" value="<?php echo $_SESSION['id'] ?>" />
			<input type="submit" value="Valider" id="btn_submit_annonce" name="submit" />

		<!--/form>

		<form id="uploadFileForm" enctype="multipart/form-data" target="uploadFileFrame" name="uploadFile" method="post" action="#">
			<h3>Vos documents</h3>
			<p>
				<span class="bold">Vous pouvez télécharger 10 fichier(s) GRATUITEMENT<br />En fonction de la taille de votre fichier, le téléchargement peut prendre plusieurs minutes.</span><br />(optionnel) &nbsp; PDF, DOC, DOCX ou ODT</p>
			<p>
				<span id="err_depot_5" class="p-error">L'extension de votre fichier n'est pas autorisée.</span>
				<span id="err_depot_6" class="p-error">Le poids de votre fichier est trop lourd.</span>
				<span id="err_depot_7" class="p-error">Une erreur s'est produite lors du téléchargement.</span>
				<span id="err_depot_8" class="p-error">Vous avez atteint le nombre maximum de fichier</span>
			</p>
			<div id="uploadFile" class="flex-container">
				<div >
					<a class="upload_delete_link" href=""></a>
					<span>1</span>
					<input type="file" class="input-file" name="file1" />
					<p class="loading"><img src="images/loading.gif" alt="" /></p>
					<img class="upload_file" src="images/upload_file.png" alt="" />
				</div>
				<div style="display:none">
					<a class="upload_delete_link" href=""></a>
					<span>2</span>
					<input type="file" class="input-file" name="file2" />
					<p class="loading"><img src="images/loading.gif" alt="" /></p>
					<img class="upload_file" src="images/upload_file.png" alt="" />
				</div>
				<div style="display:none">
					<a class="upload_delete_link" href=""></a>
					<span>3</span>
					<input type="file" class="input-file" name="file3" />
					<p class="loading"><img src="images/loading.gif" alt="" /></p>
					<img class="upload_file" src="images/upload_file.png" alt="" />
				</div>
				<div style="display:none">
					<a class="upload_delete_link" href=""></a>
					<span>4</span>
					<input type="file" class="input-file" name="file4" />
					<p class="loading"><img src="images/loading.gif" alt="" /></p>
					<img class="upload_file" src="images/upload_file.png" alt="" />
				</div>
				<div style="display:none">
					<a class="upload_delete_link" href=""></a>
					<span>5</span>
					<input type="file" class="input-file" name="file5" />
					<p class="loading"><img src="images/loading.gif" alt="" /></p>
					<img class="upload_file" src="images/upload_file.png" alt="" />
				</div>
			</div>

		</form>

		<form id="uploadForm" enctype="multipart/form-data" target="uploadFrame" name="upload" method="post" action="#">
			<h3>Vos photos</h3>
			<p>
				<span class="bold">Vous pouvez télécharger 4 photo(s) GRATUITEMENT + 4 dans le pack payant<br />En fonction de la taille de votre image, le téléchargement peut prendre plusieurs minutes.</span></p>
				<p>Le prix du pack photo est de : 10000,00 Ar</p>
			<p>
				<span id="err_depot_1" class="p-error">L'extension de votre fichier n'est pas autorisée.</span>
				<span id="err_depot_2" class="p-error">Le poids de votre fichier est trop lourd.</span>
				<span id="err_depot_3" class="p-error">Une erreur s'est produite lors du téléchargement.</span>
				<span id="err_depot_4" class="p-error">Vous avez atteint le nombre maximum de photo</span>
			</p>
			<div id="upload" class="flex-container">
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>1</span>
					<input type="file" class="input-file" name="photo1" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo1" src="images/upload_photo.png" alt="" />
				</div>
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>2</span>
					<input type="file" class="input-file" name="photo2" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo2" src="images/upload_photo.png" alt="" />
				</div>
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>3</span>
					<input type="file" class="input-file" name="photo3" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo3" src="images/upload_photo.png" alt="" />
				</div>
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>4</span>
					<input type="file" class="input-file" name="photo4" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo4" src="images/upload_photo.png" alt="" />
				</div>
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>5</span>
					<input type="file" class="input-file" name="photo5" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo5" src="images/upload_photo.png" alt="" />
				</div>
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>6</span>
					<input type="file" class="input-file" name="photo6" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo6" src="images/upload_photo.png" alt="" />
				</div>
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>7</span>
					<input type="file" class="input-file" name="photo7" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo7" src="images/upload_photo.png" alt="" />
				</div>
				<div>
					<a class="upload_delete_link" href=""></a>
					<span>8</span>
					<input type="file" class="input-file" name="photo8" />
					<p class="loading">
						<img src="images/loading.gif" alt="" />
					</p>
					<img class="upload_photo" id="photo8" src="images/upload_photo.png" alt="" />
				</div>
				<div id="ad_photo_pack_button">
					<a class="upload_delete_link" href="javascript:void(0)"></a>
					<span>+</span>
					<img class="upload_photo" src="images/upload_photo.png" alt="" />
					<p>4 Photo(s) supplémentaire(s)</p>
				</div>
			<input type="hidden" name="nb_photo_free" id="nb_photo_free" data-nb-photo-free="4" data-nb-photo-total="8" />

		</form-->

		</form>

	</div>
</div>

<?php
	require "include/footer.php";
?>

<script>
	var visit_latitude = 0;
	var visit_longitude = 0;
</script>

<script type="text/javascript">
	/*$("#pri").on('click', function(){
		console.log(formatPrice($("#an_price").val()));
	});*/



	function formatNumberField() {
	    // unformat the value
	    var value = this.value.replace(/[^\d,]/g, '');

	    // split value into (leading digits, 3*x digits, decimal part)
	    // also allows numbers like ',5'; if you don't want that,
	    // use /^(\d{1,3})((?:\d{3})*))((?:,\d*)?)$/ instead
	    var matches = /^(?:(\d{1,3})?((?:\d{3})*))((?:,\d*)?)$/.exec(value);

	    if (!matches) {
	        // invalid format; deal with it however you want to
	        // this just stops trying to reformat the value
	        return;
	    }

	    // add a space before every group of three digits
	    var spaceified = matches[2].replace(/(\d{3})/g, ' $1');

	    // now splice it all back together
	    this.value = [matches[1], spaceified, matches[3]].join('');
	}

	// attaching event handler with jQuery...
	$(document).ready(function() {
	    $('#an_price').on('keyup', formatNumberField);
	});

	// With vanilla JS, it can get a little ugly.  This is the simplest way that
	// will work in pretty much all browsers.
	// Stick this in your "dom is loaded" callback
	document.getElementById('an_price').onkeyup = formatNumberField;
</script>
