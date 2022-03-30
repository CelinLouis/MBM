<?php
    include "includes/header.php";
    
    include "includes/navbar.php";

    include "includes/sidebar.php";
?>

<?php 

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $aid = (isset($_GET['aid'])) ? $_GET['aid'] : 1 ;
  
  $sql = "SELECT * FROM an_annonces WHERE id=".$aid;
  $result = $conn->query($sql);

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Annonce</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Detail Annonce</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php 

      if ($result) {
      
      if ($result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?= $row['an_title']; ?></h3>
              <div class="col-12">
                <img src="../<?= $row['an_photo1']; ?>" class="product-image" alt="Product Image">
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb active"><img src="../<?= $row['an_photo1']; ?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../<?= $row['an_photo2']; ?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../<?= $row['an_photo3']; ?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../<?= $row['an_photo4']; ?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../<?= $row['an_photo5']; ?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../<?= $row['an_photo6']; ?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../<?= $row['an_photo7']; ?>" alt="Product Image"></div>
                <div class="product-image-thumb" ><img src="../<?= $row['an_photo8']; ?>" alt="Product Image"></div>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3"><?= $row['an_title']; ?></h3>
              <p style="color:red;"><?= ($row['an_payment'] == 'non payee') ? strtoupper($row['an_payment']) : ''; ?></p>

              <hr>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  <?= $row['an_price']; ?> Ariary
                </h2>
              </div>

              <?php 
              if ($row['an_payment'] == 'non payee') {
               ?>
              <div class="mt-4">
                <a class="btn btn-warning btn-lg btn-flat" href="payment.php?aid=<?= $aid; ?>"> 
                  Payer
                </a>
              </div>
              <?php 
              } else {
                echo '';
              }
               ?>
            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?= $row['an_desc']; ?> </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a href="allAdvs.php" class="btn btn-default">Retour</a>
          <div class="float-right">
            <a href="editAdv.php?aid=<?= $aid; ?>" class="btn btn-primary">Modifier</a>
            <a href="validateAdv.php?aid=<?= $aid; ?>" class="btn btn-success">Valider</a>
            <a href="refuseAdv.php?aid=<?= $aid; ?>" class="btn btn-danger">Refuser</a>
          </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

    <?php
    }
        }
      }
    ?>

  </div>
  <!-- /.content-wrapper -->
  <?php
      include "includes/footer.php";
  ?>