<?php
	include("include/header.php");
		if (isset($_GET['region'])) {
			$id_region = $_GET['region'];
	    $_SESSION['region'] = $id_region;
	    $select_cout = "SELECT COUNT(*) cout FROM an_annonces,an_region WHERE an_annonces.an_region = an_region.id AND an_region.id = ('".$id_region."') ";
	    $coutvalue = $conn->query($select_cout);
	    $result_cout  = $coutvalue -> fetch_assoc();

	    $region = " SELECT * FROM an_region WHERE id IN('".$id_region."') ";
	    $regions =$conn->query($region);
	    $result_region = $regions -> fetch_assoc();
		}
    else
		{
			$select_cout = "SELECT COUNT(*) cout FROM an_annonces,an_region WHERE an_annonces.an_region = an_region.id ";
	    $coutvalue = $conn->query($select_cout);
	    $result_cout  = $coutvalue -> fetch_assoc();

	    $region = "SELECT * FROM an_region";
	    $regions =$conn->query($region);
	    $result_region = $regions -> fetch_assoc();
		}
?>
<title><?php if (isset($_GET['region'])): ?>
	<?php echo $result_region['label']; ?>
	<?php else: ?>
		Liste de toutes les annonces
<?php endif; ?></title>
<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child ad-page-container" itemscope itemtype="http://schema.org/CreativeWork">
      <div class="ad-page-bloc-title flex-container">
				<?php if (isset($_GET['region'])): ?>
					<ul>
							<li><a href="index.php"><?php echo $result_region['label']; ?></a><span>></span><input type="hidden" id="region" name="region" value="<?php echo $result_region['id']; ?>"></li>
		        <?php if($result_cout['cout'] <= 1){?>
							<li><a href="#"><?php echo $result_cout['cout']; ?> annonce</a><span>></span></li>
						<?php }else{?>
		        	<li><a href="#"><?php echo $result_cout['cout']; ?> annonces</a><span>></span></li>
		        <?php }?>
					</ul>
				<?php endif; ?>

		</div>


				<form class="search-form" method="get" action="search.php">
						<p class="search-geoloc-error p-error" style="display: none;">Vous n'avez pas autorisé l'accès à votre position. Vous ne pouvez donc pas accéder au système de géolocalisation des annonces.</p>
						<div class="text-center">
							<ul id="search-type" class="search-ul-radio">
								<?php
								$query = "
								SELECT * FROM an_type";
								$statement = $conn->query($query);
								 while ($result = $statement->fetch_assoc()) {
									 ?>
									 <li><input type="checkbox" id="<?php echo $result['label']; ?>" name="<?php echo $result['label']; ?>" class="common_selector type" value="<?php echo $result['label']; ?>"  >
										<label for="<?php echo $result['label']; ?>"><?php echo $result['label']; ?></label></li>
								<?php
								}
								?>
							</ul>
						</div>
						<div class="row">
							<div class="col-md-4">
								<input style="width:100%" class="input-keywords " type="text" id="keywords" name="keywords" placeholder="Tapez votre recherche" value="" />
							</div>
							<div class="col-md-4">
								<input style="width:100%" type="text" name="an_code_p" id="an_code_p" placeholder="Code postal (ex: 401)" value="" />
							</div>
							<div class="col-md-4">
								<select style="width:100%" id="region" name="an_region" onchange="test($(this).val())">
									<option value="0">Toutes régions</option>

									<?php
										$req = $conn->query("SELECT * FROM an_region");
										while($res=$req->fetch_assoc())
										{
										?>
										<?php if (isset($_GET['region'])): ?>
											<option <?php if ($_GET['region'] == $res['id']): ?>
												selected
											<?php endif; ?> name="an_region" value="<?php echo $res['id'] ?>"><?php echo $res['label'] ?></option>

										<?php else: ?>
											<option name="an_region" value="<?php echo $res['id'] ?>"><?php echo $res['label'] ?></option>
										<?php endif; ?>

										<?php
										}
									 ?>
								</select>
							</div>
						</div>

						<div class="text-center">
							<span id="get_options"></span><span id="more-search" class="more-step" style="display: none;" data-less="&lt;span class=&quot;more-search-item&quot;&gt;-&lt;/span&gt;Moins de critères" data-more="&lt;span class=&quot;more-search-item&quot;&gt;+&lt;/span&gt;Plus de critères"><span class="more-search-item">+</span>Plus de critères</span></span>

							<ul id="search-ads" class="search-ul-checkbox" style="display: block">
								<li>
									<input type="hidden" name="sort" value="1" />
									<input type="hidden" name="status" value="0" />
									<input type="checkbox" id="title" name="title" value="1"  /><label for="title">Rechercher uniquement dans le titre</label>
								</li>
								<li>
									<input type="checkbox" class="input_select" id="urgent" name="urgent" value="1"  />
									<label for="urgent">Annonces urgentes</label>
								</li>
								<li>
									<input type="checkbox" id="picture" name="picture" value="1"  />
									<label for="picture">Annonces avec photo</label>
								</li>
							</ul>
						</div>

						<input type="submit" value="Lancer la recherche" />

						</form>




				<div class="listing-infos">
					<h1>Petites Annonces</h1>
						<p>
						<a class="listing-infos-link " href="listes-annonces.php">Toutes les offres</a> :
						<?php if($result_cout['cout'] <= 1){?>
							<span class="txt_info_nb_ads"><?php echo $result_cout['cout']; ?></span>
						<?php }else{?>
								<span class="txt_info_nb_ads"><?php echo $result_cout['cout']; ?></span>

		        <?php }?>
						</p>
						<p>
								<a class="listing-infos-link " href="listes-annonces.php">Region</a> :
								<?php if (isset($_GET['region'])): ?>
									<a class="txt_info_nb_ads" href="listes-annonces.php?region=<?php echo $_GET['region'] ?>"><?php echo $result_region['label']; ?></a>
								<?php else: ?>
									<a class="txt_info_nb_ads" href="listes-annonces.php">Toutes régions</a>
								<?php endif; ?>

						</p>
						<!--p>
						<a class="listing-infos-link " href="https://www.script-pag.com/demo/fr/search.php?type=1&amp;status=1">Particulier</a> :
								17			</p>
					<p>
						<a class="listing-infos-link link-selected" href="https://www.script-pag.com/demo/fr/search.php?type=1&amp;status=2">Professionnel</a> :
								1 à 30 sur  4			</p>
						<p class="listing-infos-select">
						<select onchange="window.document.location.href=this.options[this.selectedIndex].value;">
							<option value="https://www.script-pag.com/demo/fr/search.php?type=1&amp;status=2&amp;sort=1" selected="">Plus récentes</option>
							<option value="https://www.script-pag.com/demo/fr/search.php?type=1&amp;status=2&amp;sort=2">Plus anciennes</option>
							<option value="https://www.script-pag.com/demo/fr/search.php?type=1&amp;status=2&amp;sort=3">Prix croissant</option>
							<option value="https://www.script-pag.com/demo/fr/search.php?type=1&amp;status=2&amp;sort=4">Prix décroissant</option>
						</select>
					</p>
						<p class="save-shearch-container">
						<a class="save-shearch" data-query="type=1&amp;status=2" href="https://www.script-pag.com/demo/fr/acc_connexion.php?back=SearchAlert" data-textsaved="Recherche sauvegardée" data-textsave="Sauvegarder cette recherche">Sauvegarder cette recherche</a>
					</p-->
				</div>
		<div class="col-md-4" id="fitra">
                <div class="list-group search-form">
                    <h3>Catégorie</h3>
                    <div style="height: 180px; overflow: auto; width:100%">
                          <?php

                    $query = "SELECT DISTINCT(label),id FROM an_souscat ORDER BY label ASC";
                    $statement = $conn->query($query);
                    while ($result = $statement->fetch_assoc()) {
                       ?>
                       <div class="list-group-item checkbox" style="font-family: verdana;font-size:12px;height:40px;">
												 <div class="" style="top:-5px;">
                        		<input type="checkbox" class="common_selector categorie" id="<?php echo $result['label']; ?>" name="<?php echo $result['label']; ?>" value="<?php echo $result['id']; ?>"  >
                        		<label for="<?php echo $result['label']; ?>"><?php echo $result['label']; ?></label><br>
													</div>
                        </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
                <div class="container-100 header-end"></div>

				<div class="list-group search-form">
					<h3>Prix</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 65000</p>
                    <div id="price_range"></div>
                </div>

            </div>

             <div class="col-md-8" id="valiny">
            	<br />
                <div class="row filter_data">

                </div>
								<div id="loading" style="display:none;" ></div>
            </div>


</div>
</div>

<?php
	include("include/footer.php");
?>
<link href = "css/jquery-ui.css" rel = "stylesheet">
<style>
#loading
{
    text-align:center;
    background: url('image/loader2.gif') no-repeat center;
    height: 150px;
}
#fitra{
   display:  inline-block;
   vertical-align: top;
}

#valiny{
   display: inline-block;
   vertical-align: top;
   float: right;
}


</style>
<script type="text/javascript">
	function test(idreg){
		if(idreg != 0 ){javascript:location.href='listes-annonces.php?region='+idreg}
		else{javascript:location.href='listes-annonces.php'}
	}
</script>
<?php if (isset($_GET['region'])): ?>
	<script>
	$(document).ready(function(){
	    filter_data();
	    function filter_data()
	    {
	        $('#loading').fadeIn(2000).show();
	        var action = 'data_region';
	        var minimum_price = $('#hidden_minimum_price').val();
	        var maximum_price = $('#hidden_maximum_price').val();
	        var brand = get_filter('brand');
	        var ram = get_filter('ram');
	        var storage = get_filter('storage');
	        var type = get_filter('type');
	        var title = get_filter('title');
	        var region = $('#region').val();
	        var categorie = get_filter('categorie');
	        var recherche = $('#keywords').val();
	        var postal = $('#an_code_p').val();
					setTimeout(function()
					{
						$.ajax({
							 url:"data_region.php",
							 method:"POST",
							 data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage, type:type, categorie:categorie, recherche:recherche, postal:postal, title:title},
							 success:function(data){

									 setTimeout(function()
				 					{
										$('#loading').fadeOut(500).hide();
										$('.filter_data').html(data);
									},1000);
							 }
					 });
				 }, 1000);

	    }

	    function get_filter(class_name)
	    {
	        var filter = [];
	        $('.'+class_name+':checked').each(function(){
	            filter.push($(this).val());
	        });

	        return filter;
	    }

	    $('.common_selector').click(function(){
				$('.background-ads-listing-container').hide();
					$('.text-page').hide();
	        filter_data();
	    });

	    $('#keywords').keyup(function(){
				$('.background-ads-listing-container').hide();
				$('.text-page').hide();
	                filter_data();
	            });
	    $('#an_code_p').keyup(function(){
	                filter_data();
	            });

	    $('#price_range').slider({
	        range:true,
	        min:1000,
	        max:65000,
	        values:[1000, 65000],
	        step:500,
	        stop:function(event, ui)
	        {
	            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
	            $('#hidden_minimum_price').val(ui.values[0]);
	            $('#hidden_maximum_price').val(ui.values[1]);
	            filter_data();
	        }
	    });
	});
	</script>
<?php else: ?>
	<script>
	$(document).ready(function(){
	    filter_data();
	    function filter_data()
	    {
	       $('#loading').fadeIn(2000).show();
	        var action = 'liste_annonces';
	        var minimum_price = $('#hidden_minimum_price').val();
	        var maximum_price = $('#hidden_maximum_price').val();
	        var brand = get_filter('brand');
	        var ram = get_filter('ram');
	        var storage = get_filter('storage');
	        var type = get_filter('type');
	        var title = get_filter('title');
	        var region = $('#region').val();
	        var categorie = get_filter('categorie');
	        var recherche = $('#keywords').val();
	        var postal = $('#an_code_p').val();
					setTimeout(function()
					{
						$.ajax({
							 url:"data_region.php",
							 method:"POST",
							 data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage, type:type, categorie:categorie, recherche:recherche, postal:postal, title:title},
							 success:function(data){

									 setTimeout(function()
				 					{
										$('#loading').fadeOut(500).hide();
										$('.filter_data').html(data);
									},1000);
							 }
					 });
				 }, 1000);
	    }

	    function get_filter(class_name)
	    {
	        var filter = [];
	        $('.'+class_name+':checked').each(function(){
	            filter.push($(this).val());
	        });

	        return filter;
	    }

	    $('.common_selector').click(function(){
				$('.background-ads-listing-container').hide();
				$('.text-page').hide();
	        filter_data();
	    });

	    $('#keywords').keyup(function(){
				$('.background-ads-listing-container').hide();
				$('.text-page').hide();
	                filter_data();
	            });
	    $('#an_code_p').keyup(function(){
				$('.background-ads-listing-container').hide();
				$('.text-page').hide();
	                filter_data();
	            });

	    $('#price_range').slider({
	        range:true,
	        min:1000,
	        max:65000,
	        values:[1000, 65000],
	        step:500,
	        stop:function(event, ui)
	        {
	            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
	            $('#hidden_minimum_price').val(ui.values[0]);
	            $('#hidden_maximum_price').val(ui.values[1]);
	            filter_data();
	        }
	    });
	});
	</script>
<?php endif; ?>
