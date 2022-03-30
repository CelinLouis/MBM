<?php
	include("include/header.php");
		if (isset($_GET['region'])) 
		{
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
			if (isset($_POST['page'])) {
				$page = $_POST['page'];
	            $_SESSION['page'] = $page;
			}
			$select_cout = "SELECT COUNT(*) cout FROM an_annonces,an_region WHERE an_annonces.an_region = an_region.id ";
	    $coutvalue = $conn->query($select_cout);
	    $result_cout  = $coutvalue -> fetch_assoc();

	    $region = "SELECT * FROM an_region";
	    $regions =$conn->query($region);
	    $result_region = $regions -> fetch_assoc();
		
		}
?>

<div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child ad-page-container" itemscope itemtype="http://schema.org/CreativeWork">
            
				<form class="search-form" method="get" action="search.php">
				<p class="search-geoloc-error p-error" style="display: none;">Vous n'avez pas autorisé l'accès à votre position. Vous ne pouvez donc pas accéder au système de géolocalisation des annonces.</p>
				<ul id="search-type" class="search-ul-radio">
					<li>
					    <input type="checkbox" id="Ventes" class="common_selector Ventes" name="Ventes" value="Offre"  />
					    <label for="Ventes">Ventes</label>
					</li>
					<li>
					    <input type="checkbox" id="Achats" class="common_selector Achats" name="Achats" value="Demande"  />
					    <label for="Achats">Achats</label>
					</li>
				</ul>

            <?php if (isset($_POST['recherche'])) {?>
            	<input data-texttype1="Tapez votre recherche" data-texttype2="Rechercher une vitrine" class="input-keywords " type="text" id="keywords" name="keywords" placeholder="Tapez votre recherche" value="<?php echo $_POST['recherche']; ?>" />
            <?php }else{?>
                <input data-texttype1="Tapez votre recherche" data-texttype2="Rechercher une vitrine" class="input-keywords " type="text" id="keywords" name="keywords" placeholder="Tapez votre recherche" value="" />
            <?php }?>
            

            <?php if (isset($_POST['code'])) {?>
            	<input type="text" name="an_code_p" id="an_code_p" placeholder="Code postal (ex: 401)" value="<?php echo $_POST['code']; ?>" />
            <?php }else{?>
                <input type="text" name="an_code_p" id="an_code_p" placeholder="Code postal (ex: 401)" value="" />
            <?php }?>
			

			<select id="an_region" name="an_region" onchange="">
				<option value="">Toutes régions</option>
				<?php
					$req = $conn->query("SELECT * FROM an_region");
					while($res=$req->fetch_assoc())
					{
					?>
                            <?php if (isset($_POST['region'])){ ?>
											<option <?php if ($_POST['region'] == $res['id']){ ?>
												selected
											<?php } ?> name="an_region" value="<?php echo $res['id'] ?>"><?php echo $res['label'] ?></option>

							<?php }elseif(isset($_GET['region'])){ ?>

											<option <?php if ($_GET['region'] == $res['id']){ ?>
												selected
											<?php } ?> name="an_region" value="<?php echo $res['id'] ?>"><?php echo $res['label'] ?></option>

							<?php }else{ ?>

											<option name="an_region" value="<?php echo $res['id'] ?>"><?php echo $res['label'] ?></option>

							<?php } ?>
					<?php
					}
				 ?>
			</select>

			 <span id="get_counties"></span><span id="cat-search">
			 	<select id="options" name="an_cat" class="short">
					<option value="">Toutes catégories</option>
					<?php
						$req_cat= $conn->query("SELECT * FROM an_categorie");
						while ($res_cat = $req_cat->fetch_assoc())
						{
							?>
							<optgroup label="<?php echo "-- ".strtoupper($res_cat['label'])." --" ?>" style="background-color: #F5F5F5;">
							<?php
							$req_souscat= $conn->query("SELECT * FROM an_souscat WHERE id_cat = '".$res_cat['id']."' ");
							while($res_souscat=$req_souscat->fetch_assoc())
							{
					       ?>
					       <?php if (isset($_POST['categorie'])){ ?>
											<option <?php if ($_POST['categorie'] == $res_souscat['id']){ ?>
												selected
											<?php } ?>  value="<?php echo $res_souscat['id'] ?>"><?php echo $res_souscat['label']; ?></option>

                                        <?php }elseif (isset($_GET['categorie'])) { ?>
                                            <option <?php if ($_GET['categorie'] == $res_souscat['id']){ ?>
												selected
											<?php } ?> value="<?php echo $res_souscat['id'] ?>"><?php echo $res_souscat['label']; ?></option>
										<?php }else{ ?>

											<option  value="<?php echo $res_souscat['id'] ?>"><?php echo $res_souscat['label']; ?></option>

										<?php } ?>
					<?php
							}
							?>
							</optgroup>
							<?php
						}
					 ?>
				</select>


			 	<span id="get_options"></span><span id="more-search" class="more-step" style="display: none;" data-less="&lt;span class=&quot;more-search-item&quot;&gt;-&lt;/span&gt;Moins de critères" data-more="&lt;span class=&quot;more-search-item&quot;&gt;+&lt;/span&gt;Plus de critères"><span class="more-search-item">+</span>Plus de critères</span></span>

				<ul id="search-ads" class="search-ul-checkbox" style="display: block">
					<li>
						<input type="hidden" name="sort" value="1" />
						<input type="hidden" name="status" value="0" />
    
						<input type="checkbox" id="title" class="common_selector title" name="title" value="1"  /><label for="title">Rechercher uniquement dans le titre</label>
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

		</form>

		<div class="col-md-4" id="fitra">
				<div class="list-group search-form">
					<h3>Prix</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="1000000" />
                    <p id="price_show">1000 - 1000000</p>  
                    <div id="price_range"></div> 
                </div>
                   <div class="list-group search-form option-1">
                        <h3>Kilométrage</h3>
                        <input type="hidden" id="hidden_minimum_kilo" value="0" />
                        <input type="hidden" id="hidden_maximum_kilo" value="300000" />
                        <p id="kilo_show">10000 - 300000</p>  
                        <div id="kilo_range"></div> 
                    </div>

                    <div class="list-group search-form option-1 option-2">
                        <h3>Année</h3>
                        <input type="hidden" id="hidden_minimum_annee" value="0" />
                        <input type="hidden" id="hidden_maximum_annee" value="2020" />
                        <p id="annee_show">1960 - 2020</p>  
                        <div id="annee_range"></div> 
                    </div>
                  

                    <div class="list-group search-form option-2">
                        <h3>Cylindrée</h3>
                        <input type="hidden" id="hidden_minimum_cylindre" value="0" />
                        <input type="hidden" id="hidden_maximum_cylindre" value="2020" />
                        <p id="cylindre_show">50 - 1000</p>
                        <div id="cylindre_range"></div> 
                    </div>

                    <div class="list-group search-form option-8 option-9 option-11 option-12 option-10 option-14 option-13 option-15">
                        <h3>Surface</h3>
                        <input type="hidden" id="hidden_minimum_surface" value="0" />
                        <input type="hidden" id="hidden_maximum_surface" value="500" />
                        <p id="surface_show">20 - 500</p>
                        <div id="surface_range"></div> 
                    </div>

                    <div class="list-group search-form option-8 option-9 option-11 option-12 option-13 option-15">
                        <h3>Pièces</h3>
                        <input type="hidden" id="hidden_minimum_piece" value="0" />
                        <input type="hidden" id="hidden_maximum_piece" value="8" />
                        <p id="piece_show">1 - 8</p>
                        <div id="piece_range"></div> 
                    </div>

                    <div class="list-group search-form option-8 option-9 option-11 option-12">
                        <h3>Capacité</h3>
                        <input type="hidden" id="hidden_minimum_capacité" value="0" />
                        <input type="hidden" id="hidden_maximum_capacité" value="13" />
                        <p id="capacité_show">1 - 13</p>
                        <div id="capacité_range"></div> 
                    </div>

                   <div class="list-group search-form option-1">
                        <h3>Energie</h3>
                        <div >
                            <div class="list-group-item checkbox">
                                <input type="checkbox" class="common_selector energie" id="essence" name="essence" value="Essence"  >
                                <label for="essence">Essence</label><br>
                                <input type="checkbox" class="common_selector energie" id="diesel" name="diesel" value="Diesel"  >
                                <label for="diesel">Diesel</label><br>
                                <input type="checkbox" class="common_selector energie" id="gpl" name="gpl" value="GPL"  >
                                <label for="gpl">GPL</label><br>
                                <input type="checkbox" class="common_selector energie" id="electrique" name="electrique" value="Electrique">
                                <label for="electrique">Electrique</label><br>
                                <input type="checkbox" class="common_selector energie" id="autre" name="autre" value="Autre"  >
                                <label for="autre">Autre</label><br>
                            </div>
                        </div>
                    </div>

                    <div class="list-group search-form option-1">
                        <h3>Boite de vitesse</h3>
                        <div>
                              <div class="list-group-item checkbox">
                                <input type="checkbox" class="common_selector vitesse" id="Manuelle" name="Manuelle" value="Manuelle"  >
                                <label for="Manuelle">Manuelle</label><br>
                                <input type="checkbox" class="common_selector vitesse" id="Automatique" name="Automatique" value="Automatique"  >
                                <label for="Automatique">Automatique</label><br>
                            </div>
                        </div>
                    </div><br>

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
   top: 75px;
}

#valiny{
   display: inline-block;
   vertical-align: top;
   float: right;
   bottom: 25px;
}


</style>
<script>
	$(document).ready(function(){
	    filter_data();
	    function filter_data(page)
	    {
	        $('#loading').fadeIn(2000).show();
	        var action = 'data_new';
	        var minimum_price = $('#hidden_minimum_price').val();
	        var maximum_price = $('#hidden_maximum_price').val();
	        var minimum_kilo = $('#hidden_minimum_kilo').val();
	        var maximum_kilo = $('#hidden_maximum_kilo').val();
	        var minimum_annee = $('#hidden_minimum_annee').val();
	        var maximum_annee = $('#hidden_maximum_annee').val();
	        var minimum_cylindre = $('#hidden_minimum_cylindre').val();
	        var maximum_cylindre = $('#hidden_maximum_cylindre').val();
	        var minimum_surface = $('#hidden_minimum_surface').val();
	        var maximum_surface = $('#hidden_maximum_surface').val();
	        var minimum_capacite = $('#hidden_minimum_capacité').val();
	        var maximum_capacite = $('#hidden_maximum_capacité').val();
	        var minimum_piece = $('#hidden_minimum_piece').val();
	        var maximum_piece = $('#hidden_maximum_piece').val();

	        var energie = get_filter('energie');
	        var vitesse = get_filter('vitesse');
	        var Ventes = get_filter('Ventes');
	        var Achats = get_filter('Achats');
	        var title = get_filter('title');
	        var region = $('#an_region').val();
	        var categorie = $('#options').val();
	        var recherche = $('#keywords').val();
	        var postal = $('#an_code_p').val();
					setTimeout(function()
					{
						$.ajax({
							 url:"data_new.php",
							 method:"POST",
							 data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, minimum_kilo:minimum_kilo, maximum_kilo:maximum_kilo, minimum_annee:minimum_annee, maximum_annee:maximum_annee, minimum_cylindre:minimum_cylindre, maximum_cylindre:maximum_cylindre, minimum_surface:minimum_surface, maximum_surface:maximum_surface, minimum_piece:minimum_piece, maximum_piece:maximum_piece, minimum_capacite:minimum_capacite, maximum_capacite:maximum_capacite, energie:energie, vitesse:vitesse, Ventes:Ventes, Achats:Achats, categorie:categorie, recherche:recherche, postal:postal, title:title, region:region,page:page},
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

	    $(document).on('click', '.pagination_link', function(){   
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
			var page = $(this).attr("id"); 
           filter_data(page) 
        });  

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

	   $('#an_region').change(function(){
	   	        $('.background-ads-listing-container').hide();
				$('.text-page').hide();
               filter_data();
            });
       $('#options').change(function(){
	   	        $('.background-ads-listing-container').hide();
				$('.text-page').hide();
               filter_data();
            });

      


	    $('#price_range').slider({
        range:true,
        min:1000,
        max:1000000,
        values:[1000, 1000000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
            filter_data();
        }
         });

    $('#kilo_range').slider({
        range:true,
        min:10000,
        max:300000,
        values:[10000, 300000],
        step:10000,
        stop:function(event, ui)
        {
            $('#kilo_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_kilo').val(ui.values[0]);
            $('#hidden_maximum_kilo').val(ui.values[1]);
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
            filter_data();
        }
    });

     $('#annee_range').slider({
        range:true,
        min:1960,
        max:2020,
        values:[1960, 2020],
        step:1,
        stop:function(event, ui)
        {
            $('#annee_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_annee').val(ui.values[0]);
            $('#hidden_maximum_annee').val(ui.values[1]);
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
            filter_data();
        }
    });

      $('#cylindre_range').slider({
        range:true,
        min:50,
        max:1000,
        values:[50, 1000],
        step:10,
        stop:function(event, ui)
        {
            $('#cylindre_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_cylindre').val(ui.values[0]);
            $('#hidden_maximum_cylindre').val(ui.values[1]);
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
            filter_data();
        }
    });

      $('#surface_range').slider({
        range:true,
        min:20,
        max:500,
        values:[20, 500],
        step:10,
        stop:function(event, ui)
        {
            $('#surface_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_surface').val(ui.values[0]);
            $('#hidden_maximum_surface').val(ui.values[1]);
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
            filter_data();
        }
    });

       $('#piece_range').slider({
        range:true,
        min:1,
        max:8,
        values:[1, 8],
        step:1,
        stop:function(event, ui)
        {
            $('#piece_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_piece').val(ui.values[0]);
            $('#hidden_maximum_piece').val(ui.values[1]);
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
            filter_data();
        }
    });

       $('#capacité_range').slider({
        range:true,
        min:1,
        max:13,
        values:[1, 13],
        step:1,
        stop:function(event, ui)
        {
            $('#capacité_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_capacité').val(ui.values[0]);
            $('#hidden_maximum_capacité').val(ui.values[1]);
            $('.background-ads-listing-container').hide();
			$('.text-page').hide();
            filter_data();
        }
    });
	});
	</script>
