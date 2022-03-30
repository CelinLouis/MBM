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
            <h1>Categorie</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Categorie</li>
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
              <h3 class="card-title">Categorie</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
               <i class="fas fa-plus"></i> Ajouter Categorie
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
                        <h4 class="modal-title">Ajouter un nouvel catégorie</h4>
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
                              <label for="title">Nom du Categorie</label>
                              <input  type="text" class="form-control" name="title" id="title" placeholder="nom du nouvel categorie" >
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
                          $.post('scripts/send.php', {
                              title: title
                          }, function(donnees) {
                              $('.return').html(donnees).slideDown();
                              $('#title').val('');
                              recupMessages();

                          });
                          return false;
                      });
                                       
                      function recupMessages() {
                          $.post('scripts/recup.php', function(data) {
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
