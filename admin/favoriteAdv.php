<?php
    include "includes/header.php";
    
    include "includes/navbar.php";

    include "includes/sidebar.php";
?>

<?php 

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT *, DATE_FORMAT(an_datenreg, '%d/%m/%Y à %Hh%imin') AS
date_fr FROM an_annonces a INNER JOIN an_favori b ON b.id_annonces=a.id";
	$result = $conn->query($sql);

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Toutes les Annonces Favorites</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Toutes les Annonces Favorites</li>
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
              <h3 class="card-title">Liste de toutes les annonces favorites</h3>
              <div class="card-tools">
              	<a href="addAdv.php" class="btn btn-block bg-gradient-success btn-sm">
              		<i class="fas fa-plus"></i>
              		Nouvelle Annonce
              	</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
	            <table id="example1" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                  <th>Titre</th>
		                  <th>Categorie</th>
		                  <th>Sous categorie</th>
		                  <th>Prix</th>
		                  <th>Region</th>
		                  <th>Ville</th>
		                  <th>Type</th>
		                  <th>Ajouter le</th>
		                  <th></th>
		                </tr>
	                </thead>
	                <tbody>
	                	<?php 

	                		if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<tr>
						                  	<td>".ucfirst($row['an_title'])."</td>";

						            $sql_1 = "SELECT * FROM an_souscat WHERE id=".$row['an_souscat'];
									$result_1 = $conn->query($sql_1);

									if ($result_1->num_rows > 0) {
										$row_1 = $result_1->fetch_assoc();

										$sql_1_ = "SELECT * FROM an_categorie WHERE id=".$row_1['id_cat'];
										$result_1_ = $conn->query($sql_1_);

										if ($result_1_->num_rows > 0) {
											$row_1_ = $result_1_->fetch_assoc();
											echo "<td>".ucfirst($row_1_['label'])."</td>";
										}


										echo "<td>".ucfirst($row_1['label'])."</td>";
									}

						            echo "<td>".$row['an_price']."</td>";

									$sql_ = "SELECT * FROM an_region WHERE id=".$row['an_region'];
									$result_ = $conn->query($sql_);

									if ($result_->num_rows > 0) {
										$row_ = $result_->fetch_assoc();
										echo "<td>".ucfirst($row_['label'])."</td>";
									}

						            echo "<td>".ucfirst($row['an_city'])."</td>
						                  	<td>".strtolower($row['an_type'])."</td>
						                  	<td>".$row['date_fr'].'</td>
						                  	<td class="btn-group btn-group-sm">
		                						<a href="editAdv.php?aid='.$row['id'].'" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        						<a href="scripts/delete-adv.php?aid='.$row['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        					</td>
		                				</tr>';
								}
							} 
							else {
								
							}

							$conn->close();

	                	 ?>
		           	</tbody>
		            <tfoot>
		                <tr>
		                  <th>Titre</th>
		                  <th>Categorie</th>
		                  <th>Sous categorie</th>
		                  <th>Prix</th>
		                  <th>Region</th>
		                  <th>Ville</th>
		                  <th>Type</th>
		                  <th>Ajouter le</th>
		                  <th></th>
		                </tr>
	                </tfoot>
	            </table>
            </div>
            <!-- /.card-body -->
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
