<?php
include("inc/header.php");

if (!isset($_SESSION['id'])) {
    header("Location: ../connexion.php");
} 
else { 
    
 ?>


<title>Mes annonces</title>
<style type="text/css">
    /*Reset CSS*/
*{
    margin: 0px;
    padding: 0px;
    font-family: Avenir, sans-serif;
}

nav{
    width: 100%;
    height: 45px;
    margin: 0px auto 40px auto;
    background-color: white;
    position: sticky;
    top: 0px;
}

nav ul{
    list-style-type: none;
}

nav li{
    float: left;
    width: 25%;/*100% divisé par le nombre d'éléments de menu*/
    text-align: center;/*Centre le texte dans les éléments de menu*/
}

/*Evite que le menu n'ait une hauteur nulle*/
nav ul::after{
    content: "";
    display: table;
    clear: both;
}

nav a{
    display: block; /*Toute la surface sera cliquable*/
    text-decoration: none;
    color: black;
    border-bottom: 2px solid transparent;/*Evite le décalage des éléments sous le menu à cause de la bordure en :hover*/
    padding: 10px 0px;/*Agrandit le menu et espace la bordure du texte*/
}

nav a:hover{
    color: green;
    border-bottom: 2px solid green;
}

.astyle{
    color: green;
    border-bottom: 2px solid green;
}
.conteneur{
  margin: 0px 20px;
  height: 1500px;
}
</style>

<div class="container-100 header-end"></div>

<div class="container-100">
    <div class="container-100-child index-container">

        <input id="u" type="hidden" name="" value="<?= $_SESSION['id'] ?>">
        <div class="ad-page-parent-container flex-container">
            <nav>
              <ul style="text-align: center;">
                <li><a style=" text-decoration: none;" class="astyle" href="mes-annonces.php">Annonces</a></li>
                <li><a style=" text-decoration: none;" href="mes-transaction.php">Transactions</a></li>
                <li><a style=" text-decoration: none;" href="mes-achats.php">Achats</a></li>
              </ul>
            </nav>

        </div>
    </div>
</div>

<style type="text/css">
    a.nav-link{
        color: green;
    }
   
</style>

    <div class="container-100-child" >
        <div class="listing-infos">
            <h1>Mes annonces</h1>
        </div>

            <div class="col-xl-12">
                    <!-- begin nav-tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#tab-annonces" data-toggle="tab" class="nav-link active">
                                <span class="d-sm-none">Vos annonces</span>
                                <span class="d-sm-block d-none">Vos annonces</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-annonces-en-tête" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Annonces en tête</span>
                                <span class="d-sm-block d-none">Annonces en tête</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-annonces-premium" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Annonces premium</span>
                                <span class="d-sm-block d-none">Annonces premium</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-annonces-urgentes" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Annonces urgentes</span>
                                <span class="d-sm-block d-none">Annonces urgentes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab-annonces-encadrees" data-toggle="tab" class="nav-link">
                                <span class="d-sm-none">Annonces encadrées</span>
                                <span class="d-sm-block d-none">Annonces encadrées</span>
                            </a>
                        </li>
                    </ul>
                    <!-- end nav-tabs -->
                    <!-- begin tab-content -->
                    <div class="tab-content">
                        <!-- begin tab-pane -->
                        <div class="tab-pane fade active show" id="tab-annonces" style="background: white; padding-left: 50px;padding-right: 50px;padding-bottom: 50px;">
                            <br>
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <table id="data-table-combine" class="table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Image</th>
                                                <th width="" class="text-nowrap" style="text-align: center;">Titre</th>
                                                <th width="40%" class="text-nowrap" style="text-align: center;">Description</th>
                                                <th  width="20%" class="text-nowrap" style="text-align: center;">
                                                    Prix
                                                </th>
                                                <th  width="" class="text-nowrap" style="text-align: center;">
                                                    Localisation
                                                </th>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $membre = $_SESSION['id'];

                                                $sql = "SELECT * FROM an_annonces WHERE id_membres=". $membre;
                                                //echo $sql;
                                                $result = $conn->query($sql);
                                                        
                                                if ($result->num_rows > 0) {
                                                    echo '<h4 class="panel-title"> Vos annonces : <span class="span-total">'. $result->num_rows .'</span> </h4><br>';
                                                    while($row = $result->fetch_assoc()) {
                                             ?>
                                            <tr class="odd gradeX background-ads-listing-container" style="text-align: center;">
                                                <td width="1%" class="with-img">
                                                   <div class="bloc-listing-picture">
                                                        <img src="<?= "../".$row['an_photo1']  ?>" alt="" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br><?= $row['an_title']  ?></p>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br>
                                                        <span class="price-listing" ><?= $row['an_desc']  ?> </span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                    <br>
                                                    <span class="price-listing" style="color:#FFA500"><?= $row['an_price'] ?> Ar</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                        <br>
                                                        <?= $row['an_address'] ?><br />                     
                                                        <?= $row['an_city'] ?>, <?= $row['an_region'] ?><br />
                                                        
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="title-listing" style="margin-top:40px;">
                                                       <a href="../annonce-detail.php?an=<?php echo $row['id']; ?>" class="btn btn-primary" title="Modifier"><i class="fa fa-edit"></i> Modifier
                                                       </a>
                                                        <button  onclick='supprimerAnnonces($(this))' class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i>
                                                            Supprimer</button>
                                                    </p>

                                                    
                                                </td>
                                                
                                            </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="tab-annonces-en-tête" style="background: white; padding-left: 50px;padding-right: 50px;padding-bottom: 50px;">
                            <br>
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <table id="data-table-combine" class="table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Image</th>
                                                <th width="" class="text-nowrap" style="text-align: center;">Titre</th>
                                                <th width="40%" class="text-nowrap" style="text-align: center;">Description</th>
                                                <th  width="20%" class="text-nowrap" style="text-align: center;">
                                                    Prix
                                                </th>
                                                <th  width="" class="text-nowrap" style="text-align: center;">
                                                    Localisation
                                                </th>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $membre = $_SESSION['id'];
                                                $sql = "SELECT *,a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_entetes b ON a.id=b.id_annonce WHERE a.id_membres=".$membre." ORDER BY b.id DESC";

                                                $result = $conn->query($sql);
                                                        
                                                if ($result->num_rows > 0) {
                                                    echo '<h4 class="panel-title"> Annonces en tête : <span class="span-total">'. $result->num_rows .'</span> </h4><br>';
                                                    while($row = $result->fetch_assoc()) {
                                             ?>
                                            <tr class="odd gradeX background-ads-listing-container" style="text-align: center;">
                                                <td width="1%" class="with-img">
                                                   <div class="bloc-listing-picture">
                                                        <img src="<?= "../".$row['an_photo1']  ?>" alt="" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br><?= $row['an_title']  ?></p>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br>
                                                        <span class="price-listing" ><?= $row['an_desc']  ?> </span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                    <br>
                                                    <span class="price-listing" style="color:#FFA500"><?= $row['an_price'] ?> Ar</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                        <br>
                                                        <?= $row['an_address'] ?><br />                     
                                                        <?= $row['an_city'] ?>, <?= $row['an_region'] ?><br />
                                                        
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="title-listing" style="margin-top:40px;">
                                                       <button  onclick='modifierAnnonces($(this))' class="btn btn-primary" title="Modifier"><i class="fa fa-edit"></i>
                                                       </button>
                                                        <button  onclick='supprimerAnnonces($(this))' class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i>
                                                            </button>
                                                    </p>
                                                </td>
                                                
                                            </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        
                        <div class="tab-pane fade" id="tab-annonces-premium" style="background: white; padding-left: 50px;padding-right: 50px;padding-bottom: 50px;">
                            <br>
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <table id="data-table-combine" class="table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Image</th>
                                                <th width="" class="text-nowrap" style="text-align: center;">Titre</th>
                                                <th width="40%" class="text-nowrap" style="text-align: center;">Description</th>
                                                <th  width="20%" class="text-nowrap" style="text-align: center;">
                                                    Prix
                                                </th>
                                                <th  width="" class="text-nowrap" style="text-align: center;">
                                                    Localisation
                                                </th>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $membre = $_SESSION['id'];
                                                $sql = "SELECT *,a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_premiums b ON a.id=b.id_annonce WHERE a.id_membres=".$membre." ORDER BY b.id ASC LIMIT 0, 5";


                                                $result = $conn->query($sql);
                                                        
                                                if ($result->num_rows > 0) {
                                                    echo '<h4 class="panel-title"> Annonces premium : <span class="span-total">'. $result->num_rows .'</span> </h4><br>';
                                                    while($row = $result->fetch_assoc()) {
                                             ?>
                                            <tr class="odd gradeX background-ads-listing-container" style="text-align: center;">
                                                <td width="1%" class="with-img">
                                                   <div class="bloc-listing-picture">
                                                        <img src="<?= "../".$row['an_photo1']  ?>" alt="" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br><?= $row['an_title']  ?></p>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br>
                                                        <span class="price-listing" ><?= $row['an_desc']  ?> </span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                    <br>
                                                    <span class="price-listing" style="color:#FFA500"><?= $row['an_price'] ?> Ar</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                        <br>
                                                        <?= $row['an_address'] ?><br />                     
                                                        <?= $row['an_city'] ?>, <?= $row['an_region'] ?><br />
                                                        
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="title-listing" style="margin-top:40px;">
                                                        <button  onclick='modifierAnnonces($(this))' class="btn btn-primary" title="Modifier"><i class="fa fa-edit"></i>
                                                       </button>
                                                        <button  onclick='supprimerAnnonces($(this))' class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i> Supprimer
                                                            </button>
                                                    </p>
                                                </td>
                                                
                                            </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="tab-annonces-urgentes" style="background: white; padding-left: 50px;padding-right: 50px;padding-bottom: 50px;">
                            <br>
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <table id="data-table-combine" class="table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Image</th>
                                                <th width="15%" class="text-nowrap" style="text-align: center;">
                                                   Status 
                                                </th>
                                                <th width="" class="text-nowrap" style="text-align: center;">Titre</th>
                                                <th width="25%" class="text-nowrap" style="text-align: center;">Description</th>
                                                <th  width="20%" class="text-nowrap" style="text-align: center;">
                                                    Prix
                                                </th>
                                                <th  width="" class="text-nowrap" style="text-align: center;">
                                                    Localisation
                                                </th>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $membre = $_SESSION['id'];

                                                 $sql = "SELECT *,a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_urgentes b ON a.id=b.id_annonce WHERE a.id_membres=".$membre." ORDER BY b.id ASC LIMIT 0, 5";

                                                $result = $conn->query($sql);
                                                        
                                                if ($result->num_rows > 0) {
                                                    echo '<h4 class="panel-title"> Annonces urgentes : <span class="span-total">'. $result->num_rows .'</span> </h4><br>';
                                                    while($row = $result->fetch_assoc()) {
                                             ?>
                                            <tr class="odd gradeX background-ads-listing-container" style="text-align: center;">
                                                <td width="1%" class="with-img">
                                                   <div class="bloc-listing-picture">
                                                        <img src="<?= "../".$row['an_photo1']  ?>" alt="" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="title-listing" style="color: red;"><br>
                                                        <i class="fa fa-exclamation-circle"></i> <b>Urgent</b>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br><?= $row['an_title']  ?></p>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br>
                                                        <span class="price-listing" ><?= $row['an_desc']  ?> </span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                    <br>
                                                    <span class="price-listing" style="color:#FFA500"><?= $row['an_price'] ?> Ar</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                        <br>
                                                        <?= $row['an_address'] ?><br />                     
                                                        <?= $row['an_city'] ?>, <?= $row['an_region'] ?><br />
                                                        
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="title-listing" style="margin-top:40px;">
                                                       <button  onclick='modifierAnnonces($(this))' class="btn btn-primary" title="Modifier"><i class="fa fa-edit"></i>
                                                       </button>
                                                        <button  onclick='supprimerAnnonces($(this))' class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i>
                                                            </button>
                                                    </p>
                                                </td>
                                                
                                            </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                       
                       <div class="tab-pane fade" id="tab-annonces-encadrees" style="background: white; padding-left: 50px;padding-right: 50px;padding-bottom: 50px;">
                            <br>
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <table id="data-table-combine" class="table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Image</th>
                                                <th width="" class="text-nowrap" style="text-align: center;">Titre</th>
                                                <th width="40%" class="text-nowrap" style="text-align: center;">Description</th>
                                                <th  width="20%" class="text-nowrap" style="text-align: center;">
                                                    Prix
                                                </th>
                                                <th  width="" class="text-nowrap" style="text-align: center;">
                                                    Localisation
                                                </th>
                                                <th width="20%" class="text-nowrap" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $membre = $_SESSION['id'];

                                                $sql = "SELECT *,a.id as id, a.an_photo1 as photo1, a.an_title as title, a.an_price as price FROM an_annonces a INNER JOIN an_urgentes b ON a.id=b.id_annonce WHERE a.id_membres=".$membre." ORDER BY b.id ASC LIMIT 0, 5";
                                                
                                                $result = $conn->query($sql);
                                                        
                                                if ($result->num_rows > 0) {
                                                    echo '<h4 class="panel-title"> Annonces encadrées : <span class="span-total">'. $result->num_rows .'</span> </h4><br>';
                                                    while($row = $result->fetch_assoc()) {
                                             ?>
                                            <tr class="odd gradeX background-ads-listing-container" style="text-align: center;">
                                                <td width="1%" class="with-img">
                                                   <div class="bloc-listing-picture">
                                                        <img src="<?= "../".$row['an_photo1']  ?>" alt="" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br><?= $row['an_title']  ?></p>
                                                </td>
                                                <td>
                                                    <p class="title-listing"><br>
                                                        <span class="price-listing" ><?= $row['an_desc']  ?> </span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                    <br>
                                                    <span class="price-listing" style="color:#FFA500"><?= $row['an_price'] ?> Ar</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="localisation-listing">
                                                        <br>
                                                        <?= $row['an_address'] ?><br />                     
                                                        <?= $row['an_city'] ?><br />
                                                        
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="title-listing" style="margin-top:40px;">
                                                       <button  onclick='modifierAnnonces($(this))' class="btn btn-primary" title="Modifier"><i class="fa fa-edit"></i>
                                                       </button>
                                                        <button  onclick='supprimerAnnonces($(this))' class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i>
                                                            </button>
                                                    </p>
                                                </td>
                                                
                                            </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end tab-pane -->
                    </div>
                    <!-- end tab-content -->
                </div>
            </div>
        </div>
    </div>


        
     

<?php 
include("inc/footer.php");

}
 ?>