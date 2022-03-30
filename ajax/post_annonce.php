<?php
	//echo "lasa";
	require '../cnx.php';


        $id_membres = $_POST["id_membres"];;
        $an_souscat =$_POST["an_souscat"];
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
        $an_etat = $_POST["an_etat"];
        $an_type = $_POST["an_type"];
        $an_title = $_POST["an_title"];
        $an_desc = $_POST["an_desc"];
        $an_price = $_POST["an_price"];
        $an_region = $_POST["an_region"];
        $an_city = $_POST["an_city"];
        $an_postcode = $_POST["an_postcode"];
        $an_address = $_POST["an_address"];
        $an_cond = $_POST["an_cond"];

        $an_photo1 =  $_POST["an_photo1"];
        $an_photo2 =  $_POST["an_photo2"];
        $an_photo3 =  $_POST["an_photo3"];
        $an_photo4 =  $_POST["an_photo4"];
        $an_photo5 =  $_POST["an_photo5"];
        $an_photo6 =  $_POST["an_photo6"];
        $an_photo7 =  $_POST["an_photo7"];
        $an_photo8 =  $_POST["an_photo8"];


	$query = "INSERT INTO an_annonces SET id_membres = ?, an_souscat = ?, an_type = ?, an_title = ?, an_desc = ?, an_marquev = ?, an_kmeterv = ?, an_kmeterm = ?, an_kmeterc = ?, an_anneev = ?, an_anneem = ?, an_anneec = ?, an_energyv = ?, an_energyc = ?, an_vitessev = ?, an_cylinder = ?, an_vitessec = ?, an_surfacevm = ?, an_surfacelm = ?, an_surfacet = ?, an_surfacelv = ?, an_surfacecl = ?, an_surfaceg = ?, an_surfacel = ?, an_surfacebc = ?, an_piecevm = ?, an_piecelm = ?, an_piececl = ?, an_piecelv = ?, an_piecel = ?, an_piecebc = ?, an_capacityvm = ?, an_capacitylm = ?, an_capacitycl = ?, an_capacitylv = ?, an_debutlv = ?, an_finlv = ?, an_genref = ?, an_genrem = ?, an_nombref = ?, an_nombrem = ?, an_temploi = ?, an_tcours = ?, an_cporte = ?, an_tporte = ?, an_pporte = ?, an_cmonbij = ?, an_mmonbij = ?, an_pmonbij = ?, an_imgson = ?, an_info = ?, an_tel =?, an_jeu =?, an_price =?, an_region =?, an_city =?, an_postcode = ?, an_address = ?, an_cond = ?, an_photo1 = ?, an_photo2 = ?, an_photo3 = ?, an_photo4 = ?, an_photo5 = ?, an_photo6 = ?, an_photo7 = ?, an_photo8 = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', $id_membres, $an_souscat, $an_type, $an_title, $an_desc, $an_marquev, $an_kmeterv, $an_kmeterm, $an_kmeterc, $an_anneev, $an_anneem, $an_anneec, $an_energyv, $an_energyc, $an_vitessev, $an_cylinder, $an_vitessec, $an_surfacevm, $an_surfacelm, $an_surfacet, $an_surfacelv, $an_surfacecl, $an_surfaceg, $an_surfacel, $an_surfacebc, $an_piecevm, $an_piecelm, $an_piececl, $an_piecelv, $an_piecel, $an_piecebc, $an_capacityvm, $an_capacitylm, $an_capacitycl, $an_capacitylv, $an_debutlv, $an_finlv, $an_genref, $an_genrem, $an_nombref, $an_nombrem, $an_temploi, $an_tcours, $an_cporte, $an_tporte, $an_pporte, $an_cmonbij, $an_mmonbij, $an_pmonbij, $an_imgson, $an_info, $an_tel, $an_jeu, $an_price, $an_region, $an_city, $an_postcode, $an_address ,$an_cond, $an_photo1, $an_photo2, $an_photo3, $an_photo4, $an_photo5, $an_photo6, $an_photo7, $an_photo8);
        $result = $stmt->execute();

    if ($result) {
        $an_id = $stmt->insert_id;
        $stmt->close();
        echo $an_id;
    }

?>
