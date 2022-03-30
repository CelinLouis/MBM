<?php
    //try {
        $bdd = new PDO('mysql:host=127.0.0.1;dbname=eshop', 'root', '');
    /*}
    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }*/

    $comp_name = htmlspecialchars($_POST['comp_name']);
    $comp_num = htmlspecialchars($_POST['comp_num']);
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

    if (empty($comp_name) || empty($comp_num) || empty($name) || empty($first_name) || empty($address) || empty($postcode) || empty($city) || empty($phone) || empty($email) || empty($pas) || empty($pas2)) {
        header("Location: inscription1.php?error=emptyfields&c_name=".$comp_name."&c_num=".$comp_num."&name=".$name."&f_name=".$first_name."&addr=".$address."&pc=".$postcode."&city=".$city."&tel=".$phone."&mail=".$email);
        exit();
    }
    else {
        $paslen = strlen($pas);
        $reqmail = $bdd->prepare("SELECT id FROM members WHERE email=?");
        $reqmail->execute();
        $mailexist = $reqmail->rowCount();

        if (!preg_match("/^[0-9]*$/", $postcode)) {
            header("Location: inscription1.php?error=invalidpostcode&c_name=".$comp_name."&c_num=".$comp_num."&name=".$name."&f_name=".$first_name."&addr=".$address."&city=".$city."&tel=".$phone."&mail=".$email);
            exit();
        }
        else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: inscription1.php?error=invalidmail&c_name=".$comp_name."&c_num=".$comp_num."&name=".$name."&f_name=".$first_name."&addr=".$address."&pc=".$postcode."&city=".$city."&tel=".$phone);
                exit();
            }
            else {
                if ($mailexist !== 0) {
                    header("Location: inscription1.php?error=existingmail&name=".$name."&f_name=".$first_name."&addr=".$address."&pc=".$postcode."&city=".$city."&tel=".$phone);
                    exit();
                }
                else {
                    if ($paslen < 8) {
                        header("Location: inscription1.php?error=passwordlen&c_name=".$comp_name."&c_num=".$comp_num."&name=".$name."&f_name=".$first_name."&addr=".$address."&pc=".$postcode."&city=".$city."&tel=".$phone."&mail=".$email);
                        exit();
                    }
                    else {
                        if ($pas !== $pas2) {
                            header("Location: inscription1.php?error=passwordcheck&c_name=".$comp_name."&c_num=".$comp_num."&name=".$name."&f_name=".$first_name."&addr=".$address."&pc=".$postcode."&city=".$city."&tel=".$phone."&mail=".$email);
                            exit();
                        }
                        else {
                            $pas = password_hash($pas, PASSWORD_DEFAULT);
                
                            $req = $bdd->prepare("INSERT INTO members (civility, name, first_name, region, address, postcode, city, phone, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                            $req->execute(array($civility, $name, $first_name, $reg, $address, $postcode, $city, $phone, $email, $pas));
                
                            header("Location: inscription1.php?success=true");
                            exit();
                        }
                    }
                }
            }
        }
    }
?>
