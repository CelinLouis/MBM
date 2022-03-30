<?php
    include "includes/header.php";
    
    include "includes/navbar.php";

    include "includes/sidebar.php";
?>
 <?php 
  session_start();
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	 $uid = (isset($_GET['uid'])) ? $_GET['uid'] : 1 ;
   $sectcat = $conn->query("SELECT * FROM an_categorie WHERE id = ".$uid." ");
   $rescat = $sectcat->fetch_assoc();
	$sql = "SELECT * FROM an_categorie INNER JOIN an_souscat ON an_categorie.id = an_souscat.id_cat AND an_souscat.id_cat = ".$uid." ";
	$result = $conn->query($sql);

 ?>
  
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sous-categorie</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item "><a href="categorie.php"><?php echo $rescat['label']; ?></a></li>
              <li class="breadcrumb-item active">Sous-categrie</li>
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
              <h3 class="card-title"><?php echo $rescat['label']; ?></h3>
              <div class="card-tools">
              	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
               <i class="fas fa-plus"></i> Ajouter Sous-categorie
              </button>
              </div>
            </div>
            <!-- /.card-header -->
            
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                   <!-- form start -->
                    <form  method="post" id="formulaire">

                      <div class="modal-header">
                        <h4 class="modal-title">Ajouter un nouvel sous-categorie</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                      </div>
                  <div class="modal-body">
                      <div class="return"></div>
                      <div class="card-body">
                        <div class="row">
                          <!-- right column -->
                          <div class="col-md-8">
                            <div class="form-group">
                              <label for="title">Nom du sous-categorie</label>
                              <input  type="text" class="form-control" name="title" id="title" placeholder="nom du nouvel categorie" >
                              <input type="hidden" name="cat" id="cat" value="<?php echo $uid; ?>">
                            </div>

                          
                          </div>
                          <!-- ./left column -->
                        </div>
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                  </div>

                   <!-- /.card-footer -->
                    </form>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <script src="js/jquery.min.js"></script>
            <script type="text/javascript">
                  $(document).ready(function() {
                      recupMessages();
                      $('#formulaire').submit(function() {

                          var title = $('#title').val();
                          var cat = $('#cat').val();
                          $.post('scripts/sends.php', {
                              title: title,
                              cat: cat
                          }, function(donnees) {
                              $('.return').html(donnees).slideDown();
                              $('#title').val('');
                              recupMessages();

                          });
                          return false;
                      });
                                       
                      function recupMessages() {
                        var cat = $('#cat').val();
                          $.post('scripts/recups.php?id='+cat, function(data) {
                              $('#valiny').html(data);
                          });
                      }

                      setInterval(recupMessages, 1000);
                  });
                  </script>
            

             
          
            <div class="card-body" id="valiny">
	            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </section>

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
