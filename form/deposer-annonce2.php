<?php
	require "include/header.php";
?>
<title>Deposer une annonce</title>

<div class="container-100 header-end"></div>
<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG. Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="container-100">
	<div class="container-100-child forms form-deposit">		
		<h1>Déposer une petite annonce</h1>
		<form id="form_dep_annonce" method="post" action="#">		
			<div>	
								<!--INFORMATION CLIENT-->
				<?php if (!isset($_SESSION['id'])): ?>
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
				<?php endif ?>		


											<!--ANNONCE-->			
				<h3>Votre annonce</h3>
				<!--
					<select id="options" name="cat" class="short" onchange="DisplayOptions(); DisplayNote(); Displayan_price(); DisplayCalendar(); DisplayFile()">
				-->
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
						
						$conn->close();
					?>
				</select>		
				<br>
				<label for="options" class="error" style="display:none;">Please choose one.</label>			
				<div id="display_an_price"></div>
								
				<div id="options_form"></div>

				<input class="short option-1" type="text" id="an_kmeterv" name="an_kmeterv" placeholder="Kilométrage">
				<select id="an_anneev" name="an_anneev[]" class="short option-1"><option value="0">« Choisissez année-modèle»</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960 ou avant">1960 ou avant</option></select>
				<!--label for="an_annee[]" class="error" style="display:none;">Please choose one.</label-->
				<select name="an_energyv[]" id="an_energyv" class="short option-1">
			        <option value="0">« Choisissez carburant »</option>
			        <option value="Essence">Essence</option>
					<option value="Diesel">Diesel</option>
					<option value="GPL">GPL</option>
					<option value="Electrique">Electrique</option>
					<option value="Hybride">Hybride</option>
					<option value="Autre">Autre</option>
			    </select>
				<!--label for="an_energy[]" class="error" style="display:none;">Please choose one.</label-->
				<select name="an_vitessev[]" id="an_vitessev"  class="short option-1">
				    <option value="0" >« Choisissez Boîte de vitesse »</option>
				    <option value="1">Manuelle</option>
					<option value="2">Automatique</option>
				</select>
				<!--label for="an_vitesse[]" class="error" style="display:none;">Please choose one.</label-->
						
				<!--<input class="short option-2" type="text" id="kmeterm" name="an_kmeterm" placeholder="Kilométrage">
				<select id="an_anneem" name="an_anneem[]" class="short option-2"><option value="0">« Choisissez année-modèle»</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960 ou avant">1960 ou avant</option></select>
				<label for="an_annee[]" class="error" style="display:none;">Please choose one.</label
				<input class="short option-2" type="text" id="cylinder" name="an_cylinder" placeholder="Cylindrée">

				<input class="short option-3" type="text" id="an_kmeterc" name="an_kmeterc" placeholder="Kilométrage">
				<select id="an_anneec" name="an_anneec[]" class="short option-3"><option value="0">« Choisissez année-modèle»</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960 ou avant">1960 ou avant</option></select>
				<label for="an_annee[]" class="error" style="display:none;">Please choose one.</label
				<select name="an_energyc[]" id="an_energyc" class="short option-3">
			        <option value="0">« Choisissez carburant »</option>
			        <option value="Essence">Essence</option>
					<option value="Diesel">Diesel</option>
					<option value="GPL">GPL</option>
					<option value="Electrique">Electrique</option>
					<option value="Hybride">Hybride</option>
					<option value="Autre">Autre</option>
			    </select>
				<label for="an_energy[]" class="error" style="display:none;">Please choose one.</label>
				<select name="an_vitessec[]" id="an_vitessec"  class="short option-3">
				    <option value="0" >« Choisissez Boîte de vitesse »</option>
				    <option value="1">Manuelle</option>
					<option value="2">Automatique</option>
				</select>
				<label for="an_vitesse[]" class="error" style="display:none;">Please choose one.</label>

				<input class="short option-8" type="text" name="an_surface" placeholder="Surface">
				<input class="short option-8" type="text" name="an_piece" placeholder="Piece">
				<input class="short option-8" type="text" name="an_capacity" placeholder="Capacité">

				<input class="short option-9" type="text" name="an_surface" placeholder="Surface">
				<input class="short option-9" type="text" name="an_piece" placeholder="Piece">
				<input class="short option-9" type="text" name="an_capacity" placeholder="Capacité">

				<input class="short option-10" type="text" name="an_surface" placeholder="Surface">

				<input class="short option-11" type="text" name="an_surface" placeholder="Surface">
				<input class="short option-11" type="text" name="an_piece" placeholder="Piece">
				<input class="short option-11" type="text" name="an_capacity" placeholder="Capacité">

				<input class="short option-12" type="text" name="an_debut" placeholder="Debut">
				<input class="short option-12" type="text" name="an_fin" placeholder="Fin">
				<input class="short option-12" type="text" name="an_surface" placeholder="Surface">
				<input class="short option-12" type="text" name="an_piece" placeholder="Piece">
				<input class="short option-12" type="text" name="an_capacity" placeholder="Capacité">

				<input class="short option-13" type="text" name="an_surface" placeholder="Surface">
				<input class="short option-13" type="text" name="an_piece" placeholder="Piece">

				<input class="short option-14" type="text" name="an_surface" placeholder="Surface">

				<input class="short option-15" type="text" name="an_surface" placeholder="Surface">
				<input class="short option-15" type="text" name="an_piece" placeholder="Piece">-->

				<p class="bold">Type d'annonce :</p>
				<p>
					<input type="radio" id="typ1" name="an_type[]" value="Offre"  />
					<label for="typ1">Offre</label>
				
					<input type="radio" id="typ2" name="an_type[]" value="Demande"  />
					<label for="typ2">Demande</label>
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
					<input type="number" id="an_price" class="short " name="an_price" placeholder="Prix" value="" /><span>Ar <?php //echo "&nbsp;(optionnel)" ?></span>
					<br>
					<label for="an_price" class="error" style="display:none;">Please choose one.</label>		
				</div>

					

												<!--LOCALISATION OFFRE-->	
				<h3>Localisation</h3>
				<!--input id="geolocation" class="av_input" name="geolocation" placeholder="Géolocalisation (Saisissez une ville ou un code postal)" value="" type="text" autocomplete="off">
				<div id="geoloc-error1" class="tahoma" style="display:none;">Veuillez saisir et selectionner une ville ou un code postal.</div>
				<div id="geoloc-error2" class="tahoma" style="display:none;">Votre navigateur ne permet pas de vous géolocaliser.</div>
				<div id="geoloc-error3" class="tahoma" style="display:none;">Vous avez refusé la géolocalisation.</div>
				<div id="geoloc-error4" class="tahoma" style="display:none;">Une erreur est survenue lors de la géolocalisation.</div>
				<div id="geoloc-info" class="tahoma" style="display:none;">Vérifiez les informations ci-dessous.<br />Vous pouvez préciser votre position en déplaçant le marqueur sur la carte.</div>
				<a href="javascript:void(0)" id="geolocalisation-link" class="first-color bold">Cliquer ici pour vous géolocaliser</a>
				<input type="hidden" name="lat" id="lat" value="0" />
				<input type="hidden" name="lng" id="lng" value="0" /-->

				<div class="  <?php //echo "geolocalisation flex-container"; ?>">
					<div>	
						<div>
							<select id="an_region" name="an_region[]" class="short">
								<option value="0">Choisissez la région</option>
								<option value="geoloc_search" class="search-geoloc">-- AUTOUR DE MOI --</option>
								<?php 
									$req = $conn->query("SELECT * FROM an_region");
									while($res=$req->fetch_assoc())
									{
									?>
									<option name="an_region" value="<?php echo $res['id'] ?>"><?php echo $res['label'] ?></option>
									<?php 
									}
								 ?>
							</select>	
							<br>
							<label for="an_region[]" class="error" style="display:none;">Please choose one.</label>	
						</div>
						<div>
							<input type="text" id="an_ville" class="short" name="an_ville" placeholder="Votre ville" value="" />
						</div>
						<div>
							<input type="text" id="an_postcode" class="short" name="an_postcode" placeholder="Votre code postal (ex : 401)" value="" />
						</div>
												
						<div>
							<input type="text" id="an_address" class="short" name="an_address" placeholder="Adresse" value="" />
						</div>					
					</div>
					
				
										
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

				

										<!--PHOTO ANNONCE-->	

			<div id="uploadForm"  target="uploadFrame" name="upload" >
				<h3>Vos photos</h3>
				<p>
					<span class="bold">Vous pouvez télécharger 4 photo(s) GRATUITEMENT + 4 dans le pack payant<br />En fonction de la taille de votre image, le téléchargement peut prendre plusieurs minutes.</span>	
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
						<p class="loading">
							<img id="imgload_1" src="images/loading.gif" alt="" />
						</p>
						<img class="upload_photo" id="imgshow_1" src="images/upload_photo.png" alt="" />
						
					</div>

					<div>
						<a id="imgdel_2" class="upload_delete_link" href="includes/display/ad_photos_upload_delete0b30.html?id=2" ></a>
						<span>2</span>
						<input id="file_2" type="file" class="input-file" name="photo2" />
						<p class="loading">
							<img id="imgload_2" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_2" class="upload_photo" src="images/upload_photo.png" alt="" />
						
					</div>

					<div>
						<a id="imgdel_3" class="upload_delete_link" href="includes/display/ad_photos_upload_deleted708.html?id=3"></a>
						<span>3</span>
						<input id="file_3" type="file" class="input-file" name="photo3" />
						<p class="loading">
							<img id="imgload_3" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_3" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_4" class="upload_delete_link" href="includes/display/ad_photos_upload_deletedcfd.html?id=4"></a>
						<span>4</span>
						<input id="file_4" type="file" class="input-file" name="photo4" />
						<p class="loading">
							<img id="imgload_4" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_4" class="upload_photo"  src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_5" class="upload_delete_link" href="includes/display/ad_photos_upload_deleted61c.html?id=5"></a>
						<span>5</span>
						<input id="file_5" type="file" class="input-file" name="photo5" />
						<p class="loading">
							<img id="imgload_5" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_5" class="upload_photo"  src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_6" class="upload_delete_link" href="includes/display/ad_photos_upload_delete3a9f.html?id=6"></a>
						<span>6</span>
						<input id="file_6" type="file" class="input-file" name="photo6" />
						<p class="loading">
							<img id="imgload_6" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_6" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_7" class="upload_delete_link" href="includes/display/ad_photos_upload_delete8803.html?id=7"></a>
						<span>7</span>
						<input id="file_7" type="file" class="input-file" name="photo7" />
						<p class="loading">
							<img id="imgload_7" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_7" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>

					<div>
						<a id="imgdel_8" class="upload_delete_link" href="includes/display/ad_photos_upload_deletec3c9.html?id=8"></a>
						<span>8</span>
						<input id="file_8" type="file" class="input-file" name="photo15" />
						<p class="loading">
							<img id="imgload_8" src="images/loading.gif" alt="" />
						</p>
						<img id="imgshow_8" class="upload_photo" src="images/upload_photo.png" alt="" />
					</div>		

					<div id="ad_photo_pack_button">
						<a class="upload_delete_link" href="javascript:void(0)"></a><span>+</span>
						<img class="upload_photo" src="images/upload_photo.png" alt="" />
						<p>4 Photo(s) supplémentaire(s)</p>
					</div>
				</div>	

				<input type="hidden" name="nb_photo_free" id="nb_photo_free" data-nb-photo-free="4" data-nb-photo-total="8" />

			</div>

			<input type="submit" id="btn_submit_annonce" value="Valider" />	
		</form>

		</div>
	</div>

	<?php
		require "include/footer.php";
	?>

	<!--<script src="js/geolocalisation-depot.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCmA6vuNkWNlRVEQueTzkzFW-MUZgiR6dQ&amp;libraries=places&amp;callback=initMap" async defer></script>-->


	<script>
		$(document).ready(function(){
			console.log("ok");
		});
	</script>

</body>

<!-- Mirrored from www.script-pag.com/demo/Pagrowoc/fr/deposer-une-petite-annonce by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 16:39:21 GMT -->
</html>