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
   $sid =  (isset($_GET['sid'])) ? $_GET['uid'] : 1 ;
   $sectcat = $conn->query("SELECT * FROM an_region WHERE id = ".$uid." ");
   $resreg = $sectcat->fetch_assoc();
	$sql = "SELECT * FROM an_region INNER JOIN an_ville ON an_region.id = an_ville.id_region AND an_ville.id_region = ".$uid." ";
	$result = $conn->query($sql);

 ?>
  
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Ville </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item "><a href="region.php"><?php echo $resreg['label']; ?></a></li>
              <li class="breadcrumb-item active">Ville</li>
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
              <h3 class="card-title"><?php echo $resreg['label']; ?></h3>
              <div class="card-tools">
              	<a href="addville.php?uid=<?php echo $resreg['id']; ?>" class="btn btn-block bg-gradient-success btn-sm">
              		<i class="fas fa-plus"></i>
              		Ajouter Ville
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
						                  	<td>".strtoupper($row['Label'])."</td>";

						            echo '<td class="btn-group btn-group-sm">
		                						<a href="modifville.php?uid='.$row['id_region'].'& sid='.$row['id'].'" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                </td>
                                <td class="btn-group btn-group-sm">
                        						<a href="scripts/delete-ville.php?uid='.$row['id'].'" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
