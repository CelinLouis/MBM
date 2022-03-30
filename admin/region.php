<?php
    include "includes/header.php";
    
    include "includes/navbar.php";

    include "includes/sidebar.php";
?>
 <?php 

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT * FROM an_region ";
	$result = $conn->query($sql);

 ?>
  
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Region</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Region</li>
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
              <h3 class="card-title">Region</h3>
              <div class="card-tools">
              	<a href="addReg.php" class="btn btn-block bg-gradient-success btn-sm">
              		<i class="fas fa-plus"></i>
              		Ajouter Region
              	</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
	            <table id="example1" class="table table-bordered table-striped">
	                <thead>
		                <tr>
		                  <th>Id</th>
		                  <th>Nom</th>
		                  
		                </tr>
	                </thead>
	                <tbody>
		                <?php 

	                		if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<tr>
						                  	<td>".ucfirst($row['id'])."</td>
						                  	<td>".strtoupper($row['label'])."</td>";
  //https://fontawesome.com/v4.7.0/icons/
												echo '<td class="btn-group btn-group-sm">
                                <a href="modifreg.php?uid='.$row['id'].'" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                </td>
                                
                                <td class="btn-group btn-group-sm">
                        						<a href="scripts/delete-region.php?uid='.$row['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        					</td>

                                  <td class="btn-group btn-group-sm">
                                <a href="ville.php?uid='.$row['id'].'" class="btn btn-info"><i class="fa fa-arrow-circle-right"></i></a>
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
		                  <th>Id</th>
		                  <th>Nom</th>
		                  
		                </tr>
	                </tfoot>
	            </table>
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
