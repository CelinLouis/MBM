<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
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

<body class="hold-transition login-page">
	<a href="../index.php" class="btn btn-info" style="positon: relative;right: 250px;"><i class="fa fa-reply"></i></a>
                                </td>
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Admin</b></a>
    </div>
    <!-- /.login-logo -->

    <?php
    //require '../cnx.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      list($errors, $inputs) = validateForm();
      if ($errors) {
        showForm($errors);
      } else {
        processForm($inputs);
      }
    } else {
      showForm();
    }

    function processForm($input)
    {
      session_start();

      $_SESSION['user'][] = array(
        'id' => $input['id'],
        'first_name' => $input['first_name'],
        'last_name' => $input['last_name']
      );

      header('Location: index.php');
    }

    function showForm($error = "")
    {
      $message = ($error) ? '<b style="color: red;">' . $error . '</b>' : 'Connectez-vous pour commencer votre session';

      echo '
          <div class="card">
            <div class="card-body login-card-body">
              <p class="login-box-msg">' . $message . '</p>
              
              <form action="' . htmlentities($_SERVER['PHP_SELF']) . '" method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="email" placeholder="Email">
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
                <div class="row">
                  <div class="col-7">
                    <div class="icheck-primary">
                      <input type="checkbox" id="remember">
                      <label for="remember">
                        Se souvenir de moi
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <p class="mb-1">
                <a href="forgot-password.php">J\'ai oublie mon mot de passe</a>
              </p>
              <p class="mb-0">
                <a href="register.php" class="text-center">Ajouter un administrateur</a>
              </p>
            </div>
            <!-- /.login-card-body -->
          </div>
        ';
    }

    function validateForm()
    {
      require '../cnx.php';

      $input = array();
      $errors = "";

      $userEmail = strip_tags(trim($_POST['email']));
      $password = $_POST['password'];

      if (empty($_POST['email']) and empty($_POST['password'])) {
        $errors = "Tous les champs sont requis.";
      } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $sql = "SELECT * FROM users WHERE email=?";

          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $userEmail);
          $stmt->execute();

          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
              $input['id'] = $row['id'];
              $input['first_name'] = $row['first_name'];
              $input['last_name'] = $row['last_name'];
            } else {
              $errors = 'Votre mot de passe est incorrect.';
            }
          } else {
            $errors = "Votre adresse email et votre mot de passe n'existent pas.";
          }

          $stmt->close();
          $conn->close();
        } else {
          $errors = 'Vous avez entre une adresse email invalide.';
        }
      }

      return array($errors, $input);
    }
    ?>

  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>

</body>

</html>