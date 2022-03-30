<?php 
if ($_POST['cookie'] === 1) {
	setcookie('nom', $var, time()+365*24*3600, '/', null, false, true);
	echo "ok";
}
else {
	echo "pas ok";
}

?>