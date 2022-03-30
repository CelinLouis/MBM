<?php
	include("include/header.php");
	if (isset($_GET['an'])) {
		$id_an = $_GET['an'];
		$sql ="SELECT *, an_annonces.id as an_id, an_region.label as lblreg, an_souscat.label as lblsouscat, an_annonces.id_membres as id_membres FROM an_souscat,an_region,an_annonces WHERE an_souscat.id = an_annonces.an_souscat && an_annonces.id = '$id_an' && an_region.id = an_annonces.an_region";
		
		$req=$conn->query($sql);
		$r=$req->fetch_assoc();

		$sql2="SELECT * FROM membres WHERE id = '".$r['id_membres']."'";
		$req2=$conn->query($sql2);
		$r2=$req2->fetch_assoc();

		$fav="";
		if (isset($_SESSION['id'])) {
			$req=$conn->query("SELECT COUNT(*) as n FROM an_favori WHERE id_membres = '".$_SESSION['id']."' && id_annonces = '".$r['an_id']."' ");
			$res=$req->fetch_assoc();
			if($res['n']>0){ $fav = "selected"; }
		}

	}
	else
	{
		header("Location: liste-annonc.php");
	}
?>
<title><?php echo $r['an_title'] ?></title>
<div class="container-100 header-end"></div>
<div class="container-100">
	<div class="container-100-child ad-page-container" itemscope="" itemtype="http://schema.org/CreativeWork">
		<div class="ad-page-bloc-title flex-container">
			<ul>
				<li><a href=""><?php echo $r['lblreg'] ?></a><span>&gt;</span></li>
				<li><a href=""><?php echo $r['an_city'] ?></a><span>&gt;</span></li>
				<li><a href=""><?php echo $r['lblsouscat'] ?></a><span>&gt;</span></li>
				<li><h1 itemprop="name"><?php echo $r['an_title'] ?></h1></li>
			</ul>


			<div>
				
				<p><a id="<?php echo $r['an_id'] ?>" class="icon-heart <?php echo $fav ?>" ></a></p>
			</div>
		</div>


		<div class="ad-page-parent-container flex-container">
			<div class="ad-page-large-container">
				<div class="ad-page-bloc-photo" itemprop="image">
					<img data-num="1" src="<?php echo $r['an_photo1'] ?>" id="photo" alt="">
					<div class="ad-page-bloc-thumbnail">
					<div class="nav-slide prev">
						<img src="images/icons/icon_arrow_slide_left.png" alt="">
					</div>
					<div id="9d7b18" style="display: inline-block; overflow: hidden; width: 345px;">
						<ul class="ad-page-bloc-thumbnail-list" style="width: 345px; margin-left: 0px;">
							<li class="current-thumb" data-num="1">
								<img src="<?php echo $r['an_photo1'] ?>" alt="">
							</li>
							<li data-num="2"><img src="<?php echo $r['an_photo2'] ?>" alt=""></li>
							<li data-num="3"><img src="<?php echo $r['an_photo3'] ?>" alt=""></li>
							<li data-num="4"><img src="<?php echo $r['an_photo4'] ?>" alt=""></li>
						</ul>
					</div>
					<div class="nav-slide next"><img src="images/icons/icon_arrow_slide_right.png" alt=""></div>
					</div>

				</div>
				<!-- Images slideshow -->
				<div class="modal-content" style="display: none; opacity: 1;">
					<span class="close_modal close cursor">×</span>
					<img id="my_slides" data-num="1" src="<?php echo $r['an_photo1'] ?>" alt="">
					<div id="modal_nav_wrap">
						<div id="modal_nav">
							<div class="modal prev"><img src="images/icons/icon_arrow_slide_left.png" alt=""></div>

							<div id="34e8da" style="display: inline-block; overflow: hidden; width: 302px;">
								<ul class="thumb_list" style="width: 386px;">
									<li data-num="1"><img class="thumbnail" src="<?php echo $r['an_photo1'] ?>" alt=""></li>
									<li data-num="2"><img class="thumbnail" src="<?php echo $r['an_photo2'] ?>" alt=""></li>
									<li data-num="3"><img class="thumbnail" src="<?php echo $r['an_photo3'] ?>" alt=""></li>
									<li data-num="4"><img class="thumbnail" src="<?php echo $r['an_photo4'] ?>" alt=""></li>
								</ul>
							</div>
							<div class="modal next">
								<img src="images/icons/icon_arrow_slide_right.png" alt="">
							</div>
						</div>
					</div>
				</div>


				<div class="ad-page-bloc-infos">
					<p class="title"><span>Informations générales</span></p>

					<p class="price"><?php echo $r['an_price'] ?> <b>Ariary</b> </p>

					<!--aside class="flex-container">

						<p>
							<span>Kilométrage<br> </span>
							<?php if ($r['an_kmeter'] != ""): ?>
								<?php echo $r['an_kmeter']." km" ?>
							<?php endif ?>
						</p>

						<p>
							<span>Année<br> </span>
							<?php if ($r['an_annee'] != ""): ?>
								<?php echo $r['an_annee'] ?>
							<?php endif ?>
						</p>

						<p>
							<span>Energie<br> </span>
							<?php if ($r['an_energy'] != ""): ?>
								<?php echo $r['an_energy'] ?>
							<?php endif ?>
						</p>

						<p>
							<span>Boite de vitesse<br> </span>
							<?php if ($r['an_vitesse'] != ""): ?>
								<?php echo $r['an_vitesse']?>
							<?php endif ?>
						</p>
					</aside-->

					<div class="location">
						<p>
							<?php echo $r['an_address'] ?>
							<br><a href="javascript:;" class="gmap-box">Voir sur Map</a>
						</p>
					</div>

					<p class="deposit-date">
						Annonce déposée
						<time itemprop="datePublished" datetime="2019-10-21"><?php echo $r['an_datenreg'] ?></time>
					</p>
				</div>

				<div class="ad-page-bloc-infos">
					<p class="title"><span>Détail de l'annonce</span></p>
					<p itemprop="text">
						<?php echo $r['an_desc'] ?>
					</p>
					<p class="report-abuse"><a href="../send_contact23f0.html?id_ad=12">Signaler l'annonce</a></p>
				</div>
			</div>

			<div class="ad-page-small-container">
				<div class="ad-page-bloc-infos contact">
					<p class="name-contact">
						<?php echo strtoupper($r2['name']))." ".strtoupper($r2['first_name'])); ?>
					</p>
					<a href="../ads_advertiser2939.html?id_ad=18"><img src="images/icons/icon_ad_contact_glass.png" alt="">Toutes ses annonces</a>

					<a class="message" href="payement.php?obj=achat&&an=<?php echo $r['an_id'] ?>"><img src="images/icons/icon_ad_contact_phone.png" alt="">Acheter</a>

					
				</div>


				<div class="ad-page-bloc-infos">
					<p class="title"><span>Partager l'annonce</span></p>
					<div class="share">
						<a onclick="window.open(this.href); return false;" rel="nofollow" href="http://www.facebook.com/share.php?u=http://www.script-pag.com/demo/fr/annonce/Auvergne-Rhone-Alpes-Savoie-Locations-de-vacances-Villa-a-louer-en-pleine-montagne-18"><img src="images/icons/icon_ad_share_facebook.png" alt=""></a>
						<a onclick="window.open(this.href); return false;" rel="nofollow" href="http://twitter.com/share?url=http://www.script-pag.com/demo/fr/annonce/Auvergne-Rhone-Alpes-Savoie-Locations-de-vacances-Villa-a-louer-en-pleine-montagne-18"><img src="images/icons/icon_ad_share_twitter.png" alt=""></a>
						<a style="cursor:pointer" onclick="window.print()"><img src="images/icons/icon_ad_share_print.png" alt=""></a>
						<a href="../send_friend2939.html?id_ad=18"><img src="images/icons/icon_ad_share_mail.png" alt=""></a>
					</div>
				</div>

				<?php if ($_SESSION['id'] = $r['id_membres'] ) : ?>
					<div class="ad-page-bloc-infos management">
						<p class="title"><span>Gestion de l'annonce</span></p>
						<a href="../ad_update2939.html?id_ad=18"><img src="images/icons/icon_ad_management_update.png" alt="">Modifier l'annonce</a>
						<a href="../ad_delete2939.html?id_ad=18"><img src="images/icons/icon_ad_management_delete.png" alt="">Retirer l'annonce</a>
						<a href="../purchase_opts_ad2939.html?id_ad=18"><img src="images/icons/icon_ad_management_top.png" alt="">Annonce en Tête</a><a href="../purchase_opts_ad2939.html?id_ad=18"><img src="images/icons/icon_ad_management_premium.png" alt="">Annonce Premium</a><a href="../purchase_opts_ad2939.html?id_ad=18"><img src="images/icons/icon_ad_management_urgent.png" alt="">Annonce Urgente</a><a href="../purchase_opts_ad2939.html?id_ad=18"><img src="images/icons/icon_ad_management_framed.png" alt="">Annonce Encadrée</a>				
					</div>
				<?php endif ?>
				

				<div class="ad-page-bloc-infos stats">
					<p class="title"><span>Statistiques de l'annonce</span></p>
					<!--p><img src="images/icons/icon_ad_stats_prev.png" alt="">Nombre de vues : 19</p>
					<p><img src="images/icons/icon_ad_stats_last.png" alt="">Dernière visite le : 30/01 à 13:08</p-->
					<p><img src="images/icons/icon_ad_stats_ref.png" alt="">Référence : <?php echo $r['an_id'] ?></p>
				</div>


			</div>

			<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG Script PAG all rights reserved. Use under license. http://www.script-pag.com -->

		</div>
	</div>
</div>
<?php
	include("include/footer.php");
?>
<script type="text/javascript">
	function favorite(fav){
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
