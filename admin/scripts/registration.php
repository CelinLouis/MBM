<?php
    require_once "cnx.php";

    if (isset($_POST)) {
        $fullName = htmlspecialchars(trim($_POST['full_name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));
        $re_password = htmlspecialchars(trim($_POST['re_password']));
        $terms = htmlspecialchars(trim($_POST['terms']));

        if (empty($fullName) AND empty($email) AND empty($password) AND empty($re_password)) {
            //echo "Fields should not be empty";

            header('Location: register.php?err=fields-empty');
        } else {
            if (!preg_match('%[a-zA-Z]+$%', $fullName)) {
                //echo "Invalid Full name";

                header('Location: register.php?err=invalid-full_name');
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    //echo "Invalid email";

                    header('Location: register.php?err=invalid-email');
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    if (!password_verify($re_password, $password)) {
                        //echo "Passwords are not the same";

                        header('Location: register.php?err=not-same-password');
                    } else {
                        // prepare and bind
                        $stmt = $conn->prepare("INSERT INTO user (full_name, email, password, terms) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("ssss", $fullName, $email, $password, $terms);
                        
                        // execute
                        $stmt->execute();
                        

                        echo "New records created successfully";
                        
                        $stmt->close();

                        header('Location: login.php?register=success');
                    } 
                }
            }   
        }

    }
?>