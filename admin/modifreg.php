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
            <h1>Modifier du Region</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="region.php">Region</a></li>
              <li class="breadcrumb-item active">Modifier d'une Region</li>
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
                <h3 class="card-title"></h3>
              </div>
              
              <!-- /.card-header -->

              <!-- form start -->
              <form  method="post" id="formulaire">
                <div class="card-body">
                  <div class="row">
                    <p class="return"></p>
                    <!-- right column -->
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="title">Titre</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="nom du nouvel Region" value="<?php 
                        if(isset($_GET['uid'])){
                          $select_sous =  $conn->query("SELECT * FROM an_REGION WHERE id = '".$_GET['uid']."' ");
                          $ressout = $select_sous->fetch_assoc();
                            echo $ressout['label']; 
                        } 
                       
                        ?>">
                      </div>

                    
                    </div>
                    <!-- ./left column -->
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right" name="submit">Modificateur  <?php      
        
?></button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <section class="content">
            <div class="card" id="valiny">
            </div>
           </section>
            <!-- /.card -->
            <script src="js/jquery.min.js"></script>
            
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
  if (isset($_GET['uid'])) {

          if (isset($_POST['submit'])) {

          $title = $_POST['title'];
              
          $sql = "UPDATE `an_region` SET `label` = '".$title."' WHERE `an_region`.`id` = '".$_GET['uid']."' ";

          if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }

  }else{
        if (isset($_POST['submit'])) {

          $title = $_POST['title'];
              
          $sql = "INSERT INTO `an_region` (`id`, `label`) VALUES ('', '".$title."') ";

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
         
    //header('Location: region.php ');

?>