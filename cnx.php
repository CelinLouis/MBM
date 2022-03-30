<?php 

	$servername = 'localhost';
	$usernam = 'root';
	$password = '';
	$dataname = 'chat_messager';

	try {
		$conn = new PDO("mysql:host=$servername;bname=$dataname",$usernam,$password);

		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		echo("connexion reussi");

	} catch (PDOException $e) {
		echo "Erreur" . $e->getMessage();
	}

	$conn = null;

?>