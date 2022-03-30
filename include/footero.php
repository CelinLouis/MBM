	<footer class="container-100 footer" style="-moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
-webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75); ">
		<div class="container-100-child flex-container">
			<div class="footer-networks">
				<a class="rss-feed" rel="nofollow" href="https://www.script-pag.com/demo/Pagrowoc/rss/Script-PAG-Demo.xml" target="_blank"></a>
				<a class="facebook-networks" href="https://www.facebook.com/Script.PAG/" target="_blank"></a>
				<a class="twitter-networks" href="https://twitter.com/ElinaWeb" target="_blank"></a>
				<a class="linkedin-networks" href="https://www.linkedin.com/company/elinaweb/" target="_blank"></a>
				<a class="instagram-networks" href="https://www.instagram.com/" target="_blank"></a>
				<a class="pinterest-networks" href="https://www.pinterest.com/" target="_blank"></a>
				<p>Copyright &copy; <b>Tsena MAIVA</b></p>
			</div>
			<div>
				<ul>
					<li><a href="info/Aide-1.html">Aide</a></li><li><a href="info/Regles-de-diffusion-2.html">Règles de diffusion</a></li><li><a href="cond-utilisations.php">Conditions générales d'utilisation</a></li><li><a href="cond-ventes.php">Conditions générales de vente</a></li><li><a href="info/Politique-de-confidentialite-5.html">Politique de confidentialité</a></li>
					<li><a href="send_contact.html">Nous contacter</a></li>
				</ul>
			</div>
		</div>
	</footer>
	<script>
		var visit_latitude = 0;
		var visit_longitude = 0;
	</script>

	<script src="https://maps.google.com/maps/api/js?key=AIzaSyD0RVZcN60kwS2wIKJf3ck9MwG8s381bz0&amp;libraries=places&amp;callback=initMap" async defer></script>

	<script src="js/jquery-3.1.1.js"></script>
	<script src="js/jquery.validate.js"></script>

	<script src="js/functions_js.js"></script>
	<script src="js/map.js"></script>
	<script src="js/scriptjs.js"></script>
	<script src="js/sweetalert.js"></script>
	<script src="js/geolocalisation-depot.js"></script>


	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script	>
	<script type="text/javascript">
	function favori(fav){
		if(fav.hasClass("selected"))
		{

			fav.removeClass("selected");
			var addfavorite = "delfav";
			var id_annonce = fav.attr("id");
			alert(id_annonce);
			$.post('ajax/post_favori.php',
				{
					addfavorite:addfavorite,
					id_annonce:id_annonce
				},
				function(data)
				{
					//alert(data);
				},
			'text');
		}
		else
		{
			fav.addClass("selected");
			var addfavorite = "adfav";
			var id_annonce = fav.attr("id");
			var id_memmbres = <?php echo $_SESSION['id']; ?>;
			$.post('ajax/post_favori.php',
				{
					addfavorite:addfavorite,
					id_annonce:id_annonce
				},
				function(data)
				{
					//alert(data);
				},
			'text');
		}
	}
	</script>
	</body>
</html>
