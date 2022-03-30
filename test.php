<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test Bootstrap</title>
	<!--<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />-->
	<link rel="stylesheet" type="text/css" href="css/design.css">
</head>
<body>
	<select id="options" name="an_souscat[]" class="short">
		<option value="0">Choisissez la catégorie</option>
		<?php
			$server = "localhost";
			$user = "root";
			$password = "";
			$db = "pannonce";

			$conn = new mysqli($server, $user, $password, $db);

			if ($conn->connect_errno > 0) {
				trigger_error($db->connect_error);
			}
			else {
				$sql = "SELECT  c.id as id, c.label as cat FROM an_categorie c";

				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
					echo '<option value="0" disabled class="background_select_cat uppercase" style="background:#F5F5F5;">-- '.strtoupper($row['cat']).' --</option>';
					$idCat = $row['id'];

					$sql2 = "SELECT s.id as id, s.label as scat FROM an_souscat s WHERE s.id_cat=".$idCat;

					$result2 = $conn->query($sql2);
					while($row2 = $result2->fetch_assoc()) {
						echo '<option value="'.$row2['id'].'">'.$row2['scat'].'</option>';
					}
				}
			}
			
			$conn->close();
		?>
	</select>
	<select id="form_country" name="reg[]" class="short">
		<option value="0">Choisissez la région</option>
		<?php
			$server = "localhost";
			$user = "root";
			$password = "";
			$db = "pannonce";

			$conn = new mysqli($server, $user, $password, $db);

			if ($conn->connect_errno > 0) {
				trigger_error($db->connect_error);
			}
			else {
				$sql = "SELECT  r.id as id, r.label as reg FROM an_region r";

				$result = $conn->query($sql);
				while($row = $result->fetch_assoc()) {
					echo '<option value="'.$row['id'].'">'.$row['reg'].'</option>';
				}
			}
			
			$conn->close();
		?>
	</select>
	<form action="postTest.php" method="post" enctype="multipart/form-data">
		<input id="file" type="file" name="file">
		<input type="submit" name="btn" value="Upload">
	</form>
	<script src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript">
		$(function(){
			$("#options").on("change", function(){
				console.log($(this).val());
			});

			$("#file").on("change", function(){
				//console.log($(this).val());
			});
		});
	</script>
</div>
</body>
</html>