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
  
   $sectcat = $conn->query("SELECT * FROM an_region WHERE id = ".$uid." ");
   $rescat = $sectcat->fetch_assoc();
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter une Ville</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="ville.php?uid=<?php echo $rescat['id']; ?>"><?php echo $rescat['label']; ?></a></li>
              <li class="breadcrumb-item active">Ajouter une ville</li>
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

              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
                  <div class="row">
                    <!-- right column -->
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="nom du nouvelle ville" value="<?php 
                        if(isset($_GET['sid'])){
                          $select_sous =  $conn->query("SELECT * FROM an_ville WHERE id = '".$_GET['sid']."' ");
                          $ressout = $select_sous->fetch_assoc();
                            echo $ressout['Label']; 
                        } 
                        ?>">
                        <input type="hidden" name="cat" value="<?php echo $uid; ?>">
                      </div>

                    
                    </div>
                    <!-- ./left column -->
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right" name="submit">Ajouter</button>
                </div>
                <!-- /.card-footer -->
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
  if (isset($_GET['sid'])) {

          if (isset($_POST['submit'])) {

          $title = $_POST['title'];
              
          $sql = "UPDATE `an_ville` SET `Label` = '".$title."' WHERE `an_ville`.`id` = '".$_GET['sid']."' ";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }

  }else{

        if (isset($_POST['submit'])) {
          $title = $_POST['title'];
          $cat = $_POST['cat'];
      
         
            
        $sql = "INSERT INTO `an_ville` (`id`, `Label`, `id_region`) VALUES ('', '".$title."', '".$cat."') ";

        if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }

  }
  

  $conn->close();
?>

<?php
    include "includes/footer.php";
?>