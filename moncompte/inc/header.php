<?php
	session_start();
	require "../cnx.php";
	if (!isset($_SESSION['id'])) {
		header("location: ../connexion.php");
	}
	else{

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

		<link href="../css/jquery-ui.min.css" type="text/css" rel="stylesheet" />
		<link href="../css/sweetalert.css" type="text/css" rel="stylesheet" />
		<link href="../css/design2.css" type="text/css" rel="stylesheet" />
		<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" />
		<link href="../map/map.css" type="text/css" rel="stylesheet" />
		
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<link href="../assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
		<link href="../assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
		<link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
		
		<link href="../assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="../assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
		<link href="../assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
		<link href="../assets/plugins/datatables.net-autofill-bs4/css/autofill.bootstrap4.min.css" rel="stylesheet" />
		<link href="../assets/plugins/datatables.net-colreorder-bs4/css/colreorder.bootstrap4.min.css" rel="stylesheet" />
		
		<link href="../assets/plugins/datatables.net-rowreorder-bs4/css/rowreorder.bootstrap4.min.css" rel="stylesheet" />

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
				<a href="../">
					<img src="../image/logo3.png" alt="MBM" height="50"/>
				</a>
			</p>
		</div>
		<div class="header-links">
			<div class="menu">
				<a class="ring" href="../admin/index.php">Administration</a>
				<a class="selection" href="annonce-favori.php"><span id="nb-ads-selection"></span> Favoris</a>
				<!--a class="connexion" href="inscription.php">S'inscrire</a-->
				<?php if (isset($_SESSION['id'])): ?>
					<a class="connexion" href="index.php"><?php echo ucfirst(strtolower($_SESSION['name']))." ".ucfirst(strtolower($_SESSION['f_name'])); ?></a>
					<a class="" href="../logout.php"><i class="fa fa-sign-out"></i>Déconnexion</a>
				<?php else: ?>
					<a class="connexion" href="../connexion.php">Se connecter</a>
				<?php endif; ?>

				<a class="button" href="../deposer-annonce.php">Déposer une annonce</a>
			</div>
		</div>
	</div>
</header>

