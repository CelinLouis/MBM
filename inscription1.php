<?php
	include("include/header.php");
?>
<title>Créer un compte </title>
<style media="screen">
	.error{
		width:100%;
	}
</style>
<div class="container-100 header-end"></div>



<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG. Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="container-100">
	<div class="container-100-child forms">
		<h1>Création de votre compte membre</h1>
		<form id="inscriptionS" method="post" action="">
			<div>
				<a class="button-facebook-connect" href="https://www.facebook.com/v2.10/dialog/oauth?client_id=1409867919278394&amp;state=7cc09fec853040001dce04a6aa788031&amp;response_type=code&amp;sdk=php-sdk-5.6.1&amp;redirect_uri=https%3A%2F%2Fwww.script-pag.com%2Fdemo%2FPagrowoc%2Ffb_connect.php%3Ftype%3D1&amp;scope=email">Créer un compte avec Facebook</a>

				<input type="hidden" name="ip"  />
				<select id="civility" name="civility[]">
					<option value="0"  >Vous êtes ?</option>
					<option value="Homme"  >Homme</option>
					<option value="Femme"  >Femme</option>
				</select>
				<label for="civility[]" class="error" style="display:none;">Please choose one.</label>
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="" id="name" name="name" placeholder="Nom" value="<?= isset($_GET['name']) ? $_GET['name'] : ''; ?>" />
					</div>
					<div class="col-md-6">
						<input type="text" class="" id="first_name" name="first_name" placeholder="Prénom" value="<?= isset($_GET['f_name']) ? $_GET['f_name'] : ''; ?>" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<select style="width:100%" id="region" name="region[]" >
							<option value="0">Choisissez votre région</option>

							<?php
								$req = $conn->query("SELECT * FROM an_region");
								while($res=$req->fetch_assoc())
								{
								?>
									<option name="an_region" value="<?php echo $res['id'] ?>"><?php echo $res['label'] ?></option>
								<?php
								}
							 ?>
						</select>
						<div id="display_counties"></div>
					</div>
					<div class="col-md-6">
						<input type="text" class="" id="city" name="city" placeholder="Ville" value="<?= isset($_GET['city']) ? $_GET['city'] : ''; ?>" />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<input type="text" class="" id="post_code" name="post_code" placeholder="Code postal (ex : 401)" value="<?= isset($_GET['pc']) ? $_GET['pc'] : ''; ?>" />
					</div>
					<div class="col-md-6">
						<input type="text" class="" id="address" name="address" placeholder="Adresse" value="<?= isset($_GET['addr']) ? $_GET['addr'] : ''; ?>" />
					</div>
				</div>

				<div class="row">
				  <div class="col-md-6">
				    <input type="text" class="" id="phone" name="phone" placeholder="Votre numéro de téléphone" value="<?= isset($_GET['tel']) ? $_GET['tel'] : ''; ?>" />
				  </div>
				  <div class="col-md-6">
				    <input type="text" class="" id="email" name="email" placeholder="Votre email" value="<?= isset($_GET['mail']) ? $_GET['mail'] : ''; ?>" />
				  </div>
				</div>

				<div class="row">
				  <div class="col-md-6">
				    <input type="password" class="" id="mdp" name="mdp" placeholder="Mot de passe" value="" />
				  </div>
				  <div class="col-md-6">
				    <input type="password" class="" id="cmdp" name="cmdp" placeholder="Confirmez mot de passe" value="" />
				  </div>
				</div>

				<di>
					<input type="checkbox" id="gtc" name="gtc" value="1"  />
					<label for="gtc">Je reconnais avoir lu et accepter les <a href="info/Conditions-generales-d-utilisation-3.html" class="first-color bold" target="_blank">Conditions générales d'utilisation</a> et la <a href="info/Politique-de-confidentialite-5.html" class="first-color bold" target="_blank">Politique de confidentialité</a></label>
					<label for="gtc" class="error" style="display:none;">Please choose one.</label>
				</di>
					<input type="hidden"  id="inscriptionS" name="inscriptionS" value="inscriptionS">
					<button type="submit" id="btn_submit" > Valider  </button><br>
					<div id="error_show" class="alert alert-danger" style="display:none;">

					</div>
					<div id="success_show" class="alert alert-success" style="display:none;">

					</div>
			</div>

		</form>
	</div>
</div>

<?php
	include("include/footer.php");
?>
<script>
	var visit_latitude = 0;
	var visit_longitude = 0;
</script>
<script type="text/javascript">


$("#inscriptionS").validate({
	highlight: function(element) {
		$(element).parents('.form').addClass('error');
	},
	unhighlight: function(element) {
		$(element).parents('.form').removeClass('error');
	},
	rules: {
		'civility[]':{
			valueNotEquals: "0"
		},
		name:{
			required:true
		},
		first_name:{
			required:true
		},
		'region[]':{
			valueNotEquals: "0"
		},
		'city':{
			required: true
		},
		'post_code':{
			required: true
		},
		'address':{
			required: true
		},
		'phone':{
			required: true,
			regex: /^(\+33\.|0)[0-9]{9}$/
		},
		'email':{
			required: true,
      email: true
		},
		'mdp':{
			required: true,
			minlength:8
		},
		'cmdp':{
			required: true,
			equalTo: "#mdp"
		},
		'gtc':{
			required:true
		}
	},
	messages:{
		'civility[]':{
			valueNotEquals: "<div class='alert alert-danger'> Vous êtes un homme ou une femme? </div>"
		},
		name: { required: "<div class='alert alert-danger'> Entrer votre nom! </div>" },
		first_name:{ required: "<div class='alert alert-danger' style='width:100%'> Entrer votre prénom! </div>" },
		'region[]':{
			valueNotEquals: "<div class='alert alert-danger'> Choisissez votre région! </div>"
		},
		'city':{
			required: "<div class='alert alert-danger'> Entrer votre ville! </div>"
		},
		'post_code':{
			required: "<div class='alert alert-danger'> Entrer votre code postal! </div>"
		},
		'address':{
			required: "<div class='alert alert-danger'> Entrer votre adresse! </div>"
		},
		'phone':{
			required: "<div class='alert alert-danger'> Entrer numéro télephone! </div>",
			regex:"<div class='alert alert-danger'> Votre numéro est invalide! </div>"
		},
		'email':{
			required: "<div class='alert alert-danger'> Entrer votre E-mail </div>",
      email: "<div class='alert alert-danger'> Adresse E-mail invalide </div>"
		},
		'mdp':{
			required: "<div class='alert alert-danger'> Entrer votre mot de passe </div>",
			minlength: "<div class='alert alert-danger'> {0} caractères minimum </div> "
		},
		'cmdp':{
			required: "<div class='alert alert-danger'> Confirmez mot de passe </div>",
			equalTo: "<div class='alert alert-danger'> Les deux mot de passe doivent être identiques </div>"
		},
		'gtc':{
			required: "<div class='alert alert-danger'> Accepteriez vous nos conditions et règlements ? </div>"
		}
	},
	submitHandler: function(form) {
			inscriptionS();
		}
});


$('#btn_submit').on('click',function(){
  $("#inscriptionS").valid();
});

function inscriptionS(){
	$("#btn_submit").text("");
	$("#btn_submit").append("<i class='fa fa-spinner fa-spin'></i> Inscription en cours..");
	$("#error_show").hide();
	$("#success_show").hide();
	var civility = $("#civility").val();
	var name = $("#name").val();
	var first_name = $("#first_name").val();
	var region = $("#region").val();
	var city = $("#city").val();
	var post_code = $("#post_code").val();
	var address = $("#address").val();
	var phone = $("#phone").val();
	var email = $("#email").val();
	var mdp = $("#mdp").val();
	var gtc = $("#gtc").val();
	var inscriptionS = $("#inscriptionS").val();
	$.post('controller/auth_controller.php',
		{
		 	civility : civility,
		 	name : name,
		 	first_name : first_name,
		 	region : region,
		 	city : city,
		 	post_code : post_code,
		 	address : address,
		 	phone : phone,
		 	email : email,
		 	mdp : mdp,
			gtc : gtc,
		 	inscriptionS : inscriptionS,

		},
		function(data)
		{
			//console.log(data);
			$("#success_show").text("");
			$("#error_show").text("");
			if(data.length> 0){
				if(data.includes("success")){
					$("#error_show").hide();
					$("#success_show").append("Insertion réussie");
					$("#success_show").fadeIn(1000).show();
					setTimeout(function()
					{
						$("#success_show").fadeOut(500).hide();
						$("#btn_submit").text("");
						$("#btn_submit").append("<i class='fa fa-spinner fa-spin'></i> Patientez ..");
						setTimeout(function()
						{
							window.location.href='connexion.php';
						}, 3000);
					}, 3000);
				}
				else{
					$("#success_show").hide();
					setTimeout(function()
					{
						for (var i = 0; i < data.length; i++) {
							$("#error_show").append(data[i]+"<br>");
							//console.log(data[i]);
						}
						$("#error_show").fadeIn(500).show();
						$("#btn_submit").text("Valider");
					}, 2000);

				}
			}


		},
		'json');
}
</script>
</body>

<!-- Mirrored from www.script-pag.com/demo/Pagrowoc/fr/acc_created.php?type=1 by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 16:42:16 GMT -->
</html>
