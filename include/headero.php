<?php
	session_start();
	require "cnx.php";

	if (isset($_SESSION['id'])) {
		// code...
	}
?>
<!DOCTYPE html>
<html lang="FR" prefix="og: http://ogp.me/ns#">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
		<meta charset="utf-8" />
		<meta name="Description" content="Script PAG Demo" />
		<meta name="Keywords" lang="fr" content="Script PAG Demo" />
		<meta name="Robots" content="all" />
		<meta name="language" content="FR" />
		<meta name="format-detection" content="telephone=no" />


		<link href="css/sweetalert.css" type="text/css" rel="stylesheet" />
		<link href="css/design2.css" type="text/css" rel="stylesheet" />
		<!--link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" /-->
		<link href="map/map.css" type="text/css" rel="stylesheet" />


		<link rel="stylesheet" href="include/css/bootstrap.css">
		<script src="include/js/bootstrap.js"></script>
		
		
	  <!--link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script-->



		<!-- FAVICON -->

		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<meta property="og:image" content="images/logo.png"/>
		<style type="text/css">
			body{
				  font-family: "Times New Roman", Times, serif;
				  background: #F5F5F5;
			}

		</style>
	</head>
<body style="color: black;">
<header class="container-100 header" style="position: fixed;-moz-box-shadow:0 5px 5px rgba(182, 182, 182, 0.75);
-webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);">
	<div class="container-100-child flex-container">
		<div id="main-menu" class="toggle-menu">
			<div>
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
		<div class="header-logo" >
			<p>
				<a href="index.php">
					<img src="image/logo3.png" alt="MBM" height="50"/>
				
				</a>
			</p>
		</div>
		<div class="header-links">
			<div class="menu">
				<a class="ring" href="acc_connexion7f95.html?back=SearchAlert">Mes recherches</a>
				<a class="selection" href="moncompte/annonce-favori.php"><span id="nb-ads-selection"></span> Favoris</a>
				<!--a class="connexion" href="inscription.php">S'inscrire</a-->
				<?php if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['f_name'])): ?>
					<a class="connexion" href="moncompte/"><?php echo ucfirst(strtolower($_SESSION['name']))." ".ucfirst(strtolower($_SESSION['f_name'])); ?></a>
					<a class="" href="logout.php"><i class="fa fa-sign-out"></i>Déconnexion</a>
				<?php else: ?>
					<a class="connexion" href="connexion.php">Se connecter</a>
				<?php endif; ?>

				<a class="button" href="<?php if (isset($_SESSION['id'])): ?>
					deposer-annonce.php
					<?php else: ?>
						connexion.php
				<?php endif; ?> "> Déposer une annonce</a>
			</div>
		</div>
	</div>
</header>
