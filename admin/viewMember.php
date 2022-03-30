<?php
    include "includes/header.php";
    
    include "includes/navbar.php";

    include "includes/sidebar.php";
?>

<?php 

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $uid = (isset($_GET['uid'])) ? $_GET['uid'] : 1 ;
  
  $sql = "SELECT * FROM membres WHERE id=".$uid;
  $result = $conn->query($sql);

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Membre <?php echo $uid; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Detail Membre</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Membre</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <?php 
            if ($result->num_rows > 0) {
              if ($row=$result->fetch_assoc()) {
           ?>
          <div class="row">
            <div class="col-sm-8 table-responsive">
              <table>
                <tr>
                  <th>Entreprise</th>
                  <th></th>
                  <th></th>
                </tr>
                <p>
                  <tr>
                    <td>Nom de l'entreprise </td>
                    <td>:</td>
                    <td> <?= strtoupper($row['comp_name']); ?></td>
                  </tr>
                  <tr>
                    <td>Tel de l'entreprise </td>
                    <td>:</td>
                    <td> <?= $row['comp_num']; ?></td>
                  </tr>
                </p>
                <tr>
                  <th>Personnel</th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <td>Nom </td>
                  <td>:</td>
                  <td> <?= strtoupper($row['name']); ?></td>
                </tr>
                <tr>
                  <td>Prenom </td>
                  <td>:</td>
                  <td> <?= ucfirst(strtolower($row['first_name'])); ?></td>
                </tr>
                <tr>
                  <td>Email </td>
                  <td>:</td>
                  <td> <?= $row['email'];  ?></td>
                </tr>
                <tr>
                  <td>Telephone </td>
                  <td>:</td>
                  <td> <?= $row['phone'];  ?></td>
                </tr>
                <tr>
                  <td>Adresse </td>
                  <td>:</td>
                  <td> <?= $row['address'];  ?></td>
                </tr>
                <tr>
                  <td>Ville </td>
                  <td>:</td>
                  <td> <?= $row['city'];  ?></td>
                </tr>
                <tr>
                  <td>Code postal </td>
                  <td>:</td>
                  <td> <?= $row['post_code'];  ?></td>
                </tr>
                <tr>
                  <td>Region </td>
                  <td>:</td>
                  <?php
                    $sql_ = "SELECT * FROM an_region WHERE id=". $row['region'];
                    $result_ = $conn->query($sql_);
                                  
                    if ($result_->num_rows > 0) {
                      $row_ = $result_->fetch_assoc();
                      echo "<td>". $row_['label'] ."</td>";
                    }
                  ?>
                </tr>
              </table>
            </div>
            <div class="col-sm-4">
              <table>
                <tr>
                  <th>Compte</th>
                  <th></th>
                  <th></th>
                </tr>
                <tr>
                  <td>Pseudo </td>
                  <td>:</td>
                  <td> <?= $row['username']; ?></td>
                </tr>
                <tr>
                  <td>Membre </td>
                  <td>:</td>
                  <td> <?= $row['account_type']; ?></td>
                </tr>
                <tr>
                  <td>Annonce </td>
                  <td>:</td>
                  <?php 
                    $sql = "SELECT * FROM an_annonces WHERE id_membres=".$uid;
                    $result_ = $conn->query($sql);

                    if ($result_->num_rows > 0) {
                      $numAds = $result_->num_rows;
                  ?>
                    <td> 
                      <?= $numAds; ?>
                      (
                      <a href="memberAdvs.php?uid=<?= $uid; ?>">Les voir toutes...</a>
                      )
                    </td>
                  <?php
                    }
                   ?>
                </tr>
              </table>
            </div>
          </div>
          <?php 
              }
            }
           ?>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a href="allMembers.php" class="btn btn-default">Retour</a>
          <div class="float-right">
            <a href="editMember.php?uid=<?= $uid; ?>" class="btn btn-primary">Modifier</a>
            <a href="validateMember.php?uid=<?= $uid; ?>" class="btn btn-success">Valider</a>
            <a href="refuseMember.php?uid=<?= $uid; ?>" class="btn btn-danger">Refuser</a>
          </div>
          
        </div>
      </div>
      <!-- /.card -->

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