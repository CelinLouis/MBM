<?php
    require_once "../../cnx.php";

    if (isset($_POST)) {
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        if ($email == '' OR $password == '') {
            header('Location: ../login.php?err=emptyfields');
        } 
        else {
            if ($email != 'test@test.com') {
                header('Location: ../login.php?err=incorrectmail');
            } 
            else {
                if ($password != 'test') {
                    header('Location: ../login.php?err=incorrectpass&mail='.$email);      
                } 
                else {
                    header('Location: ../index.php');
                }
            }
        }
        
        
        

        /*
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        
        $result = $stmt->execute();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            if (!password_verify($password, $row['password'])) {
                # code...
            } else {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['full_name'];

                header('Location: index.php');
            }
            
        } 
        else {
            echo "0 results";
        }
        
        echo "New records created successfully";
        
        $stmt->close();
        */
    }
?>