<?php
include "includes/header.php";

include "includes/navbar.php";

include "includes/sidebar.php";
?>
<?php
$sql = "SELECT * FROM an_categorie ";
$result = $conn->query($sql);

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
                    <a href="addCategory.php" class="btn btn-block bg-gradient-success btn-sm">
                        <i class="fas fa-plus"></i>
                        Ajouter Categorie
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
						                  	<td>" . ucfirst($row['id']) . "</td>
						                  	<td>" . strtoupper($row['label']) . "</td>";

                                echo '<td class="btn-group btn-group-sm">
		                						<a href="editCat.php?cid=' . $row['id'] . '" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                <a href="scripts/delete-category.php?cid=' . $row['id'] . '" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                <a href="subcategory.php?cid=' . $row['id'] . '" class="btn btn-info"><i class="fas fa-arrow-circle-right"></i></a>
                        					</td>
		                				</tr>';
                            }
                        } else {
                        }

                        $conn->close();

                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Titre</th>
                            <th></th>
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