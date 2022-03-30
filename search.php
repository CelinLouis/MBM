
<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG. Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<!DOCTYPE html>
<html lang="FR" prefix="og: http://ogp.me/ns#">

	<head>

		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
		<meta charset="utf-8" />

		<title>Petites Annonces - Script PAG Demo</title>

		<meta name="Description" content="" />
		<meta name="Keywords" lang="fr" content="" />
		<meta name="Robots" content="all" />
		<meta name="language" content="FR" />
		<meta name="format-detection" content="telephone=no" />

		<link href="https://www.script-pag.com/demo/template/css/jquery-ui.min.css" type="text/css" rel="stylesheet" />
		<link href="https://www.script-pag.com/demo/template/css/design.css" type="text/css" rel="stylesheet" />
		<link href="https://www.script-pag.com/demo/template/map/map.css" type="text/css" rel="stylesheet" />

		<!-- FAVICON -->

		<link rel="apple-touch-icon" sizes="57x57" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="https://www.script-pag.com/demo/template/images/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192" href="https://www.script-pag.com/demo/template/images/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="https://www.script-pag.com/demo/template/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="https://www.script-pag.com/demo/template/images/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="https://www.script-pag.com/demo/template/images/favicon/favicon-16x16.png">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="https://www.script-pag.com/demo/template/images/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">


		<script>
			var BASEURL = 'https://www.script-pag.com/demo/fr';
			var BASEURLIMG = 'https://www.script-pag.com/demo';
			var BASELAT = '48.8587741';
			var BASELNG = '2.2069771';
		</script>


	</head>

<body>


<header class="container-100 header">
	<div class="container-100-child flex-container">
		<div id="main-menu" class="toggle-menu">
			<div>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div class="header-logo">
			<p><a href="https://www.script-pag.com/demo/fr/"><img src="https://www.script-pag.com/demo/template/images/logo.png" alt="Script PAG Demo" /></a></p>
		</div>
		<div class="header-links">
			<div class="menu">
				<a class="button" href="https://www.script-pag.com/demo/fr/deposer-une-petite-annonce">Déposer une annonce</a>
								<a class="ring" href="https://www.script-pag.com/demo/fr/acc_connexion.php?back=SearchAlert">Mes recherches</a>
								<a class="selection" href="https://www.script-pag.com/demo/fr/selection.php"><span id="nb-ads-selection">0</span> annonces favorites</a>
				<a class="connexion" href="https://www.script-pag.com/demo/fr/acc_connexion.php">Se connecter</a>							</div>
		</div>

		<div class="header-flags"><div><ul><li><img src="https://www.script-pag.com/demo/includes/language/flags/flag_fr.png" alt="fr" /></li><li><a href="https://www.script-pag.com/demo/en/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&sort=1&status=0"><img src="https://www.script-pag.com/demo/includes/language/flags/flag_en.png" alt="en" /></a></li><li><a href="https://www.script-pag.com/demo/es/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&sort=1&status=0"><img src="https://www.script-pag.com/demo/includes/language/flags/flag_es.png" alt="es" /></a></li><li><a href="https://www.script-pag.com/demo/it/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&sort=1&status=0"><img src="https://www.script-pag.com/demo/includes/language/flags/flag_it.png" alt="it" /></a></li></ul></div></div>
	</div>
</header>
<div class="container-100 header-end"></div>



<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="container-100">
	<div class="container-100-child search-results-container   margin-bottom">

				<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<form class="search-form" method="get" action="https://www.script-pag.com/demo/fr/search.php">

		<p class="search-geoloc-error p-error" style="display: none;">Vous n'avez pas autorisé l'accès à votre position. Vous ne pouvez donc pas accéder au système de géolocalisation des annonces.</p>

		<ul id="search-type" class="search-ul-radio">
		<li data-slug="annonces/offres"><input type="radio" name="type" id="search_radio1" value="1" checked /><label for="search_radio1">Offres</label></li>
		<li data-slug="annonces/recherches"><input type="radio" name="type" id="search_radio2" value="2"   /><label for="search_radio2">Recherches</label></li>
				<li data-slug="annonces/echanges"><input type="radio" name="type" id="search_radio3" value="3"  /><label for="search_radio3">Échanges</label></li>
						<li data-slug="annonces/dons"><input type="radio" name="type" id="search_radio4" value="4"  /><label for="search_radio4">Dons</label></li>
										<li data-slug="vitrines"><input type="radio" name="type" id="search_radio5" value="5"  /><label for="search_radio5">Vitrines PRO</label></li>
						</ul>

	<input data-texttype1="Tapez votre recherche" data-texttype2="Rechercher une vitrine" class="input-keywords " type="text" name="keywords" placeholder="Tapez votre recherche" value="voiture" />

		<input type="text" name="postcode" placeholder="Code postal (ex:35000)" value="" />

	<select id="county" name="reg" onchange="GetCounties()"><option value="0">Toutes régions</option><option value="geoloc_search" class="search-geoloc">-- AUTOUR DE MOI --</option><option value="1">Auvergne-Rhône-Alpes</option><option value="2">Bourgogne-Franche-Comté</option><option value="3">Bretagne</option><option value="4">Centre-Val-de-Loire</option><option value="5">Corse</option><option value="6">Grand-Est</option><option value="7">Hauts-de-France</option><option value="8">Ile-de-France</option><option value="9">Normandie</option><option value="10">Nouvelle-Aquitaine</option><option value="11">Occitanie</option><option value="12">Pays de la Loire</option><option value="13">Provence-Alpes-Côte-d&#039;Azur</option><option value="14">Guadeloupe</option><option value="15">Guyane</option><option value="16">La Réunion</option><option value="17">Martinique</option><option value="18">Mayotte</option></select> <span id="get_counties"></span><span id="cat-search"><select id="opt" name="cat" onchange="GetOptions(); GetCalendar();"><option value="0">Toutes catégories</option><option value="Vehicules" class="background-select-cat">-- VEHICULES --</option><option value="2">Voitures</option><option value="3">Motos/scooters</option><option value="4">Caravanes/Camping-cars</option><option value="6">Accessoires/pièces</option><option value="5">Utilitaires</option><option value="8">Nautisme</option><option value="7">Pièces détachées</option><option value="9">Vélos</option><option value="Se loger" class="background-select-cat">-- SE LOGER --</option><option value="11">Ventes mais./appart.</option><option value="12">Locations mais./appart.</option><option value="13">Terrains</option><option value="15">Colocations</option><option value="14">Locations de vacances</option><option value="17">Locaux</option><option value="16">Garages</option><option value="18">Bureaux et commerces</option><option value="Emploi" class="background-select-cat">-- EMPLOI --</option><option value="20">Emploi</option><option value="21">Cours particuliers</option><option value="22">Services</option><option value="Mode" class="background-select-cat">-- MODE --</option><option value="24">Prêt-à-porter et acces.</option><option value="25">Puériculture</option><option value="26">Montres et bijoux</option><option value="Hi-tech" class="background-select-cat">-- HI-TECH --</option><option value="28">Images et sons</option><option value="29">Informatique</option><option value="30">Téléphonie</option><option value="31">Jeux vidéo</option><option value="Habitation" class="background-select-cat">-- HABITATION --</option><option value="33">Mobilier</option><option value="34">Electroménager</option><option value="35">Brico/jardin</option><option value="36">Décoration</option><option value="Loisirs et divertis." class="background-select-cat">-- LOISIRS ET DIVERTIS. --</option><option value="38">Films</option><option value="39">Musique</option><option value="40">Livres/Magazines</option><option value="41">Jeux et jouets</option><option value="42">Forme/détente</option><option value="43">Sport</option><option value="44">Collection</option><option value="45">Animaux</option></select> <span id="get_options"></span><span id="more-search" class="more-step" style="display: none;" data-less="&lt;span class=&quot;more-search-item&quot;&gt;-&lt;/span&gt;Moins de critères" data-more="&lt;span class=&quot;more-search-item&quot;&gt;+&lt;/span&gt;Plus de critères"><span class="more-search-item">+</span>Plus de critères</span></span>

	<ul id="search-ads" class="search-ul-checkbox" style="display: block">
		<li>
			<input type="hidden" name="sort" value="1" />
			<input type="hidden" name="status" value="0" />
			<input type="checkbox" id="title" name="title" value="1"  /><label for="title">Rechercher uniquement dans le titre</label>
		</li>
				<li><input type="checkbox" class="input_select" id="urgent" name="urgent" value="1"  /><label for="urgent">Annonces urgentes</label></li>
				<li><input type="checkbox" id="picture" name="picture" value="1"  /><label for="picture">Annonces avec photo</label></li>
	</ul>

	<input type="submit" value="Lancer la recherche" />

</form>



		<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="listing-infos">

	<h1>Petites Annonces</h1>

		<p>
		<a class="listing-infos-link link-selected" href="https://www.script-pag.com/demo/fr/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&sort=1">Toutes les offres</a> :
				<span class="txt_info_nb_ads">1 à 30 sur  0</span>
			</p>
		<p>
		<a class="listing-infos-link " href="https://www.script-pag.com/demo/fr/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&sort=1&amp;status=1">Particulier</a> :
				0			</p>
	<p>
		<a class="listing-infos-link " href="https://www.script-pag.com/demo/fr/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&sort=1&amp;status=2">Professionnel</a> :
				0			</p>
		<p class="listing-infos-select">
		<select onChange="window.document.location.href=this.options[this.selectedIndex].value;">
			<option value="https://www.script-pag.com/demo/fr/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&status=0&amp;sort=1" selected>Plus récentes</option>
			<option value="https://www.script-pag.com/demo/fr/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&status=0&amp;sort=2" >Plus anciennes</option>
			<option value="https://www.script-pag.com/demo/fr/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&status=0&amp;sort=3" >Prix croissant</option>
			<option value="https://www.script-pag.com/demo/fr/search.php?type=1&keywords=voiture&postcode=&reg=0&cat=0&status=0&amp;sort=4" >Prix décroissant</option>
		</select>
	</p>
		<p class="save-shearch-container">
		<a class="save-shearch" data-query="type=1&keywords=voiture&postcode=&reg=0&cat=0&sort=1&status=0" href="https://www.script-pag.com/demo/fr/acc_connexion.php?back=SearchAlert" data-textsaved="Recherche sauvegardée" data-textsave="Sauvegarder cette recherche">Sauvegarder cette recherche</a>
	</p>




</div>
				<div class="text-page">
		<p class="text-center">Aucune annonce ne correspond à votre recherche</p>
		</div>


	</div>
</div>
<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="container-100 categories">
	<nav class="container-100-child">
	<ul><li class="title-cat"><a href="https://www.script-pag.com/demo/fr/annonces/offres/Vehicules">Vehicules</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Voitures">Voitures</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Motos-scooters">Motos/scooters</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Caravanes-Camping-cars">Caravanes/Camping-cars</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Accessoires-pieces">Accessoires/pièces</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Utilitaires">Utilitaires</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Nautisme">Nautisme</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Pieces-detachees">Pièces détachées</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Velos">Vélos</a></li></ul><ul><li class="title-cat"><a href="https://www.script-pag.com/demo/fr/annonces/offres/Se-loger">Se loger</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Ventes-mais-appart-">Ventes mais./appart.</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Locations-mais-appart-">Locations mais./appart.</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Terrains">Terrains</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Colocations">Colocations</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Locations-de-vacances">Locations de vacances</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Locaux">Locaux</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Garages">Garages</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Bureaux-et-commerces">Bureaux et commerces</a></li></ul><ul><li class="title-cat"><a href="https://www.script-pag.com/demo/fr/annonces/offres/Emploi">Emploi</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Emploi">Emploi</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Cours-particuliers">Cours particuliers</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Services">Services</a></li></ul><ul><li class="title-cat"><a href="https://www.script-pag.com/demo/fr/annonces/offres/Mode">Mode</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Pret-a-porter-et-acces-">Prêt-à-porter et acces.</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Puericulture">Puériculture</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Montres-et-bijoux">Montres et bijoux</a></li></ul><ul><li class="title-cat"><a href="https://www.script-pag.com/demo/fr/annonces/offres/Hi-tech">Hi-tech</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Images-et-sons">Images et sons</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Informatique">Informatique</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Telephonie">Téléphonie</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Jeux-video">Jeux vidéo</a></li></ul><ul><li class="title-cat"><a href="https://www.script-pag.com/demo/fr/annonces/offres/Habitation">Habitation</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Mobilier">Mobilier</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Electromenager">Electroménager</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Brico-jardin">Brico/jardin</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Decoration">Décoration</a></li></ul><ul><li class="title-cat"><a href="https://www.script-pag.com/demo/fr/annonces/offres/Loisirs-et-divertis-">Loisirs et divertis.</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Films">Films</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Musique">Musique</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Livres-Magazines">Livres/Magazines</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Jeux-et-jouets">Jeux et jouets</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Forme-detente">Forme/détente</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Sport">Sport</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Collection">Collection</a></li><li><a href="https://www.script-pag.com/demo/fr/annonces/offres/Animaux">Animaux</a></li></ul>	</nav>
</div>
<footer class="container-100 footer">
	<div class="container-100-child flex-container">

		<div class="footer-networks">
						<a class="rss-feed" rel="nofollow" href="https://www.script-pag.com/demo/rss/Script-PAG-Demo.xml" target="_blank"></a>


						<a class="facebook-networks" href="https://www.facebook.com/Script.PAG/" target="_blank"></a>
									<a class="twitter-networks" href="https://twitter.com/ElinaWeb" target="_blank"></a>
									<a class="linkedin-networks" href="https://www.linkedin.com/company/elinaweb/" target="_blank"></a>
									<a class="instagram-networks" href="https://www.instagram.com/" target="_blank"></a>
									<a class="pinterest-networks" href="https://www.pinterest.com" target="_blank"></a>
						<p>
			Copyright &copy; <a class="lien_foot" href="https://www.script-pag.com/demo/fr/">Script PAG Demo</a> 			</p>
		</div>

		<div>
			<ul>
				<li><a href="https://www.script-pag.com/demo/fr/info/Aide-1">Aide</a></li><li><a href="https://www.script-pag.com/demo/fr/info/Regles-de-diffusion-2">Règles de diffusion</a></li><li><a href="https://www.script-pag.com/demo/fr/info/Conditions-generales-d-utilisation-3">Conditions générales d'utilisation</a></li><li><a href="https://www.script-pag.com/demo/fr/info/Conditions-generales-de-vente-4">Conditions générales de vente</a></li><li><a href="https://www.script-pag.com/demo/fr/info/Politique-de-confidentialite-5">Politique de confidentialité</a></li>
				<li><a href="https://www.script-pag.com/demo/fr/send_contact.php">Nous contacter</a></li>
			</ul>
		</div>

	</div>
</footer>



<script src="https://www.script-pag.com/demo/js/jquery-1.11.2.min.js"></script>
<script src="https://www.script-pag.com/demo/js/jquery-11.4.ui.min.js"></script>
<script src="https://www.script-pag.com/demo/js/functions_js.js"></script>

<script>
	var visit_latitude = 0;
	var visit_longitude = 0;
</script>

<script src="https://www.script-pag.com/demo/js/map.js"></script>



<script>
$.datepicker.regional['fr'] = {
	closeText: 'Fermer',
	prevText: 'Préc',
	nextText: 'Suiv',
	currentText: 'Aujourd\'hui',
	monthNames: ["Janvier","Février","Mars","Avril","Mai","Juin", "Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
	monthNamesShort: ["Jan","Fév","Mar","Avr","Mai","Jun", "Jul","Aoû","Sep","Oct","Nov","Déc"],
	dayNames: ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"],
	dayNamesShort: ["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],
	dayNamesMin: ["Di","Lu","Ma","Me","Je","Ve","Sa"],
	weekHeader: 'Sm',
	dateFormat: 'dd/mm/yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['fr']);
</script>
<script src="https://www.script-pag.com/demo/includes/calendar/fns_js_cal.js"></script>

<script>
window.___gcfg = {lang: 'fr'};

(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/platform.js';
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
		content: 'https://www.script-pag.com/demo/more_premium.php',
		active_breakpoint: true,
		breakpoint: {width: 501, height: 501},
		breakpoint_dimensions: {width: '90%', height: '90%'}
	});
	</script>

</body>
</html>
