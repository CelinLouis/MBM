<?php
require '../cnx.php';
session_start();
$errors_login = [];
$errors_register = [];

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['mdp']);


    $query ='SELECT * FROM membres WHERE email=? LIMIT 1';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        if ($stmt->execute())
        {

            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password']) )
            {
                echo "success";

                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['f_name'] = $user['first_name'];
                $_SESSION['email'] = $user['email'];
                exit(0);
            }
            else
            {
              echo "error1";
              //array_push($errors_login, "Non d'utilisateur ou mot de passe incorrect");
            }
        }
        else
        {
          echo "error2";

        }

}

if (isset($_POST['inscriptionS'])) {
    $civility = $_POST['civility'];
    $name = trim(ucfirst(strtolower($_POST['name'])));
    $first_name = trim(strtoupper($_POST['first_name']));
    $region = $_POST['region'];
    $address = htmlspecialchars($_POST['address']);
    $post_code = htmlspecialchars($_POST['post_code']);
    $city = htmlspecialchars($_POST['city']);
    $phone = $_POST['phone'];
    $email = trim(htmlspecialchars($_POST['email']));
    $password = password_hash($_POST['mdp'], PASSWORD_DEFAULT); //encrypt password
    $gtc = $_POST['gtc'];
    $account_type="MEMBRE";


    // Check if email already exists
    $sql = "SELECT * FROM membres WHERE email='$email'  LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        array_push($errors_register, "L'email est déjà utilisé");
    }

    $sql = "SELECT * FROM membres WHERE phone='$phone'  LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        array_push($errors_register, "Le numéro téléphone est déjà utilisé");
    }

    if (count($errors_register) === 0) {
        $result = [];

        $query = "INSERT INTO membres SET account_type=?, username=?,  civility=?, name =?,
        first_name=? , email=?, region=?, address=?, post_code=?, city=?, phone=?, term_cond=?, password=?";
        $stmt = $conn->prepare($query);

        $stmt->bind_param('sssssssssssss', $account_type, $email, $civility, $name, $first_name, $email, $region, $address, $post_code,$city,$phone, $gtc, $password);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id;
            array_push($result, "success");
        }
        else
        {
            array_push($result, "Erreur de base de données: impossible d'enregistrer l'utilisateur");
        }
        echo json_encode($result);
    }
    else
    {
        echo json_encode($errors_register);
    }

}

if (isset($_POST['postRegisterP'])) {
    $civility = $_POST['civility'];
    $name = htmlspecialchars($_POST['name']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $reg = $_POST['reg'];
    $address = htmlspecialchars($_POST['address']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $city = htmlspecialchars($_POST['city']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $pas = htmlspecialchars($_POST['pas']);
    $pas2 = htmlspecialchars($_POST['pas2']);
    $gtc = $_POST['gtc'];

    /*if (empty($name)) {
        $errors_register['lastname'] = 'Veuillez saisir votre nom';
    }

    if (empty($civility) {
        $errors_register['firstname'] = 'Veuillez saisir votre prénom';
    }*/

    /*if (empty($first_name) {
        $errors_register['email'] = 'Veuillez saisir votre nom d\'utilisateur';
    }
    if (empty($first_name) {
        $errors_register['email'] = 'Veuillez saisir votre nom d\'utilisateur';
    }
    if (empty($first_name) {
        $errors_register['email'] = 'Veuillez saisir votre nom d\'utilisateur';
    }
    if (empty($first_name) {
        $errors_register['email'] = 'Veuillez saisir votre nom d\'utilisateur';
    }
    if (empty($_POST['email'])) {
        $errors_register['email'] = 'Veuillez saisir votre email';
    }
    if (empty($_POST['password'])) {
        $errors_register['password'] = 'Veuillez saisir votre mot de passe';
    }
    if (isset($_POST['password']) && $_POST['password'] !== $_POST['passwordConf']) {
        $errors_register['passwordConf'] = 'Les deux mots de passe ne correspondent pas';
    }*/



    $lat = trim($_POST['lat']);
    $lng = trim($_POST['lng']);

    $user_type_id = 2;
    $email = trim($_POST['email']);
    $email = trim($_POST['email']);
    $firstname = trim(ucfirst(strtolower($_POST['firstname'])));
    $lastname = trim(strtoupper($_POST['lastname']));
    $token = bin2hex(random_bytes(50)); // generate unique token
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

    // Check if email already exists
    $sql = "SELECT * FROM user_account WHERE email='$email'   LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $errors_register['email'] = "Le nom d'utilisateur existe déjà";
    }

    $sql2 = "SELECT * FROM user_account WHERE email='$email'  LIMIT 1";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        $errors_register['email'] = "L'email existe déjà";
    }

    if (count($errors_register) === 0) {
        $query = "INSERT INTO user_account SET email=?, email=?, token=?, password=?, firstname =?, lastname=? , user_type_id =?, lat =?,
lng =? ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssssss', $email, $email, $token, $password, $firstname, $lastname, $user_type_id, $lat, $lng);
        $result = $stmt->execute();

        if ($result) {
            $user_id = $stmt->insert_id;
            $stmt->close();

            // TO DO: send verification email to user
            // sendVerificationEmail($email, $token);

            //$the_path = 'candidat/dossier';
            //$the_mode = $user_id."_".$lastname."_".$firstname;
            //mkdir($the_path,$the_mode, true);


            $_SESSION['id'] = $user_id;
            $_SESSION['email'] = $email;
            $_SESSION['lastname'] = $firstname;
            $_SESSION['firstname'] = $lastname;
            $_SESSION['email'] = $email;
            $_SESSION['verified'] = false;

            $_SESSION['message'] = 'Vous êtes authentifié';
            $_SESSION['type'] = 'alert-success';
            header('location: candidat/');
        } else {
            $_SESSION['error_msg'] = "Erreur de base de données: impossible d'enregistrer l'utilisateur";
        }
    }
}
?>
