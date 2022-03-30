<?php
  require('inc/header.php');
?>
<title><?php echo strtoupper($_SESSION['f_name'])." ".strtoupper($_SESSION['name']); ?></title>
<div class="container-100 header-end"></div>
<div class="container-100" style="height:500px;">
  <div class="container-100-child index-container">
    <div class="search-form" style="background: white;padding: 10px; border-radius: 10px;box-shadow: 3px 3px 3px 3px #d3d3d3;">
		<div class="container-100">
			<div class="container-100-child">

				<div class="row">
					<div class="col-md-1">
						<i class="fa fa-user fa-4x"></i>
					</div>
					<div class="col-md-9">
						<h3 style="float: left;margin-top: 15px;">
						    <?php echo ucfirst(strtoupper($_SESSION['name']))." ".ucfirst(strtoupper($_SESSION['f_name'])); ?>
						</h3>
					</div>
					<div class="col-md-2">
						    <a class="btn btn-outline-success" href="editProfile.php" style="margin-top: 15px;">Voir mon profile</a>
					</div>
				</div>
			</div>
		</div>

	</div>
<style type="text/css">
	.linking{
		text-decoration: none;
		color: black;
	}
	.linking:hover{
		text-decoration: none;
		color: #78aa27;
		
	}
	.grid{
		background: white;padding-left: 20px;padding-right: 20px;padding-top: 40px; border-radius: 10px;box-shadow: 3px 3px 3px 3px #d3d3d3;height: 150px;
	}
	.grid:hover{
		background: #F5F5F5;
		box-shadow: 5px 5px 5px 5px #d3d3d3;
	}

</style>
<div class="row" style="top: 50px;">
	<div class="col-md-4">
		<div class="grid">
			<a class="linking" href="mes-annonces.php">
			<div class="container-100">
				<div class="container-100-child">
					<div class="row">
						<div class="col-md-3">
							<i class="fa fa-list-alt fa-4x"></i>
						</div>
						<div class="col-md-9">
							<h4>
					    		<b>Annonces</b>
							</h4>
							<span class="small-text">Gérer mes annonces déposées</span>
						</div>
					</div>
				</div>
			</div>
			</a>
		</div>
	</div>

	<div class="col-md-4">
		<div class="grid" >
			<a class="linking" href="mes-transaction.php">
			<div class="container-100">
				<div class="container-100-child">
					<div class="row">
						<div class="col-md-3">
							<i class="fa fa-credit-card fa-4x"></i>
						</div>
						<div class="col-md-9">
							<h4>
					    		<b>Transactions</b>
							</h4>
							<span class="small-text">Suivre mes achats et mes ventes</span>
						</div>
					</div>
				</div>
			</div>
			</a>
		</div>
	</div>

	<div class="col-md-4">
		<div class="grid">
			<a class="linking" href="editProfile.php">
			<div class="container-100">
				<div class="container-100-child">
					<div class="row">
						<div class="col-md-3">
							<i class="fa fa-cog fa-4x"></i>
						</div>
						<div class="col-md-9">
							<h4>
					    		<b>Paramètres</b>
							</h4>
							<span class="small-text">Modifier mes informations</span>
						</div>
					</div>
				</div>
			</div>
			</a>
		</div>
	</div>
</div>
	

  </div>
</div>
<?php
  require('inc/footer.php');
?>
