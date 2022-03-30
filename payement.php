<?php
	include("include/header.php");
	if (isset($_GET['an'])) {
		$req_mvola = $conn->query("SELECT * FROM an_parametre WHERE param_key = 'num_mvola' ");
		$req_orange = $conn->query("SELECT * FROM an_parametre WHERE param_key = 'num_orange_money' ");

		$num_mvola = $req_mvola->fetch_assoc();
		$num_orange_money = $req_orange->fetch_assoc();

		$id_an = $_GET['an'];
		$sql ="SELECT *, an_annonces.id as an_id, an_region.label as lblreg, an_souscat.label as lblsouscat, an_annonces.id_membres as id_membres FROM an_souscat,an_region,an_annonces WHERE an_souscat.id = an_annonces.an_souscat && an_annonces.id = '$id_an' && an_region.id = an_annonces.an_region";

		$req=$conn->query($sql);
		$r=$req->fetch_assoc();

		$sql2="SELECT * FROM membres WHERE id = '".$r['id_membres']."'";
		$req2=$conn->query($sql2);
		$r2=$req2->fetch_assoc();

		$fav="";
		if (isset($_SESSION['id'])) {
			$req=$conn->query("SELECT COUNT(*) as n FROM an_favori WHERE id_membres = '".$_SESSION['id']."' && id_annonces = '".$r['an_id']."' ");
			$res=$req->fetch_assoc();
			if($res['n']>0){ $fav = "selected"; }
		}

	}
?>
<title>Payement</title>
<style media="screen">
.info{
-webkit-animation: color-change 1s infinite;
-moz-animation: color-change 1s infinite;
-o-animation: color-change 1s infinite;
-ms-animation: color-change 1s infinite;
animation: color-change 1s infinite;
}
@-webkit-keyframes color-change {
0% { color: red; }
50% { color: blue; }
100% { color: red; }
}
@-moz-keyframes color-change {
0% { color: red; }
50% { color: blue; }
100% { color: red; }
}
@-ms-keyframes color-change {
0% { color: red; }
50% { color: blue; }
100% { color: red; }
}
@-o-keyframes color-change {
0% { color: red; }
50% { color: blue; }
100% { color: red; }
}
@keyframes color-change {
0% { color: red; }
50% { color: blue; }
100% { color: red; }
}
    .center {
      margin: 0 auto;
    }
    .awesome {
      font-family: futura;
      margin: 0 auto;
      text-align: center;
      color:#313131;
      font-weight: bold;
      -webkit-animation:colorchange 20s infinite alternate;
    }
    @-webkit-keyframes colorchange {
      0% {
        color: blue;
      }
      10% {
        color: #8e44ad;
      }
      20% {
        color: #1abc9c;
      }
      30% {
        color: #d35400;
      }
      40% {
        color: blue;
      }
      50% {
        color: #34495e;
      }

      60% {
        color: blue;
      }

      70% {
        color: #2980b9;
      }
      80% {
        color: #f1c40f;
      }

      90% {
        color: #2980b9;
      }
      100% {
        color: pink;
      }
    }
</style>
<div class="container-100 header-end"></div>
<div class="container-100">
	<div class="container-100-child ad-page-container">
		<div class="ad-page-parent-container flex-container">
			<div class="ad-page-large-container">
			    <div  class="ad-page-bloc-photo">
			    	<a  class="close" href="index.php" >&times;</a>
			    	<br>
			    	<div style="background: white;padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px; border-radius: 10px;box-shadow: 3px 3px 3px 3px #d3d3d3;">
			    		<h3>Payer via notre service de payement <br><b>Mobile Money ( <b>MM</b> )</b></h3>
			    		<center><h5>Sécuriser votre payement Chez <b>MBM</b></h5></center>
			    	</div><br>
			    	<div>
						<center><h5>Objet : <b><?php echo strtoupper($_GET['obj']); ?></b></center>
			    		<center><h5>Choisissez votre Opérateur</h5></center><br>
			    		<input id="id_annonces" type="hidden" name="" value="<?php echo $_GET['an'] ?>">
			    		<input id="type" type="hidden" name="" value="<?php echo $_GET['obj'] ?>">
			    		<input id="montant" type="hidden" name="" value="<?php echo $r['an_price'] ?>">
			    		<div class="row">
			    			<div class="col-md-5">
			    				<div class="telma" style="float: right;">
					    			<input type="radio" id="telma" name="mobile" onclick="mobile()" />
									<label for="telma"><!--img for="telma" src="images/mvola.png" style="width: 40%"-->
									<img style="background: red;width:120px;height:80px;" src="image/MVola.jpg" alt=""></label>
					    		</div>
			    			</div>
			    			<div class="col-md-5">
			    				<div class="orange" >
					    			<input type="radio" id="orange" name="mobile" onclick="mobile()" />
									<label for="orange"><!--img for="orange" src="images/orangemoney.png" style="width: 40%;height: 105px"-->
									<img style="background: red;width:120px;height:80px;" src="image/Orange.jpg" alt=""></label>
					    		</div>
			    			</div>

			    		</div>
			    	</div>
			    	<div align="center">
			    		<div id="malagasy" style="display: none;">
			                <div class="alert alert-warning">
			                	<h5>- Ouvrez l'application Téléphone dans votre Mobile;</h5>
			                	<h5>- Tapez ce code :
			                	<b class="awesome">#111*1*2*<?php echo $num_mvola['param_value'] ?>*<?php echo str_replace(" ", "", $r['an_price']); ?>#</b></h5>
			                	<h5>- Appelez via votre SIM Telma</h5>
			                	<h5>- Entrer ensuite votre code secret et valider</h5>
			                </div>
			                <h5>Entrer ci-dessous le numéro à laquel vous avez effectué votre transaction ( <b>Telma</b> ):</h5>
					    	<input id="input-telma" type="number" style="width: 300px;font-size: 30px;color: black" class=" input-keywords" name="numT" placeholder="034XXXXXXX">
					    	<input id="input-telma-numtransac" type="text" style="width: 300px;font-size: 30px;color: black" class=" input-keywords" name="numT" placeholder="Numéro de transaction">

			            </div>
			           	<div id="etrange" style="display: none;">
				           	<div class="alert alert-warning">
			                	<h5>- Ouvrez l'application Téléphone dans votre Mobile;</h5>
			                	<h5>- Tapez ce code :
			                	<b class="awesome">#144*1*3*<?php echo $num_orange_money['param_value'] ?>*<?php echo $num_orange_money['param_value'] ?>*<?php echo str_replace(" ", "", $r['an_price']); ?>*2#</b></h5>
			                	<h5>- Appelez via votre SIM Orange</h5>
			                	<h5>- Entrer ensuite votre code secret et valider</h5>
			                </div>
				        	<h5>Entrer ci-dessous le numéro à laquel vous avez effectué votre transaction ( <b>Orange</b> ):</h5>

					    	<input id="input-orange" type="number" style="width: 300px;font-size: 30px;color: black" class="input-keywords" name="numO" placeholder="032XXXXXXX">
					    	<input id="input-orange-numtransac" type="text" style="width: 300px;font-size: 30px;color: black" class=" input-keywords" name="numT" placeholder="Numéro de transaction">
			            </div>
			    	</div>
			    	<hr>
			    	<center><h4>À payer : <b><?php echo $r['an_price'] ?> Ariary</b></h4></center>
			        <div>
			        	<input id="txt_valider" type="hidden" name="" >
			        	<button id="valider_transaction" type="button" class="btn btn-success" >Valider transaction</button>
			        </div>
			    </div>
			</div>
	    	<div class="ad-page-small-container">
				<div class="ad-page-bloc-infos contact">
					<p><h3>Annonce</h3></p>
					<center><h4 itemprop="name" class="center"><?php echo $r['an_title'] ?></h4></center>
					<img src="<?php echo $r['an_photo1'] ?>" class="thumbnails" id="photo" alt="<?php echo $r['an_photo1'] ?>" width="150" height="150" style="border-color: red;">

					<a href="annonce-detail.php?an=<?php echo $r['an_id'] ?>"><img src="images/icons/icon_ad_contact_glass.png" alt=""> Voir plus de détail </a>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-100 header-end"></div>
<?php
	include("include/footer.php");
?>

<script>

$("#input-telma").on("keyup", function(){
	console.log($("#input-telma").val());
});


function mobile() {
  var checkBoxT = document.getElementById("telma");
  var textT = document.getElementById("malagasy");
  var checkBoxO = document.getElementById("orange");
  var textO = document.getElementById("etrange");

  if (checkBoxT.checked == true){
    textT.style.display = "block";
    $("#txt_valider").val("telma");
  } else {
     textT.style.display = "none";
  }

  if (checkBoxO.checked == true){
    textO.style.display = "block";
    $("#txt_valider").val("orange");
  } else {
     textO.style.display = "none";
  }

}

$("#valider_transaction").on("click", function() {
	if($("#txt_valider").val() == "orange"){
		//alert("orange");
		if($("#input-orange").val() ==""){
			alert("Numéro orange obligatoire");
		}
		else if($("#input-orange-numtransac").val() == ""){
			alert("Numéro transaction obligatoire");
		}
		else{
			
			$.post('ajax/inserer_transaction.php', {
				id_annonces : $("#id_annonces").val(),
				type : $("#type").val(),
				txt_valider : $("#txt_valider").val(),
				num_mobile : $("#input-orange").val(),
				num_transac : $("#input-orange-numtransac").val(),
				montant : $("#montant").val()
			}, 
              function(data) {
              	alert(data);
              	if (data == "success") {
              		setTimeout(function()
                    {
              			swal({
                              title: "",
                              text: "Votre transaction a été inséré en cours de validation",
                              type: "success"
                          	}, function() {
                            window.location.href = "index.php";
                        });

                    }, 500);
              	}
              	
              });	
		}
	}
	else {
		//alert("telma");
		if($("#input-telma").val() ==""){
			alert("Numéro telma obligatoire");
		}
		else if($("#input-telma-numtransac").val() == ""){
			alert("Numéro transaction obligatoire");
		}
		else{
			$.post('ajax/inserer_transaction.php', {
				id_annonces : $("#id_annonces").val(),
				type : $("#type").val(),
				txt_valider : $("#txt_valider").val(),
				num_mobile : $("#input-telma").val(),
				num_transac : $("#input-telma-numtransac").val(),
				montant : $("#montant").val()
			}, 
              function(data) {
              	alert(data);
              	if (data == "success") {
              		setTimeout(function()
                    {
              		swal({
                              title: "",
                              text: "Votre transaction a été inséré en cours de validation",
                              type: "success"
                          }, function() {
                            window.location.href = "moncompte/mes-transaction.php";
                        });

                    }, 500);
              	}
              });
		}
	}
});


</script>
