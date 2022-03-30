<?php
	require "include/header.php";
	//include 'controller/auth_controller.php';
?>
<title>Se connecter</title>
<div class="container-100 header-end"></div>

<style media="screen">
	.error{
		width: 100%;
	}
</style>

<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG. Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="container-100">
	<div class="container-100-child forms connexion-form flex-container">

		<div>
			<h1>Connexion à votre compte</h1>
			<form id="form_login" method="POST" action="">
				<div>
					<div id="error_show" class="alert alert-danger" style="display:none;">

					</div>
					<div id="success_show" class="alert alert-success" style="display:none;">

					</div>
					<a class="button-facebook-connect" href="https://www.facebook.com/v2.10/dialog/oauth?client_id=1409867919278394&amp;state=7cc09fec853040001dce04a6aa788031&amp;response_type=code&amp;sdk=php-sdk-5.6.1&amp;redirect_uri=https%3A%2F%2Fwww.script-pag.com%2Fdemo%2FPagrowoc%2Ffb_connect.php%3Ftype%3D0&amp;scope=email">Se connecter avec Facebook</a>
					<input type="text" id="email" name="email" placeholder="Adresse email" <?php if (isset($_POST['postLogin'])): ?>
											value="<?php echo $_POST['email']; ?>"
										<?php endif; ?> />
					<input type="password" id="mdp" name="mdp" placeholder="Mot de passe" value="" />

					<input type="checkbox" id="remember" name="remember" style="color:#7A1616;float: left;" /> 
					<label for="remember">
						Se souvenir de moi <a href="acc_password.html" class="forgot-password-link ">Mot de passe oublié ?</a>
					</label>
					
						<input type="hidden" id="login" value="login" />
						<Button type="submit" id="btnLogin" name="postLogin" >Se connecter</Button>
				</div>

			</form>
		</div>

		<div>
			<h3>Pas encore de compte ?</h3>

			<a class="button" href="inscription1.php">Créer un compte membre</a>

			<a class="button" href="inscription2.php">Créer un compte PRO</a>
		</div>

	</div>
</div>

<?php
	require "include/footer.php";
?>
<script>
	var visit_latitude = 0;
	var visit_longitude = 0;
</script>
<script type="text/javascript">


$("#form_login").validate({
	highlight: function(element) {
		$(element).parents('.form').addClass('error');
	},
	unhighlight: function(element) {
		$(element).parents('.form').removeClass('error');
	},
	rules: {
		'email':{
			required: true
		},
		'mdp':{
			required: true
		}
	},
	messages:{

		'email':{
			required: "<div class='alert alert-danger'> Entrer votre E-mail </div>"
		},
		'mdp':{
			required: "<div class='alert alert-danger'> Entrer votre mot de passe </div>"
		}
	},
	submitHandler: function(form) {
			login();
		}
});


$('#btnLogin').on('click',function(){
  $("#form_login").valid();
});

function login(){
	$("#btnLogin").text("");
	$("#btnLogin").append("<i class='fa fa-spinner fa-spin'></i> Connexion en cours..");
	$("#error_show").hide();
	$("#success_show").hide();
	var email = $("#email").val();
	var mdp = $("#mdp").val();
	var login= $("#login").val();
	var remember = "";
				if($('input[name="remember"]').is(':checked'))
				{
				  	// checked
				  	remember = "1";
				  	//console.log("checked");
				}
				else
				{
				 	// unchecked
				 	remember = "0";
				 	//console.log("unchecked");
				}
	$.post('controller/auth_controller.php',
		{
		 	email : email,
		 	mdp : mdp,
			login:login
		},
		function(data)
		{

			$("#success_show").text("");
			$("#error_show").text("");
				if(data == "success")
				{
					if(remember == "1"){
						setCookie("username", email);
						setCookie("password", mdp);
						//alert(getCookie("username"));
					}
					else{
						eraseCookie("username");
						eraseCookie("password");
					}
					setCookie("remember", remember);
					$("#error_show").hide();
					$("#success_show").append("<i class='fa fa-check-circle'></i> Connexion réussie");
					$("#success_show").fadeIn(1000).show();
					setTimeout(function()
					{
						$("#success_show").fadeOut(500).hide();
						$("#btnLogin").text("");
						$("#btnLogin").append("<i class='fa fa-spinner fa-spin'></i> Patientez ..");
						setTimeout(function()
						{
							//alert("moncopte");
							window.location.href='moncompte/';
						}, 1000);
					}, 2000);
				}
				else if(data== "error1")
				{
					$("#success_show").hide();
					setTimeout(function()
					{
						$("#error_show").append("Email ou mot de passe incorrecte");
						$("#error_show").fadeIn(500).show();
						$("#btnLogin").text("Se connecter");
					}, 1000);

				}
				else
				{
					$("#success_show").hide();
					setTimeout(function()
					{
						$("#error_show").append("Erreur de connexion");
						$("#error_show").fadeIn(500).show();
						$("#btnLogin").text("Se connecter");
					}, 1000);
				}
		},
		'text');
}

if(getCookie("username") != ""){
		$("#email").val(getCookie("username"));
	}

	if(getCookie("password") != ""){
		$("#mdp").val(getCookie("password"));
	}

	if(getCookie("remember") == "1"){
		$("#remember").attr("checked",true);
	}


	function setCookie(cname, cvalue) {
		  var d = new Date();
		  d.setTime(d.getTime() + (360*24*60*60*1000));
		  var expires = "expires="+ d.toUTCString();
		  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookie(cname) {
		  var name = cname + "=";
		  var decodedCookie = decodeURIComponent(document.cookie);
		  var ca = decodedCookie.split(';');
		  for(var i = 0; i <ca.length; i++) {
		    var c = ca[i];
		    while (c.charAt(0) == ' ') {
		      c = c.substring(1);
		    }
		    if (c.indexOf(name) == 0) {
		      return c.substring(name.length, c.length);
		    }
		  }
		  return "";
		}
		function eraseCookie(name) {   
		    setCookie(name, ""); 
		}
</script>
<script src="../js/map.js"></script>




<script>
window.___gcfg = {lang: 'fr'};

(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = '../../../../apis.google.com/js/platform.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>

<script>
	var more_premium = new dialogBox();
	more_premium.init({
		container: 'body',
		wrapper: {element: 'div', id: 'more-premium-box'},
		triggered: {event: 'click', element: '.more-premium-box'},
		width: '50%',
		height: '50%',
		content: 'https://www.script-pag.com/demo/Pagrowoc/more_premium.php',
		active_breakpoint: true,
		breakpoint: {width: 501, height: 501},
		breakpoint_dimensions: {width: '90%', height: '90%'}
	});
	</script>

</body>

<!-- Mirrored from www.script-pag.com/demo/Pagrowoc/fr/acc_connexion.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 16:39:12 GMT -->
</html>
