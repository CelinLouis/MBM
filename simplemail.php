<form action="" method="post">
    <label for="nom"> Nom : </label>
    <input type="text" placeholder="--" id="nom" name="nom">
    <label for="email"> Email : </label>
    <input type="text" placeholder="---@---.--" id="email" name="email">
    <label for="sujet"> Sujet : </label>
    <input type="text" placeholder="------" id="sujet" name="sujet">
    <label for="message"> Message : </label>
    <textarea id="message" name="message"></textarea>
    <input type="submit" id="envoi" name="envoi" value="ok">
</form>
<?php
if (isset($_POST['envoi'])) {
	$sujet = '=?UTF-8?B?'.base64_encode($sujet).'?=';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .='Content-Transfer-Encoding: 8bit'."\r\n" ;
$headers .= "From: $email" . "\r\n" . "Reply-To:$email" . "\r\n";
$message =  "Voici le méssage de $nom : <br>   $message ";
if(!mail("rakotonirinacelinlouis66@gmail.com", $sujet, $message, $headers)){
    echo "erreur";
}else{
    header("location:confirm.php");
}
}

?>