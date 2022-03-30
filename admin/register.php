<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="font/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Admin</b></a>
  </div>

  <?php
  //require "../cnx.php";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = validateForm();
    if ($errors) {
      showForm($errors);
    } else {
      processForm();
    }
  } else {
    showForm();
  }
  
  function processForm() {
    //echo 'process form';
    header('Location: login.php?register=success');
  }

  function showForm($error = "") {
    $message = ($error) ? '<b style="color: red;">' .$error. '</b>' : 'Ajouter un administrateur';

    echo '
      <div class="card">
        <div class="card-body register-card-body">
          <p class="login-box-msg">' .$message. '</p>

          <form action="' .htmlentities($_SERVER['PHP_SELF']). '" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="first_name" placeholder="Prenom">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="last_name" placeholder="Nom">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="email" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Mot de passe">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="re_password" placeholder="Confirmez votre mot de passe">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="agree" name="autolog" value="YES">
                  <label for="agree">
                  Me connecter apres l\'inscription
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Inscrire</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <a href="login.php" class="text-center">Je veux me connecter</a>
        </div>
        <!-- /.form-box -->
      </div><!-- /.card -->
    ';
  }

  function validateForm() {
    require '../cnx.php';

    $error = "";

    $userFirstName = ucfirst(strtolower(strip_tags(trim($_POST['first_name']))));
    $userLastName = strtoupper(strip_tags(trim($_POST['last_name'])));
    $userEmail = strip_tags(trim($_POST['email']));
    $userPassword = $_POST['password'];
    $confirmPassword = $_POST['re_password'];
    //$autoLog = strip_tags($_POST['autolog']);

    if (empty($_POST['first_name']) AND empty($_POST['last_name']) AND empty($_POST['email']) AND empty($_POST['password']) AND empty($_POST['re_password'])) {
      $error = "Tous les champs sont requis.";
    } else {
      if (!preg_match('/[a-zA-Z]*/', $userFirstName) OR !preg_match('/[a-zA-Z]*/', $userLastName)) {
        $error = "Seules les lettres sont autorisees";
      } else {
        if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
          $error = "Vous avez entre une adresse email invalide.";
        } else {
          if ($userPassword != $confirmPassword) {
            $error = "Vos mots de passe ne se correspondent pas.";
          } else {
            $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users(first_name, last_name, email, password) VALUES(?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $userFirstName, $userLastName, $userEmail, $hashedPassword);
            $stmt->execute();

            $stmt->close();
            $conn->close();
            
            //$error = 'validate form';
          }
        }
      }
    }

    return $error;
  }
  ?>
  
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>
