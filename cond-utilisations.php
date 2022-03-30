<?php
	include("include/header.php");
?>
<title>Conditions générales d'utilisation</title>
<div class="container-100 header-end"></div>



<!-- Script PHP/MYSQL of management of classifieds ads developed by Script PAG. Script PAG all rights reserved. Use under license. http://www.script-pag.com -->
<div class="container-100">
	<div class="container-100-child text-page">

		<h1>Conditions générales d'utilisation</h1>
		
		<button class="accordion">Section 1</button>
		<div class="panel">
		  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>

		<button class="accordion">2 OBJET:</button>
		<div class="panel">
		  <p>Les présentes Conditions Générales de Vente (CGV) établissent les conditions contractuelles applicables à toute souscription, par un Annonceur connecté à son Compte Personnel, d'option(s) payante(s) et d’achat de crédits depuis le Site Internet MBM.</p>
		</div>

		<button class="accordion">3 ACCEPTATION:</button>
		<div class="panel">
		  <p>Toute souscription d'option(s) payante(s) et/ou achat de crédits par un Annonceur vaut acceptation pleine et entière des CGV en vigueur.</p>
		</div>

		<button class="accordion">4 MODALITES DE SOUSCRIPTION:</button>
		<div class="panel">
		  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>
	
	</div>
</div>
<div class="container-100 header-end"></div>
<?php
	include("include/footer.php");
?>
<style>
.accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #78aa27; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
  border: 1px solid #78aa27;
}
</style>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
