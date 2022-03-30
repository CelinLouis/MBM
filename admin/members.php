<?php
    include "includes/header.php";
    
    include "includes/navbar.php";

    include "includes/sidebar.php";
?>

<?php 

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM Membres WHERE account_type='particulier'";
	$result = $conn->query($sql);

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Membres</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Membres</li>
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
              <h3 class="card-title">Membres Particuliers</h3>
              <div class="card-tools">
              	<a href="addMember.php" class="btn btn-block bg-gradient-success btn-sm">
              		<i class="fas fa-plus"></i>
              		Nouveau Membre
              	</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
	            <table id="example1" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                  <th>Pseudo</th>
		                  <th>Nom</th>
		                  <th>Prenom</th>
		                  <th>Region</th>
		                  <th>Ville</th>
		                  <th>Civilite</th>
		                  <td>Etat</td>
		                  <th></th>
		                </tr>
	                </thead>
	                <tbody>
		                <?php 

	                		if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<tr>
						                  	<td>".ucfirst($row['username'])."</td>
						                  	<td>".strtoupper($row['name'])."</td>
						                  	<td>".ucfirst($row['first_name'])."</td>";

									$sql_ = "SELECT * FROM an_region WHERE id=".$row['region'];
									$result_ = $conn->query($sql_);

									if ($result_->num_rows > 0) {
										$row_ = $result_->fetch_assoc();
										echo "<td>".ucfirst($row_['label'])."</td>";
									}

						            echo "<td>".ucfirst($row['city'])."</td>
						                  	<td>".$row['civility'].'</td>
						                  	<td>'.$row['status'].'</td>
						                  	<td class="btn-group btn-group-sm">
		                						<a href="viewMember.php?uid='.$row['id'].'" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        						<a href="scripts/delete-member.php?uid='.$row['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
		                  <th>Pseudo</th>
		                  <th>Nom</th>
		                  <th>Prenom</th>
		                  <th>Region</th>
		                  <th>Ville</th>
		                  <th>Civilite</th>
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
