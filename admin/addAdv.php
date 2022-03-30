<?php
    include "includes/header.php";
    
    include "includes/navbar.php";

    include "includes/sidebar.php";
?>

<?php 

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter une annonce</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Ajouter une annonce</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Ajouter une annonce</h3>
              </div>
              <!-- /.card-header -->

              <!-- form start -->
              <form action="scripts/insert-adv.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group col-sm-6">
                    <label>Titre</label>
                    <input type="text" class="form-control" name="title" placeholder="Entrer le titre">
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Description</label>
                    <textarea class="form-control" name="descr" cols="60" rows="10" placeholder="Entrer la description"></textarea>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="">Prix</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Ariary</span>
                      </div>
                      <input type="text" class="form-control" name="price" placeholder="Enter le prix">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="">Type</label>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="type" checked="checked" value="Offre">
                      <label class="form-check-label" for="">Vendre</label>
                    </div>
                    <div class="form-check">
                      <input type="radio" class="form-check-input" name="type" value="Demande">
                      <label class="form-check-label" for="">Acheter</label>
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Categorie</label>
                    <select class="form-control" name="category" id="options">
                      <option value="0">Choisir la categorie</option>
                      <?php 
                      $sql = "SELECT * FROM an_categorie";
                      $result = $conn->query($sql);
                      
                      if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                          echo '<option value="0" disabled style="background:#F5F5F5">-- ' .strtoupper($row['label']). ' --</option>';
                          $sql_ = "SELECT * FROM an_souscat WHERE id_cat=" .$row['id'];
                          $result_ = $conn->query($sql_);
                          
                          if ($result_->num_rows > 0) {
                            // output data of each row
                            while($row_ = $result_->fetch_assoc()) {
                              echo '<option value="' .$row_['id']. '">' .$row_['label']. '</option>';
                            }
                          } else {
                            echo "0 results";
                          }
                        }
                      } else {
                        echo "0 results";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="form-group col-sm-12">
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-1">Marque</label>
                        <select id="an_marquev" name="an_marquev" class="form-control option-1">
                          <option value="0">-- Choisissez Marque --</option><option>Alfa Romeo</option><option>Aston Martin</option><option>Audi</option><option>Bentley</option><option>BMW</option><option>Cadillac</option><option>Chevrolet</option><option>Citroen</option><option>Dacia</option><option>Daewoo</option><option>Daihatsu</option><option>Dodge</option><option>Ferrari</option><option>Fiat</option><option>Ford</option><option>Ginetta</option><option>Honda</option><option>Hummer</option><option>Hyundai</option><option>Isuzu</option><option>Jaguar</option><option>Jeep</option><option>Kia</option><option>Lada</option><option>Lamborghini</option><option>Lancia</option><option>Land Rover</option><option>Lexus</option><option>Lotus</option><option>Maserati</option><option>Mazda</option><option>Mercedes-Benz</option><option>Mitsubishi</option><option>Morgan</option><option>Nissan</option><option>Opel</option><option>Peugeot</option><option>Porche</option><option>Renault</option><option>Rolls-Royce</option><option>Rover</option><option>Saab</option><option>Seat</option><option>Skoda</option><option>Smart</option><option>Subaru</option><option>Suzuki</option><option>Toyota</option><option>TVR</option><option>Volkswagen</option><option>Volvo</option>
                        </select>
                        <label class="option-1">Annee</label>
                        <select id="an_anneev" name="an_anneev" class="form-control option-1">
                          <option value="0">-- Choisissez Année-Modèle --</option><option value="avant 2000">Avant 2000</option><option value=2000>2000</option><option value=2001>2001</option><option value=2002>2002</option><option value=2003>2003</option><option value=2004>2004</option><option value=2005>2005</option><option value=2006>2006</option><option value=2007>2007</option><option value=2008>2008</option><option value=2009>2009</option><option value=2010>2010</option><option value=2011>2011</option><option value=2012>2012</option><option value=2013>2013</option><option value=2014>2014</option><option value=2015>2015</option><option value=2016>2016</option><option value=2017>2017</option><option value=2018>2018</option><option value=2019>2019</option>
                        </select>
              <!--label for="an_annee[]" class="error" style="display:none;">Please choose one.</label-->
                        <label class="option-1">Kilometrage</label>
                        <input class="form-control option-1" type="text" id="an_kmeterv" name="an_kmeterv" placeholder="Kilométrage">
                      </div>
                      <div class="col-sm-6">
                        <label class="option-1">Carburant</label>
                        <select name="an_energyv" id="an_energyv" class="form-control option-1">
                          <option value="0">-- Choisissez type Carburant --</option><option value="Essence">Essence</option><option value="Diesel">Diesel</option><option value="GPL">GPL</option><option value="Electrique">Electrique</option><option value="Hybride">Hybride</option>
                        </select>
              <!--label for="an_energy[]" class="error" style="display:none;">Please choose one.</label-->
                        <label class="option-1">Boite de vitesse</label>
                        <select name="an_vitessev" id="an_vitessev"  class="form-control option-1">
                          <option value="0" >-- Choisissez Boîte de vitesse --</option><option value="1">Automatique</option><option value="2">Manuelle</option>
                        </select>
              <!--label for="an_vitesse[]" class="error" style="display:none;">Please choose one.</label-->
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-2">Kilometrage</label>
                        <input class="form-control option-2" type="text" id="an_kmeterm" name="an_kmeterm" placeholder="Kilométrage">
                        <label class="option-2">Annee</label>
                        <select id="an_anneem" name="an_anneem" class="form-control option-2">
                          <option value="0">-- Choisissez Année-Modèle --</option><option value="avant 2000">Avant 2000</option><option value=2000>2000</option><option value=2001>2001</option><option value=2002>2002</option><option value=2003>2003</option><option value=2004>2004</option><option value=2005>2005</option><option value=2006>2006</option><option value=2007>2007</option><option value=2008>2008</option><option value=2009>2009</option><option value=2010>2010</option><option value=2011>2011</option><option value=2012>2012</option><option value=2013>2013</option><option value=2014>2014</option><option value=2015>2015</option><option value=2016>2016</option><option value=2017>2017</option><option value=2018>2018</option><option value=2019>2019</option>
                        </select>
              <!--<label for="an_annee[]" class="error" style="display:none;">Please choose one.</label-->
                      </div>
                      <div class="col-sm-6">
                        <label class="option-2">Cylindre</label>
                        <input class="form-control option-2" type="text" id="an_cylinder" name="an_cylinder" placeholder="Cylindrée">
                      </div>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-3">Kilometrage</label>
                      <input class="form-control option-3" type="text" id="an_kmeterc" name="an_kmeterc" placeholder="Kilométrage">
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-8">Surface</label>
                        <input class="form-control option-8" type="number" name="an_surfacevm" id="an_surfacevm" placeholder="Surface de la Maison">
                        <label class="option-8">Nombre de pieces</label>
                        <input class="form-control option-8" type="number" name="an_piecevm" id="an_piecevm" placeholder="Nombre de pieces">
                      </div>
                      <div class="col-sm-6">
                        <label class="option-8">Capacite</label>
                        <input class="form-control option-8" type="number" name="an_capacityvm" id="an_capacityvm" placeholder="Capacité de la Maison">    
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-9">Surface</label>
                        <input class="form-control option-9" type="number" name="an_surfacelm" id="an_surfacelm" placeholder="Surface de la Maison">
                        <label class="option-9">Nombre de piece</label>
                        <input class="form-control option-9" type="number" name="an_piecelm" id="an_piecelm" placeholder="Nombre de pieces">
                      </div>
                      <div class="col-sm-6">
                        <label class="option-9">Capacite</label>
                        <input class="form-control option-9" type="number" name="an_capacitylm" id="an_capacitylm" placeholder="Capacité de la Maison">
                      </div>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-10">Surface</label>
                      <input class="form-control option-10" type="number" name="an_surfacet" id="an_surfacet" placeholder="Surface du Terrain">
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-11">Surface</label>
                        <input class="form-control option-11" type="number" name="an_surfacecl" id="an_surfacecl" placeholder="Surface de la Maison">
                        <label class="option-11">Nombre de pieces</label>
                        <input class="form-control option-11" type="number" name="an_piececl" id="an_piececl" placeholder="Nombre de pieces">
                      </div>
                      <div class="col-sm-6">
                        <label class="option-11">Capacite</label>
                        <input class="form-control option-11" type="number" name="an_capacitycl" id="an_capacitycl" placeholder="Capacité de la Maison">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-12">Debut</label>
                        <input class="form-control option-12" type="date" name="an_debutlv" id="an_debutlv" placeholder="Debut du Location">
                        <label class="option-12">Fin</label>
                        <input class="form-control option-12" type="date" name="an_finlv" id="an_finlv" placeholder="Fin du Location">
                        <label class="option-12">Surface</label>
                        <input class="form-control option-12" type="number" name="an_surfacelv" id="an_surfacelv" placeholder="Surface de la Maison">
                      </div>
                      <div class="col-sm-6">
                        <label class="option-12">Nombre de pieces</label>
                        <input class="form-control option-12" type="number" name="an_piecelv" id="an_piecelv" placeholder="Nombre de pieces">
                        <label class="option-12">Capacite</label>
                        <input class="form-control option-12" type="number" name="an_capacitylv" id="an_capacitylv" placeholder="Capacité de la Maison">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-13">Surface</label>
                        <input class="form-control option-13" type="number" name="an_surfacel" id="an_surfacel" placeholder="Surface du Locaux">
                      </div>
                      <div class="col-sm-6">
                        <label class="option-13">Nombre de pieces</label>
                        <input class="form-control option-13" type="number" name="an_piecel" id="an_piecel" placeholder="Nombre de pieces">
                      </div>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-14">Surface</label>
                      <input class="form-control option-14" type="number" name="an_surfaceg" id="an_surfaceg" placeholder="Surface du Garage">
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-15">Surface</label>
                        <input class="form-control option-15" type="number" name="an_surfacebc" id="an_surfacebc" placeholder="Surface du Bureau">
                      </div>
                      <div class="col-sm-6">
                        <label class="option-15">Nombre de pieces</label>
                        <input class="form-control option-15" type="number" name="an_piecebc" id="an_piecebc" placeholder="Nombre de pieces">
                      </div>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-16">Duree</label>
                      <select name="an_temploi[]" id="an_temploi" class="form-control option-16">
                        <option value="0">Duree d'emploi</option>
                        <option value="permanent">Permanent</option>
                        <option value="temporaire">Temporaire</option>
                      </select>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-17">Type</label>
                      <select name="an_tcours[]" id="an_tcours" class="form-control option-17">
                        <option value="0">Type du cour</option>
                        <option value="jour">Du Jour</option>
                        <option value="soir">Du Soir</option>
                        <option value="vacance">De Vacance</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-19">Categorie</label>
                        <select name="an_cporte[]" id="an_cporte" class="form-control option-19">
                          <option value="0">Categorie</option>
                          <option value="chemise">Chemise</option>
                          <option value="tshirt">Tshirt</option>
                          <option value="form-control">form-control</option>
                          <option value="pantalon">Pantalon</option>
                          <option value="chaussure">Chaussure</option>
                        </select>
                        <label class="option-19">Qualite</label>
                        <select name="an_tporte[]" id="an_tporte" class="form-control option-19">
                          <option value="0">Qualite</option>
                          <option value="neuf">Neuf</option>
                          <option value="occasion">Occasion</option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="option-19">Personne</label>
                        <select name="an_pporte[]" id="an_pporte" class="form-control option-19">
                          <option value="0">Personne</option>
                          <option value="enfant">Enfant</option>
                          <option value="femme">Femme</option>
                          <option value="homme">Homme</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-21">Categorie</label>
                        <select name="an_cmonbij[]" id="an_cmonbij" class="form-control option-21">
                          <option value="0">Categorie</option>
                          <option value="bague">Bague</option>
                          <option value="boucle-d-oreille">Boucle d'oreille</option>
                          <option value="bracelet">Bracelet</option>
                          <option value="collier">Collier</option>
                          <option value="montre">Montre</option>
                        </select>
                        <label class="option-21">Matiere</label>
                        <select name="an_mmonbij[]" id="an_mmonbij" class="form-control option-21">
                          <option value="argent">Argent</option>
                          <option value="or">Or</option>
                          <option value="autre">Autre</option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="option-21">Personne</label>
                        <select name="an_pmonbij[]" id="an_pmonbij" class="form-control option-21">
                          <option value="0">Personne</option>
                          <option value="enfant">Enfant</option>
                          <option value="femme">Femme</option>
                          <option value="homme">Homme</option>
                        </select>
                      </div>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-22">Categorie</label>
                      <select name="an_imgson[]" id="an_imgson" class="form-control option-22">
                        <option value="0">Categorie</option>
                        <option value="ampli">Ampli</option>
                        <option value="appareil-photo">Appareil photo</option>
                        <option value="camera">Camera</option>
                        <option value="micro">Micro</option>
                        <option value="suboufer">Suboufer</option>
                        <option value="autre">Autre</option>
                      </select>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-23">Categorie</label>
                      <select name="an_info[]" id="an_info" class="form-control option-23">
                        <option value="0">Categorie</option>
                        <option value="accessoire">Accessoire</option>
                        <option value="ordinateur-portable">Ordinateur Portable</option>
                        <option value="moniteur">Moniteur</option>
                        <option value="unite-centrale">Unite Centrale</option>
                      </select>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-24">Plateforme</label>
                      <select name="an_tel[]" id="an_tel" class="form-control option-24">
                        <option value="0">Plateforme</option>
                        <option value="android">Android</option>
                        <option value="ios">iOS</option>
                      </select>
                    </div>
                    <div class="row col-sm-6">
                      <label class="option-25">Plateforme</label>
                      <select name="an_jeu[]" id="an_jeu" class="form-control option-25">
                        <option value="0">Plateforme</option>
                        <option value="pc">PC</option>
                        <option value="playstation">Playstation</option>
                        <option value="nitendo">Nitendo</option>
                        <option value="xbox">Xbox</option>
                      </select>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-30">Genre</label>
                        <select name="an_genref[]" id="an_genref" class="form-control option-30">
                          <option value="0">Choisir le genre</option>
                          <option value="1">Action, Aventure</option>
                          <option value="2">Comédie</option>
                          <option value="3">Documentaire</option>
                          <option value="4">Drame</option>
                          <option value="5">Horreur</option>
                          <option value="6">Fantastique</option>
                          <option value="7">Policier</option>
                          <option value="8">Romance</option>
                          <option value="9">Science-Fiction</option>
                          <option value="10">Western</option>
                          <option value="11">Autres</option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="option-30">Nombre</label>
                        <input type="number" name="an_nombref" id="an_nombref" placeholder="Nombre des films" class="form-control option-30">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <label class="option-31">Genre</label>
                        <select name="an_genrem[]" id="an_genrem" class="form-control option-31">
                          <option value="0">Choisir le genre</option>
                          <option value="1">House, Techno, Electro, Dance</option>
                          <option value="2">Jazz</option>
                          <option value="3">Metal</option>
                          <option value="4">Classique</option>
                          <option value="5">Pop, Rock</option>
                          <option value="6">R&B, Soul</option>
                          <option value="7">Rap, Hip Hop</option>
                          <option value="8">Reggae</option>
                          <option value="9">Autres</option>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="option-31">Nombre</label>
                        <input type="number" name="an_nombrem" id="an_nombrem" placeholder="Nombre des musiques" class="form-control option-31">
                      </div>
                    </div> 
                  </div>
                  <div class="form-group col-sm-12">
                    <label>Localisation</label>
                    <div class="row">
                      <div class="col-sm-6">
                        <p>Geolocalisation</p>
                        <input type="text" class="form-control" name="geoloc" placeholder="Geolocalisation">
                        <a href="javascript:void(0)">Cliquer ici pour vous geolocaliser</a>
                        <p>Region</p>
                        <select class="form-control" name="region">
                          <option value="0">Choisir la region</option>
                          <?php 
                          $sql = "SELECT * FROM an_region";
                          $result = $conn->query($sql);
                          
                          if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              echo '<option value="' .$row['id']. '">' .$row['label']. '</option>';
                            }
                          } else {
                            echo "0 results";
                          }
                          
                          $conn->close();
                           ?>
                        </select>
                        <p>Ville</p>
                        <input type="text" name="city" class="form-control" placeholder="Entrer la ville">
                        <p>Code postal</p>
                        <input type="text" name="code" class="form-control" placeholder="Entrer le code postal">
                        <p>Adresse</p>
                        <input type="text" name="address" class="form-control" placeholder="Entrer l'adresse">
                      </div>
                      <div class="col-sm-6">
                        <div id="disp-map"></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <!--<label for="">Photos</label>
                    <div class="custom-file">-->
                      <input type="file" class="" name="photo">
                      <!--<label class="custom-file-label">Choisir une photo</label>
                    </div>-->
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="terms" checked="checked" value="1">
                    <label class="form-check-label">Je reconnais avoir lu et accepter les <a href="info/Conditions-generales-d-utilisation-3.html" class="first-color bold" target="_blank">Conditions générales d'utilisation</a> et la <a href="info/Politique-de-confidentialite-5.html" class="first-color bold" target="_blank">Politique de confidentialité</a></label>
                  </div>

                  <input type="hidden" name="longitude">
                  <input type="hidden" name="latitude">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="allAdvs.php" class="btn btn-default">Retour</a>
                  <button type="submit" name="submit" class="btn btn-success float-right">Enregistrer</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<?php
    include "includes/footer.php";
?>
<script type="text/javascript" src="js/add_adv.js"></script>