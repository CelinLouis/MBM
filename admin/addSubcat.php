<?php
include "includes/header.php";

include "includes/navbar.php";

include "includes/sidebar.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ajout d'un Categorie</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href=""></a></li>
                        <li class="breadcrumb-item active">Ajout d'un Sous-categorie</li>
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
                                            <input type="text" class="form-control" name="title" id="title" placeholder="nom du nouvel categorie" value="<?php
                                                                                                                                                            if (isset($_GET['sid'])) {
                                                                                                                                                                $select_sous =  $conn->query("SELECT * FROM an_souscat WHERE id = '" . $_GET['sid'] . "' ");
                                                                                                                                                                $ressout = $select_sous->fetch_assoc();
                                                                                                                                                                echo $ressout['label'];
                                                                                                                                                            }
                                                                                                                                                            ?>">
                                            <input type="hidden" name="cat" value="">
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

        $sql = "UPDATE `an_souscat` SET `label` = '" . $title . "' WHERE `an_souscat`.`id` = '" . $_GET['sid'] . "' ";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} else {

    if (isset($_POST['submit'])) {

        $title = $_POST['title'];
        $cat = $_POST['cat'];

        $sql = "INSERT INTO `an_souscat` (`id`, `id_cat`, `label`) VALUES ('', '" . $cat . "', '" . $title . "') ";

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