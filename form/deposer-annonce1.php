<?php  
	include("include/header.php");
?>
<?php $cat=""; ?>
<title>Déposer une annoce </title>
<div class="container-100 header-end"></div>
<div class="container-100">
	<div class="container-100-child forms form-deposit">
		<h1>Déposer une petite annonce</h1>

		<form method="post" action="" id="form_dep_annonce" class="">
			<div class="form-group " >
				<div id="bloc1" >
					<div id="div_type" >
	          	   		<h4>Type d'annonce *</h4>
	          	   		<p>
	                     	<input type="radio" id="typ1" name="an_type[]" value="offre" >
							<label for="typ1">Offre</label>
							<input type="radio" id="typ2" name="an_type[]" value="demande">
							<label for="typ2">Demande</label><br>
							<label for="an_type[]" class="error" style="display:none;">Please choose one.</label>
                     	</p>
	          	    </div>

	          	    <div id="div_cat" >
	          	   		<p>
	          	   			<h4>Catégorie *</h4>
	                     	<select id="an_cat" name="an_cat" class="short" >
								<option value="0">-- Choisissez la catégorie --</option>
								<?php 
									$req_cat= $conn->query("SELECT * FROM an_categorie ");
									while ($res_cat = $req_cat->fetch_assoc())
									{
										?>
										<optgroup label="<?php echo "-- ".strtoupper($res_cat['label'])." --" ?>" style="background-color: #F5F5F5;">
										<?php
										$req_souscat= $conn->query("SELECT * FROM an_souscat WHERE id_cat = '".$res_cat['id']."'  ORDER BY an_souscat.label ASC");
										while($res_souscat=$req_souscat->fetch_assoc())
										{
								?>	
									
									<option value="<?php echo $res_souscat['id'] ?>" style="background-color: white;"><?php echo $res_souscat['label']; ?> ( <?php echo $res_souscat['id'] ?> )</option>
									
								<?php
										}
										?>
										</optgroup>
										<?php
									}
								 ?>
							</select>

	                	</p>
	            	</div>
	            </div>


	            <div id="an_categorie">
	            	<div id="an_default">
	            		<h4>Votre annonce</h4>
		            	<input type="text" id="an_titre" class="short " name="an_titre" placeholder="Titre de votre annonce" value="">
		            	<textarea id="an_annonce" name="an_annonce" class="textarea-height-strong " cols="60" rows="10" placeholder="Votre annonce" ></textarea>

	            	</div>
	            	<div id="1" class="categorie" style="display: none;">
	            		<h4>Voiture</h4>


						<input class="short" type="text" name="an_voiture_km" id="an_voiture_km" placeholder="Kilométrage">
						<label for="an_voiture_km" class="error" style="display:none;">Please choose one.</label>

						<input class="short" type="text" name="an_voiture_annee" id="an_voiture_annee" placeholder="Année">
						<label for="an_voiture_annee" class="error" style="display:none;">Please choose one.</label>

					

						<select name="an_voiture_energie" id="an_voiture_energie[]" class="short error">
				            <option value="">«Choisissez carburant»</option>
				            <option value="1">Essence</option>
							<option value="2">Diesel</option>
							<option value="3">GPL</option>
							<option value="4">Electrique</option>
							<option value="6">Hybride</option>
							<option value="5">Autre</option>
				        </select>
						<label for="an_voiture_energie[]" class="error" style="display:none;">Please choose one.</label>

						<select name="an_voiture_vitesse" id="an_voiture_vitesse[]" class="short select error">
					        <option value="" selected="">«Choisissez Boîte de vitesse »</option>
					        <option value="1">Manuelle</option>
							<option value="2">Automatique</option>
					    </select>
					    <label for="an_voiture_vitesse[]" class="error" style="display:none;">Please choose one.</label>

					</div>						
					<div id="2" class="categorie" style="display: none;">
						<h4>Motos/Scooter</h4>
						<input class="short" type="text" name="an_moto_km" id="an_moto_km" placeholder="Kilométrage">
						<input class="short" type="text" name="an_moto_annee" id="an_moto_annee"placeholder="Année" >
						<input class="short" type="text" name="an_moto_cyl" id="an_moto_cyl" placeholder="Cylindrée">
					</div>
					<div id="3" class="categorie" style="display: none;">
						<h4>Caravanes/camping-cars</h4>
						<input class="short" type="text" name="an_carv_km" id="an_carv_km" placeholder="Kilométrage">
						<input class="short" type="text" name="an_carv_annee" id="an_carv_annee" placeholder="Année">
						<input class="short" type="text" name="an_carv_energie" id="an_carv_energie" placeholder="Energie">
						<input class="short" type="text" name="an_carv_vitesse" id="an_carv_vitesse" placeholder="Boite de vitesse">
					</div>
					<div id="21" class="categorie" style="display: none;">
                     	<h2>Montre &amp; Bijoux</h2>
                     	<select id="options" name="cat" class="short" onchange="DisplayOptions(); DisplayNote(); DisplayPrice(); DisplayCalendar(); DisplayFile()">
                     		<option>Univers</option>
                     		<option>Homme</option>
                     		<option>Femme</option>
                     		<option>Enfant</option>
                     		<option>Mixte</option>
                     	</select>
                     	<select id="options" name="cat" class="short" onchange="DisplayOptions(); DisplayNote(); DisplayPrice(); DisplayCalendar(); DisplayFile()">
	                     	<option>Type</option>
	                     	<option>Bague</option>
	                     	<option>Bijou de téléphone</option>
	                        <option>Bijou de tête</option>
	                     	<option>Boucles d'oreilles</option>
	                     	<option>Boutons de manchette</option>
	                     	<option>Bracelet</option>
	                     	<option>Broche</option>
	                     	<option>Chaîne</option>
	                     	<option>Charm</option>
	                     	<option>Chevalière</option>
	                     	<option>Collier, pendentif</option>
	                     	<option>Gourmette</option>
	                     	<option>Montre à gousset</option>
	                     	<option>Montre automatique</option>
	                     	<option>Montre connectée</option>
	                     	<option>Montre de sport</option>
	                     	<option>Montre mécanique</option>
	                     	<option>Montre quartz</option>
	                     	<option>Montre-bague</option>
	                     	<option>Montre-pendentif</option>
	                     	<option>Parure</option>
	                     	<option>Piercing</option>
	                     	<option>Autre</option>
                     	</select>
                       <select id="options" name="cat" class="short" onchange="DisplayOptions(); DisplayNote(); DisplayPrice(); DisplayCalendar(); DisplayFile()">
	                     	<option>Marque</option>
	                     	<option>Aghata</option>
	                     	<option>APM</option>
	                        <option>Apple</option>
	                     	<option>Aurelie Bidermann</option>
	                     	<option>Baccarat</option>
	                     	<option>Balaboosté</option>
	                     	<option>Balenciaga</option>
	                     	<option>Big Bang Bijoux</option>
	                     	<option>Bijoux Vitcoria</option>
	                     	<option>Blue Pearls</option>
	                     	<option>Boucheron</option>
	                     	<option>Breitling</option>
	                     	<option>Bulgari</option>
	                     	<option>Bulberry</option>
	                     	<option>Calvin Klein</option>
	                     	<option>Cartier</option>
	                     	<option>Céline</option>
	                     	<option>Cerruti 1881</option>
	                     	<option>Chanel</option>
	                     	<option>Chaumet</option>
	                     	<option>Cléor</option>
	                     	<option>Chopard</option>

	                     	<option>Chritian Lacroix</option>
	                     	<option>Clio Blue</option>
	                     	<option>Cluse</option>
	                     	<option>Daaniel Wellington</option>
	                     	<option>Diesel</option>
	                     	<option>Dinh Van</option>
	                     	<option>Dior</option>
	                     	<option>Dolce &amp; Gabanna</option>
	                     	<option>Fendi</option>
	                     	<option>Festina</option>
	                     	<option>Fossil</option>
	                     	<option>Fred</option>
	                     	<option>Gas Bijoux</option>
	                     	<option>Gigi Clozeau</option>
	                     	<option>Ginette NY</option>
	                     	<option>Givenchy</option>
	                     	<option>Gucci</option>
	                     	<option>Guess</option>
	                     	<option>Autre</option>
	                     </select>
	                     <select id="options" name="cat" class="short" onchange="DisplayOptions(); DisplayNote(); DisplayPrice(); DisplayCalendar(); DisplayFile()">
	                     	<option>Matière</option>
	                     	<option>Acier</option>
	                     	<option>Argent</option>
	                     	<option>Bois</option>
	                     	<option>Céramique</option>
	                     	<option>Cuir</option>
	                        <option>Diamant</option>
	                     	<option>Doré</option>
	                     	<option>Métal</option>
	                     	<option>Or blanc</option>
	                     	<option>Or jaune</option>
	                     	<option>Or jaune &amp; blanc</option>
	                     	<option>Or rose</option>
	                     	<option>Perles</option>
	                     	<option>Pierre</option>
	                     	<option>Plaqué or</option>
	                        <option>Tussi</option>
	                     	<option>Titan</option>
	                     	<option>Plastique</option>
	                     	<option>Autre</option>
	                     </select>
	                     <select id="options" name="cat" class="short" onchange="DisplayOptions(); DisplayNote(); DisplayPrice(); DisplayCalendar(); DisplayFile()">
	                     	<option>État</option>
	                     	<option>Etat neuf</option>
	                     	<option>Très bon état</option>
	                     	<option>Bon état</option>
	                     	<option>Etat moyen</option>
	                     </select>
					</div>
	            </div>
	            

	      		
	      		<div id="bloc3" style="display: block;">
	      			<form method="post" action="#">
						<div>
							<h4>Vos informations</h4>
							<input type="text" id="name" class="short " name="name" placeholder="Votre nom" value="" />
							<input type="text" id="email" class="short " name="email" placeholder="Votre email" value="" />
						
							<p>Votre email ne sera pas visible par les utilisateurs du site.<br />
											Ils pourront vous contacter en utilisant un formulaire prévu à cet effet.</p>
		
							<input type="text" id="phone" class="short " name="phone" placeholder="Votre numéro de téléphone" value="" />
							<p>
								<input type="checkbox" id="phone_hidden" name="phone_hidden" value="1"  />
								<label for="phone_hidden">Cacher votre numéro dans l'annonce</label>	
							</p>
						
							<input type="password" id="pas" class="short " name="pas" placeholder="Mot de passe" value="" />
							<input type="password" id="pas2" class="short " name="pas2" placeholder="Confirmation du mot de passe" value="" />
							
							<p class="bold">Vous êtes :</p>
								<p>
									<input type="radio" id="status1" name="status" value="1" checked="checked" onclick="GetPro(1, '', '', '0');" />
									<label for="status1">Particulier</label>/ Professionnel vous devez créer un <a href="acc_created0dab.html?type=2" class="first-color bold">Compte PRO</a>										
									<br />Particulier pour simplifier la gestion de vos annonces, vous pouvez créer un <a href="acc_created10b0.html?type=1" class="first-color bold">Compte membre</a>				
								</p>
								<div id="get_pro">		
								</div>

		
		
				<div><input type="text" id="video" class="medium " name="video" placeholder="Lien vidéo" value="" /><span>(facultatif)</span></div>
						<p>Vidéo Youtube, Daylimotion, Vimeo ou Yahoo</p>
									
								<div><input type="text" id="price" class="short " name="price" placeholder="Prix" value="" /><span>€ &nbsp;(optionnel)</span></div>
								
								
					<div id="calendar-wrap" class="calendar-wrap-hide">
		
		<p class="bold">Tarifs et Disponibilités :</p>
		
				<div id="add-period">	
			<input type="text" id="start_date" placeholder="Du" name="start_date" value="" />
			<input type="text" id="end_date" placeholder="Au" name="end_date" value="" />
			<div><input type="text" id="cal_price" name="cal_price" placeholder="Prix / semaine" value="" /><span class="css_price">€</span></div>
			<a href="javascript:void(0)" id="insert-period">+</a>
			<a href="javascript:void(0)" id="cal_eff_period" class="cal_eff_period">Effacer</a>
			<a href="javascript:void(0)" class="cal_period_update hide">Modifier</a>
			<a href="javascript:void(0)" class="cal_period_remove hide">Supprimer</a>
		</div>
		
		<p id="cal_msg_error1" class="p-error">Les périodes et ou tarifs que vous avez remplis ne sont pas valides.</p>
		<p id="cal_msg_error2" class="p-error">Le prix contient des caractères non autorisés.</p>	
		
	</div>
					
				<h3>Localisation</h3>
				
								<input id="geolocation" class="av_input" name="geolocation" placeholder="Géolocalisation (Saisissez une ville ou un code postal)" value="" type="text" autocomplete="off">
								
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
						

						<select id="region" name="an_region" onchange="">
							<option value="0">Choisissez la région</option>
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
						<div id="display_counties">
													</div>
						
												<div><input type="text" id="city" class="" name="city" placeholder="Votre ville" value="" /></div>
																		<div><input type="text" id="postcode" class="" name="postcode" placeholder="Votre code postal (ex : 75000)" value="" /></div>
												
												<div><input type="text" id="address" class="" name="address" placeholder="Adresse" value="" /></div>
												
					</div>
					
										<div id="display-map"></div>
										
				</div>
			
				<div id="upload_file_wrap" style="display:none;"></div>
			
				<div id="upload_photo_wrap"></div>
			
								<h3>Options</h3>
								
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
													</div>
										
				<p class="gtc">
					<input type="checkbox" id="gtc" name="gtc" value="1"  />
					<label for="gtc">Je reconnais avoir lu et accepter les <a href="info/Conditions-generales-d-utilisation-3.html" class="first-color bold" target="_blank">Conditions générales d'utilisation</a> et la <a href="info/Politique-de-confidentialite-5.html" class="first-color bold" target="_blank">Politique de confidentialité</a></label>
				</p>
				
			</div>
			
			<input id="btn_submit_annonce" type="submit" value="Valider" />	
		
		</form>
	      			</div>	
				</div>
			</div>
		</form>
</div>
</div>
<?php  
	include("include/footer.php");
?>
<style type="text/css">
	.error{
		color: red;

	}
	.disabled {
	    pointer-events: none;
	    opacity: 0.4;
	}
</style>
<script type="text/javascript">

	$(function() {
        $('#an_cat').change(function(){
        	$('#an_default').hide();
        	$('.categorie').hide();
        	$('.categorie').children().attr("disabled",true);
        	$('.categorie').addClass("disabled");
        	$('#' + $(this).val()).children().attr("disabled",false);
        	$('#' + $(this).val()).removeClass("disabled");
            $('#' + $(this).val()).show();
        });
    });

 	



	$(document).ready(function(){
		$.validator.addMethod("valueNotEquals", function(value, element, arg){
		  return arg !== value;
		 }, "choisir");

		$.validator.addMethod(
		  "regex",
		   function(value, element, regexp) {
		       if (regexp.constructor != RegExp)
		          regexp = new RegExp(regexp);
		       else if (regexp.global)
		          regexp.lastIndex = 0;
		          return this.optional(element) || regexp.test(value);
		   },"erreur expression reguliere"
		);

		$("#form_dep_annonce").validate({

			highlight: function(element) {
			   $(element).parents('.form').addClass('error');
			},
			unhighlight: function(element) {
			   $(element).parents('.form').removeClass('error');
			},
			rules: {
			    "an_cat": 
			    { 
			    	valueNotEquals: "0"
			    },
			    "an_type[]":{
			    	required:true
			    }
			},
			messages:{
				"an_cat": 
			    { 
			    	valueNotEquals: "<p >Choisissez une catégorie pour votre annonce</p>"
			    },
			    "an_type[]": 
			    { 
			    	required: "<p >Choisissez le type de votre annonce</p>"
			    }
			},

			submitHandler: function(form) {
	          
	           var radio = $('input:radio[name="an_type[]"]').val();
	            alert(radio);
	        }
		});

		$('#btn_submit_annonce').click(function() {
	        $("#form_dep_annonce").valid();
	    });

	  

  	});

 	


</script>

