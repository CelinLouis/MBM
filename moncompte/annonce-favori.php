<?php

  require('inc/header.php');
  if (!isset($_SESSION['id'])) {
    header("location: ../connexion.php");
  }
  else{
    $req=$conn->query("SELECT *,an_region.label as lblregion,an_annonces.an_price as price, an_annonces.id as an_id, an_region.label as lblregion ,an_categorie.label as lblcat, an_souscat.label as lblscat FROM an_favori INNER JOIN an_annonces ON(an_annonces.id = an_favori.id_annonces) INNER JOIN an_souscat on(an_souscat.id = an_annonces.an_souscat)  INNER JOIN an_categorie on (an_categorie.id = an_souscat.id_cat) INNER JOIN an_region on (an_annonces.an_region = an_region.id) WHERE an_favori.id_membres = '".$_SESSION['id']."' ORDER BY fav_datenreg DESC ");


?>
<title><?php echo strtoupper($_SESSION['f_name'])." ".strtoupper($_SESSION['name']); ?></title>
<style media="screen">
.icon-delete
{
	display: block;
	position: absolute;
	right: 0;
	background: url("../images/icons/delete.png") no-repeat center top;
	background-size: 25px 25px;
  color: red;
	width: 50px;
	height: 50px;
	margin: 15px 18px;
}
</style>
<div class="container-100 header-end"></div>
<div class="container-100">
  <?php if ($req->num_rows<=0): ?>
    <div id="annonce_vide" class="container-100-child index-container" style="height: 400px;">
      <div class="search-form" method="get" action="search.php">
          <div class="container-100">
              <div class="container-100-child">
                <div>
                  <h3>
                      Vous n‘avez pas encore d‘annonce sauvegardée
                  </h3>
                </div>
                <img src="../image/favoris.png" alt="" style="width:100%;height:40%;">
              </div>
            </div>

        </div>
    </div>

  <?php else: ?>
    <div class="container-100-child search-results-container margin-top  margin-bottom">
      <div class="listing-infos">
        <h1>Vos annonces favoris </h1>
        <p>Toutes les annonces favoris : <span id="nbr_annonces"><?php echo $req->num_rows; ?></span>  </p>
      </div>

      <div class="search-results-listing flex-container">
        <div>
          <!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG Script PAG all rights reserved. Use under license. http://www.script-pag.com -->

      <?php 
        while($res = $req->fetch_assoc())
        { 
      ?>
      <div class="background-ads-listing-container"  >
        <a id="<?php echo $res['an_id'] ?>" style="cursor: pointer;" class="icon-delete" onclick="del_fav($(this));"></a>
        <a style="text-decoration:none" href="../annonce-detail.php?an=<?php echo $res['an_id'] ?>"  class="background-ads-listing  flex-container" title="">
          <div class="bloc-listing-first">
            <p class="title-listing"><?php echo $res['an_title'] ?></p>
            <div class="flex-container">
              <p class="localisation-listing">
                <?php echo $res['lblregion'].' / '.ucfirst(strtolower($res['an_city'])).'<br>
								'.ucfirst(strtolower($res['an_address'])); ?>
                <br><span class="price-listing" style="color:#FFA500"><?php echo $res['an_price'] ?> <b>Ariary</b> </span>
              </p>
              <div class="category-listing">
                <p>
                  <?php echo $res['an_type'].' / '.$res['lblscat'] ?>
                </p>
              </div>
            </div>
          </div>
          <div class="bloc-listing-picture">
            <img src="../<?php echo $res['an_photo1'] ?>" alt="">				</div>
          <div class="bloc-listing-last">
            <p>
              Déposée le <?php echo $res['an_datenreg'] ?> <!--br><br><strong>3</strong> Photos	-->
            </p>
          </div>
        </a>
      </div>
      <?php } ?>
          <!--div class="listing-pagination ">
              <span class="not-selected">&lt;</span><a href="ads_advertisercb18.html?id_ad=7&amp;page=1" class="selected-link">1</a><span class="not-selected">&gt;</span>
          </div-->
        </div>

      </div>
    </div>
  <?php endif; ?>


</div>
<?php
  require('inc/footer.php');
?>
<script type="text/javascript">
  function del_fav(fav){
   
    $.post('../ajax/del_fav.php',
    {
      id_annonce:fav.attr("id")
    },
    function(data)
    {
      fav.parents('.background-ads-listing-container').fadeOut(2000).remove();
      
      if(data == 0){
        window.location.reload();
      }
      else{
        $('#nbr_annonces').text(data);
      }
    },
  'text');
  }
</script>
<?php } ?>
