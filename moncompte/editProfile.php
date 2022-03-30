<?php
include "inc/header.php";

if (!isset($_SESSION['id'])) {
	header("Location: ../connexion.php");
} 
else { 
	$membre = $_SESSION['id'];


 ?>
 <div class="container-100 header-end"></div>

<div class="container-100">
	<div class="container-100-child forms">
		<h1>Mes informations</h1>
		<?php 
			$sql = "SELECT * FROM membres WHERE id=".$membre;
			$result = $conn->query($sql);

			if ($result->num_rows > 0) :
				if ($row = $result->fetch_assoc()) :
		 ?>
		<form id="profileForm">
			<div>
				<input type="hidden" id="a_type" value="<?= $row['account_type'] ?>">
				<input id="u" type="hidden" name="" value="<?= $_GET['u'] ?>">
				<label class="comp">Nom de la compagnie</label>
				<input id="c_name" type="text" class="comp" name="comp_name" placeholder="Nom de votre entreprise" value="<?= $row['comp_name'] ?>" />
				<label class="comp">Numero de la compagnie</label>
				<input id="c_num" type="text" class="comp" name="comp_num" placeholder="N° Entreprise" value="<?= $row['comp_num'] ?>" />
				
				<label>Nom</label>
				<input id="name" type="text" class="" name="name" placeholder="Votre nom" value="<?= $row['name'] ?>" />
				<label>Prenom</label>
				<input id="f_name" type="text" class="" name="first_name" placeholder="Votre prénom" value="<?= $row['first_name'] ?>" />
				
				<label>Region</label>
				<?php 
					$reg = $row['region'];
					$sql_ = "SELECT * FROM an_region WHERE id=".$reg;
					$result_ = $conn->query($sql_);

					if ($result_->num_rows > 0) :
						if ($row_ = $result_->fetch_assoc()) :
				 ?>
				<input type="text" name="" value="<?= $row_['label'] ?>" readonly="readonly">
				<?php 
						endif; 
					endif;
				 ?>
				<label>Changer la region</label>
				<select id="reg" name="reg">
					<option value="0">Choisissez la région</option>
					<?php 
						$sql_1 = "SELECT * FROM an_region";
						$result_1 = $conn->query($sql_1);

						if ($result_1->num_rows > 0) :
							while ($row_1 = $result_1->fetch_assoc()) :
				 	?>
					<option value="<?= $row_1['id'] ?>"><?= $row_1['label'] ?></option>
					<?php 
							endwhile; 
						endif;
					 ?>
				</select>
				
				<label>Adresse</label>
				<input id="addr" type="text" class="" name="address" placeholder="Votre adresse" value="<?= $row['address']  ?>" />
				
				<label>Code Postal</label>
				<input id="p_code" type="text" class="" name="postcode" placeholder="Votre code postal (ex : 101)" value="<?= $row['post_code'] ?>" />
				
				<label>Ville</label>
				<input id="city" type="text" class="" name="city" placeholder="Votre ville" value="<?= $row['city'] ?>" />
				
				<label>Numero telephone</label>	
				<input id="phone" type="text" class="" name="phone" placeholder="Votre numéro de téléphone" value="<?= $row['phone'] ?>" />

				<label>Email</label>
				<input type="text" class="" name="email" placeholder="Votre email" value="<?= $row['email'] ?>" readonly="true" />
			</div>
			<input type="submit" value="Modifier" />
		</form>
		<?php 
				endif;
			endif;
		 ?>
	</div>
</div>

<?php 
	include "inc/footer.php";
 ?>
 <?php 
}
  ?>
 
 <script type="text/javascript">
 	$(function(){
 		var a_type = $("#a_type").val();
 		var u = $('#u').val();
 		var c_name = $('#c_name').val();
 		var c_num = $('#c_num').val();
 		var name = $('#name').val();
 		var f_name = $('#f_name').val();
 		var reg = ($('#reg').val() === "0") ? '' : $('#reg').val();
 		var addr = $('#addr').val();
 		var p_code = $('#p_code').val();
 		var city = $('#city').val();
 		var phone = $('#phone').val();

 		if (a_type === "MEMBRE") {
 			$(".comp").attr("disabled", true).hide();
 		}

 		$('#profileForm').on('submit', function(){
 			$.post(
 				'../ajax/postProfile.php',
 				{
 					u: u
			 		c_name: c_name,
			 		c_num: c_num,
			 		name: name,
			 		f_name: f_name,
			 		reg: reg,
			 		addr: addr,
			 		p_code: p_code,
			 		city: city,
			 		phone: phone
 				},
 				function(data, status) {
 					alert(data);
 				}
 			);
 		});
 	});
 </script>