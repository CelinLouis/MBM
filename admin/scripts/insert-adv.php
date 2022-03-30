<?php 
require_once "../../cnx.php";

if (isset($_POST['submit'])) {
	$title = ucfirst(strtolower(trim(htmlspecialchars($_POST['title']))));
	$descr = ucfirst(trim(htmlspecialchars($_POST['descr'])));
	$price = trim(htmlspecialchars($_POST['price']));
	$type = strtolower(trim(htmlspecialchars($_POST['type'])));
	$category = trim(htmlspecialchars($_POST['category']));
	$region = trim(htmlspecialchars($_POST['region']));
	$city = ucfirst(strtolower(trim(htmlspecialchars($_POST['city']))));
	$postCode = trim(htmlspecialchars($_POST['code']));
	$address = trim(htmlspecialchars($_POST['address']));

	$id_membres = '0';
    $an_souscat =$_POST["category"];
    $an_marquev =$_POST["an_marquev"];
    $an_anneev =$_POST["an_anneev"];
    $an_kmeterv =$_POST["an_kmeterv"];
    $an_energyv =$_POST["an_energyv"];
    $an_vitessev =$_POST["an_vitessev"];
    $an_kmeterm =$_POST["an_kmeterm"];
    $an_anneem =$_POST["an_anneem"];
    $an_cylinder = $_POST["an_cylinder"];

    $an_kmeterc = $_POST["an_kmeterc"];
    $an_anneec = $_POST["an_anneec"];
    $an_energyc = $_POST["an_energyc"];
    $an_vitessec = $_POST["an_vitessec"];
    $an_surfacevm = $_POST["an_surfacevm"];
    $an_piecevm = $_POST["an_piecevm"];
    $an_capacityvm = $_POST["an_capacityvm"];
    $an_surfacelm = $_POST["an_surfacelm"];
    $an_piecelm = $_POST["an_piecelm"];
    $an_capacitylm = $_POST["an_capacitylm"];

    $an_surfacet = $_POST["an_surfacet"];
    $an_surfacecl = $_POST["an_surfacecl"];
    $an_piececl = $_POST["an_piececl"];
    $an_capacitycl = $_POST["an_capacitycl"];
    $an_debutlv = $_POST["an_debutlv"];
    $an_finlv = $_POST["an_finlv"];
    $an_surfacelv = $_POST["an_surfacelv"];
    $an_piecelv = $_POST["an_piecelv"];
    $an_capacitylv = $_POST["an_capacitylv"];
    $an_surfacel = $_POST["an_surfacel"];
    $an_piecel = $_POST["an_piecel"];

    $an_surfaceg =  $_POST["an_surfaceg"];
    $an_surfacebc =  $_POST["an_surfacebc"];
    $an_piecebc =  $_POST["an_piecebc"];
    $an_temploi =  $_POST["an_temploi"];
    $an_tcours =  $_POST["an_tcours"];
    $an_cporte =  $_POST["an_cporte"];
    $an_tporte =  $_POST["an_tporte"];
    $an_pporte =  $_POST["an_pporte"];
    $an_cmonbij = $_POST["an_cmonbij"];
    $an_mmonbij =  $_POST["an_mmonbij"];
    $an_pmonbij =  $_POST["an_pmonbij"];
    $an_imgson =  $_POST["an_imgson"];
    $an_info =  $_POST["an_info"];
    $an_tel = $_POST["an_tel"];
    $an_jeu = $_POST["an_jeu"];

    $an_genref = $_POST["an_genref"];
	$an_nombref = $_POST["an_nombref"];
    $an_genrem = $_POST["an_genrem"];
    $an_nombrem = $_POST["an_nombrem"];
    $an_cond = $_POST["terms"];

    $photo = $_FILES['photo']['name'];

	$query = "INSERT INTO an_annonces SET id_membres = ?, an_souscat = ?, an_type = ?, an_title = ?, an_desc = ?, an_marquev = ?, an_kmeterv = ?, an_kmeterm = ?, an_kmeterc = ?, an_anneev = ?, an_anneem = ?, an_anneec = ?, an_energyv = ?, an_energyc = ?, an_vitessev = ?, an_cylinder = ?, an_vitessec = ?, an_surfacevm = ?, an_surfacelm = ?, an_surfacet = ?, an_surfacelv = ?, an_surfacecl = ?, an_surfaceg = ?, an_surfacel = ?, an_surfacebc = ?, an_piecevm = ?, an_piecelm = ?, an_piececl = ?, an_piecelv = ?, an_piecel = ?, an_piecebc = ?, an_capacityvm = ?, an_capacitylm = ?, an_capacitycl = ?, an_capacitylv = ?, an_debutlv = ?, an_finlv = ?, an_genref = ?, an_genrem = ?, an_nombref = ?, an_nombrem = ?, an_temploi = ?, an_tcours = ?, an_cporte = ?, an_tporte = ?, an_pporte = ?, an_cmonbij = ?, an_mmonbij = ?, an_pmonbij = ?, an_imgson = ?, an_info = ?, an_tel =?, an_jeu =?, an_price =?, an_region =?, an_city =?, an_postcode = ?, an_address = ?, an_cond = ?, an_photo1 = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', $id_membres, $category, $type, $title, $desc, $an_marquev, $an_kmeterv, $an_kmeterm, $an_kmeterc, $an_anneev, $an_anneem, $an_anneec, $an_energyv, $an_energyc, $an_vitessev, $an_cylinder, $an_vitessec, $an_surfacevm, $an_surfacelm, $an_surfacet, $an_surfacelv, $an_surfacecl, $an_surfaceg, $an_surfacel, $an_surfacebc, $an_piecevm, $an_piecelm, $an_piececl, $an_piecelv, $an_piecel, $an_piecebc, $an_capacityvm, $an_capacitylm, $an_capacitycl, $an_capacitylv, $an_debutlv, $an_finlv, $an_genref, $an_genrem, $an_nombref, $an_nombrem, $an_temploi, $an_tcours, $an_cporte, $an_tporte, $an_pporte, $an_cmonbij, $an_mmonbij, $an_pmonbij, $an_imgson, $an_info, $an_tel, $an_jeu, $price, $region, $city, $postCode, $address ,$an_cond, $photo);
    $result = $stmt->execute();
}

$conn->close();

header('Location:../allAdvs.php');
 ?>