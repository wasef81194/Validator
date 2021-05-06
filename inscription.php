<?php

include_once 'function.php';
include_once './class/bdd/connexionbdd.php';
include_once './class/inscription/forminscription.php';

//----------------------------------------------------------------------------------------------
echo Nav('Inscription');
$ConnexionBDD = New ConnexionBDD ('mysql-validator.alwaysdata.net','validator_data','validator','wasef01*');// Appel de la class


echo FormInscription();
if ($_POST["formtype"] == "inscription") {
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$tel =  $_POST['tel'];
	$login =  $_POST['login'];
	$password = $_POST['password'];
	$Inscription = new FormInscription($nom,$prenom,$email, $tel,$login, $password);
	$ChekForm = $Inscription->CehckForm();
	//echo $Inscription;
	//echo $ChekForm;
	if ($ChekForm == 1) {
		echo 'OKKKKKKKKKKKKKK';
	}
	else{
		echo $ChekForm;
	}
}
echo Footer();


?>
