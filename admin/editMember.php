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
            <h1>Modification Membre <?php echo $uid; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Modification Membre</li>
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
                <h3 class="card-title">Information Generale</h3>
              </div>
              <!-- /.card-header -->
              <?php 

                      if ($result->num_rows > 0) {
                        if ($row = $result->fetch_assoc()) {
              ?>

              <!-- form start -->
              <form action="scripts/update-member.php" method="post">
                <div class="card-body">
                  <div class="row">
                    <!-- right column -->
                    <div class="col-md-5">
                      <h4>Compte</h4>
                      <input type="hidden" name="id" value="<?= $row['id']; ?>">
                      <div class="form-group">
                        <label for="username">Pseudo</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Pseudo" value="<?= $row['username']; ?>">
                      </div>

                      <label for="inputEmail3">Type du compte</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <!-- radio -->
                          <div class="form-group">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="radio1" value="MEMBRE" <?= ($row['account_type'] == 'MEMBRE') ? 'checked' : '' ?> >
                              <label class="form-check-label">Particuliere</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <!-- radio -->
                          <div class="form-group">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="radio1" value="PRO" <?= ($row['account_type'] == 'PRO') ? 'checked' : '' ?>>
                              <label class="form-check-label">Professionnelle</label>
                            </div>
                          </div>
                        </div>    
                      </div>

                      <h4>Personnel</h4>
                      <div class="form-group">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nom" value="<?= $row['name']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="first_name">Prenom</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Prenom" value="<?= $row['first_name']; ?>">
                      </div>

                      <h4>Entreprise</h4>
                      <div class="form-group">
                        <label for="comp_name">Nom de l'entreprise</label>
                        <input type="text" class="form-control" name="comp_name" id="comp_name" placeholder="Nom de l'entreprise" value="<?= $row['comp_name']; ?>">
                      </div>
                      <div class="form-group">
                        <label for="comp_num">Telephone de l'entreprise</label>
                        <input type="text" class="form-control" name="comp_num" id="comp_num" placeholder="Tel. de l'entreprise" value="<?= $row['comp_num']; ?>">
                      </div>
                    </div>
                    <!-- ./right column -->

                    <div class="col-md-2"></div>

                    <!-- left column -->
                    <div class="col-md-5">
                      <h4>Contact</h4>
                      <div class="form-group row">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?= $row['email']; ?>" disabled>
                      </div>
                      <div class="form-group row">
                        <label for="phone">Telephone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Telephone" value="<?= $row['phone']; ?>">
                      </div>

                      <h4>Localisation</h4>
                      <div class="form-group row">
                        <div class="col-sm-7">
                          <!-- select -->
                          <div class="form-group">
                            <?php
                                $sql_ = "SELECT * FROM an_region";
                                $result_ = $conn->query($sql_);
                                
                            ?>
                            <label>Region</label>
                            <select class="form-control" name="region">
                              <?php
                                  if ($result_->num_rows > 0) {
                                    while($row_ = $result_->fetch_assoc()) {
                                      $isSelected = ($row_['id'] === $row['region']) ? 'selected="selected"' : '';
                                      echo '<option value="'.$row_['id'].'" '.$isSelected.'>'.ucfirst($row_['label'])."</option>";
                                    }
                                  }
                              ?>
                            </select>
                          </div>
                          <!-- ./select -->
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="city">Ville</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="Ville" value="<?= $row['city']; ?>">
                      </div>
                      <div class="form-group row">
                        <label for="post_code">Code Postal</label>
                        <input type="text" class="form-control" name="post_code" id="post_code" placeholder="Code Postal" value="<?= $row['post_code']; ?>">
                      </div>
                      <div class="form-group row">
                        <label for="address">Adresse</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Adresse" value="<?= $row['address']; ?>">
                      </div>
                    </div>
                    <!-- ./left column -->
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="allMembers.php" class="btn btn-default">Annuler</a>
                  <button type="submit" class="btn btn-success float-right">Enregistrer</button>
                </div>
                <!-- /.card-footer -->
              </form>

              <?php
                      }
                  }
              ?>

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