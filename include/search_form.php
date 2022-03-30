<form class="search-form" method="get" action="search.php">
				<p class="search-geoloc-error p-error" style="display: none;">Vous n'avez pas autorisé l'accès à votre position. Vous ne pouvez donc pas accéder au système de géolocalisation des annonces.</p>
				<ul id="search-type" class="search-ul-radio">
					<li data-slug="annonces/offres"><input type="radio" name="type" id="search_radio1" value="1" checked /><label for="search_radio1">Offres</label></li>
					<li data-slug="annonces/recherches"><input type="radio" name="type" id="search_radio2" value="2"   /><label for="search_radio2">Demandes</label></li>
				</ul>

			<input data-texttype1="Tapez votre recherche" data-texttype2="Rechercher une vitrine" class="input-keywords " type="text" name="keywords" placeholder="Tapez votre recherche" value="" />

			<input type="text" name="an_code_p" placeholder="Code postal (ex: 401)" value="" />

			<select id="region" name="an_region" onchange="">
				<option value="0">Toutes régions</option>
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

			 <span id="get_counties"></span><span id="cat-search">
			 	<select id="cat" name="an_cat" class="short" onchange="getcate(this.options[this.selectedIndex].value);">
					<option value="0">Toutes catégories</option>
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

						<option value="<?php echo $res_souscat['id'] ?>" style="background-color: white;"><?php echo $res_souscat['label']; ?> </option>

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

			<input type="submit" value="Lancer la recherche" />

		</form>
